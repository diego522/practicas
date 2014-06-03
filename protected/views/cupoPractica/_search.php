<?php
/* @var $this CupoPracticaController */
/* @var $model CupoPractica */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_cupo_practica'); ?>
		<?php echo $form->textField($model,'id_cupo_practica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remunerado'); ?>
		<?php echo $form->textField($model,'remunerado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'detalle_remuneracion'); ?>
		<?php echo $form->textField($model,'detalle_remuneracion',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'funcion_a_cumplir'); ?>
		<?php echo $form->textField($model,'funcion_a_cumplir',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'habilidades_requeridas'); ?>
		<?php echo $form->textField($model,'habilidades_requeridas',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'duracion'); ?>
		<?php echo $form->textField($model,'duracion',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'otros_beneficios'); ?>
		<?php echo $form->textField($model,'otros_beneficios',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_empresa_fk'); ?>
		<?php echo $form->textField($model,'id_empresa_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_periodo_practica_fk'); ?>
		<?php echo $form->textField($model,'id_periodo_practica_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_usuario_creador_fk'); ?>
		<?php echo $form->textField($model,'id_usuario_creador_fk'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->