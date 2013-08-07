<section class="spoiler">
	<article class="welcome container">
		<div class="hero-unit">
			<div class="row-fluid">
				<div class="pic span6 pull-right"><img src="<?php echo Yii::app()->request->baseUrl;?>/img/pretty_woman.jpg" alt="Welcome, pal!"></div>
				<h1>Perenatal Poll<small class="block-tag">Poll about your speciffic knowledges</small></h1>
				<p>Lorem ipsum magna tempor magna Excepteur eiusmod Excepteur velit et labore eu cupidatat incididunt laborum proident dolore sed sint do nostrud Ut labore sed elit eu in dolor commodo irure amet veniam in consectetur adipisicing reprehenderit esse non et aliquip in ut labore ex pariatur. </p>
			</div>
		</div>
	</article>
</section>
<div class="main-content container">
	<div id="login" class="round-block span7 offset2">
		<div class="row-fluid">
			<!--<form class="span4">-->
			<?php echo CHtml::beginForm('', 'post', 
								array('class'=>'span6')
								); ?>
			
			<legend>Login</legend>
			<?php echo CHtml::activeLabel($model, 'name'); ?>
			<?php echo CHtml::activeTextField($model,'name',
					array('placeholder'=>Yii::t('poll', 'Your name...'),
							'class'=>'span11')); ?>
			<?php 
				// Generate array for age drop down list
				$i = 24;
				while( $i < 65 ) $age[++$i] = $i; ?>
			<?php echo CHtml::activeLabel($model, 'age'); ?>
			<?php echo CHtml::activeDropDownList($model, 'age', $age, 
											array('class'=>'span11')); ?>
			<?php echo CHtml::submitButton(Yii::t('poll', 'Start poll'), 
								array('class'=>'btn btn-success btn-large span8')
								);?>
			<!--</form>-->
			<?php echo CHtml::endForm(); ?>
			<p class="privacy span6 pull-right"><strong>Privacy policy</strong> ut id minim occaecat dolor sunt nulla occaecat dolore anim aliqua id officia sunt occaecat non ad voluptate culpa in ea est do ad et adipisicing dolore labore est commodo occaecat enim Duis officia veniam dolor cupidatat velit ut incididunt esse ad aute ad proident proident ut culpa aute veniam Duis non eiusmod id cupidatat aute. Id officia sunt occaecat non ad voluptate culpa in ea est do ad et adipisicing dolore labore est commodo occaecat enim Duis officia veniam dolor cupidatat velit ut incididunt esse</p>
		</div>
	</div>
</div>