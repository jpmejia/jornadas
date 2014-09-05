<?php
class PuestosController extends AppController {
    
    var $uses = array("Puesto","Grupo","Programa","GruposPrograma","GruposPuesto","Curso","ProgramasCurso");
    
    function savePuesto(){
        // Mapeo del POST
        $data = $this->data;
        // Obtenemos el id de la sessión
        $data["Puesto"]["project_id"] = $this->getSessionKey();
            // Si el puesto se guarda, es decir que no tenga errores sus campos
        if($this->Puesto->save($data["Puesto"])){
            $last_puesto_id = $this->Puesto->getLastInsertID();
            // Para cada Puesto se crea un grupo default
            $this->Grupo->save(array(
                "project_id" => $data["Puesto"]["project_id"],
                "is_default" => TRUE,
                "name"       => "Grupo Default Para puesto ".$data["Puesto"]["name"],
                "puesto_id"  => $last_puesto_id
            ));
            // Para cada Puesto se crea un Programa default
            $this->Programa->save(array(
                "project_id" => $data["Puesto"]["project_id"],
                "name"       => "Programa Default Para puesto ".$data["Puesto"]["name"],
                "code"       => uniqid($data["Puesto"]["name"])
            ));
            // Se crea la relación Grupo Programa, recordemos que un programa puede ser aplicada a varios grupos
            $this->GruposPrograma->save(array(
                "grupo_id"      => $last_puesto_id,
                "programa_id"   => $this->Programa->getLastInsertID()
            ));
            
        }else{  // Si el puesto no se guarda tiene errores sus campos
                $this->Status["status"] = FAIL;
                $this->Status["description"]["errors"] = $this->Puesto->invalidFields();
                $this->Status["Model"] = "Puesto";
        }
        
        return json_encode($this->Status);
        
    }
    
    function addCoursesToProgram(){
        $id_session = $this->getSessionKey();
        $id_programa = $this->data["Programa"]["id"];
        $id_cursos  = explode(",",$this->data["Cursos"]["ids"]);
        
        $Programa = $this->Programa->findById($id_programa);
        // Si el id_proyecto del programa proporcionado no es igual al de la sessión key, entonces es significado de un posible hackeo
        if($Programa["Programa"]["project_id"] != $id_session){ $this->possibleHacking(); return false; }
        
        foreach($id_cursos as $id_curso){
            //Similar al proyecto verificamos cada curso
            $Curso = $this->Curso->findById($id_curso);
            if($Curso["Curso"]["project_id"]!=$id_session){
                $this->possibleHacking();
                return false;
            }
        }
        
        $cursosEnProgramas = $this->ProgramasCurso->find("all",array("conditions"=>array("ProgramasCurso.programa_id"=>$id_programa)));
        $cursosYaEnElPrograma = array();
        $id_cursos_en_programa = array();
        // Activamos o desactivamos los cursos del programa,
        foreach($cursosEnProgramas as $Curso){
            $dataCurso = $Curso["ProgramasCurso"];
            $id_cursos_en_programa[] = $dataCurso["curso_id"];
            $dataCurso["id"]       = $Curso["ProgramasCurso"]["id"];
            $dataCurso["is_active"]=in_array($Curso["ProgramasCurso"]["curso_id"],$id_cursos) ? TRUE : FALSE; 
            $this->ProgramasCurso->save($dataCurso);
        }
        // Se guardan los nuevos cursos si es el caso.
        foreach($id_cursos as $id_curso){
            if(!in_array($id_curso,$id_cursos_en_programa)){
                $this->ProgramasCurso->create();
                $this->ProgramasCurso->save(array(
                    "curso_id"   => $id_curso,
                    "programa_id"=> $id_programa
                ));
            }
        }
        
        return json_encode($this->Status);
    }
    
