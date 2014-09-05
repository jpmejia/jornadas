document.ready = function(){
    
    clickObject = {
        TotalRecords   : 0,
        defaultUrlSave: WEBROOT+"lms/save",
        CurrentId     : null,
        ModalWindow      : $("#myModal"),
        ClassBootstrapForTable: "table table-striped table-hover datos-ppales",
        ClickActionClass : ".clickAction",
        ObjectContentRight : null,
        CategoriaPullRight : null,
        AlertInfor  :   null,
        FormHorizontal : null,
        ControlGroup   : null,
        SaveButton     : null,
      init :    function(){
        this.setHTMLClones();
        /*@*/Global.getRightDiv().html("");
        this.setEvent();
        return false;
      },
      formSettings  :   function(){
        
        var datePicker = $('.datepicker');
        if(datePicker.length>0){
           datePicker.datepicker({format:"yyyy-mm-dd"}); 
        }
        
        return false;
      },
      setHTMLClones :function(){
        this.ObjectContentRight = /*@*/Global.getRightDiv().html("");
        this.CategoriaPullRight = $(".headerRight:eq(0)").clone();
        this.AlertInform = $(".alert-info:eq(0)").clone();  
        this.FormHorizontal = $(".formularioRight:eq(0)").clone(true);
        this.ControlGroup = this.FormHorizontal.find("fieldset .control-group:eq(0)");
        this.SaveButton   = this.FormHorizontal.find(".submitButton:eq(0)");
        this.FormHorizontal.find("fieldset").html("");
        this.setEditEvent();
      },
      setEvent :    function(){
        var This = this;
        $(this.ClickActionClass).click(function(){
            This.defaultUrlSave  = WEBROOT+"lms/save";
            
            
            
            if(Data[$(this).attr("id")]){
                This.defaultUrlSave = Data[$(this).attr("id")]["urlSave"]? Data[$(this).attr("id")]["urlSave"] : This.defaultUrlSave;
                This.setHtmlContent($(this).attr("id"));
                This.setSubmitEvent();
            }else{  
                
                
                Global.cleanLeft();
                Global.cleanRight();
                
                if($(this).attr("href")=="#/Users"){
                    /*@*/Colaboradores.init();
                }else{
                    eval($(this).attr("id")+".init();");
                }
                
            }
        });
        return false;
      },
      setHtmlContent : function(Id){
        this.CurrentId = Id;
        this.ObjectContentRight.html("");
        
        var HeaderForm = this.CategoriaPullRight.clone(true);
        HeaderForm.html(Data[Id].headerForm).appendTo(this.ObjectContentRight);
        if(Data[Id].headerFormClass){   HeaderForm.addClass(Data[Id].headerFormClass);     }
        this.AlertInform.find(".alertContent").html(Data[Id].help).end().appendTo(this.ObjectContentRight);
        
        if(Data[Id].formulario!=null){
            var newRightForm = this.createForm(Id,false);
            newRightForm.appendTo(this.ObjectContentRight);
        }
        
        var HeaderTable = this.CategoriaPullRight.clone(true);
        if(Data[Id].headerTableClass){  HeaderTable.addClass(Data[Id].headerTableClass);    }
        HeaderTable.html(Data[Id].headerTable).appendTo(this.ObjectContentRight);
        
        if(Data[Id].headers.length>0){
           this.createTable(Id);
           if(Data[Id]["modelo"]!="X"){
            this.fillTable(Id);
           } 
        }
        
        this.formSettings();
        //this.SaveButton.appendtTo(this.ObjectContentRight);
      },
      createForm     : function(Id,isEdit){
        var This = this;
        var form = this.FormHorizontal.clone(true);
        $.each(Data[Id].formulario,function(index,item){
            
            var Input = null;
            if(item["tipo"]=="text"){
              Input = $("<input/>").attr({name:item.name,placeholder:item.placeHolder,type:"text"});
            }else if(item["tipo"]=="select"){
                
               Input = $("<select/>").attr({name:item.name}); 
               $.each(item.options,function(index,item){
                Input.append($("<option></option>").html(item).val(index));
               });
               
               if(item.Model){
                
                    $.post(WEBROOT+"lms/getList",{Model:item.Model},function(data,status){
                        $.each(data["description"]["result"],function(indexList,itemList){
                            $("<option/>").attr({value:itemList[item.Model]["id"]}).html(itemList[item.Model]["name"]).appendTo(Input);
                        });
                    },"json");
                
               }
               
            }else if(item["tipo"]=="hidden"){
                Input = $("<input/>").attr({name:item.name,type:"hidden",value:item.value});
            }
            
            if(item.className){Input.addClass(item.className);}
            
            This.ControlGroup.clone().find("label").html(item["label"]).end()
                             .find("div:eq(0)").html("").append(Input).end()
                             .appendTo(form.find("fieldset"));
                             
                             
        });
        
        
        $("<input/>").attr({type:"hidden",name:"data[Model][name]"}).val(Data[Id].modelo).appendTo(form);
        
        if(!isEdit){
            this.SaveButton.show().appendTo(form.find("fieldset"));
        }
        
        return form;
        
      },
      createTable  :   function(Id){
        
        var NewTable = $("<table><thead><tr></tr></thead><tbody></tbody></table>").attr("class",this.ClassBootstrapForTable);
        
        $.each(Data[Id]["headers"],function(index,item){
            NewTable.find("thead tr").append($("<th></th>").attr("class",Data[Id]["headersClass"][index]).html(item));
        });
        
        NewTable.appendTo(this.ObjectContentRight);
        
        this.CurrentTable = NewTable;
        
        return false;
      },
      fillTable      :  function(Id){
        var This = this;
        
        var Limit = Data[Id].limitPage != null ? Data[Id].limitPage : 0;
        var Page =  Data[Id].page != null ? Data[Id].page : 0;
       
        $.post(WEBROOT+"lms/getList",{Model:Data[Id].modelo,Limit:Limit,Page:Page},function(data,status){     
            This.TotalRecords = data.description.total;
            This.SetHtmlFillTable(data.description.result,Id);
            eval("if("+Id.substring(4)+".callBackAfterSearch()){}");   
        },"json");
        return false;
      },
      fillTablePage      :  function(Id,Page){
        var This = this;
        
        var Limit = Data[Id].limitPage != null ? Data[Id].limitPage : 0;
        //var Page =  Data[Id].page != null ? Data[Id].page : 0;
       
        $.post(WEBROOT+"lms/getList",{Model:Data[Id].modelo,Limit:Limit,Page:Page},function(data,status){     
            This.TotalRecords = data.description.total;
            This.SetHtmlFillTable(data.description.result,Id);
           // eval("if("+Id.substring(4)+".callBackAfterSearch()){}");   
        },"json");
        return false;
      },
      SetHtmlFillTable: function(data,Id){
        var This = this;
        var Tr = "<tr>";
        $.each(Data[Id].campos,function(index,item){
            Tr += "<td></td>";
        });
        Tr += "</tr>";
        
        Tr = $(Tr);
        this.CurrentTable.find("tbody").html("");
        
        $.each(data,function(index,item){
            var aloneTr = Tr.clone();
            
            $.each(Data[Id].campos,function(index2,item2){
                var Fields = item2.split(".");
                var FieldsHtml = item2.split(">");
                if(index2==0){
                    
                    var Text = FieldsHtml.length>1 ? item2 : item[Fields[0]][Fields[1]];
                    
                    var triggerEdit = $("<a/>").html(Text)
                                               .data("id",item[Data[Id]["modelo"]]["id"])
                                               .addClass("triggerToEdit");
                                               
                                               
                  aloneTr.find("td").eq(index2).append(triggerEdit);  
                }else{
                    var Text = FieldsHtml.length>1 ? item2 : item[Fields[0]][Fields[1]];
                    aloneTr.find("td").eq(index2).html(Text);
                }
            });
            
            aloneTr.appendTo(This.CurrentTable.find("tbody"));
        });
        
        if(Data[This.CurrentId].modelo=="Usuario"){
            return false;
        }
        
        $(".triggerToEdit").click(function(){
            This.ModalWindow.modal();
            
            if(Data[This.CurrentId].modelo=="Curso"){
                
                if($(this).parent().parent().find("td:eq(4)").html()=="Presencial"){
                    Data[This.CurrentId].formulario = Data.dataCursoPresencial.formulario; 
                }else{
                    Data[This.CurrentId].formulario = Data.dataCursoElearning.formulario; 
                }   
            }
            
            This.createEditForm($(this).data("id"));
            
            if(Data[This.CurrentId].modelo=="Curso"){
                Data[This.CurrentId].formulario = null;
            }
            
            This.formSettings();
            
        });
        
        
        return false;
        
      },
      createEditForm :  function(idEdit){
        
        var EditForm = this.createForm(this.CurrentId,true);
            
            $("<input/>").attr({type:"hidden",name:"data["+Data[this.CurrentId]["modelo"]+"][id]"}).val(idEdit).appendTo(EditForm.find("fieldset"));
            $("<input/>").attr({type:"hidden",name:"data[Model][name]"}).val(Data[this.CurrentId]["modelo"]).appendTo(EditForm.find("fieldset"));
            this.ModalWindow.find(">div:eq(1)").html("").append(EditForm);
            
        $.post(WEBROOT+"lms/find",{Model:Data[this.CurrentId].modelo,Id:idEdit},function(data,status){
            $.each(data.description.result,function(Modelo,Campos){
                
                $.each(Campos,function(Campo,Valor){
                    EditForm.find("[name='data["+Modelo+"]["+Campo+"]']").val(Valor);
                });
                
            });
        },"json");
        
        return false;
      },
      setSubmitEvent :  function(){
        var This = this;
        /*@*/Global.getContentNode("Edicion.Right.SaveButton").click(function(){

            $.post(This.defaultUrlSave,Global.getRightDiv().find("#formularioRight").serializeArray(),function(data,status){
                    if(data.status=="fail"){
                        
                        $.each(data.description.errors,function(Campo,Errores){
                            $("*").find("[name='data["+data.Model+"]["+Campo+"]']").popover('destroy').popover({content:Errores[0],trigger:"manual"});
                            $("*").find("[name='data["+data.Model+"]["+Campo+"]']").popover("show");
                        });
                        
                    }else{
                        $("#formularioRight").find("input").not(":hidden").val("");
                        This.fillTable(This.CurrentId);
                        $("*").popover('destroy');
                        alert("Guardado!!!");
                    }
            },"json");
        });
        
      },
      setEditEvent  :  function(){
        var This = this;
        var formModalEdit = /*@*/ Global.getNode("Edicion.Form");
        /*@*/Global.getNode("Edicion.EditButton").click(function(){
        $.post(/*@*/Router.urlForSave,formModalEdit.serializeArray(),function(data,status){
                    if(data.status=="fail"){
                        $.each(data.description.errors,function(Campo,Errores){
                            formModalEdit.find("*").find("[name='data["+data.Model+"]["+Campo+"]']").popover('destroy').popover({content:Errores[0],trigger:"manual"});
                            formModalEdit.find("*").find("[name='data["+data.Model+"]["+Campo+"]']").popover("show");
                        });
                    }else{
                        formModalEdit.modal('hide');
                        This.fillTable(This.CurrentId);
                        alert("Guardado!!!");
                    }
            },"json");
        });
        
        return false;
      }
        
    };
    
    clickObject.init();
    
};