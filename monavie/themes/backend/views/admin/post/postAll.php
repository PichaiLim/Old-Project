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
                'type' => 'striped',
                'dataProvider' => $model,
                'columns' => array(
                    'id',
                    'header',
                    /*array(
                        'name' => 'content',
                        'type' => 'html',
                        'value' => '$data->content',
                    ),
                     */
                    array(
                        'name' => 'status',
                        'value' => 'Post::model()->getStatus($data->status)',
                    ),
                    array(
                        'name' => 'Page',
                        'type'=>'raw',
                        'value' => 'Post::model()->getPageName($data->id_page)'
                    ),
                    // Update
                    array(
                        'header' => 'Edit',
                        'class' => 'CLinkColumn',
                        'imageUrl' => $baseUrl . '/images/icons/system/glyphicons_039_notes.png',
                        'urlExpression' => 'Yii::app()->createUrl( "//Posts/PostAdd", array("id" => $data->id) )',
                        //'visible' => '',
                        'htmlOptions' => array(
                            'width' => '24px',
                            'align' => 'center',
                        ),
                    ),
                    // Delete
                    array(
                        'header' => 'Delete',
                        'class' => 'CLinkColumn',
                        'imageUrl' => $baseUrl . '/images/icons/system/glyphicons_207_remove_2.png',
                        'urlExpression' => 'Yii::app()->createUrl( "//Posts/PostDelete", array("id" => $data->id) )',
                        //'visible' => '',
                        'htmlOptions' => array(
                            'width' => '24px',
                            'align' => 'center',
                            'onclick' => 'return confirm("Confirm Delete Data Yes or No")',
                        ),
                    ),
                ), // End Cloumns
            ));
            ?>
        </div>

    </div>