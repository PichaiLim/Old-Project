<?php

/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - '.$title;
?>
<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $posts,
    'enableSorting' => TRUE,
    'template' => "{items}\n{pager}",
    'itemView' => '//posts/_processNewEvent',
));
?>