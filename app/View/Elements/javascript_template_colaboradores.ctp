<style>
.colaboradoresOptions img{
    width: 40px;
}
</style>
<div class="templateColaboradores" style="display: none;">

    <div class="barTool" style="width: 100%;background-color: red; height: auto;">
        
        <div class="pull-left colaboradoresOptions" style="margin: 0;">
            <?php echo $this->Html->image("check.png");?>
            <?php echo $this->Html->image("switch.png");?>
        </div>
    
        <div class="pull-left" style="margin-left: 40px;">
            <span>Página</span>
            <select style="width: 70px;"></select>
        </div>
    

    
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
	       </div>
        </div>
        
        <div class="pull-right" style="margin-right: 10px;">
            <a class="btn btn-primary">RECONOCIMIENTOS</a>
        </div>
    </div>

</div>

<div style="display: none;" class="templateColaboradoresSearch">
            <h4 class="enlace">Buscador</h4>
			<!--
            <div id="bloque">
                <form >
				  <fieldset><div class="control-group">
						<label class="control-label">Categoría</label>
						<div class="controls"><select name="data[Curso][categoria_id]"><option value="1">Basicos</option><option value="2">Intermedio</option><option value="3">Avanzado</option><option value="4">Ultimate</option><option value="5">Maximum</option></select></div>
					</div><div class="control-group">
						<label class="control-label">Nombre del Curso</label>
						<div class="controls"><input name="data[Curso][name]" placeholder="Nombre que verán los usuarios" type="text"></div>
					</div><div class="control-group">
						<label class="control-label">Id en Plataforma</label>
						<div class="controls"><input name="data[Curso][id_en_plataforma]" placeholder="Nombre corto del curso" type="text"></div>
					</div><div class="control-group">
						<label class="control-label">Horas del Curso</label>
						<div class="controls"><select name="data[Curso][horas_de_curso]"><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option></select></div>
					</div><div class="control-group">
						<label class="control-label">Calificación Aprobatoria</label>
						<div class="controls"><select name="data[Curso][calificacion_aprobatoria]"><option value="60">60</option><option value="70">70</option><option value="75">75</option><option value="80">80</option></select></div>
					</div><div class="control-group">
						<label class="control-label">Ordenamiento</label>
						<div class="controls"><input name="data[Curso][ordenamiento]" placeholder="Orden en el que aparecen" type="text"></div>
					</div><div class="control-group">
						<label class="control-label">Cumplimiento</label>
						<div class="controls"><input name="data[Curso][cumplimiento]" placeholder="Días del curso" type="text"></div>
					</div><div class="control-group">
						<label class="control-label"></label>
						<div class="controls"><input name="data[Curso][modalidad]" type="hidden" value="E-Learning"></div>
					</div><input type="hidden" name="data[Curso][id]" value="1"><input type="hidden" name="data[Model][name]" value="Curso"></fieldset>
			<input type="hidden" name="data[Model][name]" value="FacilityItem">
            
			<input type="hidden" name="data[FacilityItem][parent_id]" id="ParentIdNewItem">
            
			<input type="hidden" name="data[FacilityItem][id]" id="idEditable">
       <input type="hidden" name="data[Model][name]" value="Curso"></form>
				
			</div>
            -->
</div>