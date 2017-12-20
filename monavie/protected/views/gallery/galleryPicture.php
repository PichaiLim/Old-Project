<?php $this->pageTitle = Yii::app()->name." - ".$title;?>

<style type="text/css">
    .span6:nth-child(odd){
        margin-left: 0px;
    }
</style>


<h1>
    <?php echo $title;?>
</h1>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $model,
    'enableSorting' => TRUE,
    'template' => "{items}\n{pager}",
    'itemView' => '//gallery/_processGalleryPicture',
));
?>