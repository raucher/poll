<?php
/* @var $this SiteController */
Yii::app()->user->logout();
$this->pageTitle = Yii::t('poll', 'Thanks');;
?>
<section class="spoiler thanks">
	<article class="welcome container">
		<div class="hero-unit">
			<div class="row-fluid">
				<!--<div class="pic span6 pull-right"><img src="<?php //echo Yii::app()->request->baseUrl;?>/img/pretty_woman.jpg" alt="Welcome, pal!"></div>-->
				<h1>Спасибо за отзывчивость!<small class ="block-tag">Ваше участие в опросе было очень важно, желаю удачи, Оксана!</small></h1>
				<!--<p>Labdien! Esmu Rīgas Stradiņa Universitātes Māszinības fakultātes vecmāšu studiju programmas 3. kursa studente Oksana Strucka. Sava kvalifikācijas darba ietvaros veicu pētījumu "Sievietes zināšanas par dzemdes kakla vēža skrīningu". Jūsu palīdzība man būs ļoti noderīga, tāpēc lūdzu atbildēt uz aptaujas jautājumiem.</p>-->
			</div>
		</div>
	</article>
</section>
