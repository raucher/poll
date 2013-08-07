<div class="form">
	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::activeLabel($model, 'name'); ?>
		<?php echo CHtml::activeTextField($model, 'name'); ?>
	</div>

	<?php 
		// Generate array for age drop down list
		while( $i < 110 ) $age[++$i] = $i; ?>
	
	<div class="row">
		<?php echo CHtml::activeLabel($model, 'age'); ?>
		<?php echo CHtml::activeDropDownList($model, 'age', $age); ?>
	</div>
	<div class="row">
		<?php $this->widget('CCaptcha'); ?>
		<?php echo CHtml::activeTextField($model, 'captchaCode'); ?>
	</div>
	<div class="row submit">
		<?php echo CHtml::submitButton(); ?>
	</div>
</div>