<?php use_helper('jQuery') ?>
<h1>Information sur Dgesco</h1>

<p class="infoField">
    <label>Question :</label>
    <?php $q = $dgesco->getReponse()->getQuestion();
			echo $q[0];
     ?>&nbsp;
</p>
<p class="infoField">
    <label>Reponse :</label>
    <?php 		$reponse = $dgesco->getReponseId();
					$rep = Doctrine::getTable('Reponse')->findOneById($reponse);
				echo $rep;
     ?>&nbsp;
</p>
<p class="infoField">
    <label>Reponse litterale :</label>
    <?php echo $dgesco->getLibellereponse() ?>&nbsp;
</p>
<?php echo jq_button_to_remote('Modifier', array('url' => 'dgesco/edit?id=' . $dgesco->getId(), 'update' => 'div_dgesco')) ?>&nbsp;
<?php echo jq_button_to_remote('Retour liste', array('url' => 'dgesco/index?eleve_id=' . $dgesco->getEleveId(), 'update' => 'div_dgesco')) ?>
