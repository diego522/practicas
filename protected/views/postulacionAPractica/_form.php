<?php
/* @var $this PostulacionAPracticaController */
/* @var $model PostulacionAPractica */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'postulacion-apractica-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,)
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>


    <div class="row">
        <?php echo $form->labelEx($model, 'puntaje_por_notas'); ?>
        <?php echo $form->textField($model, 'puntaje_por_notas'); ?>
        <?php echo $form->error($model, 'puntaje_por_notas'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'puntaje_por_curriculum'); ?>
        <?php echo $form->textField($model, 'puntaje_por_curriculum'); ?>
        <?php echo $form->error($model, 'puntaje_por_curriculum'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar Cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->