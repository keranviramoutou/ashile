<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>


<h3>Enquêtes > DGESCO > Résultats de l'enquête</h3>

<script type="text/javascript">
    $j(document).ready(function() {
        oTable = $j('#dgescoTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "oLanguage" : {
                "sProcessing":     "Traitement en cours...",
                "sLengthMenu":     "Afficher _MENU_ Résultats   ",
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
<?php $route = $sf_request->getHost(); ?>

<fieldset><h3> Elève : <?php echo $dgescos[0]['nom'].'&nbsp;'.$dgescos[0]['prenom'].'&nbsp;né(e) le :&nbsp;'.format_date($dgescos[0]['datenaissance'],'dd/MM/yyyy')  ?></h3></fieldset>




<table cellpadding="0" cellspacing="0" border="0" class="display" id="dgescoTable">
    <thead>
    <tr>

      <th>Question</th>	  
      <th>Reponse</th>

    </tr>
    </thead>
    <tbody>
        <?php foreach ($dgescos as $dgesco): ?>
		

		
		
    <tr>
	   <td><?php echo $dgesco['question'] .'&nbsp- clef&nbsp; :&nbsp:' ?></td>
	    <td><?php if ($dgesco['libelle_reponse']){
		$reponse= trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $clef_cryptage, base64_decode($dgesco['libelle_reponse']), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
	    echo $reponse ; } 
	   ?></td>
	 
    </tr>
 
        <?php endforeach; ?>
    </tbody>
</table>


 <br> <?php echo button_to('Retour', 'dgesco/index') ?>
  



