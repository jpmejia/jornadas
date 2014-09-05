<?php
/**
 * ScopedtreeBehavior
 * Enables a model to be sorted as a tree.
 * Some logic from TreeBehavior of CakePHP :  Rapid Development Framework (http://www.cakephp.org)
 * @author Martin Samson
 * @since 1.2
 * @todo Optimisations of the code.
 * @version 0.2
 * @see https://trac.cakephp.org/browser/trunk/cake/1.2.x.x/cake/libs/model/behaviors/tree.php
 */
class ScopedTreeBehavior extends ModelBehavior{
    var $config = array();
    
    /**
 ?   * Initiate  behavior
 ?   *
 ?   * @param object $Model
 ?   * @param array $config
 ?   * @return void
 ?   * @access public
 ?   */
    function setup(&$Model){
        $config['tree_id'] = 'project_id';
        $config['parent_id'] = 'parent_id';
        $config['order'] = 'order';
        $this->config = $config;
        $this->model =& $Model;
        $this->maxRecursive = 20;
    }
    
    /**
     * beforeSave Called before all saves
     *
     * Overriden to transparently manage the order of the record within the tree.
     *
     * @since         1.2
     * @param AppModel $Model
     * @return boolean true to continue, false to abort the save
     * @access public
    */
    function beforeSave(&$model){
        if(!$model->id){

            if(array_key_exists($this->config['parent_id'], $model->data[$model->alias]) && $model->data[$model->alias][$this->config['parent_id']]){
                $parent_id = $this->getParent($model,$model->data[$model->alias][$this->config['parent_id']]);
            }
            else{
                $parent_id = null;
            }
            if(array_key_exists($this->config['tree_id'], $model->data[$model->alias]) && $model->data[$model->alias][$this->config['tree_id']]){
                $tree_id = $model->data[$model->alias][$this->config['tree_id']];
            }
            else{
                return false;
            }
            
            $order = $this->getMax($tree_id,$parent_id);
            $order++;
        
            
            $model->data[$model->alias][$this->config['order']] = $order;
        }
        return true;
    }

    /**
     * moveDown
     *
     * Allows moving down a node inside it's level.
     * A node cannot change level or parent
     * @param AppModel $model
     * @param mixed $node_id The node id to use.
     * @param mixed $tree_id The tree to work in.
     * @param AppModel $node If specified, will use the provided node.
     * @return boolean
     */
    public function moveDown(&$model,$node_id,$tree_id,$node = null){
        if(!$node){
            $node = $this->getNode($model,$node_id);
            if(!$node){
                return false;
            }
        }
        $options = array();
        $options['conditions'] = array();
        $options['conditions'][$model->alias .'.'. $this->config['tree_id']] = $tree_id;
        $options['conditions'][$model->alias .'.'. $this->config['parent_id']] = $node[$model->alias]['parent_id'];
        $options['conditions'][$model->alias .'.'. $this->config['order'] .' >'] = $node[$model->alias]['order'];
        $options['order'] = array($model->alias .'.'. $this->config['order'] .' ASC');
        $options['contain'] = array();
        $down = $model->find('first', $options);
        if($down){

            $nodeDown = array($model->primaryKey => $down[$model->alias][$model->primaryKey], $this->config['order'] => $down[$model->alias][$this->config['order']] - 1);
            $nodeCur = array($model->primaryKey => $node_id, $this->config['order'] => $node[$model->alias][$this->config['order']] + 1);
            
            $models = array();
            $models[0] = $nodeCur;
            $models[1] = $nodeDown;
            return $model->saveAll($models);
        }
        return false;
        
        
    }

