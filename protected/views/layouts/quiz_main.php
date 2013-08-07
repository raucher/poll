<?php $baseUrl = Yii::app()->request->baseUrl; ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo CHtml::encode($this->pageTitle).' | '.Yii::t('poll', 'Women poll');?></title>

<!-- Twitter Bootstrap and slider CSS -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>/bootstrap/css/both.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/flexslider/flexslider.css" type="text/css">
<!-- Main CSS file -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/style.css">
<noscript>
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/no-script.css">
</noscript>

<!-- jQuery, Twitter Bootstrap and Slider scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="<?php echo $baseUrl ?>/flexslider/flexslider-custom.min.js"></script>

<!-- Shoot out the slider -->
	<script type="text/javascript" charset="utf-8">
 		$(window).load(function() {
    		$('.flexslider').flexslider({
    			animationLoop: false,
    			selector: ".slides li",
    			slideshow: false,
    			keyboard: false,
    			prevText:"<?php echo Yii::t('poll', 'Previous');?>",
    			nextText:"<?php echo Yii::t('poll', 'Next'); ?>"
    		});
  		});
	</script>
</head>
<body id="main">
<div id="wrapper">
<header class="row-fluid">
    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'id'=>'demo-mode-alert',
        'alerts'=>array( // configurations per alert type
            'demoMode'=>array(
                'block'=>true,
                'fade'=>false,
                'closeText'=>false,
            ),
        ),
        'htmlOptions'=>array(
            'class'=>'text-center',
        ),
    )); ?>
	<div class="navbar pull-left language">
    	<div class="navbar-inner">
	    	<ul class="nav">
			    <li class="<?php echo ($this->getLang() === 'lv') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('', array('lang'=>'lv'));?>">
                        <strong>LV</strong>
                    </a>
                </li>
			    <li class="<?php echo ($this->getLang() === 'ru') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('', array('lang'=>'ru'));?>">
                        <strong>RU</strong>
                    </a>
                </li>
	    	</ul>
	    </div>
	</div>
	<div class="social-buttons span7">
		<?php $this->widget('ext.social.social', array(
			'networks' => array(
				'draugiem' => array(
                    'title'=>Yii::t('poll', 'Women cancer poll'),
                    'url'=>$this->createAbsoluteUrl('index',
                        array(
                            'lang'=>$this->getLang(),
                        )),
                    'width' => 90,
				),
				'twitter' => array(
					'width' => 88,
				),
				'facebook' => array(
					'width' => 120,
					'href' => $this->createAbsoluteUrl('index', 
                        array(
                            'lang'=>$this->getLang(),
                        )),
				),
				'googleplusone',
			),
		));?>
	</div>
</header>

<?php echo $content; ?>
</div><!-- #wrapper -->
<footer>
		<div class="copyright">
			<strong>Oksana Strucka &copy; 2013</strong>
			<div class="developer pull-right">
				<strong title="ggg">Developed by Makc</strong>
				<span><a href="http://www.yiiframework.com/" title="powered by Yii Framework"><img src="<?php echo $baseUrl; ?>/img/yii_powered.png" alt="Yii powered"></a></span>
			</div>
		</div>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-39646679-1', 'webege.com');
	  ga('send', 'pageview');

	</script>
</footer>
</body>
</html>