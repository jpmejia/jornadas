var Data = {
    
    dataColaboradores:{
        headerForm : "Listado de Colaboladores",
        headerFormClass: "curso",
        headerTable: "",
        help       : "Utiliza la columna izquierda para hacer un <b>filtro</b> m�s espec�fico de los <b>usuarios</b>. <b>Edita</b> o <b>Elimina</b> a los <b>usuarios</b> haciendo <b>clic en su username</b>.",
        formulario : null,
        modelo    : "Usuario",
        headers   : ["Selecci�n","Usuario","N�mina","Nombre","Apellidos","Puesto","Divisi�n","Cursos"],
        headersClass: ["t-idcurso","t-curso","t-idcurso","t-horas","t-modalidad","t-orden","t-requisito","t-calendario","t-calificacion"],
        campos    : ["<input type='checkbox'/>","Usuario.username","Usuario.nomina","Usuario.nombre","Usuario.apellidos","Puesto.name","Usuario.codigo_unidad_minima","<a>Ver</a>"],
        limitPage : 50,
        page      : 1
            
    },   
    
    dataSalas : {
        headerForm : "Alta de Salas",
        headerFormClass: "programa",
        headerTable: "Cat�logo de Salas",
        headerTableClass: "catalogo",
        help: "Llena los siguientes campos para <b>crear</b> una sala.<b>Edita</b> o <b>Elimina</b> alguna <b>sala</b> haciendo <b>clic en su Id</b>.",
        formulario :[
            {tipo:"text",label:"Nombre de la Sala",placeHolder:"Nombre de la Sala",name:"data[Sala][name]"}
        ],
        modelo    : "Sala",
        headers   : ["Id.Sala","Nombre"],
        headersClass: ["t-idcurso","t-programa"],
        campos    : ["Sala.id","Sala.name"]
        
    },
    
    dataRecursos : {
        headerForm : "Alta de Recursos",
        headerFormClass: "programa",
        headerTable: "Cat�logo de Recursos",
        headerTableClass: "catalogo",
        help: "Llena los siguientes campos para <b>crear</b> una recurso.<b>Edita</b> o <b>Elimina</b> alg�n <b>recurso</b> haciendo <b>clic en su Id</b>.",
        formulario :[
            {tipo:"text",label:"Nombre del recurso",placeHolder:"Nombre del recurso",name:"data[Recurso][name]"}
        ],
        modelo    : "Recurso",
        headers   : ["Id.recurso","Nombre"],
        headersClass: ["t-idcurso","t-programa"],
        campos    : ["Recurso.id","Recurso.name"]
        
    },
    
    dataLugares : {
        headerForm : "Alta de Lugares",
        headerFormClass: "programa",
        headerTable: "Cat�logo de Lugares",
        headerTableClass: "catalogo",
        help: "Llena los siguientes campos para <b>crear</b> un lugar .<b>Edita</b> o <b>Elimina</b> alg�n <b>lugar</b> haciendo <b>clic en su Id</b>.",
        formulario :[
            {tipo:"text",label:"Nombre de la Sala",placeHolder:"Nombre de la Sala",name:"data[Lugare][name]"}
        ],
        modelo    : "Lugare",
        headers   : ["Id.Sala","Nombre"],
        headersClass: ["t-idcurso","t-programa"],
        campos    : ["Lugare.id","Lugare.name"]
        
    },
    
    
    dataProgramas : {
        headerForm : "Alta de Programas",
        headerFormClass: "programa",
        headerTable: "Cat�logo de Programas",
        headerTableClass: "catalogo",
        help: "Llena los siguientes campos para <b>crear</b> un programa.<b>Edita</b> o <b>Elimina</b> alg�n <b>programa</b> haciendo <b>clic en su Id</b>. Despues <b>asigna</b> el <b>curso</b> a un <b>programa</b>.",
        formulario :[
            {tipo:"text",label:"Nombre del Programa",placeHolder:"Nombre del Programa",name:"data[Programa][name]"}
        ],
        modelo    : "Programa",
        headers   : ["Id.Programa","Programa"],
        headersClass: ["t-idcurso","t-programa"],
        campos    : ["Programa.id","Programa.name"]
        
    },
    
    dataCategorias : {
        headerForm : "Categor�as de Cursos",
        headerTable: "Cat�logo de Categorias",
        headerTableClass: "catalogo",
        headerFormClass: "categoria",
        help       : "Llena los siguientes campos para <b>crear</b> una categor�a.<b>Edita o Elimina</b> alguna categor�a en el cat�logo inferior,<b> haciendo clic en su Id.</b>",
        formulario :[
            {tipo:"text",label:"Id Categor�a",placeHolder:"Escriba una Id �nica",name:"data[Categoria][code]"},
            {tipo:"text",label:"Descripci�n",placeHolder:"Nombre de la Categoria",name:"data[Categoria][name]"},
            {tipo:"text",label:"Ordenamiento",placeHolder:"N�mero para Dar Una Jerarqu�a",name:"data[Categoria][ordenamiento]"},
        ],
        modelo    : "Categoria",
        headers   : ["Id.cat","Categor�a","Orden"],
        headersClass: ["t-idcurso","t-categoria","t-orden"],
        campos    : ["Categoria.code","Categoria.name","Categoria.ordenamiento"]
        
    },
    
    dataCursoElearning:{
        headerForm : "Curso en L�nea",
        headerFormClass: "online",
        headerTable: "",
        help       : "Llena los siguientes campos para <b>ligar</b> el curso de <b>moodle</b> con los <b>reportes</b>.",
        formulario :[
            {tipo:"select",label:"Categor�a",placeHolder:"Escriba una Id �nica",name:"data[Curso][categoria_id]",Model:"Categoria",options:{}},
            {tipo:"text",label:"Nombre del Curso",placeHolder:"Nombre que ver�n los usuarios",name:"data[Curso][name]"},
            {tipo:"text",label:"Id en Plataforma",placeHolder:"Nombre corto del curso",name:"data[Curso][id_en_plataforma]"},
            {tipo:"select",label:"Horas del Curso",name:"data[Curso][horas_de_curso]",options:{5:5,10:10,15:15,20:20}},
            {tipo:"select",label:"Calificaci�n Aprobatoria",name:"data[Curso][calificacion_aprobatoria]",options:{80:80,75:75,70:70,60:60}},
            {tipo:"text",label:"Ordenamiento",placeHolder:"Orden en el que aparecen",name:"data[Curso][ordenamiento]"},
            {tipo:"text",label:"Cumplimiento",placeHolder:"D�as del curso",name:"data[Curso][cumplimiento]"},
            {tipo:"hidden",label:"",name:"data[Curso][modalidad]",value:"E-Learning"}
        ],
        modelo    : "Curso",
        headers   : [],
        campos    : []
        
    },
    
    dataCursoPresencial:{
        headerForm : "Curso Presencial",
        headerTable: "",
        headerFormClass: "personas",
        help       : "Llena los siguientes campos para <b>ligar</b> el curso de <b>moodle</b> con los <b>reportes</b>.",
        formulario :[
            {tipo:"select",label:"Categor�a",placeHolder:"Escriba una Id �nica",name:"data[Curso][categoria_id]",Model:"Categoria",options:{}},
            {tipo:"text",label:"Nombre del Curso",placeHolder:"Nombre que ver�n los usuarios",name:"data[Curso][name]"},
            {tipo:"text",label:"Id en Plataforma",placeHolder:"Nombre corto del curso",name:"data[Curso][id_en_plataforma]"},
            {tipo:"select",label:"Horas del Curso",name:"data[Curso][horas_de_curso]",options:{5:5,10:10,15:15,20:20}},
            {tipo:"text",label:"Fecha de Inicio",name:"data[Curso][fecha_de_inicio]",className:"datepicker"},
            {tipo:"text",label:"Fecha de Fin",name:"data[Curso][fecha_de_fin]",className:"datepicker"},
            {tipo:"text",label:"Total de Clases",name:"data[Curso][total_de_clases]"},
            {tipo:"text",label:"Asistencias Necesarias",name:"data[Curso][asistencias_necesarias]"},
            {tipo:"hidden",label:"",name:"data[Curso][modalidad]",value:"Presencial"}
        ],
        modelo    : "Curso",
        headers   : [],
        campos    : []
        
    },
    
    dataCursosList:{
        headerForm : "Listado de Cursos",
        headerFormClass: "curso",
        headerTable: "",
        help       : "Utiliza la columna izquierda para hacer un <b>filtro</b> m�s espec�fico de los <b>cursos</b>. <b>Edita</b> o <b>Elimina</b> alg�n <b>curso</b> haciendo <b>clic en su Id</b>.",
        formulario : null,
        modelo    : "Curso",
        headers   : ["Id.Curso","Curso","Id.Plat.","Horas","Modalidad","Orden","Pre-req.","Cumpl.","Cal.Ap."],
        headersClass: ["t-idcurso","t-curso","t-idcurso","t-horas","t-modalidad","t-orden","t-requisito","t-calendario","t-calificacion"],
        campos    : ["Curso.id","Curso.name","Curso.id_en_plataforma","Curso.horas_de_curso","Curso.modalidad","Curso.ordenamiento","Curso.ordenamiento","Curso.cumplimiento","Curso.calificacion_aprobatoria"]
            
    },
    
    dataPuestos : {
        urlSave    : WEBROOT+"puestos/savePuesto",
        headerForm : "Alta de Puestos",
        headerTable: "Cat�logo de puestos",
        headerTableClass: "catalogo",
        headerFormClass: "categoria",
        help       : "Llena los siguientes campos para <b>crear</b> un puesto.<b>Edita o Elimina</b> algun puesto en el cat�logo inferior,<b> haciendo clic en su Id.</b>",
        formulario :[
            {tipo:"text",label:"Descripci�n",placeHolder:"Nombre de el puesto",name:"data[Puesto][name]"},
            {tipo:"text",label:"C�digo",placeHolder:"C�digo del puesto",name:"data[Puesto][code]"},
        ],
        modelo    : "Puesto",
        headers   : ["Id.puestos","Puesto","Codigo"],
        headersClass: ["t-idcurso","t-categoria","t-orden"],
        campos    : ["Puesto.id","Puesto.name","Puesto.code"]
        
    },
    
    dataGrupos : {
        headerForm : "Alta de Grupos",
        headerTable: "Cat�logo de Grupos",
        headerTableClass: "catalogo",
        headerFormClass: "Grupos",
        help       : "Llena los siguientes campos para <b>crear</b> un Grupo.<b>Edita o Elimina</b> algun Grupo en el cat�logo inferior,<b> haciendo clic en su Id.</b>",
        formulario :[
            {tipo:"text",label:"Descripci�n",placeHolder:"Nombre de el Grupo",name:"data[Grupo][name]"}
        ],
        modelo    : "Grupo",
        headers   : ["Id.Grupo","Nombre"],
        headersClass: ["t-idcurso","t-categoria"],
        campos    : ["Grupo.id","Grupo.name"]
        
    },
    
    dataInstructores : {
        headerForm : "Alta de Instructores",
        headerTable: "Cat�logo de Instructores",
        headerTableClass: "catalogo",
        headerFormClass: "Instructores",
        help       : "Llena los siguientes campos para <b>crear</b> un Grupo.<b>Edita o Elimina</b> algun Grupo en el cat�logo inferior,<b> haciendo clic en su Id.</b>",
        formulario :[
            {tipo:"text",label:"Descripci�n",placeHolder:"Nombre del Instructore",name:"data[Instructores][name]"}
        ],
        modelo    : "Instructores",
        headers   : ["Id.Instructor","Nombre"],
        headersClass: ["t-idcurso","t-categoria"],
        campos    : ["Instructores.id","Instructores.name"]
        
    },
    
    dataRepresentantes : {
        headerForm : "Alta de Representante",
        headerTable: "Cat�logo de Representante",
        headerTableClass: "catalogo",
        headerFormClass: "Representantes",
        help       : "Llena los siguientes campos para <b>crear</b> un Grupo.<b>Edita o Elimina</b> algun Grupo en el cat�logo inferior,<b> haciendo clic en su Id.</b>",
        formulario :[
            {tipo:"text",label:"Descripci�n",placeHolder:"Nombre del Representante",name:"data[Representantes][name]"}
        ],
        modelo    : "Representantes",
        headers   : ["Id.Representante","Nombre"],
        headersClass: ["t-idcurso","t-categoria"],
        campos    : ["Representantes.id","Representantes.name"]
        
    },
    
    dataCapacitadores : {
        headerForm : "Alta de Capacitadores",
        headerTable: "Cat�logo Capacitadores",
        headerTableClass: "catalogo",
        headerFormClass: "Capacitadores",
        help       : "Llena los siguientes campos para <b>crear</b> un Grupo.<b>Edita o Elimina</b> algun Grupo en el cat�logo inferior,<b> haciendo clic en su Id.</b>",
        formulario :[
            {tipo:"text",label:"Descripci�n",placeHolder:"Nombre del Capacitador",name:"data[Capacitadores][name]"}
        ],
        modelo    : "Capacitadores",
        headers   : ["Id.Representante","Nombre"],
        headersClass: ["t-idcurso","t-categoria"],
        campos    : ["Capacitadores.id","Capacitadores.name"]
        
    },
    
    dataOcupaciones : {
        headerForm : "Alta de Ocupaciones",
        headerTable: "Cat�logo de Ocupaciones",
        headerTableClass: "catalogo",
        headerFormClass: "Ocupaciones",
        help       : "Llena los siguientes campos para <b>crear</b> un Grupo.<b>Edita o Elimina</b> algun Grupo en el cat�logo inferior,<b> haciendo clic en su Id.</b>",
        formulario :[
            {tipo:"text",label:"Descripci�n",placeHolder:"Nombre de la Ocupaci�n",name:"data[Ocupaciones][name]"}
        ],
        modelo    : "Ocupaciones",
        headers   : ["Id.Ocupaci�n","Nombre"],
        headersClass: ["t-idcurso","t-categoria"],
        campos    : ["Ocupaciones.id","Ocupaciones.name"]
        
    },
    
    dataAreas : {
        headerForm : "Alta de Areas",
        headerTable: "Cat�logo de Areas",
        headerTableClass: "catalogo",
        headerFormClass: "Areas",
        help       : "Llena los siguientes campos para <b>crear</b> un Grupo.<b>Edita o Elimina</b> algun Grupo en el cat�logo inferior,<b> haciendo clic en su Id.</b>",
        formulario :[
            {tipo:"text",label:"Descripci�n",placeHolder:"Nombre de la �rea",name:"data[Areas][name]"}
        ],
        modelo    : "Areas",
        headers   : ["Id.Area","Nombre"],
        headersClass: ["t-idcurso","t-categoria"],
        campos    : ["Areas.id","Areas.name"]
        
    },
    
    dataProgramasCursos:{
        headerForm : "Listado de Cursos",
        headerFormClass: "curso",
        headerTable: "",
        help       : "Utiliza la columna izquierda para hacer un <b>filtro</b> m�s espec�fico de los <b>usuarios</b>. <b>Edita</b> o <b>Elimina</b> a los <b>usuarios</b> haciendo <b>clic en su username</b>.",
        formulario : null,
        modelo    : "X",
        headers   : ["","Curso","Categor�a"],
        headersClass: ["t-idcurso","t-curso","t-idcurso"],
        campos    : ["<input type='checkbox'/>","Usuario.username","Usuario.nomina"]
            
    },  
    
    dataGruposProgramas:{
        headerForm : "Listado de Cursos",
        headerFormClass: "curso",
        headerTable: "",
        help       : "Utiliza la columna izquierda para hacer un <b>filtro</b> m�s espec�fico de los <b>usuarios</b>. <b>Edita</b> o <b>Elimina</b> a los <b>usuarios</b> haciendo <b>clic en su username</b>.",
        formulario : null,
        modelo    : "X",
        headers   : ["","Programa"],
        headersClass: ["t-idcurso","t-curso"],
        campos    : ["<input type='checkbox'/>","Usuario.username"]
            
    }, 
    
    dataGruposPuestos:{
        headerForm : "Listado de Puestos",
        headerFormClass: "curso",
        headerTable: "",
        help       : "Utiliza la columna izquierda para hacer un <b>filtro</b> m�s espec�fico de los <b>usuarios</b>. <b>Edita</b> o <b>Elimina</b> a los <b>usuarios</b> haciendo <b>clic en su username</b>.",
        formulario : null,
        modelo    : "X",
        headers   : ["","Puesto"],
        headersClass: ["t-idcurso","t-curso"],
        campos    : ["<input type='checkbox'/>","Usuario.username"]
            
    }, 
};