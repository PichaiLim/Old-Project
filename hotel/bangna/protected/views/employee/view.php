<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Employee', 'url'=>array('index')),
	array('label'=>'Create Employee', 'url'=>array('create')),
	array('label'=>'Update Employee', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Employee', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Employee', 'url'=>array('admin')),
);
?>

<h1>View Employee #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'employee_type_id',
		'admin',
		'code',
		'username',
		'email',
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
	),
)); ?>
