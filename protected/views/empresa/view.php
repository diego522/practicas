<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
/* @var $modelContactos ContactoEmpresa */

$this->breadcrumbs = array(
    'Empresas' => array('index'),
    $model->nombre,
);

$this->menu = array(
    //array('label'=>'List Empresa', 'url'=>array('index')),
    //array('label'=>'Create Empresa', 'url'=>array('create')),
    array('label' => 'Agregar Contacto', 'url' => array('contactoEmpresa/create', 'ide' => $model->id_empresa), 'linkOptions' => array('id' => 'inline'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
    array('label' => 'Modificar Centro de Práctica', 'url' => array('update', 'id' => $model->id_empresa), 'linkOptions' => array('id' => 'inline')),
    array('label' => 'Eliminar Centro de Práctica', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_empresa), 'confirm' => 'Está seguro de eliminar este item?')),
    array('label' => 'Administrar Centro de Práctica', 'url' => array('admin')),
);
?>

<h1>Detalle del Centro de Práctica <?php echo $model->nombre; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id_empresa',
        'nombre',
        'direccion',
        'web',
        array('name' => 'id_cuidad_fk', 'value' => $model->idCuidadFk->COMUNA_NOMBRE . ', ' . $model->idCuidadFk->cOMUNAPROVINCIA->pROVINCIAREGION->REGION_NOMBRE),
    ),
));
?>
<h2>Listado de Contactos</h2>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'avance-grid',
    'dataProvider' => $modelContactos->search($model->id_empresa),
    'filter' => $modelContactos,
    'columns' => array(
        /* 'id_avance',
          'id_planificacion',
          'id_proyecto', */
        array('name' => 'nombre',
            'filter' => false),
        //'descripcion',
        array('name' => 'email',
            'filter' => false),
        array('name' => 'cargo',
            'filter' => false,),
        array('name' => 'contacto_principal',
            'filter' => false,
            'value' => '$data->contacto_principal==1?\'SI\':\'NO\''
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    //'label' => 'Ver detalles',
                    'url' => "CHtml::normalizeUrl(array('contactoEmpresa/view', 'id'=>\$data->id_contacto_empresa))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                    'options' => array('id' => 'inline')
                // 'options' => array('class'=>'pdf'),
                ),
                'update' => array(
                    //'label' => 'Ver detalles',
                    'url' => "CHtml::normalizeUrl(array('contactoEmpresa/update', 'id'=>\$data->id_contacto_empresa))",
                    'title' => "Modificar",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/edit_icon.png',
                    'options' => array('id' => 'inline')
                // 'options' => array('class'=>'pdf'),
                ),
                'delete' => array(
                    //'label' => 'Ver detalles',
                    'url' => "CHtml::normalizeUrl(array('contactoEmpresa/delete', 'id'=>\$data->id_contacto_empresa))",
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