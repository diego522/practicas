<?php
/* @var $this CupoPracticaController */
/* @var $model CupoPractica */

$this->breadcrumbs=array(
	'Cupo de Prácticas'=>array('admin'),
	'Nuevo Cupo de Práctica',
);


?>

<h1>Nuevo Cupo en Centro de Práctica</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>