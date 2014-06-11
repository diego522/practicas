<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	'Centros de Práctica'=>array('admin'),
	$model->nombre=>array('view','id'=>$model->id_empresa),
	'Modificar',
);


?>

<h1>Modificar Centro de Práctica <?php echo $model->nombre; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>