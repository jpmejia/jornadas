var clickObject = {};

var Global = {
    TemplateProgramas     :{
        IdForTemplateProgramas: "#templateProgramas",
        IdForDivContentOnTheLeft     : ".TemplateProgramasSearch:eq(0)",
        IdForDivContentOnTheRight    : "",
        IdForSelectPrograma         : ".ProgramasSelect:eq(0)",
        IdForSelectCategoria         : ".CategoriasSelect:eq(0)",
        IdForToolBar                : ".barTool:eq(0)",
        IdForAfterWhereInsertToolbar: ".alert:eq(0)",
        IdForAddCoursesButton       : ".addCourses:eq(0)"
    },
    TemplateEdicion        :{
        IdForTemplateEdicion : "#myModal",
        IdForEditButton    :  "#EditTrigger",
        IdForSaveButton    : "#submitRightButton"
    },
    TemplateGrupos        :{
        IdForTemplateGrupos: "#templateGrupos",
        IdForDivContentOnTheLeft     : ".TemplateGruposSearch:eq(0)",
        IdForDivContentOnTheRight    : "",
        IdForSelectGrupos         : ".GruposSelect:eq(0)",
        IdForOptionProgramas         : ".optionProgramas:eq(0)",
        IdForOptionPuestos         : ".optionPuestos:eq(0)",
        IdForOptionUnidades         : ".optionUnidades:eq(0)",
        IdForOptionUsuarios         : ".optionUsuarios:eq(0)",
        IdForToolBar                : ".barTool:eq(0)",
        IdForAfterWhereInsertToolbar: ".alert:eq(0)",
        IdForAddCoursesButton       : ".addCourses:eq(0)",
        IdForOptions                : ".options",
        IdForToolBar                : ".barTool:eq(0)",
        IdForAfterWhereInsertToolbar: ".alert:eq(0)",  
        IdForSaveButton             : ".saveButton"  
    },
    DomForDivOnTheLeft    : null,
    DomForDivOnTheRight   : null,
    IdForTheDivInTheRight : "ContenidoDerecha",
    IdForTheDivInTheLeft  : "LeftContent",
    getFromRightDiv       : function(String){
        var String = String.split(".");
        return this.getRightDiv().find(eval("this.Template"+String[0]+"."+"IdFor"+String[1]));
    },
    getLeftDiv : function(){
        if(this.DomForDivOnTheLeft==null){this.DomForDivOnTheLeft = $("#"+this.IdForTheDivInTheLeft)}
        return this.DomForDivOnTheLeft;
    },
    getRightDiv: function(){
        if(this.DomForDivOnTheRight==null){this.DomForDivOnTheRight = $("#"+this.IdForTheDivInTheRight)}
        return this.DomForDivOnTheRight;
    },
    getNode : function(String){
        //Programas.Left
        var String = String.split(".");
        var idTemplate = eval("this.Template"+String[0]+"."+"IdForTemplate"+String[0]);
        var idContent  = eval("this.Template"+String[0]+"."+"IdFor"+String[1]);
        return $(idTemplate+" "+idContent);
        
    },
    getContent : function(String){
        //Programas.Left
        var String = String.split(".");
        var idTemplate = eval("this.Template"+String[0]+"."+"IdForTemplate"+String[0]);
        var idContent  = eval("this.Template"+String[0]+"."+"IdForDivContentOnThe"+String[1]);
        
        return $(idTemplate+" "+idContent).clone(true);
        
    },
    getContentItem : function(String){
        var String = String.split(".");
        var idTemplate = eval("this.Template"+String[0]+"."+"IdForTemplate"+String[0]);
        var idContent  = eval("this.Template"+String[0]+"."+"IdForDivContentOnThe"+String[1]);
        return $(idTemplate+" "+idContent);
        
    },
    getContentNode: function(String){
        //Programas.Left.SelectProgramas
        var String = String.split(".");
        var DivParent = eval("this.get"+String[1]+"Div()");
        var Node      = eval("this.Template"+String[0]+".IdFor"+String[2]);
        return DivParent.find(Node);
    },
    getRightTable : function(){
        return this.getRightDiv().find("table:eq(0)");
    },
    cleanRight    : function(){
        this.getRightDiv().html("");
        return false;
    },
    cleanLeft     : function(){
        this.getLeftDiv().html("");
    }
};