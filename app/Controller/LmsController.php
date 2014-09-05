<?php

class LmsController extends AppController {
    
    var $uses = array("All","FacilityItem");
    var $Dc3Models = array("Instructores","Capacitadores","Representantes","Areas","Ocupaciones");
    var $Dc3ModelsValues = array("Instructores"=>1,"Capacitadores"=>4,"Representantes"=>5,"Areas"=>2,"Ocupaciones"=>3);
    
    function index(){
    }

    function savehierachy(){
        $this->autoRender = false;
        
        $this->FacilityItem->deleteAll(array("FacilityItem.project_id"=>$this->treeParentIdStructure,"FacilityItem.base"=>0));
        $this->FacilityItem->deleteAll(array('FacilityItem.project_id' => $this->treeItemsParentIdStructure), false);
        
        $newEstructure = array();
        $this->FacilityItem->create();
        $newEstructure["project_id"] = $this->treeItemsParentIdStructure;
        $newEstructure["name"]       = $this->data[0]["name"];
        $this->FacilityItem->save($newEstructure);

        
        $cleanArray = $this->data;
        
        

        for($i=0;$i<count($cleanArray);$i++){
            if($i!=0 && $i!=count($this->data)-1){
                
                $this->FacilityItem->create(); 
                $this->FacilityItem->save(array(
                                         'project_id'=>$this->treeParentIdStructure,
                                         'name'=>$this->data[$i]["name"],
                                         'parent_id'=> $i==1  ? $this->data[0]["id"] : $this->FacilityItem->getLastInsertId()  )); 
                
                 
            }
            if($i==count($this->data)-1){
                 $this->FacilityItem->save(array(
                                         'id' =>$this->data[$i]["id"],
                                         'parent_id'=> $i==1? $this->data[0]["id"] : $this->FacilityItem->getLastInsertId()
                                         )); 
                 
            }
        }
        
        
        return json_encode(array("correct"=>true));
    }
    
    function save(){
        
        $this->autoRender = false;
        

        
        if($this->loadModel($this->data["Model"]["name"])){
           
            $data = $this->data;
            $data[$this->data["Model"]["name"]]["project_id"] = $this->treeItemsParentIdStructure;
            
            if(in_array($data["Model"]["name"],$this->Dc3Models)){
                $data[$data["Model"]["name"]]["dc3catalog_id"]  = $this->Dc3ModelsValues[$data["Model"]["name"]];
            }
            
            
            if($this->data["Model"]["name"]=="FacilityItem"){
                $Parent = $this->FacilityItem->findById($data["FacilityItem"]["parent_id"]);
                $data["FacilityItem"]["level"] = $Parent["FacilityItem"]["level"]+1; 
                if($data["FacilityItem"]["id"]==""){
                    unset($data["FacilityItem"]["id"]);
                }else{
                    unset($data["FacilityItem"]["project_id"]);
                    unset($data["FacilityItem"]["level"]);
                    unset($data["FacilityItem"]["parent_id"]);
                }
            }
            
            if($this->{$this->data["Model"]["name"]}->save($data[$this->data["Model"]["name"]])){
                $this->Status["status"] = OK;
                $this->Status["description"]["id"] = $this->FacilityItem->getLastInsertId();
            }else{
                $this->Status["status"] = FAIL;
                $this->Status["description"]["errors"] = $this->{$this->data["Model"]["name"]}->invalidFields();
            }
            
            $this->Status["Model"] = $this->data["Model"]["name"];
        
        }
        
        return json_encode($this->Status);
        
    }
    
    
    function getList(){
        
        $this->autoRender = false;
        
        $conditions = array();
        
        if(in_array($this->data["Model"],$this->Dc3Models)){
           $conditions = array_merge($conditions,array($this->data["Model"].".dc3catalog_id"=>$this->Dc3ModelsValues[$this->data["Model"]]));
        }
        
        if(isset($this->data["Conditions"])){
            foreach($this->data["Conditions"] as $field => $value){
                $conditions = array_merge($conditions,array($field => $value));
            }
        }
        
        if($this->loadModel($this->data["Model"])){
            
            $dataQuery = array("conditions"=>$conditions);
        
            $this->Status["description"]["total"] = $this->{$this->data["Model"]}->find("count");
            
            if($this->data["Limit"]!=0){
                $dataQuery = array_merge($dataQuery,array("limit"=>$this->data["Limit"]));
            }
            
            if($this->data["Page"]!=0){
                $dataQuery = array_merge($dataQuery,array("page"=>$this->data["Page"]));
            }
            
            $this->Status["description"]["result"] = $this->{$this->data["Model"]}->find("all",$dataQuery);
        }
        
        
        return json_encode($this->Status);
    }
    
