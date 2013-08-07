<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Makc
 * Date: 7/16/13
 * Time: 7:41 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<div id="create" class="row-fluid">
    <div class="box span8 offset2">
        <div class="box-header">
            <h2>
                <i class="icon-edit"></i>
                <span class="break"></span>
                Add question
            </h2>
            <div class="box-icon">
                <a class="add-variant btn-setting" href="#">
                    <i class="icon-plus icon-large"></i>
                    Add Variant
                    <span class="break"></span>
                </a>
                <a class="delete-variant btn-setting" href="#">
                    <i class="icon-remove icon-large"></i>
                    Delete last
                </a>
            </div>
        </div><!-- .box-header -->
        <div class="box-content">
            <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'addForm',
                'type'=>'horizontal',
            ));
            echo $form->errorSummary($question);
            echo $form->errorSummary($answer);
            echo '<label>'.Yii::t('poll', 'Question').'</label>';
            echo $form->textFieldRow($question, 'lv_text', array('class'=>'span7'));
            echo $form->textFieldRow($question, 'ru_text', array('class'=>'span7'));

            echo '<label>'.Yii::t('poll', 'Answer variants').'</label>';?>

            <div class="answer-variant">
                <hr>
                <?php
                echo $form->checkBoxRow($answer, "[0]is_custom");
                echo $form->textAreaRow($answer, "[0]lv_text", array('class'=>'span7'));
                echo $form->textAreaRow($answer, "[0]ru_text", array('class'=>'span7'));
                ?>
            </div>

            <input class="btn" type="submit">
            <?php $this->endWidget() ?>
        </div><!-- .box-content -->
    </div><!-- .box -->
</div>
<?php
$addDeleteVariantJs = "
jQuery.pollNs = {variantCounter : 0};
jQuery('.add-variant').click(function(e){
    i = ++ jQuery.pollNs.variantCounter;
    reName = /^(\w+\[)\d+(\].+)$/i;
    reId = /^([\w]+_)\d+(_.+)$/i;
    variant = $('.answer-variant:last').clone();
    variant.find('input, textarea').each(function(){
        jQuery(this).attr({
            'name': jQuery(this).attr('name').replace(reName,'$1'+i+'$2'),
            'id': jQuery(this).attr('id').replace(reId,'$1'+i+'$2'),
            'value': '',
            'checked': false
        });
    });
    variant.find('label').each(function(){
        jQuery(this).attr({
            'for': jQuery(this).attr('for').replace(reId,'$1'+i+'$2')
        });
    });

    variant.insertAfter('.answer-variant:last');
    return false;
});
jQuery('.delete-variant').click(function(e){
    if(jQuery.pollNs.variantCounter>0){
        jQuery('.answer-variant:last').remove();
        jQuery.pollNs.variantCounter --;
    }

    return false;
});
";

Yii::app()->clientScript->registerScript('addDeleteVariantJs', $addDeleteVariantJs);

?>
