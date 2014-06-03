<?php
/* @var $this CupoPracticaController */
/* @var $data CupoPractica */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cupo_practica')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_cupo_practica), array('view', 'id'=>$data->id_cupo_practica)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remunerado')); ?>:</b>
	<?php echo CHtml::encode($data->remunerado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detalle_remuneracion')); ?>:</b>
	<?php echo CHtml::encode($data->detalle_remuneracion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('funcion_a_cumplir')); ?>:</b>
	<?php echo CHtml::encode($data->funcion_a_cumplir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('habilidades_requeridas')); ?>:</b>
	<?php echo CHtml::encode($data->habilidades_requeridas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duracion')); ?>:</b>
	<?php echo CHtml::encode($data->duracion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('otros_beneficios')); ?>:</b>
	<?php echo CHtml::encode($data->otros_beneficios); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_empresa_fk')); ?>:</b>
	<?php echo CHtml::encode($data->id_empresa_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_periodo_practica_fk')); ?>:</b>
	<?php echo CHtml::encode($data->id_periodo_practica_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario_creador_fk')); ?>:</b>
	<?php echo CHtml::encode($data->id_usuario_creador_fk); ?>
	<br />

	*/ ?>

</div>