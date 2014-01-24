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

        <link rel="stylesheet/less" href="<?php echo ROOT_DIR; ?>css/style.less">
        <script src="<?php echo ROOT_DIR; ?>js/vendor/less-1.6.1.min.js"></script>
        <script src="<?php echo ROOT_DIR; ?>js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		<?php echo $this->renderBlockHTML('block/header'); ?>
		
		<?php
		if($this->hasContent()) {
			echo $this->renderBlockHTML('block/' . $this->getContent());
		}
		?>
		
		<?php echo $this->renderBlockHTML('block/footer'); ?>

        <script src="/js/vendor/jquery-1.10.2.min.js"></script>
        <script src="<?php echo ROOT_DIR; ?>js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="<?php echo ROOT_DIR; ?>js/init.js"></script>

    </body>
</html>
