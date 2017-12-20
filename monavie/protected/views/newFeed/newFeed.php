<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => Post::model()->getNewFeed('Post'),
    'enableSorting' => TRUE,
    'template' => "{items}\n{pager}",
    'itemView' => '//newFeed/_processNewFeed',
));
?>
