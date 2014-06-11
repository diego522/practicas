<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	'Centros de Práctica'=>array('admin'),
	'Nuevo Centro de Práctica',
);


?>

<h1>Nuevo Centro de Práctica</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>