<option value="0">Choisissez</option>

<script>alert("<?php echo $niveaus ?>")</script>

<?php foreach ($niveaus as $niveau): ?>
    <option value="<?php echo $niveau->getId() ?>" 
		<?php if($selected == $niveau->getId() ) echo 'selected="selected"'?>>
		<?php echo $niveau ?>
    </option>
<?php endforeach; ?>
