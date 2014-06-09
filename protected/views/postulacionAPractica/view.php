<?php
/* @var $this PostulacionAPracticaController */
/* @var $model PostulacionAPractica */
/* @var $modelInscripcionCupo InscripcionCupoPractica */

$this->breadcrumbs = array(
    'Postulacion Apracticas' => array('index'),
    "Detalle",
);
//
//$this->menu=array(
//	//array('label'=>'List PostulacionAPractica', 'url'=>array('index')),
//	//array('label'=>'Create PostulacionAPractica', 'url'=>array('create')),
//	//array('label'=>'Update PostulacionAPractica', 'url'=>array('update', 'id'=>$model->id_inscripcion_practica)),
//	array('label'=>'Delete PostulacionAPractica', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_inscripcion_practica),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage PostulacionAPractica', 'url'=>array('admin')),
//);
?>

<h1>Detalles de la postulación</h1>

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


    <?php
    $form = $this->beginWidget('CActiveForm', array(
        //'enableAjaxValidation' => true,
        'id' => 'formCurriculum',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
    <div id='AjFlash' class="flash-success" style="display:none"></div>
    <div class="form" >
        <table>
            <tr>
                <td width="350px">
                    <div class="row">
                        <?php echo $form->labelEx($model, 'Curriculum'); ?>
                        <?php if ($model->id_estado_fk == Estado::$POSTULACION_PRACTICA_BORRADOR) { ?>
                            <?php echo $form->fileField($model, 'id_adjunto_fk'); ?> 
                        <?php } ?>
                        <?php echo $form->error($model, 'id_adjunto_fk'); ?></div>
                </td>
                <td width="90px"><div id="link_descarga"><?php
                        if (isset($model->id_adjunto_fk)) {
                            echo CHtml::link('Descargar', array('download', 'id' => $model->id_adjunto_fk,));
                        }
                        ?></div></td>
                <td>
                    <?php if ($model->id_estado_fk == Estado::$POSTULACION_PRACTICA_BORRADOR) { ?>
                        <div class="row buttons">
                            <?php
//                    echo CHtml::ajaxSubmitButton('Subir Curriculum', CHtml::normalizeUrl(array('postulacionAPractica/subirAdjunto', 'id' => $model->id_inscripcion_practica)), array(
//                        'data' => 'js:$("#formCurriculum").serialize()',
//                        'type'=>'POST',
//                        'success' => 'function(data){
//                          $("#link_descarga").html(data);
//                   }'));
                            echo CHtml::button('Subir Curriculum', array('submit' => array('postulacionAPractica/subirAdjunto', 'id' => $model->id_inscripcion_practica)));
                            ?>
                        </div>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>
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
                </td>
            </tr>
        </table>
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
<script>
    function reloadGrid(data) {
        $.fn.yiiGridView.update('menu-grid');
        $('#AjFlash').html(data).fadeIn().animate({opacity: 1.0}, 5000).fadeOut('slow');
    }
</script>
<script>
    function reloadFlash(data) {
        $('#AjFlash').html(data).fadeIn().animate({opacity: 1.0}, 5000).fadeOut('slow');
    }
</script>
<?php if ($model->id_estado_fk == Estado::$POSTULACION_PRACTICA_BORRADOR) { ?>
<div class="form" align="center">
    <div class="row buttons">
        <?php echo CHtml::ajaxSubmitButton('Actualizar Prioridades', array('ajaxUpdatePrioridad', 'act' => 'doSortOrder'), array('success' => 'reloadGrid')); ?>
    </div>
</div>
<?php }?>
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