<section class="spoiler">
	<article class="welcome container">
		<div class="hero-unit">
			<div class="row-fluid">
				<div class="pic span6 pull-right"><img src="<?php echo Yii::app()->request->baseUrl;?>/img/mums.jpg" alt="Welcome, pal!"></div>
				<h1>Sieviešu aptauja<small class="block-tag">Pētnieciskā darba ietvaros</small></h1>
				<p>Labdien! Esmu Rīgas Stradiņa Universitātes Māszinības fakultātes vecmāšu studiju programmas 3. kursa studente Oksana Strucka. Sava kvalifikācijas darba ietvaros veicu pētījumu "Sievietes zināšanas par dzemdes kakla vēža skrīningu". Jūsu palīdzība man būs ļoti noderīga, tāpēc lūdzu atbildēt uz aptaujas jautājumiem.</p>
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
			<p class="privacy span6 pull-right"><strong>Aptauja ir anonīma</strong> un iegūtu datu konfidencialitāte tiek garantēta. Dati tiks izmantoti tikai kvalifikācijas darba ietvaros, apkopotā veida.</p>
			<p class="privacy span6 pull-right"><strong>Lūdzu</strong>, aptaujas gaitā izvēlieties Jums atbilstošu atbilžu variantu un atzīmējiet to.</p>
			<p class="privacy span6 pull-right"><strong>Paldies par atsaucību!</strong></p>
		</div>
	</div>
</div>