<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>

<fieldset>
    <legend>Détails</legend>
		<table>
		  <tbody>
			<tr>
			  <th>Specialiste:</th>
                           <td><?php echo $suivit_externe->getSpecialiste() ?></td> 
			    
                        </tr>
			<tr>
			  <th>Datedebutpriseencharge:</th>
                          <td>  <?php echo format_date($suivit_externe->getDatedebutpriseencharge(),'dd/MM/yyyy') ?> </td>
 
     			</tr>
			<tr>
			  <th>Datefinpriseencharge:</th>
                           <td>  <?php echo format_date($suivit_externe->getDatefinpriseencharge(),'dd/MM/yyyy') ?> </td>
			</tr>
			<tr>
			  <th>Organismesuivit:</th>
		          <td><?php echo $suivit_externe->getOrganismeSuivit()->getLibellesuivit() ?></td>	
                       </tr>
		  </tbody>
		</table>
</fieldset>
<hr />

<?php echo jq_button_to_remote('Edition', array('url' => 'suivitexterne/edit?id=' . $suivit_externe->getId().'&eleve_id=' . $suivit_externe->getEleveId(), 'update' => 'div_suivitext')) ?>
&nbsp;
<?php echo jq_button_to_remote('Retour à la liste', array('url' => 'suivitexterne/index?eleve_id=' . $suivit_externe->getEleveId() . '&id=' . $suivit_externe->getId(), 'update' => 'div_suivitext')) ?>
