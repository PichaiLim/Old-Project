<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => Gallery::model()->getTabVideo('Gallery'),
    'enableSorting' => TRUE,
    'template' => "{items}\n{pager}",
    'itemView' => '//picture/_processTabVideo',
));
?>
