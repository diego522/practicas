<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'empresa-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'nombre'); ?>
        <?php echo $form->textField($model, 'nombre', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'nombre'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'direccion'); ?>
        <?php echo $form->textField($model, 'direccion', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'direccion'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'web'); ?>
        <?php echo $form->textField($model, 'web', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'web'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'id_cuidad_fk'); ?>
        <?php echo $form->dropDownList($model, 'id_cuidad_fk', CHtml::listData(Comuna::model()->findAll(' 1=1 order by COMUNA_NOMBRE'), 'COMUNA_ID', 'COMUNA_NOMBRE'), array('empty' => "Seleccione")); ?> 
        <?php echo $form->error($model, 'id_cuidad_fk'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar Cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->