<?php
/* @var $this BranchController */
/* @var $model Branch */

$this->breadcrumbs=array(
	'Branches'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Branch', 'url'=>array('index')),
	array('label'=>'Create Branch', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#branch-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Branches</h1>

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
	'id'=>'branch-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'created',
		'created_by',
		'updated',
		'updated_by',
		'active',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
