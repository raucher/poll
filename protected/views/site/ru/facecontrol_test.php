<section class="spoiler">
	<article class="welcome container">
		<div class="hero-unit">
			<div class="row-fluid">
				<div class="pic span6 pull-right"><img src="<?php echo Yii::app()->request->baseUrl;?>/img/mums.jpg" alt="Welcome, pal!"></div>
				<h1>Женский опрос<small class="block-tag">В рамках исследовательской работы</small></h1>
				<p>Здравствуйте! Я студентка 3-го курса кафедры акушерства Рижского Университета им. Паула Страдиня - Оксана Струцка. В рамках своей квалификационной работы провожу исследование "Знания женщин о скрининге рака шейки матки". Ваша помощь  мне будет очень полезна, поэтому прошу Вас пройти короткий опрос!</p>
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
			<p class="privacy span6 pull-right"><strong>Опрос полностью анонимен!</strong> Конфиденциальность полученных данных гарантируется. Данные будут использованы исключительно в рамках исследовательской работы в обобщённом виде.</p>
			<p class="privacy span6 pull-right"><strong>Пожалуйста</strong>, в ходе опроса выберите подходящие Вам варианты ответов и отметьте их.</p>
			<p class="privacy span6 pull-right"><strong>Благодарю за внимание!</strong></p>
		</div>
	</div>
</div>