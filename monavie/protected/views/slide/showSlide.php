<?php

//$this->widget('zii.widgets.CListView', array(
//    'dataProvider' => Slide::model()->getDataProvider('Slide'),
//    'enableSorting' => TRUE,
//    'template' => "{items}\n{pager}", // Close Header Display
//    'itemView' => '//slide/_processSlide',
//));
//$this->widget('bootstrap.widgets.TbCarousel', array(
//    'items' => array(
//        array(
//            'image' => 'images\DSC02786_1.jpg',
//            'label' => 'First Thumbnail label',
//            'caption' => 'jubiliant mood '),
//        array(
//            'image' => 'images\siva.jpg',
//            'label' => 'Second Thumbnail label',
//            'caption' => 'Another caption'),
//        array(
//            'image' => 'images\siva1.jpg',
//            'label' => 'Third Thumbnail label',
//            'caption' => 'Yet Another'),
//    ),
//    'htmlOptions'=>array(
//        'style'=>'margin:0px;'
//    ),
//));
?>

<?php

$SlideList = Slide::model()->findAll(array(
    'condition' => 'id <> 0 ',
        ));

foreach ($SlideList as $item) {

    $SlidesList[] = array(
        'image' => Yii::app()->baseUrl.'/images/media/'.$item->file,
//    'label' =>$item->slidettile,
//    'caption'=> $item->slidedescrip,
    );
}

$this->widget('bootstrap.widgets.TbCarousel', array(
    'items' => $SlidesList,
    'htmlOptions' => array(
        'class' => 'carousel-inner',
        'interval' => '2000',
//        'style' => 'height: 300px; width:980px;'
        'style' => 'margin-bottom: 0px; padding-bottom: 0px;'
    )
));
?>