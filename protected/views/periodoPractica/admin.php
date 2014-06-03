<?php
/* @var $this PeriodoPracticaController */
/* @var $model PeriodoPractica */

$this->breadcrumbs = array(
    'Periodo de Prácticas' => array('admin'),
    'Administrar',
);

$this->menu = array(
    // array('label' => 'List PeriodoPractica', 'url' => array('index')),
    array('label' => 'Nuevo Periodo de Práctica', 'url' => array('create'), 'linkOptions' => array('id' => 'inline')),
);
?>

<h1>Administrar Periodos de Prácticas</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'periodo-practica-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id_periodo_practica',
        'nombre',
        //'fecha_creacion',
        array('name' => 'fecha_apertura', 'filter' => false),
        array('name' => 'fecha_cierre', 'filter' => false),
        array('name' => 'fecha_entrega_formulario_prac', 'filter' => false),
        array(
            'name' => 'id_estado_fk',
            'value' => '$data->idEstadoFk->nombre',
            'filter' => CHtml::listData(Estado::model()->findAll('id_tipo_estado_fk=:id', array('id' => TipoEstado::$PPERIODO_PRACTICA)), 'id_estado', 'nombre'),
        ),
        array(
            'name' => 'id_tipo_practica_fk',
            'value' => '$data->idTipoPracticaFk->nombre',
            'filter' => CHtml::listData(TipoPractica::model()->findAll(), 'id_tipo_practica', 'nombre'),
        ),
        //array('name'=>'id_campus_fk','value'=>'$data->idCampusFk->nombre'),
        /*
          'id_estado_fk',
          'id_tipo_practica_fk',

         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Ver',
                    // 'url' => "CHtml::normalizeUrl(array('view', 'id'=>\$data->id_propuesta))",
                    'options' => array('id' => 'inline'),
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                ),
                'update' => array(
                    'label' => 'Editar',
                    //'url' => "CHtml::normalizeUrl(array('update', 'id'=>\$data->id_propuesta))",
                    'options' => array('id' => 'inline'),
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/edit_icon.png',
                ),
                'delete' => array(
                    'label' => 'Borrar',
                    // 'url' => "CHtml::normalizeUrl(array('delete', 'id'=>\$data->id_propuesta))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/delete_icon.png',
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