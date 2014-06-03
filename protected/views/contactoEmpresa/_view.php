<?php
/* @var $this ContactoEmpresaController */
/* @var $data ContactoEmpresa */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_contacto_empresa')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_contacto_empresa), array('view', 'id'=>$data->id_contacto_empresa)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b>
	<?php echo CHtml::encode($data->telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('celular')); ?>:</b>
	<?php echo CHtml::encode($data->celular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unidad')); ?>:</b>
	<?php echo CHtml::encode($data->unidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cargo')); ?>:</b>
	<?php echo CHtml::encode($data->cargo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('contacto_principal')); ?>:</b>
	<?php echo CHtml::encode($data->contacto_principal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_empresa_fk')); ?>:</b>
	<?php echo CHtml::encode($data->id_empresa_fk); ?>
	<br />

	*/ ?>

</div>