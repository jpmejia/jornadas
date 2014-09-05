<!-- Modal Este Modal se usa estrictamente para la edición de registros. -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header" id="ModalWindowHeader">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="myModalLabel" class="modificar">Modificar Categor&iacute;a</h3>
	</div>
	<div class="modal-body" id="ModalWindowContent">

	</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
<button class="btn">Borrar</button>
<button class="btn btn-primary" id="EditTrigger">Modificar</button>
</div>
</div>
<!-- FIN Modal -->
<div id="myModalWait" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header" id="ModalWindowHeader">
		<h3 id="myModalLabel" class="modificar">Espere por favor.</h3>
	</div>
	<div class="modal-body" id="ModalWindowContent">
    </div>
    
    <div class="modal-footer">
        <button class="btn cancelar" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        <button class="btn btn-primary follow" >Agregar</button>
    </div>
</div>
<!-- -->

<div id="newUnidadDeNegocio" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header" id="ModalWindowHeader">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="myModalLabel" class="modificar">Agregar Unidad de Negocio</h3>
	</div>
	<div class="modal-body" id="ModalWindowContent">
        <form class="form-horizontal datos-ppales formularioRight" id="formularioAddNewItem">
				  <fieldset><div class="control-group">
						<label class="control-label">Nombre</label>
						<div class="controls"><input name="data[FacilityItem][name]" placeholder="Nombre" type="text" id="nameForNewTreeItem"></div>
					</div><div class="control-group">
						<label class="control-label">Clave</label>
						<div class="controls"><input name="data[FacilityItem][code]" placeholder="Código" type="text" id="codeForNewTreeItem"></div>
					</div></fieldset>
			<input type="hidden" name="data[Model][name]" value="FacilityItem" />
			<input type="hidden" name="data[FacilityItem][parent_id]" id="ParentIdNewItem" />
			<input type="hidden" name="data[FacilityItem][id]" id="idEditable" />
       </form>
    </div>
<div class="modal-footer">

<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
<button class="btn btn-primary"  id="addNewItemHierachy" >Agregar</button>

</div>
</div>