<?php

class ContactoEmpresaController extends Controller {

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
                'actions' => array('index', 'view'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$ALUMNO, Rol::$SUPER_USUARIO),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$ALUMNO, Rol::$SUPER_USUARIO),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'roles' => array(Rol::$ADMINISTRADOR, Rol::$SUPER_USUARIO),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->renderPartial('view', array(
            'model' => $this->loadModel($id),
        ),false,true);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($ide) {
        $model = new ContactoEmpresa;
        $model->id_empresa_fk=$ide;
        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);

        if (isset($_POST['ContactoEmpresa'])) {
            $model->attributes = $_POST['ContactoEmpresa'];
            $model->id_usuario_inserta_fk = Yii::app()->user->id;
            if ($model->save())
                $this->redirect(array('empresa/view', 'id' => $model->id_empresa_fk));
        }

        $this->renderPartial('create', array(
            'model' => $model,
        ),false,true);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);

        if (isset($_POST['ContactoEmpresa'])) {
            $model->attributes = $_POST['ContactoEmpresa'];
            if ($model->save())
                $this->redirect(array('empresa/view', 'id' => $model->id_empresa_fk));
        }

        $this->renderPartial('update', array(
            'model' => $model,
        ),false,true);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model=$this->loadModel($id);
        $ide=$model->id_empresa_fk;
        $model->delete();
        $this->redirect(array('empresa/view', 'id' => $ide));
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//        if (!isset($_GET['ajax']))
//            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new ContactoEmpresa('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ContactoEmpresa']))
            $model->attributes = $_GET['ContactoEmpresa'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new ContactoEmpresa('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ContactoEmpresa']))
            $model->attributes = $_GET['ContactoEmpresa'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ContactoEmpresa the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = ContactoEmpresa::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ContactoEmpresa $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contacto-empresa-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
