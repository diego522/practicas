<?php

class PostulacionAPracticaController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'inscribirCupo', 'ajaxUpdatePrioridad', 'eliminaCupoInscrito', 'subirAdjunto', 'Download', 'enviarPostulacion'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$ALUMNO, Rol::$SUPER_USUARIO),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'Evaluar', 'asignarPracticas'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$ALUMNO, Rol::$SUPER_USUARIO),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$ALUMNO, Rol::$SUPER_USUARIO),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionSubirAdjunto($id) {
        $model = $this->loadModel($id);
        // var_dump($model);
        if (isset($_POST['PostulacionAPractica']) && $model != NULL) {
            if ($model->id_estado_fk == Estado::$POSTULACION_PRACTICA_BORRADOR) {
                $model->attributes = $_POST['PostulacionAPractica'];
                $this->actionUploadFile($model);
                if (isset($model->id_adjunto_fk)) {
                    Yii::app()->user->setFlash('success', "Archivo Subido con Éxito.");
                }
                $this->redirect(array('view', 'id' => $model->id_inscripcion_practica));
            } else {
                Yii::app()->user->setFlash('error', "La postulación debe encontrarse en estado Borrador para ser modiicada.");
                $this->redirect(array('view', 'id' => $model->id_inscripcion_practica));
            }
        }
    }

    public function actionAsignarPracticas() {
        $model = new PostulacionAPractica();
        //var_dump($_POST['PostulacionAPractica']);
        //echo isset($_POST['PostulacionAPractica']); 
        if (isset($_POST['PostulacionAPractica'])) {
            $model->attributes = $_POST['PostulacionAPractica'];
            $contadorDeAsignados = 0;
            $contadorDeQuedaronSinCupo = 0;
            if (isset($model->id_periodo_practica_fk)) {
                $listaPostulaciones = PostulacionAPractica::model()->findAll('id_periodo_practica_fk=:idp order by promedio DESC', array(':idp' => $model->id_periodo_practica_fk));
                $contador = 0;
                foreach ($listaPostulaciones as $l) {
                    if ($l->filtro_evaluacion == 1) {//evaluación hecha
                        $contador++;
                    }
                }
              //  echo " contador_evaluaciones "+$contador;
                if ($contador == count($listaPostulaciones)) {//todas las postulaciones evaluadas
                //    echo " if_true ";
                    foreach ($listaPostulaciones as $l) {//recorrer todas las postulaciones
                        //traer cada una de las inscripciones en cada postulacion
                        //echo " foreach_postulaciones ";
                        if ($l->id_estado_fk == Estado::$POSTULACION_PRACTICA_ENVIADA) {
                         //   echo " if_true_postulacion_enviada ";
                            $listaInscripciones = InscripcionCupoPractica::model()->findAll('id_postulacion_practica_fk=:id order by prioridad ASC', array(':id' => $l->id_inscripcion_practica));
                            $cupoAsignado = FALSE;
                            foreach ($listaInscripciones as $i) {
                           //     echo " foreach_inscrpciones ";
                                //Por cada inscripcion ver si es posible asignarla
                                $contadorAsignadosPrevios = 0;
                                foreach ($i->idCupoPracticaFk->inscripcionCupoPracticas as $ic) {
                                    if ($ic->id_estado_fk == Estado::$POSTULACION_CUPO_PENDIENTE_DE_CONFIRMACION || $ic->id_estado_fk == Estado::$POSTULACION_CUPO_ASIGNADO) {
                                        $contadorAsignadosPrevios++;
                                    }
                                }
                             //   echo "contador "+$contadorAsignadosPrevios;
                              //  echo " cantidad "+$i->idCupoPracticaFk->cantidad;
                                if ($contadorAsignadosPrevios < $i->idCupoPracticaFk->cantidad) {
                                    //hay cupos dosponibles se asigna el cupo 
                                    $i->id_estado_fk = Estado::$POSTULACION_CUPO_PENDIENTE_DE_CONFIRMACION;
                                    $l->id_estado_fk = Estado::$POSTULACION_PRACTICA_ESPERANDO_CONFIRMACION;
                                    if ($i->save()) {
                                        if ($l->save()) {
                                            $cupoAsignado = TRUE;
                                            $correos = array();
                                            $contadorDeAsignados++;
                                            //$correos[] = PeticionesWebService::obtieneCorreoJefe(Yii::app()->user->getState('campus'));
                                            // $correos[] = PeticionesWebService::obtieneCorreoSecretaria(Yii::app()->user->getState('campus'));
                                            $correos[] = $l->idAlumno->email;
                                            //email para profesor guia
                                            $this->SendMail('Asignación de Cupo Para Práctica Profesional', '
                                       Estimado(a) ' . $l->idAlumno->nombre . ', este correo le notifica sobre PRE-ASIGNACIÓN del cupo para práctica profesional'
                                                    . ' en ' . $i->idCupoPracticaFk->idEmpresaFk->nombre_mas_ciudad . '. Para confirmar la asignación se ruega entrar al sistema.'
                                                    , $correos);
                                            //Yii::app()->user->setFlash('success', "Proyecto Notificado con éxito.");
                                        }
                                    }
                                    //ropme el ciclo para ir a la siguiente asignacion
                                    break;
                                }
                            }
                            if ($cupoAsignado == FALSE) {
                                $l->id_estado_fk = Estado::$POSTULACION_PRACTICA_RECHAZADA_POR_FALTA_DE_CUPOS;
                                $contadorDeQuedaronSinCupo++;
                                if ($l->save()) {
                                    $correos = array();
                                    $contadorDeAsignados++;
                                    //$correos[] = PeticionesWebService::obtieneCorreoJefe(Yii::app()->user->getState('campus'));
                                    // $correos[] = PeticionesWebService::obtieneCorreoSecretaria(Yii::app()->user->getState('campus'));
                                    $correos[] = $l->idAlumno->email;
                                    //email para profesor guia
                                    $this->SendMail('Rechazo de Cupo Para Práctica Profesional', '
                                       Estimado(a) ' . $l->idAlumno->nombre . ', este correo le notifica que no ha sido posible asignarle práctica profesional '
                                            . 'a ninguna de sus postulaciones.'
                                            , $correos);
                                }
                            }
                        }
                    }
                    Yii::app()->user->setFlash('success', "Se han asignado " . $contadorDeAsignados . " prácticas y han sido rechadas " . $contadorDeQuedaronSinCupo . " por falta de cupos.");
                } else {//faltan evaluaciones por hacer
                    Yii::app()->user->setFlash('error', "Faltan postulaciones por evaluar");
                }
            } else {
                Yii::app()->user->setFlash('error', "Debe seleccionar un periodo");
            }
        } else {
            Yii::app()->user->setFlash('error', "Debe seleccionar un periodo");
        }
        $model->scenario = 'search';
//        $this->render('admin', array(
         //   'model' => $model,
       // ));
    }

    /**
     * 
     * @param PostulacionAPractica $model
     */
    public function actionUploadFile($model) {
        $uploadedFileBN = CUploadedFile::getInstance($model, 'id_adjunto_fk');
        if ($uploadedFileBN != NULL) {
            if (in_array($uploadedFileBN->extensionName, Adjunto::$formatos_acepotados)) {
                $nombre = str_replace(" ", "_", "curr_" . $model->id_inscripcion_practica . "_" . "{$uploadedFileBN}");
                $rutaCarpeta = Yii::app()->basePath . Yii::app()->params['ruta_adjunto'] . Yii::app()->params['ruta_curriculum'];
                if (!is_dir($rutaCarpeta)) {
                    mkdir($rutaCarpeta, 0777, true);
                }
                $rutaArchivo = $rutaCarpeta . "/" . $nombre;
                if ($uploadedFileBN->saveAs($rutaArchivo)) {
                    $adjuntoModel = new Adjunto;
                    $adjuntoModel->ruta = $rutaArchivo;
                    $adjuntoModel->filecontenttype = $uploadedFileBN->getType();
                    $adjuntoModel->filename = $nombre;
                    $adjuntoModel->creador = Yii::app()->user->id;
                    $adjuntoModel->save();
                    $model->id_adjunto_fk = $adjuntoModel->id_adjunto;
                    $model->save();
                } else {
                    Yii::app()->user->setFlash('error', "Error el archivo no puede ser guardado");
                }
            } else {
                Yii::app()->user->setFlash('error', "Solo extensiones " . implode(',', Adjunto::$formatos_acepotados) . " son permitidos");
            }
        } else {
            //return "Instanacia Nula";
        }
    }

    public function actionDownload($id) {
        $adjuntoModel = Adjunto::model()->findByPk($id);
        if ($adjuntoModel != null)
            Yii::app()->request->sendFile($adjuntoModel->filename, file_get_contents($adjuntoModel->ruta), $adjuntoModel->filecontenttype);

        //$this->actionView($id);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->layout = '//layouts/column1';
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'modelInscripcionCupo' => new InscripcionCupoPractica('search'),
        ));
    }

    public function actionEliminaCupoInscrito($idc, $idp) {
        $model = $this->loadModel($idp);
        if ($model->id_estado_fk == Estado::$POSTULACION_PRACTICA_BORRADOR) {
            $cupoInscrito = InscripcionCupoPractica::model()->findByPk($idc);
            if ($cupoInscrito != null) {
                if ($cupoInscrito->idPostulacionPracticaFk->id_alumno == Yii::app()->user->id) {
                    $cupoInscrito->delete();
                    echo "Eliminación Correcta";
                }
            }
        } else {
            echo "La postulación debe encontrarse en estado Borrador para ser modificada.";
        }
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionEnviarPostulacion($id) {
        $model = $this->loadModel($id);
        if ($model->id_estado_fk == Estado::$POSTULACION_PRACTICA_BORRADOR) {
            $model->id_estado_fk = Estado::$POSTULACION_PRACTICA_ENVIADA;
            $model->save();
            echo "Postulación Enviada";
        } else {
            echo "La postulación no puede ser enviada porque no se encuentra en estado Borrador";
        }
    }

    public function actionInscribirCupo($idc) {
        $idcA = explode("-", $idc);
        foreach ($idcA as $idCupo) {
            $cupo = CupoPractica::model()->findByPk($idCupo);
            $idu = Yii::app()->user->id;
            $postulacion = PostulacionAPractica::model()->find('id_alumno=:ida and id_periodo_practica_fk=:idp', array(':ida' => $idu, ':idp' => $cupo->id_periodo_practica_fk));
            if ($postulacion == NULL) {
                //nueva postulación
                $postulacion = new PostulacionAPractica();
                $postulacion->id_alumno = $idu;
                $postulacion->id_periodo_practica_fk = $cupo->id_periodo_practica_fk;
                $postulacion->id_estado_fk = Estado::$POSTULACION_PRACTICA_BORRADOR;
                if ($postulacion->save()) {
                    //es el primer cupo que inscribe, por defecto se le asignara de manera automática el cupo
                    $inscripcion = new InscripcionCupoPractica();
                    $inscripcion->id_cupo_practica_fk = $cupo->id_cupo_practica;
                    //se pasa la id de la postulacion
                    $inscripcion->id_postulacion_practica_fk = $postulacion->id_inscripcion_practica;
                    $inscripcion->id_estado_fk = Estado::$POSTULACION_CUPO_INSCRITO;
                    $inscripcion->prioridad = 1;
                    if ($inscripcion->save()) {
                        Yii::app()->user->setFlash('success', 'Postulación creada correctamente');
                        // $this->redirect(array('view', 'id' => $postulacion->id_inscripcion_practica));
                    } else {
                        throw new CHttpException(500, 'El cupo no pudo ser guardado.');
                    }
                } else {
                    //no se pudo guardar la postulación
                    throw new CHttpException(500, 'La postulación no pudo ser guardada.');
                }
            } else {
                //posee postulación anterior para el periodo seleccionado
                $inscripcionPrevia = InscripcionCupoPractica::model()->find('id_postulacion_practica_fk=:ipp and id_cupo_practica_fk=:icp', array(':ipp' => $postulacion->id_inscripcion_practica, ':icp' => $cupo->id_cupo_practica));
                if ($inscripcionPrevia == null) {
                    $inscripcion = new InscripcionCupoPractica();
                    $inscripcion->id_cupo_practica_fk = $cupo->id_cupo_practica;
                    //se pasa la id de la postulacion
                    $inscripcion->id_postulacion_practica_fk = $postulacion->id_inscripcion_practica;
                    $inscripcion->id_estado_fk = Estado::$POSTULACION_CUPO_INSCRITO;
                    //calculo de la siguiente prioridad
                    $max = 1;
                    foreach ($postulacion->inscripcionCupoPracticas as $i) {
                        if ($i->prioridad >= $max) {
                            $max = $i->prioridad;
                        }
                    }
                    $inscripcion->prioridad = ++$max;
                    if ($inscripcion->save()) {
                        Yii::app()->user->setFlash('success', 'Cupo inscrito correctamente');
                        // $this->redirect(array('view', 'id' => $postulacion->id_inscripcion_practica));
                    } else {
                        // throw new CHttpException(500, 'El cupo no pudo ser guardado.');
                    }
                } else {
                    Yii::app()->user->setFlash('error', 'Ya se había postulado a este cupo');
                }
            }
        }
        $this->redirect(array('view', 'id' => $postulacion->id_inscripcion_practica));
    }

    public function actionAjaxUpdatePrioridad() {
        $puedeActualizar = true;
        $act = $_GET['act'];
        if ($act == 'doSortOrder') {
            $sortOrderAll = $_POST['cupoInscrito'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $menuId => $sortOrder) {
                    $model = InscripcionCupoPractica::model()->findByPk($menuId);
                    if ($model != NULL && $model->idPostulacionPracticaFk->id_estado_fk == Estado::$POSTULACION_PRACTICA_BORRADOR) {
                        $model->prioridad = $sortOrder;
                        $model->save();
                    } else {
                        echo "La postulación debe encontrarse en estado Borrador para ser modificada.";
                        $puedeActualizar = false;
                        break;
                    }
                }
                if ($puedeActualizar) {
                    echo "Prioridades Actualizadas";
                }
            }
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new PostulacionAPractica;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['PostulacionAPractica'])) {
            $model->attributes = $_POST['PostulacionAPractica'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id_inscripcion_practica));
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionEvaluar($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['PostulacionAPractica'])) {
            $model->attributes = $_POST['PostulacionAPractica'];
            if ($model->puntaje_por_curriculum != 0 && $model->puntaje_por_notas) {
                $model->filtro_evaluacion = 1; //evaluacion hecha
                $model->promedio = round((($model->puntaje_por_curriculum + $model->puntaje_por_notas) / 2), 2, PHP_ROUND_HALF_UP);
            } else {
                $model->filtro_evaluacion = 0; //evaluacion incompleta
                $model->promedio = 0;
            }
            if ($model->save()) {
                Yii::app()->user->setFlash('success', "Evaluación guardada de manera correcta.");
            } else {
                Yii::app()->user->setFlash('error', "La evaluación no puede ser guardada.");
            }
            $this->redirect(array('admin'));
        }
        $this->renderPartial('_form', array(
            'model' => $model,
                ), false, true);
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['PostulacionAPractica'])) {
            $model->attributes = $_POST['PostulacionAPractica'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id_inscripcion_practica));
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->layout = '//layouts/column1';
        $model = new PostulacionAPractica('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PostulacionAPractica']))
            $model->attributes = $_GET['PostulacionAPractica'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->layout = '//layouts/column1';
        $model = new PostulacionAPractica('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PostulacionAPractica']))
            $model->attributes = $_GET['PostulacionAPractica'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PostulacionAPractica the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = PostulacionAPractica::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'La Petición no Existe.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PostulacionAPractica $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'postulacion-apractica-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * 
     * @param PostulacionAPractica $data
     * @param type $row
     */
    public function gridUrlCurriculum($data, $row) {
        if (isset($data->id_adjunto_fk)) {
            return CHtml::link('Descargar', array('download', 'id' => $data->id_adjunto_fk,));
        } else {
            return "Curriculum no adjuntado";
        }
    }

    /**
     * 
     * @param PostulacionAPractica $data
     * @param type $row
     */
    public function gridEvaluacion($data, $row) {
        if ($data->filtro_evaluacion != 0) {
            return "Hecha";
        } else {
            return "Incompleta";
        }
    }

    public function SendMail($asunto, $mensaje, $para) {
        $message = new YiiMailMessage;
        $message->subject = $asunto ? $asunto : 'Asunto';
        $mensaje.="<br/>
            <br/>
            Cualquier consulta dirigirla a secretaría de carrera 
            (" . PeticionesWebService::obtieneCorreoSecretaria(Yii::app()->user->getState('campus')) . ")
            <br/>
            --
            <br/>Atte.<br/>Administrador de sistemas de Ingeniería Civil en 
            Informática UBB<br/>" . Yii::app()->getBaseUrl(true) . " <br/> 
             Éste correo no debe ser respondido.";
        $message->setBody($mensaje, 'text/html'); //codificar el html de la vista
        $message->from = (Yii::app()->params['adminEmail']); // alias del q envia
        $message->setTo($para); // a quien se le envia
        Yii::app()->mail->send($message);
    }

}
