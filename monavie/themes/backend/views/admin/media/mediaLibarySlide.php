<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . $title_header;
$baseUrl = Yii::app()->baseUrl;
?>
<div class="row-fluid">
    <div class="span12">
        <h1><?php echo $title_header; ?></h1>
        <hr/>
        <div class="span12" style="overflow-x: scroll; height: 800px; margin-left: 0px;">
            <?php
            $this->widget('bootstrap.widgets.TbGridView', array(
                'type' => 'striped', // type => striped bordered condensed
                'dataProvider' => $model,
                'columns' => array(
                    //'id',
                    array(
                        'name' => 'Image',
                        'type' => 'html',
                        'filter' => 'name',
                        'value' => 'CHtml::image(Yii::app()->baseUrl."/images/media/".$data->file, NULL, array("width"=>"200px"))',
                        'htmlOptions' => array(
                            'width' => '200px',
                        ),
                    ),
                    array(
                        'name' => 'name',
                        'type' => 'raw',
                        'value' => 'CHtml::link(
                                    "$data->name", 
                                    Yii::app()->createUrl("Media/MediaSlideEdit", 
                                        array("id" => "$data->id"))
                                    )
                                    ."<br/>".
                                    $data->type',
                        'htmlOptions' => array(
                            'width' => '300px'
                        ),
                    ),
                    array(
                        'name' => 'link',
                        'value' => '$data->link',
                        'htmlOptions' => array(
                            'width' => '150px'
                        ),
                    ),
                    array(
                        'name' => 'date',
                        'value' => '$data->date',
                        'htmlOptions' => array(
                            'width' => '200px',
                        ),
                    ),
                    array(
                        'name'=>'title',
                        'type'=>'html',
                        'value'=>'CHtml::encode($data->title)'
                    ),
                    array(
                        'name'=>'content',
                        'type'=>'html',
                        'value'=>'CHtml::encode($data->content)'
                    ),
                    // Delete
                    array(
                        'header' => 'Delete',
                        'class' => 'CLinkColumn',
                        'imageUrl' => $baseUrl . '/images/icons/system/glyphicons_207_remove_2.png',
                        'urlExpression' => 'Yii::app()->createUrl( "//Media/MediaSlideDelete", array("id" => $data->id,"img" => $data->file) )',
                        //'visible' => '',
                        'htmlOptions' => array(
                            'width' => '24px',
                            'align' => 'center',
                            'onclick' => 'return confirm("Confirm Delete Data Yes or No")',
                        ),
                    ),
                ),
            ));
            ?>
        </div>
    </div>
</div>