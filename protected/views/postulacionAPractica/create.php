<?php
/* @var $this PostulacionAPracticaController */
/* @var $model PostulacionAPractica */

$this->breadcrumbs=array(
	'Postulacion Apracticas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PostulacionAPractica', 'url'=>array('index')),
	array('label'=>'Manage PostulacionAPractica', 'url'=>array('admin')),
);
?>

<h1>Create PostulacionAPractica</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>