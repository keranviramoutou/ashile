<?php if ($sf_user->hasFlash('error') || $sf_user->hasFlash('notice')): ?>
  <div id="feedback">
    <?php if ($sf_user->hasFlash('error')): ?>
    	<p class="error-box">
    		<?php echo $sf_user->getFlash('error') ?>
    	</p>
    <?php endif; ?>
 
    <?php if ($sf_user->hasFlash('notice')): ?>
    	<p class="notice-box">
    		<?php echo $sf_user->getFlash('notice') ?>
    	</p>
    <?php endif; ?>
  </div>
<?php endif; ?>