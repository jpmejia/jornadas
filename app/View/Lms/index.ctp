<?php echo $this->element("javascript_templates_base"); ?>
<?php echo $this->element("menu"); ?>
<?php echo $this->element("modal"); ?>
<?php echo $this->element("javascript_templates"); ?>
<?php echo $this->element("javascript_template_colaboradores"); ?>
<?php echo $this->element("javascript_template_programas"); ?>
<?php echo $this->element("javascript_template_grupos"); ?>

<script>var WEBROOT = "<?php echo $this->webroot; ?>";</script>
<script src="<?php echo $this->webroot?>js/Global.js<?php echo "?".time(); ?>"></script>
<script src="<?php echo $this->webroot?>js/data.js<?php echo "?".time(); ?>"></script>
<script src="<?php echo $this->webroot?>js/ModalWindow.js<?php echo "?".time(); ?>"></script>
<script src="<?php echo $this->webroot?>js/Messages.js<?php echo "?".time(); ?>"></script>
<script src="<?php echo $this->webroot?>js/Router.js<?php echo "?".time(); ?>"></script>
<script src="<?php echo $this->webroot?>js/FacilityItems.js<?php echo "?".time(); ?>"></script>
<script src="<?php echo $this->webroot?>js/Colaboradores.js<?php echo "?".time(); ?>"></script>
<script src="<?php echo $this->webroot?>js/Programas.js<?php echo "?".time(); ?>"></script>
<script src="<?php echo $this->webroot?>js/Grupos.js<?php echo "?".time(); ?>"></script>
<script src="<?php echo $this->webroot?>js/clickObject.js<?php echo "?".time(); ?>"></script>

<div class="container-fluid">
    <div class="row-fluid">
      <div class="span3">
          <div class="well sidebar-nav" id="LeftContent">
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="contendio" id="ContenidoDerecha">
          </div>          
        </div><!--/span-->
    </div><!--/row-->
      <hr>
      <footer>  <p>&copy; NaraLMS 2013</p>  </footer>
</div><!--/.fluid-container-->