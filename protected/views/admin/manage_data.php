<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>

<script type="text/javascript">

</script>
<div id="manage-data" class="row-fluid">
    <div class="box span10 offset1">
        <div class="box-header">
            <h2>
                <i class="icon-edit"></i>
                <span class="break"></span>
                Question Management
            </h2>
            <div class="box-icon">
                <a class="add-variant btn-setting" href="<?php echo $this->createUrl('addquestion') ?>">
                    <i class="icon-plus icon-large"></i>
                    Add Question
                </a>
            </div> <!-- .box-icon -->
        </div><!-- .box-header -->
        <div class="box-content">
            <?php $this->widget('bootstrap.widgets.TbGridView', array(
                'type'=>'bordered condensed',
                'dataProvider'=>$dataProvider,
                'columns'=>array(
                    array(  // Weird but useful solution to display index of current row
                        'value'=>'$this->grid->dataProvider->pagination->currentPage
                                    * $this->grid->dataProvider->pagination->pageSize + $row + 1',
                        'header'=>'#'),
                    array('name'=>'lv_text', 'header'=>'LV'),
                    array('name'=>'ru_text', 'header'=>'RU'),
                    array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'htmlOptions'=>array(
                            'style'=>'width: 50px; text-align:center;'
                        ),
                        'template'=>'{update}{delete}',
                    ),
                ),
            )); ?>
        </div><!-- .box-content -->
    </div><!-- .box -->
</div> <!-- end: .row-fluid -->