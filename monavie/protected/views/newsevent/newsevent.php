<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => Post::model()->getTabNewsEvent('Post','5'),
    'enableSorting' => TRUE,
    'template' => "{items}\n{pager}",
    'itemView' => '//newsevent/_processNewsEvent',
));
?>
