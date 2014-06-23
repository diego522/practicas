<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<!--

<div id="barraderecha" style="width:350px; float:right;"> 

    <div id="titulobarraderecha" style="font-weight:bold; color:#F60; text-transform:uppercase; border-bottom:1px dotted #CCC;  padding-bottom:10px; margin-bottom:10px; ">Documentos</div>
    <div id="contenidobarraderecha" style="padding-bottom:10px; margin-bottom:20px;">

        <table>
            <tr>
                <td><?php //echo CHtml::link("<img align='middle' title='Descarga esta vista en DOC' src='" . Yii::app()->request->baseUrl . "/images/doc_icon.png'/>", Yii::app()->request->baseUrl . "/documentacion/Plantilla_Proyecto_Titulo_de_Desarrollo_de_Sw-_v11.doc"); ?></td>
                <td><?php //echo CHtml::link("Plantilla Informe de Actividad de Titulación", Yii::app()->request->baseUrl . "/documentacion/Plantilla_Proyecto_Titulo_de_Desarrollo_de_Sw-_v11.doc"); ?></td>
            </tr>
            <tr>
                <td><?php //echo CHtml::link("<img align='middle' title='Descarga esta vista en PDF' src='" . Yii::app()->request->baseUrl . "/images/pdf_icon.png'/>", Yii::app()->request->baseUrl . "/documentacion/Reglamento_Actividad_de_Titulacion_2007_.pdf"); ?></td>
                <td><?php //echo CHtml::link("Reglamento de Actividad de Titulación", Yii::app()->request->baseUrl . "/documentacion/Reglamento_Actividad_de_Titulacion.pdf"); ?></td>
            </tr>
            <tr>
                <td><?php// echo CHtml::link("<img align='middle' title='Descarga esta vista en DOC' src='" . Yii::app()->request->baseUrl . "/images/doc_icon.png'/>", Yii::app()->request->baseUrl . "/documentacion/Solicitud_Inscripcion_Actividad_de_Titulacion.doc"); ?></td>
                <td><?php// echo CHtml::link("Solicitud de Inscripción Actividad de Titulación", Yii::app()->request->baseUrl . "/documentacion/Solicitud_Inscripcion_Actividad_de_Titulacion.doc"); ?></td>
            </tr>
            <tr>
                <td><?php //echo CHtml::link("<img align='middle' title='Descarga esta vista en DOC' src='" . Yii::app()->request->baseUrl . "/images/doc_icon.png'/>", Yii::app()->request->baseUrl . "/documentacion/Formato_CD_Ing_Civil_Informatica.doc"); ?></td>
                <td><?php //echo CHtml::link("Formato del DVD", Yii::app()->request->baseUrl . "/documentacion/Formato_CD_Ing_Civil_Informatica.doc"); ?></td>
            </tr>
            <tr>
                <td><?php //echo CHtml::link("<img align='middle' title='Descarga esta vista en DOC' src='" . Yii::app()->request->baseUrl . "/images/pdf_icon.png'/>", Yii::app()->request->baseUrl . "/documentacion/Contenido_del_CD.pdf"); ?></td>
                <td><?php //echo CHtml::link("Contenido del DVD", Yii::app()->request->baseUrl . "/documentacion/Contenido_del_CD.pdf"); ?></td>
            </tr>
        </table>
    </div>
</div>
-->
<h2>Noticias</h2>
<?php
$noticias = array();
if (Yii::app()->user->getState('campus') != NULL) {
    $noticias = PeticionesWebService::obtieneNoticias(Yii::app()->user->getState('campus'));
} else {
    $noticias = PeticionesWebService::obtieneNoticias(Null);
}

if (count($noticias) > 0) {
    //mostar noticias
    $contador = 0;
    foreach ($noticias as $not) {
        if ($contador > 3) {
            break;
        }
        ?>

        <div style="width:600px; border:#039; border-bottom:1px dotted #999; display:table; padding-bottom:30px; margin-bottom:40px;">

            <h1>
                <?php echo CHtml::link($not['titulo']); ?>
            </h1>
            <i style="color:#B9B9B9;">
                <?php echo 'Fecha de actualización'; ?>: 
                <?php echo $not['fecha_actualizacion']; ?>
            </i>
            <?php echo $not['contenido']; //echo substr($data->contenido, 0, 200) . '...'; ?>
            <div class="botonsimple">
                <?php //echo CHtml::link(CHtml::encode("Leer"), array('view', 'id' => $data->id_noticia)); ?>
            </div>
        </div>
        <?php
        $contador++;
    }
} else {
    echo "<p>No hay noticias disponibles </p>";
}
?>