 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="brand" href="#"><img src="<?php echo $this->webroot; ?>img/logo.png" /></a>
          <div class="barra-superior">
			<div class="btn-group pull-right">
				<button class="btn">Username</button>
				<button class="btn dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
					<ul class="dropdown-menu">
						<li><a href="#">Salir</a></li>
					</ul>
			</div>
			<p class="navbar-text pull-right">
              &nbsp;&nbsp;&nbsp;Bienvenido &nbsp;
            </p>
			<div class="menu pull-right">
				<div class="btn-group">
					<button class="btn dropdown-toggle" data-toggle="dropdown">Cursos &nbsp;<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#" class="clickAction" id="dataCursosList">Listado de Cursos</a></li>
						<li class="dropdown-submenu"><a href="#" tabindex="-1">Alta de Cursos</a>
							<ul class="dropdown-menu">
								<li><a href="#" tabindex="-1" class="clickAction" id="dataCursoElearning">Curso E-Learning</a></li>
								<!--<li><a href="#" tabindex="-1" class="clickAction" id="dataCursoPresencial">Curso Presencial</a></li>-->
								<li><a href="#" tabindex="-1" class="clickAction" id="dataCategorias">Categor&iacute;as de Cursos</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a tabindex="-1" href="#">Programas</a>
							<ul class="dropdown-menu">
								<li><a href="#Programas" tabindex="-1" class="clickAction" id="dataProgramas">Alta de Programas</a></li>
								<li><a href="#ProgramasCursos" tabindex="-1" class="clickAction" id="Programas">Asignaci&oacute;n de Cursos</a></li>
							</ul>
						</li>
                        <!-- 2° Etapa
						<li class="dropdown-submenu"><a tabindex="-1" href="#">Salas</a>
							<ul class="dropdown-menu">
								<li><a href="#" tabindex="-1" class="clickAction" id="dataSalas">Alta de Salas</a></li>
								<li><a href="#" tabindex="-1" class="clickAction" id="dataRecursos">Recursos para las Salas</a></li>
								<li><a href="#" tabindex="-1" class="clickAction" id="dataLugares">Lugares de Impartici&oacute;n</a></li>
							</ul>
						</li>
                        -->
					</ul>
				</div>
				<div class="btn-group">
					<button class="btn dropdown-toggle" data-toggle="dropdown">Matr&iacute;cula &nbsp;<span class="caret"></span></button>
					<ul class="dropdown-menu">
                    
                   	    <li><a href="#/facility" tabindex="-1" class="clickAction" id="FacilityItems">Su Empresa</a></li>
							
                    
						<li><a href="#/Users" class="clickAction" id="ViewColaboradores">Listado de Colaboradores</a></li>
						<!--
                        <li class="dropdown-submenu"><a href="#" tabindex="-1">Matriculaci&oacute;n</a>
							<ul class="dropdown-menu">
								<li><a href="#" tabindex="-1">Individual</a></li>
								<li><a href="#" tabindex="-1">Por Entidad</a></li>
							</ul>
						</li>
                        -->
						<li><a href="#">Desmatriculaci&oacute;n por Entidad</a></li>
                        <li><a href="#">Alta de Usuario</a></li>
                        <!--
						<li class="dropdown-submenu"><a href="#" tabindex="-1">Alta de Usuario</a>
						
                        	<ul class="dropdown-menu">
								<li><a href="#" tabindex="-1">Com&uacute;n</a></li>
								<li><a href="#" tabindex="-1">Temporal</a></li>
							</ul>
                        -->
						</li>
                        <!-- Esto ya no debe de ser necesario con la nueva versión
						<li><a href="#">Procesar Archivo</a></li>
						<li><a href="#">Forzar Matriculaci&oacute;n</a></li>
                        -->
						<li class="dropdown-submenu"><a href="#" tabindex="-1">Cat&aacute;logos</a>
							<ul class="dropdown-menu">
								<li><a href="#/Puestos" class="clickAction" id="dataPuestos" tabindex="-1">Alta de Puestos</a></li>
								<li><a href="#/Grupos"  class="clickAction" id="dataGrupos"  tabindex="-1">Alta de Grupos</a></li>
								<li><a href="#/Instructores"  class="clickAction" id="dataInstructores"  tabindex="-1">Alta de Instructores</a></li>
								<li><a href="#/Areas"  class="clickAction" id="dataAreas"  tabindex="-1">Alta de &Aacute;rea tem&aacute;tica</a></li>
								<li><a href="#/Ocupaciones"  class="clickAction" id="dataOcupaciones"  tabindex="-1">Alta de Ocupaci&oacute;n</a></li>
								<li><a href="#/Capacitadores"  class="clickAction" id="dataCapacitadores"  tabindex="-1">Alta de Capacitadores</a></li>
								<li><a href="#/Representantes"  class="clickAction" id="dataRepresentantes"  tabindex="-1">Alta de Representantes</a></li>
                                <li><a href="#" tabindex="-1">Alta de Mensajes</a></li>
							</ul>
						</li>
						<li><a href="#/GruposOperaciones"  class="clickAction" id="Grupos" tabindex="-1">Grupos</a>
						<!--
                        	<ul class="dropdown-menu">
								<li><a href="#/GruposOperaciones"  class="clickAction" id="Grupos" tabindex="-1">Asignaci&oacute;n de Programas</a></li>
							</ul>
                        -->
						</li>
                        <!-- 2° Etapa
						<li class="dropdown-submenu"><a href="#" tabindex="-1">Control de Presenciales</a>
							<ul class="dropdown-menu">
								<li><a href="#" tabindex="-1">Lista de Asistencia</a></li>
								<li><a href="#" tabindex="-1">Captura de Calificaciones</a></li>
							</ul>
						</li>	
                        -->
						<li><a href="#">Editar Raz&oacute;n Social</a></li>						
					</ul>
				</div>
				<div class="btn-group">
					<button class="btn dropdown-toggle" data-toggle="dropdown">Reportes &nbsp;<span class="caret"></span></button>
					<!--
                    <ul class="dropdown-menu">
						<li><a href="#">Reporte Informaci&oacute;n</a></li>
						<li><a href="#">Puesto-Curso</a></li>
						<li class="dropdown-submenu pull-left"><a href="#" tabindex="-1">Bloque Cursos</a>
							<ul class="dropdown-menu">
								<li><a href="#" tabindex="-1">Por Zona</a></li>
								<li><a href="#" tabindex="-1">Por Divisi&oacute;n</a></li>
								<li><a href="#" tabindex="-1">Por Regi&oacute;n</a></li>
								<li><a href="#" tabindex="-1">Por C. de Costo</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu pull-left"><a href="#" tabindex="-1">Kardex</a>
							<ul class="dropdown-menu">
								<li><a href="#" tabindex="-1">Personal</a></li>
								<li><a href="#" tabindex="-1">General</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu pull-left"><a href="#" tabindex="-1">Reporte RH</a>
							<ul class="dropdown-menu">
								<li><a href="#" tabindex="-1">General</a></li>
								<li><a href="#" tabindex="-1">Por Regi&oacute;n</a></li>
								<li><a href="#" tabindex="-1">Por Zona</a></li>
								<li><a href="#" tabindex="-1">Por C. de Costo</a></li>
							</ul>
						</li>		
					</ul>
                    -->
				</div>
			</div>	<!--/menu -->
          </div><!--/header -->
        </div>
      </div>
    </div>