    /**
     * moveUp
     *
     * Allows moving up a node inside it's parent
     * A node cannot change parent
     * @param AppModel $model
     * @param mixed $node_id The node id to use.
     * @param mixed $tree_id The tree to work in.
     * @param AppModel $node If specified, will use the provided node.
     * @return boolean
     */
    public function moveUp(&$model,$node_id,$tree_id,$node = null){
        if(!$node){
            $node = $this->getNode($model,$node_id);
            if(!$node){
                return false;
            }
        }
        $options = array();
        $options['conditions'] = array();
        $options['conditions'][$model->alias .'.'. $this->config['tree_id']] = $tree_id;
        $options['conditions'][$model->alias .'.'. $this->config['parent_id']] = $node[$model->alias][$this->config['parent_id']];
        $options['conditions'][$model->alias .'.'. $this->config['order'] .' <'] = $node[$model->alias][$this->config['order']];
        $options['order'] = array($model->alias .'.'. $this->config['order'] .' DESC');
        $options['contain'] = array();
        $down = $model->find('first', $options);
        if($down){

            $nodeUp = array($model->primaryKey => $down[$model->alias][$model->primaryKey], $this->config['order'] => $down[$model->alias][$this->config['order']] + 1);
            $nodeCur = array($model->primaryKey => $node_id, $this->config['order'] => $node[$model->alias][$this->config['order']] - 1);
            
            $models = array();
            $models[0] = $nodeCur;
            $models[1] = $nodeUp;
            return $model->saveAll($models);
        }
        return false;        
    }
    /**
     * removeFromTree
     *
     * Remove a node from the tree and move all the child nodes under it's parent.
     * @param AppModel $model
     * @param mixed $id The id of the node to be removed
     * @param boolean $atomic If set to True, will use transactions. (default)
     * @return boolean
     */
    public function removeFromTree(&$model,$id,$node = null,$atomic = true){
        if(!$node){
            $node = $this->getNode($model,$id);
            if(!$node){
                return false;
            }
        }
        
        
        // 1: update all the child nodes of the node to be removed.
        $conditions = array($model->alias.'.'.$this->config['tree_id'] => $node[$model->alias][$this->config['tree_id']],
                            $model->alias.'.'.$this->config['parent_id'] => $id);
        $db =& ConnectionManager::getDataSource($model->useDbConfig);
        $parentField = $model->alias .'.'.$this->config['parent_id'];
        $parent_id = $node[$model->alias][$this->config['parent_id']];
        $tree_id = $node[$model->alias][$this->config['tree_id']];
        if($atomic){
            $db->begin($this);
        }
        $model->updateAll(array($parentField => $db->value($parent_id, $parentField)), $conditions);
        //2: Remove the node entry.
        $model->delete($id);
        
        //3: Update the ordering of the childs and the level the node was in.
        $subtree = $this->getChilds($model,$tree_id,$parent_id,array($model->alias.'.'.$model->primaryKey,$model->alias.'.'.$this->config['order']));
        $this->syncLevel($model,$subtree);
        
        if($atomic){
            $db->commit($this);
            return true;
        }
        return false;
    }
    /**
     * syncLevel
     * Syncs the order of all the nodes of a level (common parent).
     * @param AppModel $model
     * @param array $subtree The nodes to sync together.
     * @access private
     * @return void
     *
     */
    private function syncLevel(&$model,&$subtree){
        $i = 0;
        foreach($subtree as $key=>$node){
            $node[$model->alias][$this->config['order']] = $i;
            $subtree[$key] = $node;
            $i++;
        }
        $model->saveAll($subtree);
    }
    public function getChilds(&$model,$tree_id,$parent_id, $fields = null){
        $options = array();
        $options['contain'] = array();
        if($fields){
            $options['fields'] = $fields;
        }
        $options['conditions'] = array($model->alias.'.'. $this->config['tree_id'] => $tree_id,
                                       $model->alias.'.'. $this->config['parent_id'] => $parent_id);
        $options['order'] = array($model->alias.'.'.$this->config['order'] .' ASC');
        return $model->find('all', $options);
        
    }
    /**
     * generateTree Generates the tree structure for the specified tree scope.
     * @param AppModel $model
     * @param mixed $tree_id The project id to generate the tree for.
     * @return array The structured tree as an array.
     */
    public function generateTree(&$model,$tree_id){
        $options = array();
        $options['contain'] = array();
        $options['conditions'] = array($model->alias.'.'. $this->config['tree_id'] => $tree_id);
        $options['order'] = array($model->alias.'.'.$this->config['order'] .' ASC');
        $rawtree = $model->find('all', $options);
        return $this->getTree($rawtree,null);
    }
    /**
     * getTree Format a raw database tree into a structured tree.
     * The function is recursive. It builds all the childs elements.
     * @param array $rawtree The database raw results
     * @param mixed $parent_id The parent id to structure for.
     * @param integer $recursive The level of recursiveness to allow/limit.
     * @return array The structured tree array.
     */
    public function getTree(&$rawtree,$parent_id,$recursive = 0){
        $tmpTree = array();
        if($recursive > $this->maxRecursive){
            return $tmpTree;
        }
        foreach($rawtree as $key => $node){
            if($node[$this->model->alias][$this->config['parent_id']] == $parent_id){

                //get the child nodes of the current node
                $node['childs'] = $this->getTree($rawtree,$node[$this->model->alias][$this->model->primaryKey],$recursive + 1);
                
                //add the node to the tmptree.
                $tmpTree[] = $node;
            }
        }
        return $tmpTree;
    }
    /**
     * getNode
     * Returns the node that match the provided id
     * @param AppModel $model
     * @param mixed $id The node id to return
     * @param array $fields The fields to return
     * @param array $contain Allows using containable if the argument is provided.
     * @return AppModel The model if found, otherwise will return null.
     *
     */
    public function getNode(&$model,$id,$fields = null,$contain = null){
        
        $options = array();
        
        if(is_array($contain)){
            $options['contain'] = $contain;  
        }
        
        $options['conditions'] = array($model->alias . '.' . $model->primaryKey => $id);
        
        if(is_array($fields)){
            $options['fields'] = $fields;   
        }
        
        $options['recursive'] = 0;

        return $model->find('first',$options);        
    }
    /**
     * getParent
     * Returns the parent of the provided node.
     * @param AppModel $model
     * @param mixed $id The id of then node.
     * @return AppModel The parent node or null
     */
    public function getParent(&$model,$id){
        $parent = $this->getNode($model,$id, array($model->primaryKey));
        if (!$parent){
            return null;
        }
        return $parent[$model->alias][$model->primaryKey];
        
    }
    /**
     * getOrder
     * Return the current maximum order value.
     * @param mixed $tree_id The id of the tree
     * @param mixed $parent_id The id of the parent
     * @return integer A the maximum value of order.
     *
     */
    private function getMax($tree_id,$parent_id){
        $db =& ConnectionManager::getDataSource($this->model->useDbConfig);
        $options = array();
        $options['conditions'] = array($this->model->alias . '.' . $this->config['tree_id'] => $tree_id,
                                       $this->model->alias . '.' . $this->config['parent_id'] => $parent_id);
        
        $options['fields'] = $db->calculate($this->model, 'max', array($this->config['order']));
        $options['recursive'] = 2;
        $edge = array_values($this->model->find('first',$options));
        
        
        return (empty($edge[$this->config['order']])) ? 0 : $edge[$this->config['order']];
    }
    
    public function generateTreeList(&$model, $tree_id, $parent_id=0, $name_field="title", $character="--", $level=0, $out=array()){
$options = array();
$options['contain'] = array();
$options['recursive'] = -1;
$options['conditions'] = array(	$model->alias.'.'. $this->config['tree_id'] => $tree_id,
$model->alias.'.'. $this->config['parent_id'] => $parent_id,);
$options['order'] = array($model->alias.'.'.$this->config['order'] .' ASC');

$raw = $model->find('all', $options);
foreach ($raw as $node) {
if (!empty($raw)) {
//process this node
$out[$node[$model->alias]['id']]=str_repeat($character, $level).$node[$model->alias][$name_field];
//now process its children
$out=$this->generateTreeList(&$model, $tree_id, $node[$model->alias]['id'], $name_field, $character, $level+1, $out);
}
}
return $out;
}
}
?>