<?php
/* @var $this PostulacionAPracticaController */
/* @var $model PostulacionAPractica */

$this->breadcrumbs = array(
    'Postulaciones a prácticas' => array('admin'),
    'Asignación de prácticas',
);

//$this->menu = array(
//    array('label' => 'List PostulacionAPractica', 'url' => array('index')),
//    array('label' => 'Create PostulacionAPractica', 'url' => array('create')),
//);
?>
<h1>Administrar Postulaciones a Prácticas</h1>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'postulacion-apractica-form',
        'enableAjaxValidation' => false,
    ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'Seleccione Periodo'); ?>
        <?php echo $form->dropDownList($model, 'id_periodo_practica_fk', CHtml::listData(PeriodoPractica::model()->findAll('id_campus_fk=' . Yii::app()->user->getState('campus')), 'id_periodo_practica', 'nombre_mas_estado'), array('empty' => "Seleccione")); ?>
        <?php echo $form->error($model, 'id_periodo_practica_fk'); ?>
    </div>
    <div class="row buttons">
        <?php
        echo CHtml::button('Asignar Prácticas', array('submit' => array('asignarPracticas'),
            'confirm' => 'Esta acción verificará que todas las postulaciones enviadas del periodo seleccionado se encuentren evaluadas. Desea continuar?')
        );
        ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->



