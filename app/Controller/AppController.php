<?php

App::uses('Controller', 'Controller');
App::import('Vendor', 'excel_reader2');

class AppController extends Controller {
    
    var $components = array('FileUpload.Upload',"RequestHandler");
    var $Status = array("status"=>OK,"description"=>null);
    
    var $treeParentIdStructure = 1;
    var $treeItemsParentIdStructure = 2;
    
    function beforeFilter(){
        ini_set('memory_limit', '100M');
        if($this->RequestHandler->isAjax()){
            $this->autoRender = false;
        }
        
    }
    
   	public function upload()
	{
	   
		$this->autoRender = false;
		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Disposition: inline; filename="files.json"');
		header('X-Content-Type-Options: nosniff');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
		header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

		switch ($_SERVER['REQUEST_METHOD']) {

		    case 'POST':
		        if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
		            $this->Upload->delete();
		        } else {
		            $this->Upload->post();
		        }
		        
		}			
	
    }
    
    public function getSessionKey(){
        return 1;
    }
    
    public function possibleHacking(){
        
    }
    
    
}
