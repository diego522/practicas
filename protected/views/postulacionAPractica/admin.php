<?php
/* @var $this PostulacionAPracticaController */
/* @var $model PostulacionAPractica */

$this->breadcrumbs = array(
    'Postulaciones a prácticas' => array('admin'),
    'Administrar Postulaciones',
);

//$this->menu = array(
//    array('label' => 'List PostulacionAPractica', 'url' => array('index')),
//    array('label' => 'Create PostulacionAPractica', 'url' => array('create')),
//);
?>

<h1>Administrar Postulaciones a Practicas</h1>

<?php
$this->widget('CTabView', array(
    'tabs' => array(
        'tab1' => array(
            'title' => 'Administrar',
            'view' => 'viewTabAdministrarPostulaciones/admin',
            'data' => array('model' => $model),
            
        ),
        'tab2' => array(
            'title' => 'Proponer Asignación de prácticas',
            'view' => 'viewTabAdministrarPostulaciones/asignacionDePracticas',
            'data' => array('model' => $model,),
        ),
    
    ),
    
));
?>
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