<?php
/* @var $this PostulacionAPracticaController */
/* @var $data PostulacionAPractica */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_inscripcion_practica')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_inscripcion_practica), array('view', 'id'=>$data->id_inscripcion_practica)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_alumno')); ?>:</b>
	<?php echo CHtml::encode($data->id_alumno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_adjunto_fk')); ?>:</b>
	<?php echo CHtml::encode($data->id_adjunto_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_periodo_practica_fk')); ?>:</b>
	<?php echo CHtml::encode($data->id_periodo_practica_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estado_fk')); ?>:</b>
	<?php echo CHtml::encode($data->id_estado_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cumple_con_requisitos_al_inscribir')); ?>:</b>
	<?php echo CHtml::encode($data->cumple_con_requisitos_al_inscribir); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('puntaje_por_notas')); ?>:</b>
	<?php echo CHtml::encode($data->puntaje_por_notas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('puntaje_por_curriculum')); ?>:</b>
	<?php echo CHtml::encode($data->puntaje_por_curriculum); ?>
	<br />

	*/ ?>

</div>