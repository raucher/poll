<?php // Register core scripts for statistics charts
Yii::app()->clientScript->registerPackage('jsMigrate');
Yii::app()->clientScript->registerPackage('statCircles');
Yii::app()->clientScript->registerPackage('statPieChart');
// Register JS for chart at the end of file cause it depends on JS global data variable
Yii::app()->clientScript
         ->registerScriptFile(Yii::app()->homeUrl.'bootstrap/admin/js/charts.config.js',
                                CClientScript::POS_END);

// Set generated data to separate namespace and register this script at the beginning of file
$script = "jQuery.statCharNS = {
                data : [
                    { label: '25-34',  data:" . User::ageInterval(25, 34) . "},
                    { label: '35-44',  data:" . User::ageInterval(35, 44) . "},
                    { label: '45-54',  data:" . User::ageInterval(45, 54) . "},
                    { label: '55-64',  data:" . User::ageInterval(55, 64) . "},
                    { label: '>65',    data:" . User::ageInterval(65, 100). "}
                ]
           }";
Yii::app()->clientScript->registerScript('chartScript', $script, CClientScript::POS_BEGIN);
?>


<div class="row-fluid">	
	<div class="box span10 offset1">
		<div class="box-header">
			<h2>
				<i class="icon-user"></i>
				<span class="break"></span>
				<?php echo Yii::t('poll', 'User Statistics'); ?>
			</h2>
		</div>
		<div class="box-content" style="overflow:hidden">
			<!-- start: My Pie Chart -->
				<div id="mypiechart" class="span3 offset1" style="height:160px;"></div>
			<!-- end: My Pie Chart -->
			
			<!-- start: Circle Stats -->	
				<div class="circleStats">
					<div class="span3 offset1">
						<div class="circleStatsItem red">
							<i class="fa-icon-user"></i>
							<span class="plus"></span>
							<span class="percent"></span>
							<input type="text" value="<?php echo User::model()->count(); ?>" class="orangeCircle">
						</div>
						<div class="box-large-title">User Count</div>
					</div>
					<div class="span3">	
						<div class="circleStatsItem blue">
							<i class="fa-icon-time"></i>
							<span class="plus"></span>
							<span class="percent"></span>
							<input type="text" value="<?php echo User::averageAge(); ?>" class="blueCircle">
						</div>
						<div class="box-large-title">Average User Age</div>
					</div>
				</div>	
			<!-- end: Circle Stats -->	
		</div>
	</div>			
</div><!--/row-->

<div id="manage-data" class="row-fluid">
	<div class="span10 offset1">
		<div class="box accordion" id="accordion2">
		<!-- start: Answer Variant -->
		<div class="accordion-group">
		<?php foreach($questions as $i => $question): ?>
			<!-- <div class="accordion-group"> -->
				<div class="box-header accordion-heading">
					<h2>
						<i class="icon-tasks"></i>
						<span class="break"></span>
						<a data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $i; ?>">
							<?php echo $question->lv_text; ?>
						</a>
					</h2>
				</div><!-- end: .box-header -->

				<div id="collapse<?php echo $i; ?>" class="accordion-body <?php echo ($i === 0) ? 'collapse in' : 'collapse'; ?>">
					<div class="accordion-inner box-content">
						
						<?php if(!empty($question->customVariant)): ?>
						<!-- start: custom answer data-->
							<ul class="tickets">
							<?php foreach($question->customVariant[0]->customContent as $cc): ?>
									<li class="ticket">

										<span class="content">
											<span class="name"><?php echo $cc->custom_content ?></span>
										</span>
									</li>
							<?php endforeach; ?>
							</ul>
						<!-- start: custom answer data-->
						<?php else: ?>
						<!-- start: answer variant data-->
							<?php foreach($question->answerVariant as $av): ?>
								<h3><?php echo $av->lv_text; //echo ' - '.$av->answerCount; ?></h3>
								<div class="progress progress-warning">
									<span class="percentage"><?php echo $av->answerPercentage(); ?>%</span>
									<div class="bar" style="width:<?php echo $av->answerPercentage(); ?>%"></div>
								</div>
							<?php endforeach; ?>
						<!-- end: answer variant data-->
						<?php endif; ?>

					</div>
				</div><!-- end: #collapseOne -->
			<!--</div> end: Answer Variant -->
		<?php endforeach; ?>
		</div>
		
		</div>
	</div>
</div>