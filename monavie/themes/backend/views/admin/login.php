<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>
<div class="row-fluid" style="height:400px;">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'focus' => array($model, 'username'),
    ));
    ?>
    <div class="span6 thumbnail offset3 White-Gloss2 box-shadow">

        <h2 class="text-center" style="padding-bottom:10px;">
            เข้าสู่ระบบ <?php echo CHtml::encode(Yii::app()->name); ?>
        </h2>

        <div class="span11">
            <?php echo $form->labelEx($model, 'username', array('class' => 'span4 text-right')); ?>&nbsp;
            <?php echo $form->textField($model, 'username', array('class' => 'span5', 'placeholder' => 'example')); ?>
            <?php echo $form->error($model, 'username', array('class' => 'alert alert-danger')); ?>
        </div>

        <div class="span11">
            <?php echo $form->labelEx($model, 'password', array('class' => 'span4 text-right')); ?>&nbsp;
            <?php echo $form->passwordField($model, 'password', array('class' => 'span5', 'placeholder' => 'password')); ?>
            <?php echo $form->error($model, 'password', array('class' => 'alert alert-danger')); ?>
        </div>

        <div class="text-right" style="padding-bottom: 20px; padding-right: 5em;">
            <button type="submit" name="submit" class="btn btn-success">
                <i class="icon-lock icon-white"></i>
                เข้าสู่ระบบ
            </button>
        </div>

        <div class="span12 text-center">
            <?php
            $url = Yii::app()->createUrl('//site/index');
            echo CHtml::link('กลับไปหน้าหลัก', $url);
            ?>
        </div>

    </div>
    <?php $this->endWidget(); ?>

</div>