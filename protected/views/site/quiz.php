<h2>Hi, <?php echo Yii::app()->user->name; ?></h2>
<h2><?php echo Yii::app()->language; ?></h2>
<div class="form">
	<?php 
	// Begin form output and launch foreach for questions
		echo CHtml::beginForm();
		echo CHtml::errorSummary(UserAnswer::model()); 
		foreach ($questions as $k => $quest):
	?>
	
	<!-- Question caption -->
	<?php $lng = $this->getLang().'_text'; ?>
		<h3><?php echo  $quest->$lng; ?></h3>
	
	<div class="row">
		<?php
			// Generate array of value=>label for radio button list
			$data = CHtml::listData($quest->answerVariant, 'id', $lng);

			/* 
			*  Generate and render radio button list 
			* 		for each question and its answer variants.
			*  Pass UserAnswer model to CHtml 
			*  		in order to generate correct names for list items.
			*/
			echo CHtml::activeRadioButtonList(UserAnswer::model(), "[$k]av_id", $data);

			if( $quest->customVariant ){
				foreach ($quest->customVariant as $custom) {
					echo CHtml::activeRadioButtonList(UserAnswer::model(), "[$k]av_id", 
												array($custom['id'] => $custom[$lng]),
												array('uncheckValue'=>null));
					echo CHtml::activeTextField(CustomContent::model(), 
													"[$k]custom_content");
				}
			}
		?>
	</div><!-- .row -->
	<?php 
		endforeach;
		echo CHtml::submitButton(); 
		echo CHtml::endForm(); 
	?>
</div><!-- .form -->

<pre>
	<?php print_r($_POST['UserAnswer']); ?>
	<?php print_r($_POST['CustomContent']); ?>
</pre>