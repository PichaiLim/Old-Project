<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $model,
    'enableSorting' => TRUE,
    'template' => "{items}\n{pager}",
    'itemView' => '//gallery/_processgalleryVideoView',
));
?>
