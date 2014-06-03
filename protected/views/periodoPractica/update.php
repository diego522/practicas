<?php
/* @var $this PeriodoPracticaController */
/* @var $model PeriodoPractica */

$this->breadcrumbs=array(
	'Periodo Practicas'=>array('index'),
	$model->id_periodo_practica=>array('view','id'=>$model->id_periodo_practica),
	'Update',
);

$this->menu=array(
	array('label'=>'List PeriodoPractica', 'url'=>array('index')),
	array('label'=>'Create PeriodoPractica', 'url'=>array('create')),
	array('label'=>'View PeriodoPractica', 'url'=>array('view', 'id'=>$model->id_periodo_practica)),
	array('label'=>'Manage PeriodoPractica', 'url'=>array('admin')),
);
?>

<h1>Modificar Periodo de Práctica </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>