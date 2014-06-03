<?php
/* @var $this PostulacionAPracticaController */
/* @var $model PostulacionAPractica */

$this->breadcrumbs=array(
	'Postulacion Apracticas'=>array('index'),
	$model->id_inscripcion_practica=>array('view','id'=>$model->id_inscripcion_practica),
	'Update',
);

$this->menu=array(
	array('label'=>'List PostulacionAPractica', 'url'=>array('index')),
	array('label'=>'Create PostulacionAPractica', 'url'=>array('create')),
	array('label'=>'View PostulacionAPractica', 'url'=>array('view', 'id'=>$model->id_inscripcion_practica)),
	array('label'=>'Manage PostulacionAPractica', 'url'=>array('admin')),
);
?>

<h1>Update PostulacionAPractica <?php echo $model->id_inscripcion_practica; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>