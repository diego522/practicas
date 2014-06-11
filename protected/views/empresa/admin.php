<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs = array(
    'Centros de Práctica' => array('admin'),
    'Administrar',
);

$this->menu = array(
    //array('label'=>'List Empresa', 'url'=>array('index')),
    array('label' => 'Nueva Empresa', 'url' => array('create'), 'linkOptions' => array('id' => 'inline')),
);
?>

<h1>Administrar Centros de Práctica</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'empresa-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'nombre',
        'direccion',
        'web',
        array('name'=>'id_cuidad_fk','value'=>'$data->idCuidadFk->COMUNA_NOMBRE'),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    //'label' => 'Ver detalles',
                    //'url' => "CHtml::normalizeUrl(array('contactoEmpresa/view', 'id'=>\$data->id_contacto_empresa))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                //'options' => array('id' => 'inline')
                // 'options' => array('class'=>'pdf'),
                ),
                'update' => array(
                    //'label' => 'Ver detalles',
                    // 'url' => "CHtml::normalizeUrl(array('contactoEmpresa/update', 'id'=>\$data->id_contacto_empresa))",
                    'title' => "Modificar",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/edit_icon.png',
                    'options' => array('id' => 'inline')
                // 'options' => array('class'=>'pdf'),
                ),
                'delete' => array(
                    //'label' => 'Ver detalles',
                    // 'url' => "CHtml::normalizeUrl(array('contactoEmpresa/delete', 'id'=>\$data->id_contacto_empresa))",
                    'title' => "Eliminar",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/delete_icon.png',
                // 'options' => array('id' => 'inline')
                // 'options' => array('class'=>'pdf'),
                ),
            ),
        ),
    ),
));
?>
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a#inline',
    'config' => array(
        'scrolling' => 'no',
        'titleShow' => false,
    // 'onComplete' => 'function(){tinyMCE_setup();}',
    ),
        )
);
?>
