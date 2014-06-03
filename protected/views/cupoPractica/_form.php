<?php
/* @var $this CupoPracticaController */
/* @var $model CupoPractica */
/* @var $form CActiveForm */
?>
<script>
    tinymce.init({selector: 'textarea', language: 'es',
        plugins: "paste textcolor table",
        tools: "inserttable"
    });
</script>
<div class="form">

    <?php
    Yii::app()->clientScript->registerScriptFile(
            Yii::app()->baseUrl . '/js/tinymce/tinymce.min.js'
    );
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'cupo-practica-form',
//        'enableClientValidation' => true,
//        'clientOptions' => array(
//            'validateOnSubmit' => true,
//        ),
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'id_periodo_practica_fk'); ?>
        <?php echo $form->dropDownList($model, 'id_periodo_practica_fk', CHtml::listData(PeriodoPractica::model()->findAll('id_campus_fk=:idc', array(':idc' => Yii::app()->user->getState('campus'))), 'id_periodo_practica', 'nombre_mas_estado'), array('empty' => "Seleccione")); ?> 
        <?php echo $form->error($model, 'id_periodo_practica_fk'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'id_empresa_fk'); ?>
        <?php echo $form->dropDownList($model, 'id_empresa_fk', CHtml::listData(Empresa::model()->findAll('campus=:idc', array(':idc' => Yii::app()->user->getState('campus'))), 'id_empresa', 'nombre_mas_ciudad'), array('empty' => "Seleccione")); ?> 

        <?php echo $form->error($model, 'id_empresa_fk'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'cantidad'); ?>
        <?php echo $form->textField($model, 'cantidad'); ?>
        <?php echo $form->error($model, 'cantidad'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'remunerado'); ?>
        <?php
        echo CHtml::activeDropDownList($model, 'remunerado', array(
            '1' => 'No',
            '2' => 'Si',
        ));
        ?>
        <?php echo $form->error($model, 'remunerado'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'detalle_remuneracion'); ?>
        <?php echo $form->textArea($model, 'detalle_remuneracion', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'detalle_remuneracion'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'funcion_a_cumplir'); ?>
        <?php echo $form->textArea($model, 'funcion_a_cumplir', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'funcion_a_cumplir'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'habilidades_requeridas'); ?>
        <?php echo $form->textArea($model, 'habilidades_requeridas', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'habilidades_requeridas'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'duracion'); ?>
        <?php echo $form->textArea($model, 'duracion', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'duracion'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'otros_beneficios'); ?>
        <?php echo $form->textArea($model, 'otros_beneficios', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'otros_beneficios'); ?>
    </div>   

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar Cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
