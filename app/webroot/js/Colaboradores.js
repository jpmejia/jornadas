var Colaboradores   =   {
    totalRecords     : 0,
    htmlNameTemplate : ".templateColaboradores:eq(0)",
    htmlNameBarTool  : ".barTool:eq(0)",
    htmlNameForSearchForm : ".templateColaboradoresSearch:eq(0)",
    divRender        : null,
    divRenderSearch  : null,
    hola    : 22,
    init    :   function(){
        this.divRender = /*@*/ Global.getRightDiv();
        this.divRenderSearch = /*@*/ Global.getLeftDiv();
        clickObject.setHtmlContent("dataColaboradores");
        this.setBarTool();
        this.setUploadButton();
        this.initSearchForm();
        return false;
    },
    callBackAfterSearch :   function(){
        this.totalRecords = clickObject.TotalRecords;
        var TotalPages = Math.ceil(this.totalRecords / Data["dataColaboradores"]["limitPage"]);
        
        var Options = "";
        for(i=1;i<=TotalPages;i++){
            Options += "<option value='"+i+"'>"+i+"</option>";
        }
        
        this.divRender.find("select").html(Options).change(function(){
            clickObject.fillTablePage("dataColaboradores",$(this).val());
        });
        
        return false;  
    },
    initSearchForm  :   function(){
        $(this.htmlNameForSearchForm).clone().appendTo(this.divRenderSearch).show();
        return false;
    },
    setBarTool  :   function(){
        $(this.htmlNameTemplate+" "+this.htmlNameBarTool).clone().insertAfter(/*@*/Global.getRightDiv().find(".headerRight:eq(1)"));
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
                        
                        /*@*/ModalWindow.callNormalWait();
                        
                        $.post(/*@*/Router.Colaboradores.urlForReadExcelUsuarios,{data:{File:File}},function(data,status){
                            
                            if(data.correct){
                               /*@*/ModalWindow.callShowModalForWait(/*@*/Messages.messageCorrecto,
                                                                     /*@*/Messages.messageCorrectValidateUnidadNegocioFile,
                                                                     {show:true,backdrop : "static"},
                                                                     {showContinue:true,showCancel:true,showFooter:true,cancel:/*@*/Messages.messageCancel,continueProcess:/*@*/Messages.messageContinue}
                                                                  
                                                                     ); 
                               /*@*/ModalWindow.getNextButton().click(function(){
                                    /*@*/ModalWindow.callShowModalForWait(/*@*/Messages.messageWaitPlease,"",{show:true,backdrop : "static"},{showFoother:false,cancel:"",continueProcess:""});
                                        
                                        $.post(/*@*/Router.Colaboradores.urlForSaveExcelUsuarios,{data:{File:This.fileUnidadesDeNegocio}},function(data,status){
                                            /*@*/ModalWindow.callShowModalForWait(/*@*/Messages.messageListo,
                                                                  Messages.messageReadyUploadUnidadesDeNegocio,
                                                                  {show:true,backdrop : "static"},
                                                                  {showFoother:true,showCancel:true,cancel:Messages.messageOk,continueProcess:"",showContinue:false}
                                            );
                                            
                                        },"json");
                                        
                               });
                            }else{
                                
                            var htmlErrors = "";
                           
                                                                                            
                                
                                
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
            
        }
    
    
    
};