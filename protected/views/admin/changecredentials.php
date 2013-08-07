<div class="row-fluid">
    <div class="box span10 offset1">
        <div class="box-header">
            <h2>
                <i class="icon-lock"></i>
                <span class="break"></span>
                <?php echo Yii::t('poll', 'Change password'); ?>
            </h2>
        </div> <!--end: .box-header-->
        <div class="box-content" style="overflow:hidden">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'type'=>'horizontal',
            ));?>
        <?php echo $form->errorSummary($admin) ?>

        <?php echo $form->passwordFieldRow($admin, 'currentPassCheck') ?>
        <?php echo $form->passwordFieldRow($admin, 'newPass_repeat') ?>
        <?php echo $form->passwordFieldRow($admin, 'newPass') ?>
        <?php echo $form->textFieldRow($admin, 'login') ?>

        <?php echo CHtml::submitButton('Save credentials', array(
                'class'=>'btn btn-primary',
            ))?>
        <?php $this->endWidget() ?>
        </div> <!--end: .box-content-->
    </div> <!--end: .box-->
</div> <!--end: .row-fluid-->