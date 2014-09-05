var Grupos = {
    data              :   null,
    rowHTML           :   "<tr><td><input type='checkbox' /></td><td></td></tr>",
    divRenderSearch   :   null,
    divRender         :   null,
    coursesInProgram  :   {},
    coursesInProgramIds:  [],
    coursesInCategoria:   null,
    id_programa       :   null,
    id_grupo          :   null,
    init              :   function(){
        
        this.divRender       = /*@*/ Global.getRightDiv();
        this.divRenderSearch = /*@*/ Global.getLeftDiv();
        /*@*/Global.getContent("Grupos.Left").appendTo(this.divRenderSearch);
        this.setFillSelectAndChangeSelectEvent();
        this.setEventsForOptions();
        
        return false;
    },
    setFillSelectAndChangeSelectEvent     :   function(){
        var This = this;
        var SelectGrupos = /*@*/ Global.getContentNode("Grupos.Left.SelectGrupos");
        var Option  = "<option></option>";
        
        $.post(Router.urlForSearchList,{"Model":"Grupo"},function(data,status){
            
            $.each(data.description.result,function(index,item){
                SelectGrupos.append($(Option).html(item.Grupo.name).val(item.Grupo.id));
            });
            
            SelectGrupos.change(function(){
                Global.cleanRight();
                This.id_grupo = $(this).val();
            });

        },"json");
        
        return false;
    },
    setEventsForOptions     :   function(){
        var Options = Global.getContentNode("Grupos.Left.Options");
        var This    = this;
        
        Options.eq(0).click(function(){ //Programas
            This.eventForProgramas();
        });
        
        Options.eq(1).click(function(){ //Puestos
            This.eventForPuestos();
        });
    },
    eventForProgramas   :   function(){
        
        clickObject.setHtmlContent("dataGruposProgramas");
        /*@*/Global.getNode("Grupos.ToolBar").clone().insertAfter(Global.getFromRightDiv("Grupos.AfterWhereInsertToolbar"));
        var This  = this;
        var Table = /*@*/ Global.getRightTable();
            Table.find("tbody").html("");
        var ProgramsInGroups = [];
        var CheckBoxes = [];
        
        $.post(Router.Grupos.urlForProgramas,{data:{Grupo:{id:this.id_grupo}}},function(data,status){
        
            $.each(data.description.gruposProgramas,function(index,item){
                if(item["GruposPrograma"]["is_active"]==1){
                    ProgramsInGroups.push(item["GruposPrograma"]["programa_id"]);
                }
            });
            
            $.each(data.description.programas,function(index,item){
                 var Tr = $(This.rowHTML).find("td:eq(0)").data("id",item["Programa"]["id"]).end()
                           .find("td:eq(1)").html(item["Programa"]["name"]).end();
                           
                 CheckBoxes.push(Tr.find("input:checkbox"));
                   
                 if($.inArray(item["Programa"]["id"],ProgramsInGroups)!=-1){
                    Tr.find("input:checkbox").attr('checked', true);
                 }
                   
                 Tr.appendTo(Table);
            });
            
        },"json");
        
        /*@*/Global.getFromRightDiv("Grupos.SaveButton").click(function(){
            
            var ids = [];
            
            Global.getRightTable().find("input:checked").each(function(index,item){ 
                ids.push($(this).parent().data("id"));
            });
            
            $.post(Router.Grupos.urlForSaveProgramas,{data:{Grupo:{id:This.id_grupo},programas:{ids:ids.join(",")}}},function(data,status){
                    alert("Se guardó");
            },"json");
            
        });
        
        return false;
    },
    eventForPuestos     :   function(){
        
        clickObject.setHtmlContent("dataGruposPuestos");
        /*@*/Global.getNode("Grupos.ToolBar").clone().insertAfter(Global.getFromRightDiv("Grupos.AfterWhereInsertToolbar"));
        var This  = this;
        var Table = /*@*/ Global.getRightTable();
            Table.find("tbody").html("");
        var PuestosInGroups = [];
        var CheckBoxes = [];
        
        $.post(Router.Grupos.urlForProgramas,{data:{Grupo:{id:this.id_grupo}}},function(data,status){
        
            $.each(data.description.gruposPuestos,function(index,item){
                if(item["GruposPuesto"]["is_active"]==1){
                    PuestosInGroups.push(item["GruposPuesto"]["puesto_id"]);
                }
            });
            
            $.each(data.description.puestos,function(index,item){
                 var Tr = $(This.rowHTML).find("td:eq(0)").data("id",item["Puesto"]["id"]).end()
                           .find("td:eq(1)").html(item["Puesto"]["name"]).end();
                           
                 CheckBoxes.push(Tr.find("input:checkbox"));
                   
                 if($.inArray(item["Puesto"]["id"],PuestosInGroups)!=-1){
                    Tr.find("input:checkbox").attr('checked', true);
                 }
                   
                 Tr.appendTo(Table);
            });
            
        },"json");
        
        /*@*/Global.getFromRightDiv("Grupos.SaveButton").click(function(){
            
            var ids = [];
            
            Global.getRightTable().find("input:checked").each(function(index,item){ 
                ids.push($(this).parent().data("id"));
            });
            
            $.post(Router.Grupos.urlForSavePuestos,{data:{Grupo:{id:This.id_grupo},puestos:{ids:ids.join(",")}}},function(data,status){
                    alert("Se guardó");
            },"json");
            
        });
        
        return false;
    }
    
     /*
    getDataBaseOnOption     :   function(id_grupo){
        var This = this;
        $.post(Router.Grupos.urlForDataGrupo,{data:{Grupo:{id:id_grupo}}},function(data,status){
            This.data = data.description;
        },"json");
        
        return false;
    },
    getCoursesForProgram    :   function(id_programa,id_categoria){
         
        if(id_programa == 0 || id_categoria == 0){return false;}
        var This = this;
        $.post(Router.urlForSearchList,{"Model":"ProgramasCurso","Conditions":{"ProgramasCurso.programa_id":id_programa}},function(data,status){
            This.coursesInProgram = data.description.result;
            This.getCoursesForCategoria(id_categoria);
        },"json");
        
        return false;
    },
    getCoursesForCategoria :    function(id_categoria){
        var This = this;
        $.post(Router.urlForSearchList,{"Model":"Curso","Conditions":{"Curso.categoria_id":id_categoria}},function(data,status){
            This.coursesInCategoria = data.description.result;
            This.setCoursesInTable();
        },"json");        
        return false;
    },
    setCoursesInTable   :   function(){
        var This  = this;
        var Table =  Global.getRightTable();
            Table.find("tbody").html("");
        $.each(this.coursesInProgram,function(index,item){
            This.coursesInProgramIds[item["ProgramasCurso"]["curso_id"]] = {"id":item["ProgramasCurso"]["id"],"is_active":item["ProgramasCurso"]["is_active"]};  
        });
        
        $.each(this.coursesInCategoria,function(index,item){
           var Tr = $(This.rowHTML).find("td:eq(0)").data("curso_id",item["Curso"]["id"]).end()
                           .find("td:eq(1)").html(item["Curso"]["name"]).end()
                           .find("td:eq(2)").html(item["Categoria"]["name"]).end();
                           
               if(This.coursesInProgramIds[item["Curso"]["id"]] && This.coursesInProgramIds[item["Curso"]["id"]]["is_active"]){
                Tr.find("input:checkbox").attr('checked', true);
                Tr.find("td:eq(0)").data("id",This.coursesInProgram[item["Curso"]["id"]]);
               }
               
               Tr.appendTo(Table);
        });
        
        return false;
    },
    setEventIntoPrograms:   function(){
        var This = this;
        Global.getFromRightDiv("Programas.AddCoursesButton").click(function(){
            
            var idsCursos = [];
            Global.getRightTable().find("tbody input:checkbox").each(function(index,item){
                idsCursos.push($(this).parent().data("curso_id"));
            });
            
            if(idsCursos.length == 0){
                    ModalWindow.callShowModalForWait(Messages.messageAtencion,Messages.emptyCursosIntoProgramas,{},{showCancel:true,cancel:Messages.OK});
            }else{
                    ModalWindow.callNormalWait();
                    $.post(Router.urlForSaveIntoPrograms,{Programa:{id:This.id_programa},Cursos:{ids:idsCursos.join(",")}},function(data,status){
                        ModalWindow.callHideModalForWait();
                    },"json");
            }
                
        });
        return false;
    }    
    
    
    
    
    */
};