<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . $title_header;
$baseUrl = Yii::app()->baseUrl;
?>

<div class="span9 margin0">
    <h1 style="margin: 0px;"><?php echo $title_header; ?></h1>
    <hr style="margin: 0px;"/>
    
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped',
        'dataProvider' => $alluser,
        'columns' => array(
            'id',
            'username',
            array(
                'name' => 'Name & Lastname',
                'value' => '$data->name." ".$data->lastname',
            ),
            'email',
            array(
                //'header' => '',
                'class' => 'CLinkColumn',
                'imageUrl' => $baseUrl . '/images/icons/system/glyphicons_051_eye_open.png',
                'urlExpression' => 'Yii::app()->createUrl( "//Member/UserProfile", array("id" => $data->id) )',
                //'visible' => '',
                'htmlOptions' => array(
                    'width' => 24,
                    'align' => 'center',
                ),
            ),
            array(
                //'header' => '',
                'class' => 'CLinkColumn',
                'imageUrl' => $baseUrl . '/images/icons/system/glyphicons_039_notes.png',
                'urlExpression' => 'Yii::app()->createUrl( "//Member/UserEdit", array("id" => $data->id) )',
                //'visible' => '',
                'htmlOptions' => array(
                    'width' => 24,
                    'align' => 'center',
                ),
            ),
            array(
                //'header' => '',
                'class' => 'CLinkColumn',
                'imageUrl' => $baseUrl . '/images/icons/system/glyphicons_207_remove_2.png',
                'urlExpression' => 'Yii::app()->createUrl( "//Member/UserDelete", array("id" => $data->id) )',
                //'visible' => '',
                'htmlOptions' => array(
                    'width' => 24,
                    'align' => 'center',
                    'onclick'=>'return confirm("Confirm Delete Data Yes or No");',
                ),
            ),
        ),
    ));
    ?>
</div>
