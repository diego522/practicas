<?php
/* @var $this PostulacionAPracticaController */
/* @var $model PostulacionAPractica */
/* @var $modelInscripcionCupo InscripcionCupoPractica */

$this->breadcrumbs = array(
    'Selección de la postulación' => array('index'),
    "Detalle de la postulación",
);
//
//$this->menu=array(
//	//array('label'=>'List PostulacionAPractica', 'url'=>array('index')),
//	//array('label'=>'Create PostulacionAPractica', 'url'=>array('create')),
//	//array('label'=>'Update PostulacionAPractica', 'url'=>array('update', 'id'=>$model->id_inscripcion_practica)),
//	array('label'=>'Delete PostulacionAPractica', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_inscripcion_practica),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage PostulacionAPractica', 'url'=>array('admin')),
//);
?>

<h1>Detalles de la postulación a práctica profesional</h1>

<div id='AjFlash' class="flash-success" style="display:none"></div>

<?php
$form = $this->beginWidget('CActiveForm', array(
    //'enableAjaxValidation' => true,
    'id' => 'formCurriculum',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<?php
$this->widget('CTabView', array(
    'tabs' => array(
        'tab1' => array(
            'title' => 'Detalles',
            'view' => 'viewTab/viewDetalle',
            'data' => array('model' => $model, 'modelInscripcionCupo' => $modelInscripcionCupo, 'form' => $form),
        ),
        'tab2' => array(
            'title' => 'Curriculum',
            'view' => 'viewTab/viewCurriculum',
            'data' => array('model' => $model, 'modelInscripcionCupo' => $modelInscripcionCupo, 'form' => $form),
        ),
    ),
));
?>
<script>
    function reloadGrid(data) {
        $.fn.yiiGridView.update('menu-grid');
        $('#AjFlash').html(data).fadeIn().animate({opacity: 1.0}, 5000).fadeOut('slow');
        $('html,body').animate({scrollTop: 0}, 'slow', function() {

        });
    }
</script>
<script>
    function reloadFlash(data) {
        $('#AjFlash').html(data).fadeIn().animate({opacity: 1.0}, 5000).fadeOut('slow');
        $('html,body').animate({scrollTop: 0}, 'slow', function() {
             
        });
        location.reload();
    }
</script>
<?php $this->endWidget(); ?>
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a#inline',
    'config' => array(
        'scrolling' => 'no',
        'titleShow' => false,
    // 'onComplete' => 'function(){tinyMCE_setup();}',
    ),
        )
);
?>