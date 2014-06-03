<?php
/* @var $this PostulacionAPracticaController */
/* @var $model PostulacionAPractica */

$this->breadcrumbs = array(
    'Postulacion Apracticas' => array('admin'),
    'Administrar Postulaciones',
);

$this->menu = array(
    array('label' => 'List PostulacionAPractica', 'url' => array('index')),
    array('label' => 'Create PostulacionAPractica', 'url' => array('create')),
);
?>

<h1>Administrar Postulaciones a Practicas</h1>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'postulacion-apractica-form',
        'enableAjaxValidation' => false,
    ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'Seleccione Periodo'); ?>
        <?php echo $form->dropDownList($model, 'id_periodo_practica_fk',CHtml::listData(PeriodoPractica::model()->findAll('id_campus_fk=' . Yii::app()->user->getState('campus')), 'id_periodo_practica', 'nombre_mas_estado')); ?>
        <?php echo $form->error($model, 'id_periodo_practica_fk'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::button('Asignar Prácticas', array('submit' => array('asignarPracticas')));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'postulacion-apractica-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id_inscripcion_practica',
        array(
            'name' => 'id_periodo_practica_fk',
            'value' => '$data->idPeriodoPracticaFk->nombre_mas_estado',
            'filter' => CHtml::listData(PeriodoPractica::model()->findAll('id_campus_fk=' . Yii::app()->user->getState('campus')), 'id_periodo_practica', 'nombre_mas_estado'),
        ),
        array(
            'name' => 'id_estado_fk',
            'value' => '$data->idEstadoFk->nombre',
            'filter' => CHtml::listData(Estado::model()->findAll('id_tipo_estado_fk=' . TipoEstado::$POSTULACION_A_PRACTICA), 'id_estado', 'nombre'),
        ),
        array('name' => 'id_alumno',
            'value' => '$data->idAlumno->nombre." ".$data->idAlumno->apellido',
            'filter' => false,
        ),
        array('header' => "Curriculum",
            'filter' => false,
            'type' => 'raw',
            'value' => array($this, 'gridUrlCurriculum')),
        array('header' => "Evaluación",
            'filter' => CHtml::activeDropDownList($model, 'filtro_evaluacion', array(
                '' => '',
                '1' => 'Hecha',
                '0' => 'Incompleta',
            )),
            'type' => 'raw',
            'value' => array($this, 'gridEvaluacion')),
        //'id_alumno',
        //'id_adjunto_fk',
        //'fecha_creacion',

        /*
          'cumple_con_requisitos_al_inscribir',
          'observaciones',
          'puntaje_por_notas',
          'puntaje_por_curriculum',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete} {evaluar}',
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
                'evaluar' => array(
                    'label' => 'Evaluar',
                    'url' => "CHtml::normalizeUrl(array('evaluar', 'id'=>\$data->id_inscripcion_practica))",
                    'options' => array('id' => 'inline')
                //'imageUrl' => Yii::app()->request->baseUrl . '/images/delete_icon.png',
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