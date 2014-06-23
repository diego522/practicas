

<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="es" />

        <!--/*SCRIPT DE CARRUSEL*/-->

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/js/jquery.roundabout-1.0.min.js"></script> 
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/js/jquery.easing.1.3.js"></script>



        <!--[if IE 6]>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/js/DD_belatedPNG_0.0.8a-min.js"></script>
        <script>
          /* EXAMPLE */
          DD_belatedPNG.fix('.button');
          
          /* string argument can be any CSS selector */
          /* .png_bg example is unnecessary */
          /* change it to what suits you! */
        </script>
        <![endif]--> 
        <!--/*FIN SCRIPT DE CARRUSEL*/-->   

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="http://arrau.chillan.ubiobio.cl/sistemaici/ici/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    </head>
    <body>
        <div id="header"><div id="headercentral">
                <!--<div id="headerlogoubb"></div>-->
                <div id="logo">
                    <span style="font-size:12px; color:#FFF;">Escuela de Ingeniería Civil Informática
                    </span><br />

                    <?php echo CHtml::encode(Yii::app()->name); ?></div></div>
        </div><!-- header -->
        <div id="mainMbMenu" class="barramenu">
            <div class="menujerarquico" >
                <div id="rolheader">
                    <?php
                    if (Yii::app()->user->getState("rol")) {
                        echo '' .
                        CHtml::link(Yii::app()->user->getState('nombre'), array('usuario/view', 'id' => Yii::app()->user->id,));
                        echo " " . Rol::model()->findByPk(Yii::app()->user->getState("rol"))->nombre;
                        if (Yii::app()->user->getState('rol_real') != Yii::app()->user->getState('rol')) {
                            echo CHtml::link(' Volver a mi rol', array('rol/volverRolOriginal',));
                        }
                    }
                    ?>
                </div>
                <?php
                $this->widget('application.extensions.mbmenu.MbMenu', array(
                    'items' => array(
                        array('label' => 'Inicio', 'url' => array('/site/index')),
                        array('label' => 'Postulaciones a Práctica', 'items' => array(
                                array('label' => 'Prácticas Disponibles', 'url' => array('periodoPractica/periodosDisponibles'),),
                                array('label' => 'Mis Postulaciones', 'url' => array('postulacionAPractica/index'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ALUMNO))),
                                // array('label' => 'Proponer Asignación de Prácticas', 'url' => array('postulacionAPractica/asignarPracticas'),),
                                array('label' => 'Administrar Postulaciones', 'url' => array('postulacionAPractica/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                            ), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ALUMNO, Rol::$ADMINISTRADOR))),
                        array('label' => 'Administración', 'items' => array(
                                array('label' => 'Administrar Centros de Práctica', 'url' => array('empresa/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                                array('label' => 'Administrar Periodos Práctica', 'url' => array('periodoPractica/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                                array('label' => 'Administrar Cupos Prácticas', 'url' => array('cupoPractica/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                            // array('label' => 'Cambio de Rol', 'url' => array('rol/cambioRol'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                            // array('label' => 'Planificaciones', 'url' => array('planificacion/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO))),
                            // array('label' => 'Estados', 'url' => array('estado/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO))),
                            //array('label' => 'Roles', 'url' => array('rol/admin'), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO)))
                            ), 'visible' => Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO, Rol::$ADMINISTRADOR))),
                        array('label' => 'Sistema ICI', 'url' => 'http://arrau.chillan.ubiobio.cl/sistemaici', 'visible' => TRUE),
                        array('label' => 'Iniciar Sesión', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Cerrar Sesión', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div>
        </div><!-- mainmenu -->
        <!-- conmtenido -->  
        <div class="container" id="page">          
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?>
                <!-- breadcrumbs -->
            <?php endif ?>
            <?php
            $flashMessages = Yii::app()->user->getFlashes();
            if ($flashMessages) {
                echo '<ul class="flashes">';
                foreach ($flashMessages as $key => $message) {
                    echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
                }
                echo '</ul>';
            }
            ?>


            <?php
            echo $content;
            ?>
            <div class="clear"></div>



        </div><!-- END contenido -->
        <!-- PIE -->
        <div id="pie">
            <div class="piecontenedor">
                <div class="piecaja">
                    <p>Escuela de Ingeniería Civil Informática</p>
                    <p>SEDE CONCEPCIÓN<br />
                        Av. Collao 1202</p>
                    <p>SEDE CHILLÁN<br />
                        Av. Andrés Bello s/n
                    </p>
                </div>
                <div class="piecaja"><!--PIE A -->
                </div>
                <div class="piecaja"><!--PIE B --><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/redes_soc.png" alt="Redes sociales" width="200" height="122" border="0" usemap="#Map" />
                    <map name="Map" id="Map">
                        <area shape="poly" coords="15,39,79,24,97,93,29,109" href="https://www.facebook.com/iciubb" target="_new" alt="Facebook" />
                    </map>
                </div>
                <div class="piecaja"><div id="headerlogoubb"></div>

                </div>

            </div>

        </div><!-- ENDPIE -->
    </body>
</html>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-45320357-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

</script>