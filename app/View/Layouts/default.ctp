<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="ISO-8859-1">
    <title>Lista de Cursos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot?>aciTree/css/aciTree.css" media="all">
    <!-- Le styles -->
    <link href="<?php echo $this->webroot; ?>assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-bottom: 40px;
      }
      
      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="<?php echo $this->webroot; ?>assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php echo $this->webroot; ?>assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <!--  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->webroot; ?>assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->webroot; ?>assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->webroot; ?>assets/ico/apple-touch-icon-72-precomposed.png">-->
      <link rel="apple-touch-icon-precomposed" href="<?php echo $this->webroot; ?>assets/ico/apple-touch-icon-57-precomposed.png">
      <link rel="shortcut icon" href="<?php echo $this->webroot; ?>assets/ico/favicon.png">
      <script src="<?php echo $this->webroot; ?>assets/js/jquery.js"></script>
    
	
  </head>
  <body>

        <?php echo $this->fetch('content'); ?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $this->webroot; ?>assets/js/bootstrap-transition.js"></script>
    <script src="<?php echo $this->webroot; ?>assets/js/bootstrap-alert.js"></script>
    <script src="<?php echo $this->webroot; ?>assets/js/bootstrap-modal.js"></script>
    <script src="<?php echo $this->webroot; ?>assets/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo $this->webroot; ?>assets/js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo $this->webroot; ?>assets/js/bootstrap-tab.js"></script>
    <script src="<?php echo $this->webroot; ?>assets/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo $this->webroot; ?>assets/js/bootstrap-popover.js"></script>
    <script src="<?php echo $this->webroot; ?>assets/js/bootstrap-button.js"></script>
    <script src="<?php echo $this->webroot; ?>assets/js/bootstrap-collapse.js"></script>
    <script src="<?php echo $this->webroot; ?>assets/js/bootstrap-carousel.js"></script>
    <script src="<?php echo $this->webroot; ?>assets/js/bootstrap-typeahead.js"></script>
    
    <link href="<?php echo $this->webroot; ?>datepicker/css/datepicker.css" rel="stylesheet">
    <script src="<?php echo $this->webroot; ?>datepicker/js/bootstrap-datepicker.js"></script>
    
    <script type="text/javascript" src="<?php echo $this->webroot?>aciTree/js/jquery.aciPlugin.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot?>aciTree/js/jquery.aciTree.core.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot?>aciTree/js/jquery.aciTree.selectable.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot?>aciTree/js/jquery.aciTree.checkbox.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot?>aciTree/js/jquery.aciTree.radio.js"></script>

    <script src="<?php echo $this->webroot?>file_uploader/js/vendor/jquery.ui.widget.js"></script>
    <script src="<?php echo $this->webroot?>file_uploader/js/jquery.iframe-transport.js"></script>
    <script src="<?php echo $this->webroot?>file_uploader/js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="<?php echo $this->webroot?>file_uploader/js/jquery.fileupload-process.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="<?php echo $this->webroot?>file_uploader/js/jquery.fileupload-validate.js"></script>

  </body>
</html>
