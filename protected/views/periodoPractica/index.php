<?php
/* @var $this PeriodoPracticaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Periodo Practicas',
);

$this->menu=array(
	array('label'=>'Create PeriodoPractica', 'url'=>array('create')),
	array('label'=>'Manage PeriodoPractica', 'url'=>array('admin')),
);
?>

<h1>Periodo Practicas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
