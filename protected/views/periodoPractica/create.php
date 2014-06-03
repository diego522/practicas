<?php
/* @var $this PeriodoPracticaController */
/* @var $model PeriodoPractica */

$this->breadcrumbs=array(
	'Periodo Practicas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PeriodoPractica', 'url'=>array('index')),
	array('label'=>'Manage PeriodoPractica', 'url'=>array('admin')),
);
?>

<h1>Nuevo Periodo de Práctica</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>