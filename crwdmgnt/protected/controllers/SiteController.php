<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionRegister() {

        $error = null;
        if (isset($_POST['formAddUser'])) {
            if (Users::model()->find('email=?', array($_POST['formAddUser']['email'])) != null)
                $error = "Email Exisit";
            else {
                $storeUser = new Users();
                $storeUser->attributes = $_POST['formAddUser'];
                $storeUser->rec_time();
                $storeUser->icm_users_type_id = 1;
                if ($storeUser->save()) {
                    $this->redirect(array('site/Login'));
                }
            }
        }

        $formAddUser = new formAddUser();

        $this->render('register', array(
            'formAddUser' => $formAddUser,
            'error'=>$error
        ));
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionIndex() {
        if (Yii::app()->user->getId()) {
            if (Yii::app()->user->getState("type") == 2) {
                $this->redirect(array('administrator/index'));
            } else if (Yii::app()->user->getState("type") == 1) {
                $this->redirect(array('dashboard/index'));
            }
        }
        
        $this->render('index');
    }

    public function actionLogin() {
        ob_start();
        $formLogin = new formLogin();
        if (isset($_POST['formLogin'])) {
            $formLogin->attributes = $_POST['formLogin'];
            if ($formLogin->validate() && $formLogin->login()) {
                $this->redirect(array('site/index'));
            }
        }

        $this->render('login', array(
            'login' => $formLogin
        ));
    }

    /**
     * Displays the contact page
     */

    /**


      /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}