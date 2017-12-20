<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => Post::model()->getTabNewsEvent('Post','6'),
    'enableSorting' => TRUE,
    'template' => "{items}\n{pager}",
    'itemView' => '//article/_processArticleList',
));
?>
