<?php use_helper('jQuery') ?>
<?php //use_stylesheet('data_table.css') ?>
<?php //use_stylesheet('datatable_jui.css') ?>
<?php use_helper('Date') ?>


<div class= 'aide' onClick="<?php echo url_for('eleve/aide') ?>"></div>


<h1><?php  echo 'Secteur :&nbsp;' . $sf_user->getAttribute('secteur'); ?></h1>
<!-- <h1>Listes des &eacute;l&egrave;ves <?php echo $etab == 'avec' ? 'par établissement scolaire' : 'non scolarisés' ?> </h1> -->
 <h1>Elèves <?php echo $etab == 'avec' ? 'par établissement scolaire' : 'en cours d\'actualisation d\'affectation' ?> </h1>
<?php  //echo 'nom :'.$sf_user->getGuardUser()->getFirstName(); ?>
<button style="float: right" onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'listeEleve')) ?>'">Liste des élèves par secteur</button>

<?php 
$i = 1; 
$nomEtabsco = '';
 $fermetureTableau = '';

$enteteTableau = <<<EOT
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="laTable">
        <thead>
            <tr>
                <th>Ine</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Date de naissance</th>
                <th>Sexe</th>
            </tr>
        </thead>
        <tbody>
EOT;
if($etab == 'sans')
    echo $enteteTableau;

foreach ($pager->getResults() as $eleve):

    if($etab != 'sans') {
        if ($nomEtabsco != $eleve->Etabsco->getNometabsco()){
            echo $fermetureTableau;
            echo '<h2>Etablissement: '.Doctrine::getTable('Typeetablissement')->find($eleve->Etabsco->getTypeetablissementId())->getNomtypeetablissement() .' '.$eleve->Etabsco->getNometabsco().'</h2>';
            echo $enteteTableau;
        }
    } 
?>

            <tr onClick="location.href='<?php echo url_for('eleve/edit?id=' . ($etab != 'sans' ? $eleve->Eleve->getId() : $eleve->getId()))   ?>'"  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">
                <td><?php echo $etab != 'sans' ? $eleve->Eleve->getIne() : $eleve->getIne() ?></td>
                <td><?php echo $etab != 'sans' ? $eleve->Eleve->getNom() : $eleve->getNom() ?></td>
                <td><?php echo $etab != 'sans' ? $eleve->Eleve->getPrenom() : $eleve->getPrenom()?></td>
<!--            <td><?php //echo $etab != 'sans' ? $eleve->Eleve->getDatenaissance() :  format_date( $eleve->getDatenaissance(),'dd/MM/yyyy')?></td> -->
                <td><?php echo $etab != 'sans' ? $eleve->Eleve->getDatenaissance() :  format_date( $eleve->datenaissance,'dd/MM/yyyy')?></td>
 
                <td><?php echo $etab != 'sans' ? $eleve->Eleve->getSexe() : $eleve->getSexe() ?></td>
 
            </tr>
            <?php
            $i++;
            if($etab != 'sans') {
                if ($nomEtabsco != $eleve->Etabsco->getNometabsco()):
                    $i = 1;
                    $nomEtabsco = $eleve->Etabsco->getNometabsco();

                    $fermetureTableau = '</tbody></table>';
                endif;
            }
 
endforeach;

if($etab == 'sans')
    echo '</tbody></table>';
?>
            <?php echo $fermetureTableau; ?>
<?php include_partial('global/paginate', array('pager' => $pager, 'route' => '@eleve_pagination')) ?>            
<div class="yui-g fr-separator">&nbsp;</div> 

<?php echo button_to('Nouvel &eacute;l&egrave;ve', 'eleve/new') ?>
<?php 
if ($etab == 'sans')
    echo button_to('Avec etablissement', 'eleve/index?etab=avec');
else
    echo button_to('Sans etablissement', 'eleve/index?etab=sans');
?>


<!-- Le second script pour le pop up d'aide -->
<script>
var src = "<?php echo url_for('eleve/aide') ?>";

$j(document).ready(function(){

        $j('.aide').click(function (){
                $j.modal('<iframe src="' + src + '" height="450" width="830" style="border:0">', {
                        closeHTML:"",
                        containerCss:{
                                backgroundColor:"#fff",
                                borderColor:"#fff",
                                height:450,
                                padding:0,
                                width:830
                        },
                        overlayClose:true
                });
        });
});

</script>
