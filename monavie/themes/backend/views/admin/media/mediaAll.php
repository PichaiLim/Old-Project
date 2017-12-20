<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . $title_header;
$baseUrl = Yii::app()->baseUrl;
?>
<div class="row-fluid">
    <h1><?php echo $title_header; ?></h1>
    <hr/>
    <div class="span12 text-center" style="margin: 0px;">
        <div class="span4">
            <a href="<?php echo Yii::app()->createUrl('//Media/MediaLibaryGallery'); ?>" class="btn btn-large btn-info">
                 <h2>
                     Media Gallery
                 </h2>
            </a>
        </div>
        
        <div class="span4">
            <a href="<?php echo Yii::app()->createUrl('//Media/MediaLibaryImage'); ?>" class="btn btn-large btn-success">
                 <h2>
                     Media Picture
                 </h2>
            </a>
        </div>
        
        <div class="span4">
            <a href="<?php echo Yii::app()->createUrl('//Media/MediaLibaryVideo'); ?>" class="btn btn-large btn-warning">
                <h2>
                    Media Video
                </h2>
            </a>
        </div>

    </div>
</div>