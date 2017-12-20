<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . $title_header;
$baseUrl = Yii::app()->baseUrl;
?>
<h1 style="margin: 0px;"><?php echo $title_header; ?></h1>
<br/>
<hr style="margin: 0px;"/>
<br/>

<div class="span9 margin0">
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped',
        'dataProvider'=>$model,
        'columns'=>array(
            'id',
            'name',
            'title',
            /*
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
             */
            // update
            array(
                'header' => 'Edit',
                'class' => 'CLinkColumn',
                'imageUrl' => $baseUrl . '/images/icons/system/glyphicons_039_notes.png',
                'urlExpression' => 'Yii::app()->createUrl( "//Pages/PageUpdate", array("id" => $data->id) )',
                //'visible' => '',
                'htmlOptions' => array(
                    'width' => 24,
                    'align' => 'center',
                ),
            ),
            
            /*
            // Delte
            array(
                //'header' => '',
                'class' => 'CLinkColumn',
                'imageUrl' => $baseUrl . '/images/icons/system/glyphicons_207_remove_2.png',
                'urlExpression' => 'Yii::app()->createUrl( "//Pages/UserDelete", array("id" => $data->id) )',
                //'visible' => '',
                'htmlOptions' => array(
                    'width' => 24,
                    'align' => 'center',
                ),
            ),
             */
        ),
    ));
    ?>
</div>