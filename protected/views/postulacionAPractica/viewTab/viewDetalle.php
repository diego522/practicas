
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
    //'cumple_con_requisitos_al_inscribir',
    //'observaciones',
    //'puntaje_por_notas',
    //'puntaje_por_curriculum',
    ),
));
?>
<div class="form" >
    <?php if ($model->id_estado_fk == Estado::$POSTULACION_PRACTICA_BORRADOR) { ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'Postulación'); ?>
            <div class="buttons">
                <?php
                echo CHtml::ajaxSubmitButton('Enviar Postulación', array('enviarPostulacion', 'id' => $model->id_inscripcion_practica), array('success' => 'reloadFlash'));
                ?>
            </div>
        </div>
    <?php } ?>
</div>
<h3>Cupos Inscritos</h3>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'menu-grid',
    'dataProvider' => $modelInscripcionCupo->searchInscrpcionesCupoPorPostulacion($model->id_inscripcion_practica),
    'filter' => $modelInscripcionCupo,
    'columns' => array(
        array("header" => "Centro de Práctica",
            "value" => '$data->idCupoPracticaFk->idEmpresaFk->nombre_mas_ciudad'
        ),
        array("header" => "Estado",
            "value" => '$data->idEstadoFk->nombre'
        ),
        array(
            'header' => 'Prioridad',
            'type' => 'raw',
            'value' => 'CHtml::textField("cupoInscrito[$data->id_inscripcion_practica]",$data->prioridad,array("style"=>"width:50px;"))',
            'htmlOptions' => array("width" => "50px"),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {delete}',
            'htmlOptions' => array('style' => 'width:100px'),
            'buttons' => array(
                'view' => array(
                    //'label' => 'Ver detalles',
                    'url' => "CHtml::normalizeUrl(array('cupoPractica/view', 'id'=>\$data->id_cupo_practica_fk))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/ver_icon.png',
                    'options' => array('id' => 'inline')
                //'options' => array('id' => 'inline')
                ),
                'delete' => array(
                    'label' => 'Renunciar',
                    'url' => "CHtml::normalizeUrl(array('eliminaCupoInscrito', 'idc'=>\$data->id_inscripcion_practica,'idp'=>\$data->id_postulacion_practica_fk))",
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/delete_icon.png',
                    'click' => "function(){
                                    $.fn.yiiGridView.update('menu-grid', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data) {
                                              $('#AjFlash').html(data).fadeIn().animate({opacity: 1.0}, 3000).fadeOut('slow');
                                              $.fn.yiiGridView.update('menu-grid');
                                        }
                                    })
                                    return false;
                              }
                     ",
                    'options' => array('confirm' => 'Desea renunciar a este cupo?')
                //'options' => array('id' => 'inline')
                ),
            ),
        ),
    ),
));
?>

<?php if ($model->id_estado_fk == Estado::$POSTULACION_PRACTICA_BORRADOR) { ?>
    <div class="form" align="center">
        <div class="row buttons">
            <?php echo CHtml::ajaxSubmitButton('Actualizar Prioridades', array('ajaxUpdatePrioridad', 'act' => 'doSortOrder'), array('success' => 'reloadGrid')); ?>
        </div>
    </div>
<?php } ?>