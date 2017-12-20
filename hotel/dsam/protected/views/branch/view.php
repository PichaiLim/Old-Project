<?php
/* @var $this BranchController */
/* @var $model Branch */

$this->breadcrumbs=array(
	'Branches'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Branch', 'url'=>array('index')),
	array('label'=>'Create Branch', 'url'=>array('create')),
	array('label'=>'Update Branch', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Branch', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Branch', 'url'=>array('admin')),
);
?>

<h1>View Branch #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created',
		'created_by',
		'updated',
		'updated_by',
		'active',
		'published',
		'name',
		'remark',
		'address',
		'province_id',
		'district_id',
		'area_id',
		'postal_code',
		'map_data',
		'phone',
		'fax',
		'seo_title',
		'seo_description',
		'seo_keywords',
		'building_count',
		'floor_count',
		'room_count',
		'room_type_count',
	),
)); ?>