    function find(){
        
        $this->autoRender = false;
        
        if($this->loadModel($this->data["Model"])){
            $this->Status["description"]["result"] = $this->{$this->data["Model"]}->findById($this->data["Id"]);
        }
        
        return json_encode($this->Status);
        
    }
    
    function getFacilityItems(){
        
        $this->layout = false;
        $this->autoRender = false;
        $this->FacilityItem->maxRecursive = 20;
        $Facility = $this->FacilityItem->generateTree($this->treeParentIdStructure);
        $this->FacilityItem->maxRecursive = 0;
        $FirstItem = $this->FacilityItem->generateTree($this->treeItemsParentIdStructure);
        return json_encode(array("Facility"=>$Facility,"FirstItem"=>$FirstItem[0]));
        
    }
    
    
    function getHierachyItems($id){
        
        $this->autoRender = false;
        
        $branches = $this->FacilityItem->find("all",array("conditions"=>array("parent_id"=>$id)));
        $totalLevels = $this->FacilityItem->find("count",array("conditions"=>array("project_id"=>$this->treeParentIdStructure))) -1;
       // $totalLevels = count($totalLevels) - 1;
        $data = array();
        foreach($branches as $branch){
            array_push($data,array(
                        "id"=> $branch["FacilityItem"]["id"],
                        "label"=> $branch["FacilityItem"]["name"]." (".$branch["FacilityItem"]["code"].")",
                        "childs"=> array(),
                        "isFolder"=> $branch["FacilityItem"]["level"] == $totalLevels ? false : true,
                        "open"=> false,
                        "icon"=> $branch["FacilityItem"]["level"] == $totalLevels ? "file" : "folder"
            ));
        }
        
        if(empty($data)){
            array_push($data,array(
                        "id"=> null,
                        "label"=> "VACIO",
                        "childs"=> array(),
                        "isFolder"=> false,
                        "open"=> false,
                        "icon"=> "file"
            ));
        }
        
        
        echo json_encode($data);
        
    }
    
    

    
    public function readExcelUnidadesDeNegocio(){
        $this->autoRender = false;
        
        define("NIVEL",3);
        define("NOMBRE",1);
        define("CODIGO",2);
        define("UNIDAD_ARRIBA",4);
        
        
        ini_set('memory_limit', '100M');
        $data = new Spreadsheet_Excel_Reader('files/'.$this->data["File"], true);
        $data = $data->dumptoarray();
        
        $errores = array(
            "nivel_no_number" => array(),
            "no_hay_nombre"   => array(),
            "no_hay_codigo"   => array(),
            "no_hay_unidad"   => array(),
            "codigo_repetido" => array(),
            "level_codigo_unidad_arriba" => array(),
            "error_codigo_unidad_arriba" => array()
        );
         $totalLevels = $this->FacilityItem->find("count",array("conditions"=>array("project_id"=>$this->treeParentIdStructure))) -1;
       
         for($i=1;$i<=$totalLevels;$i++){
            $niveles[$i] = array();
            $niveles[$i]["codes"] = array();
            $niveles[$i]["unidad_arriba"] = array();
         }
         
         unset($data[1]);
         $correct = true;
        
        foreach($data as $item){
            //Para agregar errores de que el nivel no sea un entero
            
            $inArray = isset($niveles[$item[NIVEL]]);
            
            if(intval($item[NIVEL])==0){
                if(!in_array($item[NIVEL],$errores["nivel_no_number"])){
                    
                    array_push($errores["nivel_no_number"],$item[NIVEL]);
                }
                $correct = false;
            
            }else{
            
            if($item[NOMBRE]==""){
                array_push($errores["no_hay_nombre"],array("nivel"=>$item[NIVEL],"code"=>$item[CODIGO]));
                $correct = false;
            }
            if($item[CODIGO]==""){
                array_push($errores["no_hay_codigo"],array("name"=>$item[NOMBRE],"nivel"=>$item[NIVEL],"code"=>$item[CODIGO]));
                $correct = false;
            }
            if($item[NIVEL]!=1 && $item[UNIDAD_ARRIBA]==""){
                array_push($errores["no_hay_unidad"],array("name"=>$item[NOMBRE],"nivel"=>$item[NIVEL],"code"=>$item[CODIGO]));
                $correct = false;
            }
            
            
            if($inArray && in_array($item[CODIGO],$niveles[$item[NIVEL]]["codes"])){
                $correct = false;
                array_push($errores["codigo_repetido"],array("nivel"=>$item[NIVEL],"code"=>$item[CODIGO],"name"=>$item[NOMBRE]));
            }else{
                if($inArray){
                    array_push($niveles[$item[NIVEL]]["codes"],$item[CODIGO]); 
                }
                    
            
            }
            
            if($inArray && !in_array($item[UNIDAD_ARRIBA],$niveles[$item[NIVEL]]["unidad_arriba"])){
               
               if($inArray){
                    array_push($niveles[$item[NIVEL]]["unidad_arriba"],$item[UNIDAD_ARRIBA]);
               }
                    
               
            }
            
            }
            
            
        }
        
        for($i=2;$i<count($niveles);$i++){
            foreach($niveles[$i]["unidad_arriba"] as $UnidadArriba){
                if(!in_array($UnidadArriba,$niveles[$i-1]["codes"])){
                    $correct = false;
                    if(!in_array($UnidadArriba,$errores["error_codigo_unidad_arriba"])){
                        array_push($errores["level_codigo_unidad_arriba"],array($i-1));
                        array_push($errores["error_codigo_unidad_arriba"],array($UnidadArriba));
                    }
                }
            }
        }
        
        
        echo json_encode(array("correct"=>$correct,"errors"=>$errores));
        
    }
    
    
    function saveUnidadesDeNegocio(){
        $this->autoRender = false;
        define("NIVEL",3);
        define("NOMBRE",1);
        define("CODIGO",2);
        define("UNIDAD_ARRIBA",4);
        
        $data = new Spreadsheet_Excel_Reader('files/'.$this->data["File"], true);
        $this->FacilityItem->deleteAll(array('FacilityItem.project_id' => $this->treeItemsParentIdStructure,"FacilityItem.parent_id is not null"), false);
        $Base = $this->FacilityItem->find("first",array("conditions"=>array("FacilityItem.project_id"=>$this->treeItemsParentIdStructure)));
        $data = $data->dumptoarray();
        
        unset($data[1]);
        
        $dataToSave = array();
        
        foreach($data as $item){
            $dataToSave[] = array(
                "parent_id" => $Base["FacilityItem"]["id"],
                "project_id"=> $this->treeItemsParentIdStructure,
                "name" => $item[NOMBRE],
                "code" => $item[CODIGO],
                "level" =>$item[NIVEL] ,
                "unidad_arriba" => $item[UNIDAD_ARRIBA] 
                
            );
        }
        
        $dataToSave = array_chunk($dataToSave,100);
        
        for($i=0;$i<count($dataToSave);$i++){
            $this->FacilityItem->saveMany($dataToSave[$i]);
            
        }
        
        
        $this->FacilityItem->query(
        "update facility_items as A,facility_items as B
            set    A.parent_id = B.id
        where A.project_id = {$this->treeItemsParentIdStructure} and B.project_id = {$this->treeItemsParentIdStructure} and A.unidad_arriba = B.code"
        );
        
        echo json_encode(array());
        
    }
    
