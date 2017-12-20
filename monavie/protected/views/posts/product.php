<?php

/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' ผลิตภัฑณ์';
?>

<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $posts,
    'enableSorting' => true,
    'template' => "{items}\n{pager}", // Close Header Display
    'itemView' => '//posts/_processProduct',
));

?>