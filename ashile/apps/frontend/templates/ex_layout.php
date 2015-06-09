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

<script type="text/javascript" src="/ashile/sfDependentSelectPlugin/js/SelectDependiente.min.js"></script>


        <link rel="shortcut icon" href="../images/favicon.ico" />

        <!-- ce script permet de regler la hauteur de la colonne gauche en fonction de la hauteur du contenu -->
        <script type="text/javascript">
            var $j = jQuery.noConflict();
            function reglerHauteur(){
                var globalHeight = parseInt($j("#logo_ash").css("height")) + parseInt($j("#content").css("height")) + 10;
                if (globalHeight < 900){
                    globalHeight = 900;
                }
                $j("#global").css("height", globalHeight + "px");
            };
            $j(reglerHauteur);
            $j(function() {
                $j("input:submit, input:button, form a").button();
            });
            $j(function() {
                $j( "#tab_eleve" ).tabs();
            });
        </script>
        
    </head>
    <body>
        <div id="global">
            <div id="colonne_nav">
                <div id="www"><a><img src="images/attention.gif" width="22" height="300" /></a></div>
                <div id="logo" onclick="location.href='http://www.ac-reunion.fr'"></div>
                <div id="menu">
						<?php include_component('menu','index'); ?>
                </div>
            </div>
            <div id="header">
                <div id="logo_ash"></div>
            </div>
            <div id="content">
                <?php if ($sf_user->hasFlash('notice')): ?>
                    <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
                <?php endif ?>

                <?php if ($sf_user->hasFlash('error')): ?>
                    <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
                <?php endif ?>

                <!-- enfin le contenu -->
				<?php $etab = sfContext::getInstance()->getUser()->getAttribute('etab') ?>
				<?php if (!$etab) sfContext::getInstance()->getUser()->setAttribute('etab', 'sans') // Si le choix d'affichage pour les eleves n'est pas defini, on met à homepage sans (sans etab) ?>
                <?php echo $sf_content ?>
            </div>
        </div>
    </body>
</html>

