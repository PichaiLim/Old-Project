<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
	'Employees'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Employee', 'url'=>array('index')),
	array('label'=>'Create Employee', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#employee-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Employees</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employee-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'employee_type_id',
		'admin',
		'code',
		'username',
		'email',
		/*
		'password',
		'login_timeout',
		'avatar',
		'created',
		'created_by',
		'updated',
		'updated_by',
		'active',
		'initial',
		'first_name',
		'last_name',
		'gender',
		'birthdate',
		'marital_status',
		'address',
		'province_id',
		'district_id',
		'area_id',
		'postal_code',
		'home_phone',
		'work_phone',
		'mobile_phone',
		'remark',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
