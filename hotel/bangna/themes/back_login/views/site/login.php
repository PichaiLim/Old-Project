<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<a class="login-logo" href="#">&nbsp;</a>

<div class="container" id="login-form">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>เข้าสู่ระบบ</h2></div>
                <div class="panel-body">

                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'validate-form',
                            'enableClientValidation'=>true,
                            'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                            ),
                            'htmlOptions'=>array(
                                'class'=>'form-horizontal'
                            )
                        ));
                        ?>
                        <?php echo CHtml::errorSummary($model,"อีเมล์/ชื่อผู้ใช้งาน
                        หรือรหัสผ่านไม่ถูกต้อง", null, array('class'=>'alert alert-danger')); ?>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-user"></i>
									</span>
                                    <?php echo $form->textField($model,'username', array('class'=>'form-control',
                                        'placeholder'=>'Email Username', 'data-parsley-minlength'=>'6',
                                        'required'=>true, 'autofocus'=>true, "autocomplete"=>"off")); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-key"></i>
									</span>
                                    <?php echo $form->passwordField($model,'password', array('class'=>'form-control',
                                        'placeholder'=>'Password', "autocomplete"=>"off")) ; ?>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <div class="clearfix">
                                <button class="btn btn-primary btn-block" type="submit">เข้าสู่ระบบ</button>
                            </div>
                        </div>

                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<br/>

<p class="text text-center">
    <span class="well well-small bg-warning">
        Hint: You may login with <kbd>demoadmin</kbd>/<kbd>demoadmin</kbd> or <kbd>demouser</kbd>/<kbd>demouser</kbd>.
    </span>
</p>
