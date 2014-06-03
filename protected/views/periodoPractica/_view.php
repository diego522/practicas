<?php
/* @var $this PeriodoPracticaController */
/* @var $data PeriodoPractica */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_periodo_practica')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_periodo_practica), array('view', 'id'=>$data->id_periodo_practica)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_apertura')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_apertura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_cierre')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_cierre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('campus')); ?>:</b>
	<?php echo CHtml::encode($data->campus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estado_fk')); ?>:</b>
	<?php echo CHtml::encode($data->id_estado_fk); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_practica_fk')); ?>:</b>
	<?php echo CHtml::encode($data->id_tipo_practica_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_entrega_formulario_prac')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_entrega_formulario_prac); ?>
	<br />

	*/ ?>

</div>