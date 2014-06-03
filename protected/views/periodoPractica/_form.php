<?php
/* @var $this PeriodoPracticaController */
/* @var $model PeriodoPractica */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'periodo-practica-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,)
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'nombre'); ?>
        <?php echo $form->textField($model, 'nombre', array('size' => 60, 'maxlength' => 2000)); ?>
        <?php echo $form->error($model, 'nombre'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'fecha_apertura'); ?>
        <?php
        $this->widget(
                'ext.jui.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'fecha_apertura',
            //'language' => 'es', //default Yii::app()->language
            'language' => Yii::app()->language,
            'mode' => 'datetime', //'datetime' or 'time' ('datetime' default)
            'options' => array(
                'dateFormat' => 'dd/mm/yy',
                'timeFormat' => 'hh:mm', //'hh:mm tt' default
            ),
                )
        );
        ?>
        <?php echo $form->error($model, 'fecha_apertura'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'fecha_cierre'); ?>
        <?php
        $this->widget(
                'ext.jui.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'fecha_cierre',
            'language' => Yii::app()->language,
            'mode' => 'datetime', //'datetime' or 'time' ('datetime' default)
            'options' => array(
                'dateFormat' => 'dd/mm/yy',
                'timeFormat' => 'hh:mm', //'hh:mm tt' default
            ),
                )
        );
        ?>
        <?php echo $form->error($model, 'fecha_cierre'); ?>
    </div>

    <?php if (!$model->isNewRecord) { ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'id_estado_fk'); ?>
            <?php echo $form->dropDownList($model, 'id_estado_fk', CHtml::listData(Estado::model()->findAll('id_tipo_estado_fk=' . TipoEstado::$PPERIODO_PRACTICA), 'id_estado', 'nombre'), array('empty' => "Seleccione")); ?> 
            <?php echo $form->error($model, 'id_estado_fk'); ?>
        </div>

    <?php } ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'id_tipo_practica_fk'); ?>
        <?php echo $form->dropDownList($model, 'id_tipo_practica_fk', CHtml::listData(TipoPractica::model()->findAll(), 'id_tipo_practica', 'nombre'), array('empty' => "Seleccione")); ?> 
        <?php echo $form->error($model, 'id_tipo_practica_fk'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'fecha_entrega_formulario_prac'); ?>
        <?php
        $this->widget(
                'ext.jui.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'fecha_entrega_formulario_prac',
            'language' => Yii::app()->language,
            'mode' => 'datetime', //'datetime' or 'time' ('datetime' default)
            'options' => array(
                'dateFormat' => 'dd/mm/yy',
                'timeFormat' => 'hh:mm', //'hh:mm tt' default
            ),
                )
        );
        ?>
        <?php echo $form->error($model, 'fecha_entrega_formulario_prac'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar Cambios'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<?php
Yii::app()->clientScript->registerScript('frDatepicker.js', "
$(document).ready(function(){
        $.datepicker.regional['fr']={
                closeText:'Fermer',prevText:'Précédent',nextText:'Suivant',currentText:'Aujourd\'hui',
                 monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
                'Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
                dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
                weekHeader:'Sem.',dateFormat:'dd/mm/yy',firstDay:1,isRTL:false,
                showMonthAfterYear:false,yearSuffix:''};
        $.datepicker.setDefaults($.datepicker.regional['fr']);
});
", CClientScript::POS_READY);
?>