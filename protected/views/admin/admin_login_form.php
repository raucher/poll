<div class="row-fluid">
	<div class="login-box">
		<div class="icons">
			<a href="index.html"><i class="icon-home"></i></a>
		</div>
		<h2>Login to your account</h2>
		<?php echo CHtml::beginForm('', 'post', 
							array('class'=>'form-horizontal'));
				echo CHtml::errorSummary($model); ?>

			<div class="input-prepend" title="Username">
				<span class="add-on"><i class="icon-user"></i></span>
				<?php echo CHtml::activeTextField($model, 'login',
									array(
										'class'=>'input-large span10',
										'placeholder' => 'Username',
									));?>
			</div>
			<div class="clearfix"></div>

			<div class="input-prepend" title="Password">
				<span class="add-on"><i class="icon-lock"></i></span>
				<?php echo CHtml::activePasswordField($model, 'passwrd',
									array(
										'class'=>'input-large span10',
										'placeholder' => 'Password',
									));?>
			</div>
			<div class="clearfix"></div>

			<div class="button-login">	
				<button type="submit" class="btn btn-primary"><i class="icon-off icon-white"></i> Login</button>
			</div>
			<div class="clearfix"></div>
		<?php echo CHtml::endForm(); ?>
	</div><!--/login-box-->
</div><!--/row-fluid-->