<?php
/* @var $this ContactoEmpresaController */
/* @var $model ContactoEmpresa */



?>

<h1>Detalle del Contacto</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id_contacto_empresa',
		'nombre',
		'email',
		'telefono',
		'celular',
		'unidad',
		'cargo',
		array('name'=>'contacto_principal','value'=>$model->contacto_principal==1?'SI':'NO'),
		array('name'=>'id_empresa_fk','value'=>$model->idEmpresaFk->nombre),
	),
)); ?>
