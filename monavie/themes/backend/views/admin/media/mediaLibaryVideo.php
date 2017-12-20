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
                    array(
                        'name'=>'id_movie',
                        'value'=>'$data->id_movie',
                        'htmlOptions'=>array(
                            'width'=>50,
                        ),
                    ),
                    array(
                        'name' => 'movie_name',
                        'type' => 'raw',
                        'value' => 'CHtml::link(
                                    "$data->movie_name", 
                                    Yii::app()->createUrl("Media/MediaVideoEdit", 
                                        array("id" => "$data->id_movie"))
                                    )
                                    ."<br/>"',
                        'htmlOptions' => array(
                            'width' => '300px'
                        ),
                    ),
                    // Delete
                    array(
                        'header' => 'Delete',
                        'class' => 'CLinkColumn',
                        'imageUrl' => $baseUrl . '/images/icons/system/glyphicons_207_remove_2.png',
                        'urlExpression' => 'Yii::app()->createUrl( "//Media/MediaVideoDelete", array("id" => $data->id_movie) )',
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