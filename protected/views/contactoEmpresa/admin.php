<?php
/* @var $this ContactoEmpresaController */
/* @var $model ContactoEmpresa */

$this->breadcrumbs=array(
	'Contacto Empresas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ContactoEmpresa', 'url'=>array('index')),
	array('label'=>'Create ContactoEmpresa', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#contacto-empresa-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Contacto Empresas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

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
