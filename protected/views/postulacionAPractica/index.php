<?php
/* @var $this PostulacionAPracticaController */
/* @var $model PostulacionAPractica */

$this->breadcrumbs = array(
    'Mis Postulaciones' => array('index'),
    'Manage',
);
?>

<h1>Mis Postulaciones a Practicas</h1>



<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'postulacion-apractica-grid',
    'dataProvider' => $model->searchMisPostulaciones(),
    'filter' => $model,
    'columns' => array(
        //'id_inscripcion_practica',
        //'id_alumno',
        //'id_adjunto_fk',
        array('name'=>'id_periodo_practica_fk','value'=>'$data->idPeriodoPracticaFk->nombre_mas_estado'),
        //'fecha_creacion'array(),
        array('name'=>'id_estado_fk','value'=>'$data->idEstadoFk->nombre'),
        /*
          'cumple_con_requisitos_al_inscribir',
          'observaciones',
          'puntaje_por_notas',
          'puntaje_por_curriculum',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {delete}',
            'buttons' => array(
                'view' => array(
                    //'label' => 'Ver detalles',
                    //'url' => "CHtml::normalizeUrl(array('contactoEmpresa/view', 'id'=>\$data->id_contacto_empresa))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                //'options' => array('id' => 'inline')
                // 'options' => array('class'=>'pdf'),
                ),
                'delete' => array(
                    'label' => 'Renunciar',
                    // 'url' => "CHtml::normalizeUrl(array('contactoEmpresa/delete', 'id'=>\$data->id_contacto_empresa))",
                    'title' => "Renunciar",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/delete_icon.png',
                // 'options' => array('id' => 'inline')
                // 'options' => array('class'=>'pdf'),
                ),
            ),
        ),
    ),
));
?>
