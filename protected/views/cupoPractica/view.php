<?php
/* @var $this CupoPracticaController */
/* @var $model CupoPractica */

$this->breadcrumbs = array(
    'Cupo Practicas' => array('admin'),
    'Cupo',
);

$this->menu = array(
    //array('label'=>'List CupoPractica', 'url'=>array('index')),
    // array('label' => 'Create CupoPractica', 'url' => array('create')),
    array('label' => 'Modificar CupoPractica', 'url' => array('update', 'id' => $model->id_cupo_practica)),
    // array('label' => 'Delete CupoPractica', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_cupo_practica), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Administar CupoPractica', 'url' => array('admin')),
);
?>

<h1>Detalle del Cupo en Centro de Práctica </h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id_cupo_practica',
        array('name' => 'id_empresa_fk', 'value' => $model->idEmpresaFk->nombre_mas_ciudad),
        array('name' => 'id_periodo_practica_fk', 'value' => $model->idPeriodoPracticaFk->nombre_mas_estado),
        //'id_usuario_creador_fk',
        'cantidad',
        array(
            'name' => 'remunerado',
            'value' => $model->remunerado == 1 ? 'SI' : 'NO',
        ),
        array(
            'name' => 'detalle_remuneracion',
            'type' => 'raw',
            'visible' => $model->remunerado == 1 ? true : false,
        ),
        array(
            'name' => 'funcion_a_cumplir',
            'type' => 'raw'
        ),
        array(
            'name' => 'habilidades_requeridas',
            'type' => 'raw'
        ),
        array(
            'name' => 'duracion',
            'type' => 'raw'
        ),
        array(
            'name' => 'otros_beneficios',
            'type' => 'raw'
        ),
    ),
));
?>
