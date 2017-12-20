<?php @session_start(); ?>
<?php @ob_start(); ?>
<?php
/* @var $this Controller */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <?php echo Yii::app()->bootstrap->register(); /* include File Bootstrap */ ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/MainStyle.css'); /* include File CSS */ ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/BackgroundStyle.css'); /* include File CSS */ ?>
        <?php echo CHtml::scriptFile(Yii::app()->baseUrl . '/js/ckeditor/ckeditor.js'); ?>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container space-padding-all"  style="background-color: wheat;">
            <?php if (!empty(Yii::app()->session['id'])): ?>
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="span3">
                                <h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>
                            </div>

                            <div class="span9 text-right">
                                <i class="icon-user"></i> 
                                <?php echo Yii::app()->session['username']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <?php echo $content; ?>
            <?php else: ?>
                <?php echo $content; ?>
            <?php endif; ?>
        </div><!-- page -->

        <div class="container">
            <div class="row">
                <div class="span12 text-center" style="margin-top: 1em; border-top: 1px inset black; color: white;">
                    <p><tt>Create Program By Pichai Limpanitivat</tt></p>
                    <p><kbd>Email : Pichai.Limpanitivat@Gmail.com</kbd> | <tt>Tel : 087-165-114-3</tt></p>
                </div>
            </div>
        </div>

    </body>
</html>
