<?php
/* @var $this Controller */
@session_start();
@ob_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <style type="text/css">
                        body{
                            background-image:url('images/bg01.png');
                        }
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <?php echo Yii::app()->bootstrap->register(); /* include File Bootstrap */ ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/MainStyle.css'); /* include File CSS */ ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/BackgroundStyle.css'); /* include File CSS */ ?>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
    </head>

    <body>
        <div class="bg-line"></div>

        <div class="container" id="page-980">
            <div class="row-fluid">

                <div class="span6 pull-left">
                    <h1><?php echo CHtml::link(CHtml::encode(Yii::app()->name), array('site/index')); ?></h1>
                </div><!-- Logo -->

                <div class="pull-right">
                    <ul class="nav nav-pills" style="margin-bottom: 0px;">
                        <li><img src="<?php echo Yii::app()->baseUrl; ?>/images/icons/social/facebook.png" width="24" style="padding-top:10px;"/></li>
                        <li><img src="<?php echo Yii::app()->baseUrl; ?>/images/icons/social/google.png" width="24" style="padding-top:10px;"/></li>
                        <li><img src="<?php echo Yii::app()->baseUrl; ?>/images/icons/social/twitter.png" width="24" style="padding-top:10px;"/></li>
                        <li><img src="<?php echo Yii::app()->baseUrl; ?>/images/icons/social/rss.png" width="24" style="padding-top:10px;"/></li>
                        <?php if (empty(Yii::app()->request->cookies['id'])): ?>
                            <li class="text-center navbar-inverse">
                                <a href="<?php echo Yii::app()->createUrl('//site/Login'); ?>" class="btn">
                                    <i class="icon-lock"></i> 
                                    <b>เข้าสู่ระบบ</b>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="text-center navbar-inverse">
                                <a href="<?php echo Yii::app()->createUrl('//site/Logout'); ?>" class="btn">
                                    <i class="icon-lock"></i> 
                                    <b>ออกจากระบบ</b>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div> <!-- Login -->

                <div class="row-fluid">
                    <div class="span-12">
                        <div class="pull-right navbar nav-pills navbar-inner" style="margin-bottom: 0px;">
                            <ul class="nav">
                                <li class="active">
                                    <a href="<?php echo Yii::app()->createUrl('//Site/index'); ?>">หน้าหลัก</a>
                                </li>

                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('//Posts/Product'); ?>">
                                        ผลิตภัณฑ์
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('//Posts/WhyMoanvie'); ?>">
                                        ทำไมต้องโมนาวี
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('//Posts/WhyTeam'); ?>">
                                        ทำไมต้อง <?php echo CHtml::encode(Yii::app()->name); ?>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('//Posts/Business'); ?>">
                                        โอกาสทางธุรกิจ
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('//Posts/NewEvent'); ?>">
                                        ข่าวสารกิจกรรม
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('//Site/ContactUs'); ?>">
                                        ติดต่อเรา
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- Nav -->

            </div>
        </div><!-- header -->
        
        <div>
            <?php echo $content;?>
        </div>
        
        <div class="container-fluid" style="background-color: #f36921; color: white; padding-top: 10px;">
            <div class="container">
                <div class="row-fluid">
                    <div class="span-12 text-center">
                        Copyright &copy; 2013 - <?php echo date('Y'); ?> by <?php echo CHtml::encode(Yii::app()->name); ?>.<br/>
                        All Rights Reserved.<br/>
                        <?php echo Yii::powered(); ?>
                    </div>
                </div>
            </div>
        </div><!-- footer -->

        <div class="bg-line"></div>
    </body>
</html>