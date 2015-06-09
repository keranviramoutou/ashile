
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php  // $breadcrumbs->addItem('My action', 'eleve/index') ?>


<script type="text/javascript">
    $j(document).ready(function() {
        oTable = $j('#eleveTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "oLanguage" : {
                "sProcessing":     "Traitement en cours...",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&egrave;ves",
                "sZeroRecords":    "Aucun &eacute;l&egrave;ve &agrave; afficher",
                "sInfo":           "Affichage de l'&eacute;l&egrave;ve _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&egrave;ves",
                "sInfoEmpty":      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix":    "",
                "sSearch":         "Rechercher&nbsp;:",
                "sLoadingRecords": "Téargement...",
                "sUrl":            "",
                "oPaginate": {
                    "sFirst":    "Premier",
                    "sPrevious": "Pr&eacute;c&eacute;dent",
                    "sNext":     "Suivant",
                    "sLast":     "Dernier"
                }
            }
        });
    } );
</script>
 <div id="orientation"> 
<div class='aide' onClick="<?php echo url_for('orientation/aide') ?>"> </div> 
<?php $route = $sf_request->getHost(); ?>
<fieldset>
<h3>Liste des scolarisations pour l'élève : <?php echo $eleves[0]['nom'].'  '.$eleve[0]['prenom'].$eleves['ine'].' né(e) le '.format_date($eleves[0]['datenaissance'],'dd/MM/yyyy').' - secteur élève :<small> '.$eleves[0]['libellesecteur'].'</small>'?></h3>
<h5> scolarisé(e) à :&nbsp;<?php echo $dersco1[0]['rne'].'-'.$dersco1[0]['typetab'].'&nbsp'.$dersco1[0]['nometabsco']. ' - &nbsp;'.'sur le secteur de :&nbsp;'.$dersco1[0]['libellesecteur'] ?></h4>
</fieldset>
<?php //echo 'ttt'.$request->getParameter('eleve_id') ?>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="eleveTable">
    <thead>
        <tr>
      
           
			<th>Etab affectation</th>
			<th>Scolarité(s)</th>
			<th>Date début</th>
            <th>Date Fin</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($eleves as $eleve): ?>
           <tr>
             
			    <td><?php echo $eleve['typetab'].'  ' . $eleve['nometabsco'] .' - '.$eleve['rne'] .' - <small>'.$eleve['libellesecteur_etab'].'*</small>' ?></td>
                <td> <?php //if(format_date($fin,'dd/MM/yyyy')  >= format_date($eleve['datefin'],'dd/MM/yyyy') && format_date($eleve['datedebut'],'dd/MM/yyyy') >= format_date($deb,'dd/MM/yyyy') ){ ?>
				<a href="<?php echo url_for('orientation/edit?id=' . $eleve['orienId'].'&eleve_id=' .$eleve['eleveId'] .'&secteur_id=' .$eleve['secteur_id'] ) ?>"><?php echo 'Modifier</a>'  ?>
				  <?php echo link_to('Supprimer', 'orientation/delete?id='.$eleve['orienId'], array('method' => 'delete', 'confirm' => 'Etes vous sur ?')) ?>
                <?php //}else{ echo ''; }; ?>
				 </td>
				<td><?php echo format_date($eleve['datedebut'],'dd/MM/yyyy')?></td>
				<td><?php echo format_date($eleve['datefin'],'dd/MM/yyyy')  ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<br> <small>* secteur de rattachement de l'établissement </small></br>
<br><big><a href="<?php echo url_for('eleve/recherche?eleve_id='.$sf_request->getParameter('eleve_id').'&eleve_nom='.$sf_request->getParameter('eleve_nom'). '&eleve_prenom=' .$sf_request->getParameter('eleve_prenom').'&flag_recherche=1' ) ?>"><button>Retour</button></a></big><br>
<?php

	  // TEST ////////////////////////
	 //sfContext::getInstance()->getUser()->setAttribute('foo', $foo);
	//////////////////////

function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>
<script>
var src = "<?php echo url_for('orientation/aide') ?>";

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
