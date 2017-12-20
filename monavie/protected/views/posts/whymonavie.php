<?php

// Setting Title page

$this->pageTitle = Yii::app()->name . ' ทำไมต้อง โมนาวี';
?>

<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $posts,
    'enableSorting' => true,
    'template' => "{items}\n{pager}", // Close Header Display
    'itemView' => '//posts/_processWhyMoanvie',
));

?>