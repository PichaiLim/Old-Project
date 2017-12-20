<?php
/* @var $this ReservationHistoryController */
/* @var $model ReservationHistory */

$this->breadcrumbs=array(
	'Reservation Histories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReservationHistory', 'url'=>array('index')),
	array('label'=>'Create ReservationHistory', 'url'=>array('create')),
	array('label'=>'View ReservationHistory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReservationHistory', 'url'=>array('admin')),
);
?>

<h1>Update ReservationHistory <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>