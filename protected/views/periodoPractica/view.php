<?php
/* @var $this PeriodoPracticaController */
/* @var $model PeriodoPractica */

$this->breadcrumbs = array(
    'Periodo Practicas' => array('index'),
    $model->id_periodo_practica,
);

$this->menu = array(
    array('label' => 'List PeriodoPractica', 'url' => array('index')),
    array('label' => 'Create PeriodoPractica', 'url' => array('create')),
    array('label' => 'Update PeriodoPractica', 'url' => array('update', 'id' => $model->id_periodo_practica)),
    array('label' => 'Delete PeriodoPractica', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_periodo_practica), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage PeriodoPractica', 'url' => array('admin')),
);
?>

<h1>Detalle Periodo de Práctica </h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id_periodo_practica',
        'nombre',
        array('name' => 'id_tipo_practica_fk', 'value' => $model->idTipoPracticaFk->nombre),
        //'fecha_creacion',
        'fecha_apertura',
        'fecha_cierre',
        'fecha_entrega_formulario_prac',
        //'campus',
        array('name' => 'id_estado_fk', 'value' => $model->idEstadoFk->nombre),
    ),
));
?>
