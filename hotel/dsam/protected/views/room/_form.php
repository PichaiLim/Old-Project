<?php
/* @var $this RoomController */
/* @var $model Room */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'room-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'branch_id'); ?>
		<?php echo $form->textField($model,'branch_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'branch_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'building_id'); ?>
		<?php echo $form->textField($model,'building_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'building_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'floor_id'); ?>
		<?php echo $form->textField($model,'floor_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'floor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'room_type_id'); ?>
		<?php echo $form->textField($model,'room_type_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'room_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'created_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated'); ?>
		<?php echo $form->textField($model,'updated'); ?>
		<?php echo $form->error($model,'updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_by'); ?>
		<?php echo $form->textField($model,'updated_by',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'updated_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'published'); ?>
		<?php echo $form->textField($model,'published',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'published'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remark'); ?>
		<?php echo $form->textField($model,'remark',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seo_title'); ?>
		<?php echo $form->textField($model,'seo_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'seo_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seo_description'); ?>
		<?php echo $form->textField($model,'seo_description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'seo_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seo_keywords'); ?>
		<?php echo $form->textField($model,'seo_keywords',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'seo_keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reservation_count'); ?>
		<?php echo $form->textField($model,'reservation_count',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'reservation_count'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->