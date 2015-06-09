<table class="tabulaire">
  <?php foreach ($eleves as $i => $eleve): ?>
    <tr>
      <td>
        <?php echo link_to($eleve->getIne(), 'eleve/show?id='.$eleve->getId(), $eleve) ?>
      </td>
      <td>
        <?php echo $eleve->getPrenom() ?>
      </td>
      <td>
        <?php echo $eleve->getNom() ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

