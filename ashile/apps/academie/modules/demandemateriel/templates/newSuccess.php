<h3>Nouvelle Demande materiel</h3>
<div id="demande_materiel">
<?php 

  echo '<fieldset><legend><h3>Synthèse </h3></legend>';
         echo '<p><i> vous traitez l\'éleve :<strong> '.$mdph->getEleve().'</strong>&nbsp&nbspEtablissement frequenté&nbsp:&nbsp <strong> '.$orientation->Etabsco->Typeetablissement->nomtypeetablissement.$orientation->Etabsco->nometabsco.'</strong>&nbsp&nbsp Niveau scolaire :&nbsp<strong>'.$orientation->Niveauscolaire->nomniveauscolaire.'</strong>&nbsp&nbspClasse :&nbsp&nbsp<strong>'.$orientation->Classe->TypeClasse->nomtypeclasse.'</strong></i></p>';
  echo '<p><i> Dossier MDPH n °&nbsp  <strong>' .$mdph->id.'</strong>&nbsp Date ESS  :&nbsp'.format_date($mdph->dateess,'dd/MM/yyyy').'&nbsp Date envoi dossier : ' .format_date($mdph->dateenvoiedossier,'dd/M/yyyy').'</i></p></fieldset>';
?>
<?php include_partial('form', array('form' => $form)) ?>
</div>