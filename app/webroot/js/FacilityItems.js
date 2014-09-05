var treeApi = null;
var FacilityItems = {
        urlData :   /*@*/Router.urlForSaveFacilityItem,
        fileUnidadesDeNegocio : null,
        divForTree : null,
        divRender:  null,
        TreeItems:  null,
        newTreeArray : null,
        selectedOneTree: null,
        rootData : [{"id": null,"label": null,"childs": [],"isFolder": true,"open": false,"icon": "folder",}],
        init    :   function(){
            this.divRender = $("#"+/*@*/Global.IdForTheDivInTheRight);
            this.divRender.html("");
            this.getData();
            return false;                        
        },
        getData :   function(){
            var This = this;
            $.post(this.urlData,{},function(data,status){
                This.rootData[0].id = data.FirstItem.FacilityItem.id ;
                This.rootData[0].label = data.FirstItem.FacilityItem.name ;
                This.newTreeArray = null,
                This.TreeItems = [];
                This.decodeTreeArray(data.Facility);
                This.setHTML();
                This.setCurrentTree();
                This.setEventNewItem();
                This.setEventSave();
                This.startTree();
                This.setActionForAddAndDeleteChild();
                This.setSaveNewItem();
                This.setUploadButton();
                This.setActionDeleteChild();
            },"json");
            
        },
        setHTML :   function(){
            $(".divRenderFacilityItems:eq(0)").clone(true).show().appendTo(this.divRender);
            return false;
        },
        setEventNewItem :  function(){
            var This = this;
            this.divRender.find(".trigger,.triggerInfo").tooltip();
            
            this.divRender.find(".nameItem").click(function(){
                if($(this).find("input").length==0){
                    $(this).html($("<input style='width:80%' />").val($(this).html()));
                    $(this).find("input").focus().mouseout(function(){
                        if($(this).parent().data("id")!=null){
                            $.post(WEBROOT+"lms/save",
                              {data:{Model:{name:"FacilityItem"},
                              FacilityItem:{id:$(this).parent().data("id"),name:$(this).val()}}})
                        }
                        $(this).parent().html($(this).val());
                    });
                }
            });
            
            this.divRender.find(".triggerAddItem").click(function(){
                    
                    This.divRender.find(".tooltip").remove();
                    This.divRender.find(".trigger").tooltip("destroy");
                    
                    $(this).parent().parent().clone(true)
                           .find("td").removeClass("active").addClass("notSaved").end()
                           .find(".trigger").show().end()
                           .find("span").html("Click para Editar").data("id",null).end()
                           .insertAfter($(this).parent().parent());
                           
                    This.divRender.find(".trigger").tooltip();
                           
            });
            
            this.divRender.find(".triggerDeleteItem").dblclick(function(){
                  ($(this).parent().find("span:eq(0)").data("id")==null)? $(this).parent().parent().remove() : $(this).parent().parent().hide();      
            });
            
            var ElementRender = $(".divRenderFacilityItems:eq(1) .divRenderFacilityItemsJerarquia:first");
            
            this.divRender.find(".cancelButton").click(function(){
                $.each(ElementRender.find("tr"),function(index,item){ ($(this).find("span:eq(0)").data("id")==null)? $(this).remove() : $(this).show();});
            });
            
            return false;
        },
        setEventSave   :    function(){
            var This = this;
            this.divRender.find(".saveButtonTrigger:eq(0)").unbind("click").click(function(){
                
            var ArrayHierachy = [];
            var isModified    = false;
            var ElementRender = $(".divRenderFacilityItems:eq(1) .divRenderFacilityItemsJerarquia:first");
              
                $.each(ElementRender.find("tr"),function(index,item){
                    
                    var deleted = $(this).is(":visible") ? false : true;
                    
                    if($(this).is(":visible")){
                    
                    var newItems = false;
                    if($(this).find("span:eq(0)").data("id")!=null){
                        ArrayHierachy.push({id:$(this).find("span:eq(0)").data("id"),name:$(this).find("span:eq(0)").html()});
                    }else{
                        newItems = true;
                        ArrayHierachy.push({name:$(this).find("span:eq(0)").html()});
                    }
                    
                    }
                    
                    if(deleted || newItems){
                        isModified = true;
                    }
                    
                });
                
                This.newTreeArray = ArrayHierachy;
                
                if(isModified){
                    This.setEventCallModifyStructure();
                }else{
                    /*@*/ModalWindow.callShowModalForWait(Messages.messageNothingToChangeHeader,
                            Messages.messageNothingToChangeBody,{show:true},
                            {showFooter:true,showCancel:true,showContinue:false,cancel:Messages.messageOk}
                         );
                }
            });
            
            return false;
        },
        setEventCallModifyStructure :   function(){
            var This = this;
            /*@*/ ModalWindow.callShowModalForWait(Messages.messageAtencion,Messages.messageModifyStructureWarning,{
                    backdrop : "static",show     : true},
                    {showFooter:true,showCancel:true,showContinue:true,cancel:Messages.messageCancel,continueProcess:Messages.messageContinue});
                  
                  ModalWindow.getNextButton().click(function(){
                    /*@*/ ModalWindow.callNormalWait();
                    $.post(/*@*/Router.urlForSaveHierachy,{data:This.newTreeArray},function(index,item){
                        $('a[href="#/facility"]').click();
                        /*@*/ModalWindow.callHideModalForWait();
                             This.divRender.html("");
                    },"json");                    
                                      
                  });
            return false;
        },
        setCurrentTree :    function(){
            var This = this;
            var ElementRender = $(".divRenderFacilityItems:eq(1) .divRenderFacilityItemsJerarquia:first");
            
            $.each(this.TreeItems,function(index,item){
                if(index==0){
                    ElementRender.find("tr:first td:eq(0) span:eq(0)").html(item.name).data("id",item.id);
                }else if(This.TreeItems.length-1 == index){
                    ElementRender.find("tr:last td:eq(0) span:eq(0)").html(item.name).data("id",item.id);
                }else{
                    ElementRender.find("tr:first").clone(true).insertBefore(ElementRender.find("tr:last"))
                                 .find("td:eq(0)").removeClass("active").end()
                                 .find(".trigger").show().end()
                                 .find("span:eq(0)").html(item.name).data("id",item.id)
                }
            });
            return false;
        },
        decodeTreeArray:    function(data){
            if(data[0].FacilityItem){
                this.TreeItems.push({id:data[0].FacilityItem.id,name:data[0].FacilityItem.name});
                if(data[0].childs.length>0){
                    this.decodeTreeArray(data[0].childs);
                }
            }
            return false;
        },
        startTree   :   function(){
            var This = this;
            var Div = this.divRender.find(".RenderHierachyItems:eq(0)");
            this.divForTree = Div;
                  treeApi = Div.aciTree({autoInit: false,rootData:this.rootData,jsonUrl: /*@*/ Router.urlForGetUnidadDeNegocio,}).aciTree('api');
                  treeApi.init({uid: 'user-defined'});
                    
                  Div.on('click', '.aciTreeItem', function(e) {
                        This.divRender.find(".cancelButton").click();
                        var divRender = $(".divRenderFacilityItemsJerarquia:eq(1)");
                        var divRenderTr = divRender.find("tr:eq("+treeApi.level(treeApi.itemFrom(this))+")");
                            divRender.find("td").removeClass("selectedHierachy");
                            divRenderTr.fadeIn(100).fadeOut(100).fadeIn(100,function(){divRenderTr.find("td").addClass("selectedHierachy");});
                  });
                    
             return false;                      
        },
        setActionForAddAndDeleteChild   :   function(){
            var This = this;
            this.divRender.find(".addChild").click(function(){
                This.selectedOneTree = This.divForTree.find(".aciTreeSelected:eq(0)");
               var idParent = (treeApi.getId(treeApi.itemFrom(This.divForTree.find(".aciTreeSelected:eq(0)"))));
               if(idParent==null){
                alert("Seleccione la unidad de negocio donde desea agregarla subunidad");
               }else if(!treeApi.isFolder(This.selectedOneTree)){
                alert("Usted seleccionó una unidad mínima de jerarquía, por lo cual ya no puede agregar más niveles debajo de esta unidad de negocio");
               }
               else{
                $("#newUnidadDeNegocio").find("input[type='text']").val("");
                $("#idEditable").val("");
                $("#ParentIdNewItem").val(idParent);
                $("#newUnidadDeNegocio").modal("show");
               }
            });
            
            this.divRender.find(".editChild").click(function(){
                This.selectedOneTree = This.divForTree.find(".aciTreeSelected:eq(0)");
               var idParent = (treeApi.getId(treeApi.itemFrom(This.divForTree.find(".aciTreeSelected:eq(0)"))));
               if(idParent==null){
                alert("Seleccione la unidad de negocio que desea editar");
               }
               else{
                /*@*/ModalWindow.callNormalWait();
                
                $.post(Router.urlForReadModel,{data:{Model:"FacilityItem",Id:idParent}},function(data,status){
                    /*@*/ModalWindow.callHideModalForWait();
                                    $("#newUnidadDeNegocio").find("input[type='text']").val("");
                                    $("#ParentIdNewItem").val(idParent);
                                    $("#idEditable").val(idParent);
                                    $("#nameForNewTreeItem").val(data.data.FacilityItem.name);
                                    $("#codeForNewTreeItem").val(data.data.FacilityItem.code);
                                    $("#newUnidadDeNegocio").modal("show");
                },"json");
                

               }
            });
        },
        setSaveNewItem  :   function(){
            var This = this;
            if($("#addNewItemHierachy").data("setted")==null){
                
                $("#addNewItemHierachy").data("setted","setted");
            
               $("#addNewItemHierachy").click(function(){
                  $("#newUnidadDeNegocio").modal("hide");
                /*@*/ModalWindow.callNormalWait();
                $.post(/*@*/Router.urlForSave,$("#formularioAddNewItem").serializeArray(),function(data,status){
                    
                    if($("#idEditable").val()!=""){
                        treeApi.setLabel(This.selectedOneTree,{label:$("#nameForNewTreeItem").val()+"("+$("#codeForNewTreeItem").val()+")"});
                    }
                
                var ItemToCheck = This.divForTree.find(".aciTreeSelected:eq(0)");
                if(treeApi.isFolder(ItemToCheck)){
                treeApi.unload(ItemToCheck,{uid: 'user-defined',success: function(item) {
                                    treeApi.ajaxLoad(ItemToCheck,{uid: 'user-defined',success: function(){treeApi.open(ItemToCheck); }});
                    }
                });      
                }        
                /*@*/ModalWindow.callHideModalForWait();
                },"json");
            });
            }
            
            return false;
            
        },
        setUploadButton :   function(){
            var This = this;
                this.divRender.find('#fileupload').fileupload({
                    dataType: 'json',
                    done: function (e, data) {
                        
                        var File = data.result[0].name;
                        This.fileUnidadesDeNegocio = File;
                        $('.bar').css('width',0 + '%');
                        /*@*/ModalWindow.callShowModalForWait(/*@*/Messages.messageWaitPlease,
                                                                  "",
                                                                  {show:true,backdrop : "static"},
                                                                  {showFoother:false,cancel:"",continueProcess:""}
                                                                  );
                        $.post(WEBROOT+"lms/readExcelUnidadesDeNegocio",{data:{File:File}},function(data,status){
                            
                            if(data.correct){
                               /*@*/ModalWindow.callShowModalForWait(/*@*/Messages.messageCorrecto,
                                                                     /*@*/Messages.messageCorrectValidateUnidadNegocioFile,
                                                                     {show:true,backdrop : "static"},
                                                                     {showContinue:true,showCancel:true,showFooter:true,cancel:/*@*/Messages.messageCancel,continueProcess:/*@*/Messages.messageContinue}
                                                                  
                                                                     ); 
                               /*@*/ModalWindow.getNextButton().click(function(){
                                    /*@*/ModalWindow.callShowModalForWait(/*@*/Messages.messageWaitPlease,
                                                                  "",
                                                                  {show:true,backdrop : "static"},
                                                                  {showFoother:false,cancel:"",continueProcess:""}
                                        );
                                        
                                        $.post(WEBROOT+"lms/saveUnidadesDeNegocio",{data:{File:This.fileUnidadesDeNegocio}},function(data,status){
                                            /*@*/ModalWindow.callShowModalForWait(/*@*/Messages.messageListo,
                                                                  Messages.messageReadyUploadUnidadesDeNegocio,
                                                                  {show:true,backdrop : "static"},
                                                                  {showFoother:true,showCancel:true,cancel:Messages.messageOk,continueProcess:"",showContinue:false}
                                            );
                                            treeApi.destroy( {
                                                success: function (item, options){
                                                treeApi.init();
                                            }
                                            });
                                        },"json");
                                        
                               });
                            }else{
                                
                            var htmlErrors = "";
                            
                              if(data.errors.nivel_no_number.length>0){
                                    htmlErrors += "<br/><span class='label label-important'>"+Messages.messsageErrorNivelNotNumber+"</span><br/>";
                                      
                                
                              $.each(data.errors.nivel_no_number,function(index,item){
                                htmlErrors+='<span class="badge badge-warning">'+item+'</span>';
                              });
                                
                              } 
                            
                              if(data.errors.codigo_repetido.length>0){
                                    htmlErrors += "<br/><span class='label label-important'>"+Messages.messsageErrorCodigoRepetido+"</span><br/>";
                                    htmlErrors += "<table><thead><tr><th>Código</th><th>Nombre</th><th>Nivel</th></tr></thead>";  
                                
                              $.each(data.errors.codigo_repetido,function(index,item){
                                htmlErrors+="<tr><td>"+item.code+"</td><td>"+item.name+"</td><td>"+item.nivel+"</td></tr>";
                              });
                                
                              htmlErrors += "</table>";
                              }  

                              if(data.errors.no_hay_nombre.length>0){
                                    htmlErrors += "<br/><span class='label label-important'>"+Messages.messsageErrorNoHayNombre+"</span><br/>";
                                    htmlErrors += "<table><thead><tr><th>Código</th><th>Nombre</th><th>Nivel</th></tr></thead>";  
                                
                              $.each(data.errors.no_hay_nombre,function(index,item){
                                htmlErrors+="<tr><td>"+item.code+"</td><td> </td><td>"+item.nivel+"</td></tr>";
                              });
                                
                              htmlErrors += "</table>";
                              } 
                              
                              if(data.errors.no_hay_codigo.length>0){
                                    htmlErrors += "<br/><span class='label label-important'>"+Messages.messsageErrorNoHayCodigo+"</span><br/>";
                                    htmlErrors += "<table><thead><tr><th>Código</th><th>Nombre</th><th>Nivel</th></tr></thead>";  
                                
                              $.each(data.errors.no_hay_codigo,function(index,item){
                                htmlErrors+="<tr><td></td><td>"+item.name+"</td><td>"+item.nivel+"</td></tr>";
                              });
                                
                              htmlErrors += "</table>";
                              }  
                              
                              if(data.errors.no_hay_unidad.length>0){
                                    htmlErrors += "<br/><span class='label label-important'>"+Messages.messsageErrorNoHayUnidad+"</span><br/>";
                                    htmlErrors += "<table><thead><tr><th>Código</th><th>Nombre</th><th>Nivel</th></tr></thead>";  
                                
                              $.each(data.errors.no_hay_unidad,function(index,item){
                                htmlErrors+="<tr><td>"+item.code+"</td><td>"+item.name+"</td><td>"+item.nivel+"</td></tr>";
                              });
                                
                              htmlErrors += "</table>";
                              }                                 

                              if(data.errors.error_codigo_unidad_arriba.length>0){
                                    htmlErrors += "<br/><span class='label label-important'>"+Messages.messsageErrorNoExiste+"</span><br/>";
                                    htmlErrors += "<table><thead><tr><th>Código</th><th>Nombre</th><th>Nivel</th></tr></thead>";  
                                
                              $.each(data.errors.error_codigo_unidad_arriba,function(index,item){
                                if(item!=""){
                                    htmlErrors+="<tr><td>"+item+"</td><td></td><td>"+data.errors.level_codigo_unidad_arriba[index]+"</td></tr>";
                                }
                              });
                                
                              htmlErrors += "</table>";
                              }                                
                                
                                
                              /*@*/ModalWindow.callShowModalForWait(/*@*/Messages.messageErrores,
                                                                     /*@*/Messages.messageErrorValidateUnidadNegocioFile+htmlErrors,
                                                                     {show:true,backdrop : "static"},
                                                                     {showFooter:true,cancel:/*@*/Messages.messageOk,showContinue:false
                                                                     }
                                                                  
                                                                     );   
                            }
                        },"json");
                    },
                    progressall: function (e, data) {
                        var progress = parseInt(data.loaded / data.total * 100, 10);
                        $('.bar').css('width',progress + '%');
                    },
                    maxFileSize: 5000000,
                    acceptFileTypes: /(\.|\/)(xls)$/i
                });
                
                this.divRender.find('#fileupload')
                               .bind('fileuploadadd', function (e, data) {

                                if(data.files[0].type!="application/vnd.ms-excel"){
                                    alert("Este tipo de archivo no es valido suba un archivo de 'Unidades de Negocio'")   
                                }
                               })
                
                this.divRender.find("#imageTriggerUpload").click(function(){
                    This.divRender.find("#fileupload").click();
                });
            
        },
        setActionDeleteChild :   function(){
            var This = this;
            this.divRender.find(".deleteChild").click(function(){
                
                This.selectedOneTree = This.divForTree.find(".aciTreeSelected:eq(0)");
               var idParent = (treeApi.getId(treeApi.itemFrom(This.divForTree.find(".aciTreeSelected:eq(0)"))));
               if(idParent==null){
                alert("Seleccione la unidad de negocio donde desea Eliminar");
               }
               else{
                /*@*/ModalWindow.callShowModalForWait(Messages.messageAtencion,Messages.messageDeleteChild,
                    {show:true,backdrop : "static"},
                    {showFooter:true,
                     cancel:/*@*/Messages.messageCancel,showContinue:true,
                     continueProcess:/*@*/Messages.messageContinue
                    }
                    );
                    
                /*@*/ModalWindow.getNextButton().click(function(){
                                    /*@*/ModalWindow.callShowModalForWait(/*@*/Messages.messageWaitPlease,
                                                                  "",
                                                                  {show:true,backdrop : "static"},
                                                                  {showFoother:false,cancel:"",continueProcess:""}
                                        );
                                        
                                        $.post(WEBROOT+"lms/deleteUnidadesDeNegocio",{data:{Id:idParent}},function(data,status){
                                            /*@*/ModalWindow.callShowModalForWait(/*@*/Messages.messageListo,
                                                                  Messages.messageReadyUploadUnidadesDeNegocio,
                                                                  {show:true,backdrop : "static"},
                                                                  {showFoother:true,showCancel:true,cancel:Messages.messageOk,continueProcess:"",showContinue:false}
                                            );
                                            
                                            var ItemSelected = This.divForTree.find(".aciTreeSelected:eq(0)");
                                            
                                            if(treeApi.level(ItemSelected)!=0){
                                            
                                            treeApi.remove(ItemSelected,{
                                                success: function (item, options){
                                                /*@*/ModalWindow.callShowModalForWaitReady();
                                                }
                                                }
                                                );
                                            }else{
                                                treeApi.unload(ItemSelected);
                                            }
                                            
                                           
                                        },"json");
                                        
                });
               }
               
            });
               
        }
               
};
