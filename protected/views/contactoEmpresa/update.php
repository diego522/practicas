<?php
/* @var $this ContactoEmpresaController */
/* @var $model ContactoEmpresa */

$this->breadcrumbs=array(
	'Contacto Empresas'=>array('index'),
	$model->id_contacto_empresa=>array('view','id'=>$model->id_contacto_empresa),
	'Update',
);

$this->menu=array(
	array('label'=>'List ContactoEmpresa', 'url'=>array('index')),
	array('label'=>'Create ContactoEmpresa', 'url'=>array('create')),
	array('label'=>'View ContactoEmpresa', 'url'=>array('view', 'id'=>$model->id_contacto_empresa)),
	array('label'=>'Manage ContactoEmpresa', 'url'=>array('admin')),
);
?>

<h1>Modificar Contacto de Empresa</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>