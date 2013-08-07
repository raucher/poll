<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $this->pageTitle ?> | Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" >

	<!-- required styles -->
	<!-- start: CSS -->
	<?php $adminAssets = Yii::app()->request->baseUrl.'/bootstrap/admin'; ?>
	<link id="bootstrap-style" href="<?php echo $adminAssets ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $adminAssets ?>/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="<?php echo $adminAssets ?>/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="<?php echo $adminAssets ?>/css/style-responsive.css" rel="stylesheet">
	
	<!--[if lt IE 7 ]>
	<link id="ie-style" href="<?php echo $adminAssets ?>/css/style-ie.css" rel="stylesheet">
	<![endif]-->
	<!--[if IE 8 ]>
	<link id="ie-style" href="<?php echo $adminAssets ?>/css/style-ie.css" rel="stylesheet">
	<![endif]-->
	<!--[if IE 9 ]>
	<![endif]-->
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script src="<?php echo $adminAssets ?>/js/bootstrap.min.js"></script>

    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo $adminAssets ?>/css/user-styles.css" rel="stylesheet">

</head>
<body>

    <div id="wrapper" class="container-fluid">
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
        ));?>
        <?php if($this->navMenu): ?>
            <div id="admin-bar" class="navbar">
                <div class="navbar-inner">
                    <a class="btn" href="<?php echo $this->createUrl('logout')?>">
                        <i class="icon-off icon-white icon-large"></i>
                        <span> <?php echo Yii::t('poll', 'Log out') ?></span>
                    </a>
                    <a class="btn" href="<?php echo Yii::app()->createUrl('/index')?>">
                        <i class="icon-eye-open icon-white icon-large"></i>
                        <span> <?php echo Yii::t('poll', 'View site') ?></span>
                    </a>
                    <a class="btn offset1" href="<?php echo $this->createUrl('statistics')?>">
                        <i class="icon-bar-chart icon-white icon-large"></i>
                        <span> <?php echo Yii::t('poll', 'Statistics') ?></span>
                    </a>
                    <a class="btn" href="<?php echo $this->createUrl('managedata')?>">
                        <i class="icon-edit icon-white icon-large"></i>
                        <span>  <?php echo Yii::t('poll', 'Manage data') ?></span>
                    </a>
                <?php if(!Yii::app()->user->hasState('demoUserId')): ?>
                    <a class="btn" href="<?php echo $this->createUrl('changecredentials')?>">
                        <i class="icon-lock icon-white icon-large"></i>
                        <span>  <?php echo Yii::t('poll', 'Change credentials') ?></span>
                    </a>
                <?php endif ?>
                </div>
            </div>
        <?php endif ?>
		<?php echo $content; ?>
	</div>
</body>
</html>