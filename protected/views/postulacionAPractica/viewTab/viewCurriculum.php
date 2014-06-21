
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
                
            </td>
        </tr>
    </table>
</div>