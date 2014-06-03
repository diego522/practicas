<?php
/* @var $this PeriodoPracticaController */
/* @var $model PeriodoPractica */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_periodo_practica'); ?>
		<?php echo $form->textField($model,'id_periodo_practica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_apertura'); ?>
		<?php echo $form->textField($model,'fecha_apertura'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_cierre'); ?>
		<?php echo $form->textField($model,'fecha_cierre'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'campus'); ?>
		<?php echo $form->textField($model,'campus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estado_fk'); ?>
		<?php echo $form->textField($model,'id_estado_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tipo_practica_fk'); ?>
		<?php echo $form->textField($model,'id_tipo_practica_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_entrega_formulario_prac'); ?>
		<?php echo $form->textField($model,'fecha_entrega_formulario_prac'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->