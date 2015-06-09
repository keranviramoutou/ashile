<?php use_helper('jQuery'); ?>

<table class="show">
    <tbody>
		<tr>
			<th>Classe Inclusion :</th>
			<td><?php echo $inclusion->getClasseId() ?></td>
		</tr>
		<tr>	
			<th>Temps classe integration :</th>
			<td><?php echo $inclusion->getTemspclasseintegration() ?></td>
		</tr>
	</tbody>
</table>

<?php
		//echo jq_button_to_remote('Modifier', array(
			//	'url' => 'orientation/show?id=' . $sf_request->getParameter('orientation_id'),
				//'update' => 'div_orientation',
			//));
?>
