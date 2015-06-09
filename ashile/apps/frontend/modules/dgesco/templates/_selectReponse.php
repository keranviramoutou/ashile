<option value="0">Choisissez une reponsesss</option>
<?php foreach ($reponses as $reponse): ?>
    <option value="<?php echo $reponse->getId() ?>" <?php if($selected == $reponse) echo 'selected="selected"'  ?>><?php echo $reponse;  ?></option>
<?php endforeach; ?>
