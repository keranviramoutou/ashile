<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<script type="text/javascript">

   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
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
               "sLoadingRecords": "Téléchargement...",
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
<div id="demandeavs">  
<div class='aide' onClick="<?php echo url_for('demandeavs/aide') ?>"> </div>
<fieldset>	
<h3> Liste de(s) demande(s) d'accompagnement  traitées pour l'élève:  <?php echo $demande_avss[0]['nom'].'  '.$demande_avss[0]['prenom']?> <?php echo 'né(e) le &nbsp;'.format_date($demande_avss[0]['datenaissance'],'dd/MM/yyyy') ?></h3> 

<h5> scolarisé(e) à :&nbsp;<?php echo $dersco1[0]['rne'].'-'.$dersco1[0]['typetab'].'&nbsp'.$dersco1[0]['nometabsco']. ' - &nbsp;'.'sur le secteur de :&nbsp;'.$dersco1[0]['libellesecteur'] ?></h4>
	
 
</fieldset>	

  


<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>

    <tr>

	 <th>N° Dossier MDPH</th>
     <th>Date ESS</th>
     <th>Date envoi MDPH </th> 
     <th>Date CDA </th>
	 <th>Décision</th>
	 <th>Quotité notifiée</th>
	 <th>Date Fin acc.</th>
     <th>Date deb. Notif </th>
     <th>Date Fin  Notif </th>

   </tr>
  </thead>
	<tbody>
<?php 	foreach($demande_avss as $demandeavs): ?>

	 <?php if($dem_avss_traites['decisioncda'] = 1 ){ ?>
	<?php $decisioncda='&nbsp;Acceptée&nbsp;';} ?>
	<?php if($dem_avss_traites['decisioncda'] = 0 ){ ?>
	<?php $decisioncda='&nbsp;Refusée&nbsp;';} ?>


    <tr>
		     <td><?php echo $demandeavs['MdphId']  ?> </td>     		 
             <td><?php echo format_date($demandeavs['dateess'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($demandeavs['dateenvoiedossier'],'dd/MM/yyyy') ?></td> 
             <td><?php echo format_date($demandeavs['datedecisioncda'],'dd/MM/yyyy') ?></td>
			 <td><?php $decisioncda ?></td>
			 <td><?php echo $demandeavs['quotitehorrairenotifie'].'&nbsp;Heure(s)' ?></td>
			 <td><?php echo format_date($demandeavs['etat_acc'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($demandeavs['datedebutnotif'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($demandeavs['datefinnotif'],'dd/MM/yyyy') ?></td>


 
     </tr>	
	<?php endforeach; ?>
		</tbody>
	</table>
<br><big><a href="<?php echo url_for('eleve/recherche?eleve_id='.$sf_request->getParameter('eleve_id').'&eleve_nom='.$demande_avss[0]['nom'].'&eleve_prenom='.$demande_avss[0]['prenom'].'&flag_recherche=1' ) ?>"><button>Retour</button></a></big></br><br>


</div>

<script>
var src = "<?php echo url_for('demandeavs/aide') ?>";

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



