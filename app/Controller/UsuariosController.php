<?php

class UsuariosController extends AppController {
    
    var $uses = array("Usuario","Puesto");
    
    function beforeFilter(){
        //$this->Auth->allow("index");
    }
    
    function index(){
        
    }
    
    
    function saveArchivoUsuarios(){
        
        define("USERNAME",1);
        define("NOMBRE",2);
        define("APELLIDOS",3);
        define("PASSWORD",4);
        define("EMAIL",5);
        define("CURP",6);
        define("CODIGO_UNIDAD",7);
        define("PUESTO",8);
        define("FECHA_INGRESO",9);
        define("DELETED",10);

        
        $file = $this->data["File"];
        
        $usuarios = new Spreadsheet_Excel_Reader('files/'.$file, true,"ISO-8859-1");
        $usuarios = $usuarios->dumptoarray();
        
        unset($usuarios[1]);
        
        $this->Usuario->recursive = -1;
        $usuariosByUsername = array();
        $usuariosByRFC = array();
        $usuariosByCurp =array();
        $usuariosInDatabase = $this->Usuario->find("all",array("conditions"=>array("Usuario.project_id"=>$this->treeParentIdStructure),
                                                               "fields"=>array("Usuario.username","Usuario.rfc","Usuario.curp","Usuario.id"
                                                               )
                              ));
        $puestosArray = array();
        $puestosInDatabase  = $this->Puesto->find("all",array("conditions"=>array("Puesto.project_id"=>$this->treeParentIdStructure),
                                                               "fields"=>array("Puesto.id","Puesto.code")
                              ));
        foreach($puestosInDatabase as $Puesto){
            $puestosArray[$Puesto["Puesto"]["code"]] = $Puesto["Puesto"]["id"];
        }
        
        foreach($usuariosInDatabase as $usuarioInDatabase){
            
            $usuariosByUsername[$usuarioInDatabase["Usuario"]["username"]]    = $usuarioInDatabase["Usuario"]["id"];  
            $usuariosByCurp[$usuarioInDatabase["Usuario"]["curp"]]            = $usuarioInDatabase["Usuario"]["id"];
            $usuariosByRFC[$usuarioInDatabase["Usuario"]["rfc"]]              = $usuarioInDatabase["Usuario"]["id"];
            
        }
        
        $dataToSave = array();
        
        
        foreach($usuarios as $item){
            $dataToSave[] = array(
                "nombre"        =>  $item[NOMBRE],
                "apellidos"     =>  $item[APELLIDOS],
                "puesto_id"     =>  $puestosArray[$item[PUESTO]],
                "puesto_code"   =>  $item[PUESTO],
                "email"         =>  $item[EMAIL],
                "codigo_unidad_minima"=>  $item[CODIGO_UNIDAD],
                "project_id"    =>  $this->treeParentIdStructure,
                "fecha_de_ingreso"    =>  $item[FECHA_INGRESO],
                "username"      =>  $item[USERNAME],
                "password"      =>  $item[PASSWORD],
                "curp"          =>  $item[CURP],
                //"rfc"           =>  $item[RFC],
                "deleted"       =>  $item[DELETED],
            );
        }
        
        for($i=0;$i<count($dataToSave);$i++){
            if(isset($usuariosByUsername[$dataToSave[$i]["username"]])){
                $dataToSave[$i]["id"] = $usuariosByUsername[$dataToSave[$i]["username"]];
            }else if(isset($usuariosByRFC[$dataToSave[$i]["rfc"]])){
                $dataToSave[$i]["id"] = $usuariosByRFC[$dataToSave[$i]["rfc"]];
            }else if(isset($usuariosByCurp[$dataToSave[$i]["curp"]])){
                $dataToSave[$i]["id"] = $usuariosByCurp[$dataToSave[$i]["curp"]];
            }
        }
        
        
        //$dataToSave = array_chunk($dataToSave,1000);
        
       // for($i=0;$i<count($dataToSave);$i++){
            $this->Usuario->saveMany($dataToSave);
       // }
        
        echo json_encode(array("correct"=>true,"errors"=>array()));
        
    }
    
    
    function readExcelUsuarios(){
        $this->autoRender = false;
        $usuarios = new Spreadsheet_Excel_Reader('files/'.$this->data["File"], true);
        $usuarios = $usuarios->dumptoarray();
        unset($usuarios[1]);
        return json_encode(array("correct"=>true,"errors"=>array()));
    }
    
}
