<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>

<h1>Dossier ASH n° <?php echo $mdph->id .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'?>
 <?php echo '<small>'.jq_button_to_remote('Edition', array('url' => 'mdph/edit?id=' . $mdph->getId(), 'update' => 'div_mdph')) ?>
&nbsp;
<?php echo jq_button_to_remote('Revenir à la liste', array('url' => 'mdph/index?eleve_id=' . $mdph->getEleveId(), 'update' => 'div_mdph')).'</small>' ?></h1>

<fieldset>
    <legend>Suivi du Dossier </legend>
    <table class="show">
        <tbody>
             <tr>
                <th>Date réunion  :</th>
                <td><?php echo format_date($mdph->dateess,'dd/MM/yyyy') ?></td>
                <th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspDossier cerfa signé le :</th>
                <td><?php echo format_date($mdph->datecreationpps, 'dd/MM/yyyy') ?></td>
            </tr>
            <tr>
                <th>Etat du dossier :</th>
                <td> <?php //echo $mdph->DemandeComplet(); ?></td>
            </tr>
            <tr>
                <th>Justificatif de Domicile reçu le :</th>
                <td><?php echo format_date($mdph->datepjdom, 'dd/MM/yyyy') ?></td>
                <th>&nbsp&nbsp&nbsp&nbsp&nbsp Justificatif d'Identité reçu le :</th>
                <td><?php echo format_date($mdph->datepjident, 'dd/MM/yyyy') ?></td>
            </tr>
      
 
            <tr>
			    <th>Bilan médical :</th>
                <td><?php echo format_date($mdph->datebilanmedical, 'dd/MM/yyyy') ?></td>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Transmis à la MDPH le :</th>
                <td><?php echo format_date($mdph->dateenvoiedossier, 'dd/MM/yyyy') ?></td>
            </tr>


            <tr>
				<th>Dossier déposé par les parents</th>
				<td>
				     <?php  if ( $mdph->depotparent == true){ ?>
				<input type="checkbox" name="depot" value="depot" checked="checked" disabled="disabled"  > 
				<?php  }else{ ?>
				<input type="checkbox" name="depot" value="depot" disabled="disabled"  > 
				<?php  } ?>
				</td>
            </tr>
        </tbody>
    </table>
</fieldset>


</fieldset>
<fieldset><legend>Pièces complémentaire(s)</legend>
    <div id="mdphListBi" class="divList">
        <?php echo jq_javascript_tag(jq_remote_function(array('url' => 'bilan/list?mdph_id=' . $mdph->getId(), 'update' => 'mdphListBi'))) ?>
    </div>
</fieldset>
<fieldset><legend>Demande(s) d'orientation</legend>
    <div id="mdphListDo" class="divList">
        <?php echo jq_javascript_tag(jq_remote_function(array('url' => 'demandeorientation/list?mdph_id=' . $mdph->getId(), 'update' => 'mdphListDo'))) ?>
    </div>
</fieldset>
<fieldset>
    <legend>Demande(s) de materiel</legend>
    <div id="mdphListDm" class="divList">
        <?php echo jq_javascript_tag(jq_remote_function(array('url' => 'demandemateriel/list?mdph_id=' . $mdph->getId(), 'update' => 'mdphListDm'))) ?>
    </div>
</fieldset>
<fieldset><legend>Demande d'accompagnement scolaire</legend>
    <div id="mdphListDa" class="divList">
        <?php echo jq_javascript_tag(jq_remote_function(array('url' => 'demandeavs/detail?mdph_id=' . $mdph->getId(), 'update' => 'mdphListDa'))) ?>
    </div>
</fieldset>
<fieldset><legend>Demande de sessad</legend>
    <div id="mdphListDs" class="divList">
        <?php echo jq_javascript_tag(jq_remote_function(array('url' => 'demandesessad/detail?mdph_id=' . $mdph->getId(), 'update' => 'mdphListDs'))) ?>
    </div>
</fieldset>
<fieldset><legend>Demande de transport</legend>
    <div id="mdphListDt" class="divList">
        <?php echo jq_javascript_tag(jq_remote_function(array('url' => 'demandetransport/detail?mdph_id=' . $mdph->getId(), 'update' => 'mdphListDt'))) ?>
    </div>
	</fieldset>
	<fieldset><legend>Autre(s) pièces(s)</legend>
    <div id="mdphListPd" class="divList">
        <?php echo jq_javascript_tag(jq_remote_function(array('url' => 'piecesdossier/list?mdph_id=' . $mdph->getId(), 'update' => 'mdphListPd'))) ?>
    </div>
	</fieldset>

