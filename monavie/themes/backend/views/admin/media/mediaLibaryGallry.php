<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . $title_header;
$baseUrl = Yii::app()->baseUrl;
?>
<div class="row-fluid">
    <div class="span12">
        <h1><?php echo $title_header; ?></h1>
        <hr/>
        <div class="row-fluid">
            <div class="span12">
                <?php
                $this->widget('bootstrap.widgets.TbGridView', array(
                    'type' => 'striped', // type => striped bordered condensed
                    'dataProvider' => $model,
                    //'template'=>"{items}",
                    'columns' => array(
                        'id',
                        'name',
                        'content',
                        array(
                            'name' => 'date',
                            'value' => '$data->date',
                            'htmlOptions' => array(
                                'width' => '150px',
                            ),
                        ),
                        array(
                            'name' => 'type',
                            'type' => 'raw',
                            'value' => 'Gallery::model()->getStatus($data->type)',
                            'htmlOptions' => array(
                                'width' => '64px',
                                'align' => 'center',
                            ),
                        ),
                        /*
                         array(
                            'name'=>'Coutn',
                            'type'=>'raw',
                            'value'=>'Gallery::model()->getCountMedia($data->id)'
                        ),
                         */
                        array(
                            'header' => 'Edit',
                            'class' => 'CLinkColumn',
                            'imageUrl' => $baseUrl . '/images/icons/system/glyphicons_039_notes.png',
                            'urlExpression' => 'Yii::app()->createUrl("//Media/MediaGallryAdd", array("id"=>$data->id))',
                            'htmlOptions' => array(
                                'width' => '25px',
                                'align' => 'center'
                            ),
                        ),
                        array(
                            'header' => 'Delete',
                            'class' => 'CLinkColumn',
                            'imageUrl' => $baseUrl . '/images/icons/system/glyphicons_207_remove_2.png',
                            'urlExpression' => 'Yii::app()->createUrl("//Media/MediaGallryDelete",array("id"=>$data->id))',
                            'htmlOptions' => array(
                                'align' => 'center',
                                'width' => '25px',
                                'Onclick' => 'return confirm("Confirm Delete Data Yes or No");',
                            )
                        ),
                    ),
                ));
                ?>
            </div>
        </div>

    </div>
</div>