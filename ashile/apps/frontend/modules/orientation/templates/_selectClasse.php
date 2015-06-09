<option value="0">Choisissez</option>

<?php foreach ($classes as $classe): ?>
    <option value="<?php echo $classe->getId() ?>" 
		<?php if($selected == $classe->getId()) echo 'selected="selected"'?>>
		<?php echo $classe ?>
    </option>
<?php endforeach; ?>
