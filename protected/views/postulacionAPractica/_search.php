<?php
/* @var $this PostulacionAPracticaController */
/* @var $model PostulacionAPractica */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_inscripcion_practica'); ?>
		<?php echo $form->textField($model,'id_inscripcion_practica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_alumno'); ?>
		<?php echo $form->textField($model,'id_alumno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_adjunto_fk'); ?>
		<?php echo $form->textField($model,'id_adjunto_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_periodo_practica_fk'); ?>
		<?php echo $form->textField($model,'id_periodo_practica_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estado_fk'); ?>
		<?php echo $form->textField($model,'id_estado_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cumple_con_requisitos_al_inscribir'); ?>
		<?php echo $form->textField($model,'cumple_con_requisitos_al_inscribir'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'observaciones'); ?>
		<?php echo $form->textField($model,'observaciones',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'puntaje_por_notas'); ?>
		<?php echo $form->textField($model,'puntaje_por_notas'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'puntaje_por_curriculum'); ?>
		<?php echo $form->textField($model,'puntaje_por_curriculum'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->