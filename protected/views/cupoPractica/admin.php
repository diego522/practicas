<?php
/* @var $this CupoPracticaController */
/* @var $model CupoPractica */

$this->breadcrumbs = array(
    'Cupos de Prácticas' => array('admin'),
    'Administrar Cupos de Prácticas',
);

$this->menu = array(
    array('label' => 'Nuevo Cupo en Centro de Práctica', 'url' => array('create')),
);
?>

<h1>Administrar Cupos de Prácticas</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'cupo-practica-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id_cupo_practica',
        array(
            'name' => 'id_empresa_fk',
            'value' => '$data->idEmpresaFk->nombre_mas_ciudad',
            'filter' => CHtml::listData(Empresa::model()->findAll('campus=:idc', array(':idc' => Yii::app()->user->getState('campus'))), 'id_empresa', 'nombre_mas_ciudad'),
        ),
        array(
            'name' => 'id_periodo_practica_fk',
            'value' => '$data->idPeriodoPracticaFk->nombre_mas_estado',
            'filter' => CHtml::listData(PeriodoPractica::model()->findAll('id_campus_fk=:idc', array(':idc' => Yii::app()->user->getState('campus'))), 'id_periodo_practica', 'nombre_mas_estado'),
        ),
        array('name' => 'remunerado',
            'filter' => CHtml::activeDropDownList($model, 'remunerado', array(
                '' => '',
                '1' => 'SI',
                '2' => 'NO',
            )),
            'value' => '$data->remunerado==1?\'SI\':\'NO\''),
        array('name' => 'filtro_ciudad',
            'filter' => CHtml::listData(Comuna::model()->findAll('1=1 order by COMUNA_NOMBRE ASC'), 'COMUNA_ID', 'COMUNA_NOMBRE'),
            'value' => '$data->idEmpresaFk->idCuidadFk->COMUNA_NOMBRE',
        ),
        array('name' => 'cantidad', 'filter' => false),
        //'remunerado',
        //'detalle_remuneracion',
        //'funcion_a_cumplir',
        //'habilidades_requeridas',
        /*
          'duracion',
          'otros_beneficios',


          'id_usuario_creador_fk',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    //'label' => 'Ver detalles',
                    //'url' => "CHtml::normalizeUrl(array('contactoEmpresa/view', 'id'=>\$data->id_contacto_empresa))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                    'options' => array('id' => 'inline')
                // 'options' => array('class'=>'pdf'),
                ),
                'update' => array(
                    //'label' => 'Ver detalles',
                    // 'url' => "CHtml::normalizeUrl(array('contactoEmpresa/update', 'id'=>\$data->id_contacto_empresa))",
                    'title' => "Modificar",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/edit_icon.png',
                //'options' => array('id' => 'inline')
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