    function addProgramsToGroups(){
        
        $id_session = $this->getSessionKey();
        $id_grupo = $this->data["Grupo"]["id"];
        $id_programas  = explode(",",$this->data["programas"]["ids"]);
        
        $Grupo = $this->Grupo->findById($id_grupo);
        // Si el id_proyecto del programa proporcionado no es igual al de la sessión key, entonces es significado de un posible hackeo
        if($Grupo["Grupo"]["project_id"] != $id_session){ $this->possibleHacking(); return false; }
        
        foreach($id_programas as $id_programa){
            //Similar al proyecto verificamos cada curso
            $Programa = $this->Programa->findById($id_programa);
            if($Programa["Programa"]["project_id"]!=$id_session){
                $this->possibleHacking();
                return false;
            }
        }
        
        $programasEnGrupo = $this->GruposPrograma->find("all",array("conditions"=>array("GruposPrograma.grupo_id"=>$id_grupo)));
        $programaYaEnGrupo = array();
        $id_programas_en_grupo = array();
        // Activamos o desactivamos los cursos del programa,
        foreach($programasEnGrupo as $Programa){
            $dataPrograma = array();
            $id_programas_en_grupo[] = $Programa["GruposPrograma"]["programa_id"];
            $dataPrograma["id"]       = $Programa["GruposPrograma"]["id"];
            $dataPrograma["is_active"]=in_array($Programa["GruposPrograma"]["programa_id"],$id_programas) ? TRUE : FALSE; 
            $this->GruposPrograma->save($dataPrograma);
        }
        
        // Se guardan los nuevos cursos si es el caso.
        foreach($id_programas as $id_programa){
            if(!in_array($id_programa,$id_programas_en_grupo)){
                $this->GruposPrograma->create();
                $this->GruposPrograma->save(array(
                    "grupo_id"   => $id_grupo,
                    "programa_id"=> $id_programa
                ));
            }
        }
        
        return json_encode($this->Status);
        
    }
    
    function addPuestosToGroups(){
        
        $id_session = $this->getSessionKey();
        $id_grupo = $this->data["Grupo"]["id"];
        $id_puestos  = explode(",",$this->data["puestos"]["ids"]);
        
        $Grupo = $this->Grupo->findById($id_grupo);
        // Si el id_proyecto del programa proporcionado no es igual al de la sessión key, entonces es significado de un posible hackeo
        if($Grupo["Grupo"]["project_id"] != $id_session){ $this->possibleHacking(); return false; }
        
        foreach($id_puestos as $id_puesto){
            //Similar al proyecto verificamos cada curso
            $Puesto = $this->Puesto->findById($id_puesto);
            if($Puesto["Puesto"]["project_id"]!=$id_session){
                $this->possibleHacking();
                return false;
            }
        }
        
        $puestosEnGrupo = $this->GruposPuesto->find("all",array("conditions"=>array("GruposPuesto.grupo_id"=>$id_grupo)));
        $puestoYaEnGrupo = array();
        $id_puestos_en_grupo = array();
        // Activamos o desactivamos los cursos del programa,
        foreach($puestosEnGrupo as $Puesto){
            $dataPuesto = array();
            $id_puesto_en_grupo[] = $Puesto["GruposPuesto"]["puesto_id"];
            $dataPuesto["id"]       = $Puesto["GruposPuesto"]["id"];
            $dataPuesto["is_active"]=in_array($Puesto["GruposPuesto"]["puesto_id"],$id_puestos) ? TRUE : FALSE; 
            $this->GruposPuesto->save($dataPuesto);
        }
        // Se guardan los nuevos cursos si es el caso.
        foreach($id_puestos as $id_puesto){
            if(!in_array($id_puesto,$id_puestos_en_grupo)){
                $this->GruposPuesto->create();
                $this->GruposPuesto->save(array(
                    "grupo_id"   => $id_grupo,
                    "puesto_id"=> $id_puesto
                ));
            }
        }
        
        return json_encode($this->Status);
        
    }
    
    function getProgramasPuestosInGrupo(){
        $gruposProgramas = $this->GruposPrograma->find("all",array("conditions"=>array("GruposPrograma.grupo_id"=>$this->data["Grupo"]["id"])));
        $programas = $this->Programa->find("all",array("Programa.project_id"=>$this->getSessionKey()));
        $this->Status["description"]["gruposProgramas"] = $gruposProgramas;
        $this->Status["description"]["programas"] = $programas;
        $gruposPuestos = $this->GruposPuesto->find("all",array("conditions"=>array("GruposPuesto.grupo_id"=>$this->data["Grupo"]["id"])));
        $puestos = $this->Puesto->find("all",array("Puesto.project_id"=>$this->getSessionKey()));
        $this->Status["description"]["gruposPuestos"] = $gruposPuestos;
        $this->Status["description"]["puestos"] = $puestos;
        return json_encode($this->Status);
    }

    
}
