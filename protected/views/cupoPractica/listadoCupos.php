<?php
/* @var $this CupoPracticaController */
/* @var $model CupoPractica */

$this->breadcrumbs = array(
    'Cupos de Prácticas' => '#',
    'Listado de Cupos para Prácticas',
);
?>

<h1>Listado de cupos disponibles para prácticas profesionales</h1>

<?php
$form = $this->beginWidget('CActiveForm', array(
        // 'enableAjaxValidation'=>true,
        ));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'cupo-practica-grid',
    'dataProvider' => $model->searchCupoPracticaDisponible($idp),
    'filter' => $model,
    'columns' => array(
        //'id_cupo_practica',
        array(
            'name' => 'id_empresa_fk',
            'value' => '$data->idEmpresaFk->nombre_mas_ciudad',
            'filter' => false,
        //'filter' => CHtml::listData(Empresa::model()->findAll('campus=:idc', array(':idc' => Yii::app()->user->getState('campus'))), 'id_empresa', 'nombre_mas_ciudad'),
        ),
        array(
            'name' => 'id_periodo_practica_fk',
            'value' => '$data->idPeriodoPracticaFk->nombre_mas_estado',
            'filter' => false
        //'filter' => CHtml::listData(PeriodoPractica::model()->findAll('id_campus_fk=:idc', array(':idc' => Yii::app()->user->getState('campus'))), 'id_periodo_practica', 'nombre_mas_estado'),
        ),
        array('name' => 'remunerado', 'value' => '$data->remunerado==1?\'Si\':\'No\'', 'filter' => false),
        array('name' => 'cantidad', 'filter' => false),
        array('header' => 'Postulantes', 'value' => array($this, 'gridPotulantes')),
        array(
            "header" => "Postular",
            'class' => 'CCheckBoxColumn',
            'selectableRows' => 2
        ),
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
            'template' => '{view} ',
            'buttons' => array(
                'view' => array(
                    //'label' => 'Ver detalles',
                    //'url' => "CHtml::normalizeUrl(array('contactoEmpresa/view', 'id'=>\$data->id_contacto_empresa))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                    'options' => array('id' => 'inline')
                ),
//                'postular' => array(
//                    'label' => 'Postular',
//                    'url' => "CHtml::normalizeUrl(array('inscribirCupo', 'idc'=>\$data->id_cupo_practica))",
//                // 'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
//                //'options' => array('id' => 'inline')
//                ),
            ),
        ),
    ),
));
?>
<div class="form" align="center">
    <div class="row buttons">
        <?php
        echo CHtml::submitButton('Postular a la(s) Seleccionada(s)', array(
            'submit' => array('inscribirCupo'),
                /* 'confirm' => '¿Seguro que desea enviar la propuesta a revisión?, después ya no podrá editarla'
                  // or you can use 'params'=>array('id'=>$id) */
                )
        );
        ?>
    </div>
</div>
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