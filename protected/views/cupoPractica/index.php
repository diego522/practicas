<?php
/* @var $this CupoPracticaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cupo Practicas',
);

$this->menu=array(
	array('label'=>'Create CupoPractica', 'url'=>array('create')),
	array('label'=>'Manage CupoPractica', 'url'=>array('admin')),
);
?>

<h1>Cupo Practicas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
