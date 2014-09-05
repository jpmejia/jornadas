<style>
.noDisplay{display: none;}
table .active{
    background-color: rgb(243, 243, 243);
}

table .selectedHierachy{
    background-color: #fef3a9;
}

table .notSaved{
    background-color: rgb(217, 237, 247);
}
</style>
<!-- 1 Aquí comienza el template que se utiliza para mostrar los datos de la empresa-->
<div style="width: 100%; height:800px;" class="divRenderFacilityItems noDisplay">
    
    <h3 class="pull-right headerRight empresa">Su Empresa</h3>
    
    <div class="alert alert-info">
					<span class="pop"><img src="<?php echo $this->webroot; ?>assets/css/images/info-pop.png" width="24px" height="21px"></span>
					<span class="alertContent">
					En la siguiente interfaz uste podrá editar la estructura jerarquica de su empresa. 
                    </span>
     </div>
    
    
    <div style="width: 45%;" class="pull-left" ><h4 class="subtitulo">Estructura</h4>
       <table class="table table-bordered divRenderFacilityItemsJerarquia">
        <tr>
            <td class="active">
                <div class="pull-left trigger triggerAddItem" data-original-title="Click para Agregar Nivel Debajo">
                    <img src="<?php echo $this->webroot ?>img/agregar.png" width="19px" />
                </div>
                <span class="nameItem">BASE 1</span>
                <div class="pull-right trigger triggerDeleteItem" style="display: none;" data-original-title="Doble click para Eliminar Nivel">
                    <img src="<?php echo $this->webroot ?>img/eliminar.png" width="19px" />
                </div>
              
            </td>
        </tr>
        <tr><td>
            <div class="pull-left trigger" data-original-title="Esta es su 'Unidad mínima de Jerarquía', no puede ser eliminada, pero si puede editarla haciendo click en el nombre">
              <img src="<?php echo $this->webroot ?>img/info-little.png" />
            </div>
        <span class="nameItem">UNIDAD MÍNIMA</span></td></tr>
       </table>
	   <div class="tabla-funciones">
	          <a class="btn triggerInfo cancelButton">Cancelar</a> &nbsp; &nbsp;

	   <a class="btn btn-primary triggerInfo saveButtonTrigger">Guardar</a>
       </div>
    </div>
    <div style="width: 45%;height: 500px; margin-left: 10%;" class="pull-right" >
    
    

        
      
    
<h4 class="subtitulo pull-left">Unidad de Negocio</h4>
<div class="btn-toolbar pull-right" style="margin: 0;">
	<div class="btn-group">
		<div class="btn btn-default" type="button" style="width: 8em; height: 1.5em;">
			<div class="progress progress-striped" style=" display: block;
    float: left;
    margin-right: 0.2em;
    margin-top: 0.6em;
    width: 70%;">
				<div class="bar" style="width: 0%;"></div>
			</div>
			<div style="display: block;
    float: left;
    margin-left: 5%;
    width: 10%;" class="trigger " data-original-title="Suba un archivo de 'Unidades de Negocio' para acelerar el procedimiento">
				<img id="imageTriggerUpload" src="<?php echo $this->webroot ?>img/subir.png"  />
				<input style="display: none;" id="fileupload" type="file" name="files[]" data-url="<?php echo $this->webroot ?>lms/upload" >
			</div>  

		</div>
		<div class="btn btn-default" type="button">
			<div  style="margin-left: 5%;width: 10%;" class="trigger editChild" data-original-title="Haga click sobre una unidad de negocio y presione aquí para editar">
				<img src="<?php echo $this->webroot ?>img/folder-editar.png" />
			</div> 
		</div>
		<div class="btn btn-default" type="button">
			<div  style="margin-left: 5%;width: 10%;" class="trigger addChild" data-original-title="Haga click sobre una unidad de negocio y presione aquí para agregar una sub-unidad dentro de la unidad seleccionada">
				<img src="<?php echo $this->webroot ?>img/folder-agregar.png" />
			</div>
		</div>
		<div class="btn btn-default" type="button">
			<div style="margin-left: 5%;width: 10%;" class="trigger deleteChild" data-original-title="Haga click sobre una unidad de negocio y presione aquí para eliminar la unidad y todas las sub-unidades dentro de esta">
				<img src="<?php echo $this->webroot ?>img/folder-eliminar.png" width="32px" />
			</div>
		</div>
	</div>
</div>


        <div style="width: 100%;overflow: auto; height:100%;" class="RenderHierachyItems aciTree" ></div>
    
    </div>
    <div></div>


</div>






<!-- 1 Aquí finaliza el template que se utilizapara mostrarlos datos de la empresa-->
