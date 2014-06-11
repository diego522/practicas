<?php
/* @var $this ContactoEmpresaController */
/* @var $model ContactoEmpresa */

$this->breadcrumbs=array(
	'Contacto Empresas'=>array('index'),
	$model->id_contacto_empresa=>array('view','id'=>$model->id_contacto_empresa),
	'Update',
);


?>

<h1>Modificar Contacto de Empresa</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>