<?php
/* @var $this CupoPracticaController */
/* @var $model CupoPractica */

$this->breadcrumbs=array(
	'Cupos de Prácticas'=>array('admin'),
	'Cupo'=>array('view','id'=>$model->id_cupo_practica),
	'Modificar',
);


?>

<h1>Modificar Cupo de Práctica</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>