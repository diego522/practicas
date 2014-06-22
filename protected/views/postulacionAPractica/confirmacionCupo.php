<?php
/* @var $this PostulacionAPracticaController */
/* @var $model PostulacionAPractica */
/* @var $modelCupo CupoPractica */
/* @var $modelInscripcionCupo InscripcionCupoPractica */

$this->breadcrumbs = array(
    'Confirmación de asignación' => array('index'),
    "Detalle",
);
?>

<h1>Confirmación del cupo de práctica asignado</h1>
<h3>Postulación</h3>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'id' => 'viewDetalle',
    'data' => $model,
    'attributes' => array(
        //'id_inscripcion_practica',
        //'id_alumno',
        //'id_adjunto_fk',
        array('name' => 'id_periodo_practica_fk', 'value' => $model->idPeriodoPracticaFk->nombre_mas_estado),
        //'fecha_creacion',
        array('name' => 'id_estado_fk', 'value' => $model->idEstadoFk->nombre),
    ),
));
?>
<h3>Centro de Práctica asignado</h3>
<?php
//echo CHtml::link('<img src="'.Yii::app()->request->baseUrl . '/images/ver_icon.png'.'"/>', array('cupoPractica/view', 'id'=> $modelCupo->id_cupo_practica),array('id'=>'inline'));
?>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'id' => 'viewDetalleCupo',
    'data' => $modelCupo,
    'attributes' => array(
        array('name' => 'id_empresa_fk',
            'value' => $modelCupo->idEmpresaFk->nombre_mas_ciudad . " " . CHtml::link('<img src="' . Yii::app()->request->baseUrl . '/images/ver_icon.png' . '"/>', array('cupoPractica/view', 'id' => $modelCupo->id_cupo_practica), array('id' => 'inline')),
            'type' => 'raw',
        ),
    //array('name' => 'id_periodo_practica_fk', 'value' => $model->idPeriodoPracticaFk->nombre_mas_estado),
    //'id_usuario_creador_fk',
//        'cantidad',
//        array(
//            'name' => 'remunerado',
//            'value' => $modelCupo->remunerado == 1 ? 'SI' : 'NO',
//        ),
//        array(
//            'name' => 'detalle_remuneracion',
//            'type' => 'raw',
//            'visible' => $modelCupo->remunerado == 1 ? true : false,
//        ),
//        array(
//            'name' => 'funcion_a_cumplir',
//            'type' => 'raw'
//        ),
//        array(
//            'name' => 'habilidades_requeridas',
//            'type' => 'raw'
//        ),
//        array(
//            'name' => 'duracion',
//            'type' => 'raw'
//        ),
//        array(
//            'name' => 'otros_beneficios',
//            'type' => 'raw'
//        ),
    ),
));
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    //'enableAjaxValidation' => true,
    'id' => 'formCurriculum',
        // 'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>
<div class="form" >
    <div align="center">
        <table>
            <tr>
                <td align="center">
                    <div class="row buttons">
                        <?php
                        echo CHtml::button('Confirmar', array('submit' => array('postulacionAPractica/confirmar', 'id' => $model->id_inscripcion_practica),
                            'confirm' => 'Seguro desea confirmar la asignacióm hecha por el sistema?'
                        ));
                        ?>
                    </div>
                </td>
                <td align="center">
                    <div class="row buttons">
                        <?php
                        echo CHtml::button('Rechazar', array('submit' => array('postulacionAPractica/rechazar', 'id' => $model->id_inscripcion_practica),
                            'confirm' => 'Seguro desea rechazar la asignación hecha por el sistema?'
                        ));
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<!--
<h3>Cupos Inscritos</h3>
-->
<?php
//$this->widget('zii.widgets.grid.CGridView', array(
//    'id' => 'menu-grid',
//    'dataProvider' => $modelInscripcionCupo->searchInscrpcionesCupoPorPostulacion($model->id_inscripcion_practica),
//    'filter' => $modelInscripcionCupo,
//    'columns' => array(
//        array("header" => "Centro de Práctica",
//            "value" => '$data->idCupoPracticaFk->idEmpresaFk->nombre_mas_ciudad'
//        ),
//        array("header" => "Estado",
//            "value" => '$data->idEstadoFk->nombre'
//        ),
//        array(
//            'header' => 'Prioridad',
//            'type' => 'raw',
//            'value' => '$data->prioridad',
//            'htmlOptions' => array("width" => "50px"),
//        ),
//        array(
//            'class' => 'CButtonColumn',
//            'template' => '{view} ',
//            'htmlOptions' => array('style' => 'width:100px'),
//            'buttons' => array(
//                'view' => array(
//                    //'label' => 'Ver detalles',
//                    'url' => "CHtml::normalizeUrl(array('cupoPractica/view', 'id'=>\$data->id_cupo_practica_fk))",
//                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
//                    'options' => array('id' => 'inline')
//                //'options' => array('id' => 'inline')
//                ),
//            ),
//        ),
//    ),
//));
?>

<?php $this->endWidget(); ?>
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