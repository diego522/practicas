<?php
/* @var $this ContactoEmpresaController */
/* @var $model ContactoEmpresa */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'contacto-empresa-form',
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
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'telefono'); ?>
        <?php echo $form->textField($model, 'telefono', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'telefono'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'celular'); ?>
        <?php echo $form->textField($model, 'celular', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'celular'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'unidad'); ?>
        <?php echo $form->textField($model, 'unidad', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'unidad'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'cargo'); ?>
        <?php echo $form->textField($model, 'cargo', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'cargo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'contacto_principal'); ?>
        <?php echo $form->checkBox($model, 'contacto_principal', array('value' => 1, 'uncheckValue' => 0/* , 'checked' => ($model->contacto_principal == "") ? true : $model->contacto_principal */)); ?>
        <?php echo $form->error($model, 'contacto_principal'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar Cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->