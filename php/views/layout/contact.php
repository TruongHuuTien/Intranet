<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $this->getTitle(); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet/less" href="<?php echo ROOT_URL; ?>css/bootstrap.min.css">
        <script src="<?php echo ROOT_URL; ?>js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		<?php echo $this->renderBlockHTML('html/header'); ?>
		
		<div class="container">
			<h1>Contactez-nous</h1>
			<p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
			<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>
		</div>
		
        <script src="<?php echo ROOT_URL; ?>js/vendor/jquery-1.10.2.min.js"></script>
        <script src="<?php echo ROOT_URL; ?>js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="<?php echo ROOT_URL; ?>js/init.js"></script>

    </body>
</html>
