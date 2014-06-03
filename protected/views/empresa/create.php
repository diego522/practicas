<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	'Empresas'=>array('admin'),
	'Create',
);


?>

<h1>Nueca Empresa</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>