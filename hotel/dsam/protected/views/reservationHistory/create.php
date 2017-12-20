<?php
/* @var $this ReservationHistoryController */
/* @var $model ReservationHistory */

$this->breadcrumbs=array(
	'Reservation Histories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReservationHistory', 'url'=>array('index')),
	array('label'=>'Manage ReservationHistory', 'url'=>array('admin')),
);
?>

<h1>Create ReservationHistory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>