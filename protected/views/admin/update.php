<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Makc
 * Date: 7/16/13
 * Time: 6:38 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<div id="update" class="row-fluid">
    <div class="box span8 offset2">
        <div class="box-header">
            <h2>
                <i class="icon-edit"></i>
                <span class="break"></span>
                Update question
            </h2>
        </div><!-- .box-header -->
        <div class="box-content">
            <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'updateForm',
                'type'=>'horizontal',
            )); ?>
            <?php echo $form->errorSummary($model); ?>

            <?php
                echo '<label>'.Yii::t('poll', 'Question').'</label>';
                echo $form->textFieldRow($model, 'lv_text', array('class'=>'span7'));
                echo $form->textFieldRow($model, 'ru_text', array('class'=>'span7'));

                echo '<label>'.Yii::t('poll', 'Answer variants').'</label>';
                foreach ($model->everyVariant as $i => $variant)
                {
                    echo '<hr>';
                    echo $form->checkBoxRow($variant, "[$i]is_custom");
                    echo $form->textAreaRow($variant, "[$i]lv_text", array('class'=>'span7'));
                    echo $form->textAreaRow($variant, "[$i]ru_text", array('class'=>'span7'));
                };
            ?>
            <input class="btn" type="submit">
            <?php $this->endWidget(); ?>
        </div><!-- .box-content -->
    </div><!-- .box -->
<div>