var Programas = {
    rowHTML           :   "<tr><td><input type='checkbox' /></td><td></td><td></td></tr>",
    divRenderSearch   :   null,
    divRender         :   null,
    coursesInProgram  :   {},
    coursesInProgramIds:  [],
    coursesInCategoria:   null,
    id_programa       :   null,
    init              :   function(){
        this.divRender       = /*@*/ Global.getRightDiv();
        this.divRenderSearch = /*@*/ Global.getLeftDiv();
        /*@*/Global.getContent("Programas.Left").appendTo(this.divRenderSearch);
        this.setFillSelectAndChangeSelectEvent();
        /*@*/clickObject.setHtmlContent("dataProgramasCursos");
        /*@*/Global.getNode("Programas.ToolBar").insertAfter(Global.getFromRightDiv("Programas.AfterWhereInsertToolbar"));
        this.setEventIntoPrograms();
        return false;
    },
    setFillSelectAndChangeSelectEvent     :   function(){
        var This = this;
        var SelectProgramas = /*@*/ Global.getContentNode("Programas.Left.SelectPrograma");
        var SelectCategorias= /*@*/ Global.getContentNode("Programas.Left.SelectCategoria");
        var Option  = "<option></option>";
        
        $.post(/*@*/Router.urlForSearchList,{"Model":"Programa"},function(data,status){
            $.each(data.description.result,function(index,item){
                SelectProgramas.append($(Option).html(item.Programa.name).val(item.Programa.id));
            });
        },"json");
        
        $.post(/*@*/Router.urlForSearchList,{"Model":"Categoria"},function(data,status){
            $.each(data.description.result,function(index,item){
                $(Option).html(item.Categoria.name).val(item.Categoria.id).appendTo(SelectCategorias);
            });            
        },"json");
        
        var Selects = SelectProgramas.add(SelectCategorias);
        
        Selects.change(function(){
            var Data = Selects.serializeArray();
            This.id_programa = Data[0]["value"];
            This.getCoursesForProgram(Data[0]["value"],Data[1]["value"]);
        });
        
        return false;
    },
    getCoursesForProgram    :   function(id_programa,id_categoria){
        /*@*/ 
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
        var Table = /*@*/ Global.getRightTable();
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
        /*@*/Global.getFromRightDiv("Programas.AddCoursesButton").click(function(){
            
            var idsCursos = [];
            /*@*/ Global.getRightTable().find("tbody input:checkbox").each(function(index,item){
                idsCursos.push($(this).parent().data("curso_id"));
            });
            
            if(idsCursos.length == 0){
                    /*@*/ ModalWindow.callShowModalForWait(/*@*/Messages.messageAtencion,/*@*/Messages.emptyCursosIntoProgramas,{},{showCancel:true,cancel:/*@*/Messages.OK});
            }else{
                    /*@*/ ModalWindow.callNormalWait();
                    $.post(/*@*/Router.urlForSaveIntoPrograms,{Programa:{id:This.id_programa},Cursos:{ids:idsCursos.join(",")}},function(data,status){
                        /*@*/ ModalWindow.callHideModalForWait();
                    },"json");
            }
                
        });
        return false;
    }
};