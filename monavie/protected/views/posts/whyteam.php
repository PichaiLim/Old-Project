<?php

$this->pageTitle = Yii::app()->name . ' ' . $title;
?>

<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $posts,
    'enableSorting' => TRUE,
    'template' => "{items}\n{pager}", // Close Header Display
    'itemView' => '//posts/_processWhyTeam',
));
?>