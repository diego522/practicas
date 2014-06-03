<?php
/* @var $this ContactoEmpresaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contacto Empresas',
);

$this->menu=array(
	array('label'=>'Create ContactoEmpresa', 'url'=>array('create')),
	array('label'=>'Manage ContactoEmpresa', 'url'=>array('admin')),
);
?>

<h1>Contacto Empresas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
