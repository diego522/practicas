<?php
/* @var $this PeriodoPracticaController */
/* @var $model PeriodoPractica */

$this->breadcrumbs = array(
    'Periodo de Prácticas Disponibles' => array('index'),
    'Administrar',
);
?>

<h1>Periodos de Prácticas Disponibles</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'periodo-practica-grid',
    'dataProvider' => $model->searchPeriodosDisponibles(),
    'filter' => $model,
    'columns' => array(
        //'id_periodo_practica',
        array('name'=>'nombre','filter'=>false),
        array(
            'name' => 'id_tipo_practica_fk',
            'value' => '$data->idTipoPracticaFk->nombre',
            'filter' => CHtml::listData(TipoPractica::model()->findAll(), 'id_tipo_practica', 'nombre'),
        ),
        //'fecha_creacion',
        // array('name' => 'fecha_apertura', 'filter' => false),
        array('name' => 'fecha_cierre', 'filter' => false),
        //array('name' => 'fecha_entrega_formulario_prac', 'filter' => false),
        array(
            'name' => 'id_estado_fk',
            'value' => '$data->idEstadoFk->nombre',
            'filter' => false
        //'filter' => CHtml::listData(Estado::model()->findAll('id_tipo_estado_fk=:id', array('id' => TipoEstado::$PPERIODO_PRACTICA)), 'id_estado', 'nombre'),
        ),
        //array('name'=>'id_campus_fk','value'=>'$data->idCampusFk->nombre'),
        /*
          'id_estado_fk',
          'id_tipo_practica_fk',

         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Revisar Cupos',
                    'url' => "CHtml::normalizeUrl(array('cupoPractica/listadoCupos', 'idp'=>\$data->id_periodo_practica))",
                    //'options' => array('id' => 'inline'),
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                ),
//                'update' => array(
//                    'label' => 'Editar',
//                    //'url' => "CHtml::normalizeUrl(array('update', 'id'=>\$data->id_propuesta))",
//                    'options' => array('id' => 'inline'),
//                    'imageUrl' => Yii::app()->request->baseUrl . '/images/edit_icon.png',
//                ),
//                'delete' => array(
//                    'label' => 'Borrar',
//                    // 'url' => "CHtml::normalizeUrl(array('delete', 'id'=>\$data->id_propuesta))",
//                    'imageUrl' => Yii::app()->request->baseUrl . '/images/delete_icon.png',
//                ),
            ),
        ),
    ),
));
?>