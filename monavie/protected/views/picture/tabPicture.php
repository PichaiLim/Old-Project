<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => Gallery::model()->getTabPictuer('Gallery', "1"),
    'enableSorting' => TRUE,
    'template' => "{items}\n{pager}",
    'itemView' => '//picture/_processTabPicture',
));
?>
