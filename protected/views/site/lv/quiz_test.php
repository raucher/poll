<script type="text/javascript" charset="utf-8">
	 $(window).load(function() {
		$('.slides li span input:first-child').attr('checked', true)	
	});
</script>

<section class="spoiler quiz-spoiler">
	<article class="container">
		<div class=" row-fluid">
		<!--<form id="quiz-form" class="flexslider span9 offset1">-->
		<?php 
			// Begin form output and launch foreach for questions
			echo CHtml::beginForm('', 'post', 
					array(
						'id' => 'quiz-form',
						'class' => 'flexslider span9 offset1',
						)); ?>
			<ul class="slides">
			<?php foreach ($questions as $k => $quest): ?>
				<li>
					<div class="round-block">
					
			<!-- Question caption -->
					<?php $lng = $this->getLang().'_text'; ?>
					<legend><?php echo  $quest->$lng; ?></legend>
			
			<?php
			// Generate array of value=>label for radio button list
				$data = CHtml::listData($quest->answerVariant, 'id', $lng);

			/* 
			*  Generate and render radio button list 
			* 		for each question and its answer variants.
			*  Pass UserAnswer model to CHtml 
			*  		in order to generate correct names for list items.
			*/
				echo CHtml::activeRadioButtonList(UserAnswer::model(), "[$k]av_id", $data, 
							array('class'=>'pull-left', 'uncheckValue'=>null));
				
				if( $quest->customVariant ){
					foreach ($quest->customVariant as $custom) {
						echo CHtml::activeRadioButtonList(UserAnswer::model(), "[$k]av_id", 
													array($custom['id'] => $custom[$lng]),
													array('class'=>'pull-left', 'uncheckValue'=>null));
						echo CHtml::activeTextArea(CustomContent::model(), 
														"[$k]custom_content",
														array(
															'class' => 'span8 custom-answer', 
															'placeholder' => Yii::t('poll', 'Your answer'),
															));
					}
				}
			?>
					</div><!-- .round-block -->
				</li>
				<?php endforeach; ?>
			</ul><!-- .slides -->
			<?php 
				echo CHtml::submitButton(Yii::t('poll', 'End poll'), 
										array('class'=>'send-res flex-hidden btn btn-primary btn-large span4 pull-right')); ?>
		<!--</form>-->
		<?php echo CHtml::endForm(); ?>
		</div>
	</article>
</section>