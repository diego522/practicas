<?php
/* @var $this ContactoEmpresaController */
/* @var $model ContactoEmpresa */

$this->breadcrumbs=array(
	'Contacto Empresas'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	//array('label'=>'List ContactoEmpresa', 'url'=>array('index')),
	array('label'=>'Nuevo Centro de práctica', 'url'=>array('create')),
);

?>

<h1>Administración de Contactos en Centros de Práctica</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contacto-empresa-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_contacto_empresa',
		'nombre',
		'email',
		'telefono',
		'celular',
		'unidad',
		/*
		'cargo',
		'contacto_principal',
		'id_empresa_fk',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