    function deleteUnidadesDeNegocio(){
        $this->autoRender = false;
        
        $idToDelete = $this->data["Id"];
        $totalLevels = $this->FacilityItem->find("count",array("conditions"=>array("project_id"=>$this->treeParentIdStructure))) -1;
        $itemToDelete = $this->FacilityItem->findById($this->data);
        
        $currentIds = array();
        array_push($currentIds,$idToDelete);
        
        if($itemToDelete["FacilityItem"]["parent_id"]!=null || $itemToDelete["FacilityItem"]["parent_id"]!=""){
            $this->FacilityItem->delete($idToDelete);
        }
        
        
        for($i=$itemToDelete["FacilityItem"]["level"];$i<$totalLevels;$i++){
            
            $this->log($currentIds);
            
            $parentsIds =$this->FacilityItem->find("all",array("fields"=>array("FacilityItem.id"),
                                                              "conditions"=>array("FacilityItem.parent_id"=>$currentIds))
                                                              
            );
            
            if(!empty($currentIds)){
                $this->FacilityItem->deleteAll(array("FacilityItem.project_id"=>$this->treeItemsParentIdStructure,
                                                 "FacilityItem.parent_id"=>$currentIds));
            }else{
                $i=$totalLevels;
            }
            
            $currentIds = array();
            
            foreach($parentsIds as $item){  array_push($currentIds,$item["FacilityItem"]["id"]);    }
        }
        
        
        echo json_encode(array());
    }
    
    function readRecord(){
        $this->autoRender = false;
        $this->loadModel($this->data["Model"]);
        echo json_encode(array("data"=>$this->{$this->data["Model"]}->find("first",array("conditions"=>array("{$this->data["Model"]}.id"=>$this->data["Id"])))));   
    }
    
    
}
