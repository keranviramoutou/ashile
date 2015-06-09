<h1>Liste des Organismes de suivi externe </h1>

<div id="tab_eleve">
	<table>
	  <thead>
		<tr>
		  <th>Id</th>
		  <th>Organisme</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($organisme_suivits as $organisme_suivit): ?>
		<tr>
		  <td><a href="<?php echo url_for('organismesuivit/show?id='.$organisme_suivit->getId()) ?>"><?php echo $organisme_suivit->getId() ?></a></td>
		  <td><?php echo $organisme_suivit->getLibellesuivit() ?></td>
		</tr>
		<?php endforeach; ?>
	  </tbody>
	</table>

  <a href="<?php echo url_for('organismesuivit/new') ?>">Créer</a>
</div>
