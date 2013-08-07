$(window).load(function() {
    $('.flexslider').flexslider({
        animationLoop: false,
        selector: ".slides li",
        slideshow: false,
        prevText:"<?php echo Yii::t('poll', 'Previous'); ?>",
        nextText:"<?php echo Yii::t('poll', 'Next'); ?>"
    });
})
