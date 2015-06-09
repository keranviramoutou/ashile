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

        
    </head>
    <body>
        <div id="global">
            <div id="colonne_nav">
                <div id="www"><a><img src="images/wwwacreunion.png" width="22" height="300" /></a></div>
                <div id="logo" onclick="location.href='http://www.ac-reunion.fr'"></div>
            </div>
            <div id="header">
                <div id="logo_ash"></div>
            </div>
            <div id="content_accueil">
				<?php echo $sf_content ?>
            </div>
        </div>
    </body>
</html>

