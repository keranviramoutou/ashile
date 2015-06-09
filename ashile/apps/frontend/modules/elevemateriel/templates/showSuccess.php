<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>   
<h1>Informations sur le matériel attribué</h1>
<fieldset>
   <legend>Prêt</legend>
            <?php  if($materiel->getNumeroConvention()){ ?>
            <?php echo 'Convention n° :&nbsp;<strong>'.$materiel->getNumeroConvention()  .'</strong><br>' ?>
			<?php } ?>
			 <?php  if($materiel->getDateRemiseErf()){ ?>
            <?php echo 'Remise du matériel à l\'ERF le :&nbsp;<strong>'.format_date($materiel->getDateRemiseErf(),'dd/MM/yyyy') .'</strong><br>' ?>
			<?php } ?>
		    <?php echo 'Remise du matériel aux parents le :&nbsp;<strong>'.format_date($materiel->getDatedebut(),'dd/MM/yyyy') .'</strong><br>' ?>
			 <?php echo 'Autorisation parentale (déblocage Internet) donnée le :&nbsp;<strong>'.format_date($materiel->getAutorisationParent(),'dd/MM/yyyy') .'</strong><br>' ?>
			 	
            <?php echo 'Prêt du&nbsp;<strong>'.format_date($materiel->getDatedebut(),'dd/MM/yyyy').'</strong>&nbsp;au&nbsp;<strong>'.format_date($materiel->getDatefin(),'dd/MM/yyyy').'</strong>'  ?>

</fieldset>
<fieldset>
   <legend>Demande matériel</legend>
   
             <?php if($demande_mat->getDecisioncda() == 1){
			$decision = 'ACCEPTEE';
			}else{
			}  ?>
			<?php echo 'Dossier MDPH n° :&nbsp;<strong>'.$demande_mat->getMdphId()  .'</strong><br>' ?>
			<?php echo 'Type matériel demandé :&nbsp;<strong>'.$demande_mat->getTypemateriel()  .'</strong><br>' ?>
            <?php echo 'Décision de la CDA du&nbsp;<strong>'.format_date($demande_mat->getDatedecisioncda(),'dd/MM/yyyy').'</strong>&nbsp;&nbsp;Décision :&nbsp;<strong>'.$decision.'</strong><br>' ?>
			<?php echo 'Notifiée du&nbsp;<strong>'.format_date($demande_mat->getDatedebutnotif() ,'dd/MM/yyyy').'</strong>&nbsp;au&nbsp;<strong>'.format_date($demande_mat->getDatefinnotif() ,'dd/MM/yyyy').'</strong>'  ?>

</fieldset>
<fieldset>
    <legend>Matériel</legend>
    <table class="show">
        <tr>
            <th>Marque :</th>
            <td><?php echo $mat->getMarque() ?></td>
        </tr>
        <tr>
            <th>Type :</th>
            <td><?php echo $mat->getTypemateriel() ?></td>
        </tr>
		   <tr>
            <th>Catégorie  :</th>
            <td><?php echo $mat->getTypemateriel() ?></td>
        </tr>
        <tr>
            <th>Libellé  :</th>
            <td><?php echo $mat->getLibellemateriel() ?></td>
        </tr>
        <tr>
            <th>Caracteristiques :</th>
            <td><?php echo $mat->getCaracteristiquemateriel() ?></td>
        </tr>
        <tr>
            <th>Numero de serie :</th>
            <td><?php echo $mat->getNumeromateriel() ?></td>
        </tr>
        <tr>

    </table>
</fieldset>


&nbsp;
<?php echo jq_button_to_remote('Revenir à la liste', array('url' => 'elevemateriel/index?eleve_id=' . $materiel->getEleveId() . '&materiel_id=' . $materiel->getMaterielId(), 'update' => 'div_materiel')) ?>
