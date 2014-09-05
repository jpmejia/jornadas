var ModalWindow = {
    modalForWait : $("#myModalWait"),
    callShowModalForWait: function(Header,Body,Options,Others){
         
        this.modalForWait.find(".modal-header:eq(0) .modificar:eq(0)").html(Header);
        this.modalForWait.find(".modal-body:eq(0)").html(Body);
        this.modalForWait.modal(Options);
        this.modalForWait.find(".modal-footer:eq(0)").toggle(Others.showFooter);
        this.modalForWait.find(".modal-footer:eq(0) .cancelar:eq(0)").html(Others.cancel);
        this.modalForWait.find(".modal-footer:eq(0) .follow:eq(0)").html(Others.continueProcess);
        
        var nextButton = this.modalForWait.find(".modal-footer:eq(0) .follow:eq(0)").clone()
                         this.modalForWait.find(".modal-footer:eq(0) .follow:eq(0)").remove();
                         nextButton.appendTo(this.modalForWait.find(".modal-footer:eq(0)"));
        
        
        if(Others.hasOwnProperty("showCancel")){
            this.modalForWait.find(".modal-footer:eq(0) .cancelar:eq(0)").toggle(Others.showCancel);
        }
        if(Others.hasOwnProperty("showContinue")){
            this.modalForWait.find(".modal-footer:eq(0) .follow:eq(0)").toggle(Others.showContinue); 
        }
        
        return false;
    },
    callShowModalForWaitReady:  function(){
        this.modalForWait.find(".modal-header:eq(0) .modificar:eq(0)").html(Messages.messageListo);
        this.modalForWait.find(".modal-body:eq(0)").html("");
        this.modalForWait.modal("show");
        this.modalForWait.find(".modal-footer:eq(0)").toggle(true);
        this.modalForWait.find(".modal-footer:eq(0) .cancelar:eq(0)").html(Messages.messageOk);
        this.modalForWait.find(".modal-footer:eq(0) .follow:eq(0)").toggle(false); 
        return false;
    },
    callHideModalForWait :function(){
        this.modalForWait.modal("hide");
        return false;
    },
    getNextButton : function(){
        return this.modalForWait.find(".modal-footer:eq(0) .follow:eq(0)");
    },
    callNormalWait: function(){
        this.modalForWait.find(".modal-header:eq(0) .modificar:eq(0)").html(Messages.messageWaitPlease);
        this.modalForWait.find(".modal-body:eq(0)").html("");
        this.modalForWait.modal({backdrop : "static",show : true});
        this.modalForWait.find(".modal-footer:eq(0)").toggle(false);
        return false;
    }
};