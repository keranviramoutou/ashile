<?php
/**
 * Le layout de l'application va 'encadrer' les contenus tels que menus, et 
 * formulaires ect. c'est ici que l'on charge les balises Metas de la page, en 
 * utilisant les helpers de symfony : 
 * 
 *   <?php include_http_metas() ?>
 *   <?php include_metas() ?>
 *   <?php include_title() ?>
 *   <?php include_stylesheets() ?>
 *   <?php include_javascripts() ?>
 * 
 * et l'aspect général de la page.
 */
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        <link rel="shortcut icon" href="../../../images/favicon.ico" />
        
	<script type="text/javascript">
		var $j = jQuery.noConflict();
	</script>
       
    </head>

    <body >
		<div id="popup">
		
		
  
				   <!-- test pour afficher si sur application en production ou en développement -->
	              

				 
				 
		<!-------------------  BOUTON DECONNECTION ET RETOUR PORTAIL ---------------------------------->
				<?php if($_SERVER["HTTP_X_FORWARDED_HOST"] == 'accueil.in.ac-reunion.fr' ){ 
				$retour='https://accueil.in.ac-reunion.fr';
				} ?>


				<?php if($_SERVER["HTTP_X_FORWARDED_HOST"] == 'portail.ac-reunion.fr' ){ 
				$retour='https://portail.ac-reunion.fr';
				} ?>

		<!----------------------------------------------------------------------------------------------->
                <?php if ($sf_user->hasFlash('notice')): ?>
                    <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
                <?php endif ?>

                <?php if ($sf_user->hasFlash('error')): ?>
                    <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
                <?php endif ?>





                <!-- enfin le contenu -->

    </body>
	                <?php echo $sf_content ?>
<div>
      
 
</html>

