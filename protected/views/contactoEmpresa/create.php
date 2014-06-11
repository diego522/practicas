<?php
/* @var $this ContactoEmpresaController */
/* @var $model ContactoEmpresa */

$this->breadcrumbs=array(
	'Contacto Empresas'=>array('index'),
	'Create',
);


?>

<h1>Nuevo Contacto de Centro de Práctica</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>