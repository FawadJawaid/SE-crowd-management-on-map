<?php

class DashboardController extends Controller {

    private $userId;

    public function actionIndex() {
        $this->isLogged();

        $criteria = new CDbCriteria();
        $criteria->condition = "icm_users_id=" . $this->userId . " AND status=1";
        
        $dbConnection=Yii::app()->db;
            $command=$dbConnection->createCommand("SELECT * FROM `icm_website_quad` 
                WHERE icm_website_unq_id in (SELECT unq_id FROM icm_website WHERE icm_users_id= $this->userId)");
            
        

        $webSites = Website::model()->findAll($criteria);
        $webQuads=$command->queryAll();
        //print_r($webQuads);

        $this->render('index', array(
            'webSites' => $webSites,
            'webQuads'=>$webQuads
        ));
    }
    public function actionViewWebQuad() {
        $this->isLogged();
        if (!isset($_REQUEST['unqId']))
            $this->error("too few argument");
        $unqId = $_REQUEST['unqId'];
        
        $webQuad = WebsiteQuad::model()->findAll('icm_website_unq_id=?',array($unqId));
        
        $this->render('viewWebQuad',array(
            'webQuad'=>$webQuad
        ));
        
        
    }

    public function actionAddWebsite() {
        $this->isLogged();

        if (isset($_POST['formAddWebsite'])) {
            $storeWebsite = new Website();
            $storeWebsite->attributes = $_POST['formAddWebsite'];
            $storeWebsite->unq_id = md5(uniqid(date("d-m-Y h:i:s"), true));
            $storeWebsite->icm_users_id = $this->userId;
            $storeWebsite->rec_time();
            ;
            if ($storeWebsite->save()) {
                $this->redirect(array('dashboard/viewCode', 'unqId' => $storeWebsite->unq_id));
            }
            else
                $this->error("Error Saving Website");
        }

        $formAddWebsite = new formAddWebsite();

        $this->render('addWebsite', array(
            'formAddWebsite' => $formAddWebsite
        ));
    }
    public function actionAddQuad() {
        $this->isLogged();
        if (!isset($_REQUEST['unqId']))
            $this->error("too few argument");
        $unqId = $_REQUEST['unqId'];
        if(isset($_POST['formAddQuad'])) {
            $addQuad = new WebsiteQuad();
            $addQuad->div_name =$_POST['formAddQuad']['div_id'] ;
            $addQuad->icm_website_unq_id = $unqId;
            if($addQuad->save() ) {
                $this->redirect(array('dashboard/index'));
            }
        }
        
        $formAddQuad = new formAddQuad();
        
        
        $this->render('addQuad',array(
            'formAddQuad'=>$formAddQuad
        ));
    }

    public function actionViewCode() {
        $this->isLogged();
        $unqId = "";
        if (!isset($_REQUEST['unqId']))
            $this->error("too few argument");
        $unqId = $_REQUEST['unqId'];

        $webData = Website::model()->find('unq_id=?', array($unqId));
        if ($webData == null)
            $this->error("Unidentified Object");

        $this->render('viewCode', array(
            'webData' => $webData
        ));
    }

    public function actionWebStatistics() {
        $this->isLogged();
        $unqId = "";
        if (!isset($_REQUEST['unqId']))
            $this->error("too few argument");
        $unqId = $_REQUEST['unqId'];
        $criteria = new CDbCriteria();
        $condition = "icm_website_unq_id='".$unqId."' ";
        
        
        
        if(isset($_POST['date1']) && isset($_POST['date2'])) {
            $date1=$_POST['date1'];
            $date2=$_POST['date2'];
            $date1 =date("Y-m-d", strtotime($date1) );
            $date2 =date("Y-m-d", strtotime($date2) );
            $condition .= "AND DATE(datetime) BETWEEN '"."$date1' AND '$date2' ";
            //echo $date1;
        }
        $criteria->condition = $condition;
       // echo $condition;
        $statsData = Statistics::model()->findAll($criteria);

        $this->render('webStatistics', array(
            'statsData' => $statsData
        ));
    }

    public function actionWebStatisticsMap() {
        $this->isLogged();
        $unqId = "";
        if (!isset($_REQUEST['unqId']))
            $this->error("too few argument");
        $unqId = $_REQUEST['unqId'];
        $criteria = new CDbCriteria();
        $condition = "icm_website_unq_id='".$unqId."' ";
        
        
        
        if(isset($_POST['date1']) && isset($_POST['date2'])) {
            $date1=$_POST['date1'];
            $date2=$_POST['date2'];
            $date1 =date("Y-m-d", strtotime($date1) );
            $date2 =date("Y-m-d", strtotime($date2) );
            $condition .= "AND DATE(datetime) BETWEEN '"."$date1' AND '$date2' ";
            //echo $date1;
        }
        $criteria->condition = $condition;
        //echo $condition;
        $statsData = Statistics::model()->findAll($criteria);


        $this->render('webStatisticsMap', array(
            'statsData' => $statsData
        ));
    }

    public function actionWebStatisticsGraphs() {
        $this->isLogged();
        $unqId = "";
        if (!isset($_REQUEST['unqId']))
            $this->error("too few argument");
        $unqId = $_REQUEST['unqId'];
        $dbConnection = Yii::app()->db;
        $command = $dbConnection->createCommand("SELECT DATE(datetime) as date,COUNT(*) as no FROM `icm_statistics`
                WHERE icm_website_unq_id='$unqId' 
                GROUP BY DATE(datetime) ORDER BY datetime DESC LIMIT 5");
        $dbData = $command->queryAll();
        $hisLabel;
        $hisData;
        $i = 1;
        $hisLabel[0] = "";
        $hisData[0] = 0;
        foreach ($dbData as $d) {
            $hisLabel[$i] = $d['date'];
            $hisData[$i] = $d['no'];
            $i++;
        }

        $dbConnection = Yii::app()->db;
        $command = $dbConnection->createCommand("SELECT icm_system_city.name ,count(*) as no FROM icm_statistics,icm_system_city 
            WHERE icm_website_unq_id='$unqId' AND icm_system_city_id=icm_system_city.id 
            GROUP BY icm_system_city_id ORDER BY datetime DESC LIMIT 5 ");
        $dbData = $command->queryAll();
        $i = 1;
        $radData;
        $radLabel;
        $radData[0] = 0;
        $radLabel[0] = "" ;
        foreach ($dbData as $d) {
            $radData[$i] = $d['no'];
            $radLabel[$i] = $d['name'];
            $i++;
        }


        $this->render('webStatisticsGraphs', array(
            'hisLabel' => $hisLabel,
            'hisData' => $hisData,
            'radData' => $radData,
            'radLabel' => $radLabel
        ));
    }
    public function actionEmailAlert() {
        $this->isLogged();

        $formAddEmailAlert = new formAddEmailAlert();
        $msg = "";
        if (isset($_POST['formAddEmailAlert'])) {
            $checkIfExisit = EmailAlert::model()->find('icm_website_unq_id=?', array($_POST['formAddEmailAlert']['icm_website_unq_id']));
            if ($checkIfExisit == null) {
                $storeEmailAlert = new EmailAlert();
                $storeEmailAlert->attributes = $_POST['formAddEmailAlert'];
                if ($storeEmailAlert->save()) {
                    $msg = "Alert Added ";
                }
            }
            else {
                EmailAlert::model()->updateByPk($checkIfExisit->id, array('alert_type' => $_POST['formAddEmailAlert']['alert_type']));
                $msg = "Alert Modified ";
            }
        }

        $criteria = new CDbCriteria();
        $criteria->condition = "icm_users_id=" . $this->userId . " AND status=1";
        $webSites = Website::model()->findAll($criteria);
        $ddData = array();
        foreach ($webSites as $web) {
            $ddData[$web->unq_id] = $web->web_url;
        }
        //print_r($ddData);
        $this->render('emailAlert', array(
            'formAddEmailAlert' => $formAddEmailAlert,
            'ddData' => $ddData,
            'msg' => $msg
        ));
    }
    public function actionViewProfile() {
        $this->isLogged();
        
        $user = Users::model()->find('id=?',array($this->userId));
        $formAddUser = new formAddUser();
        if(isset($_POST['formAddUser'])) {
            Website::model()->updateByPk($this->userId, array('name' => $_POST['formAddUser']['name'],
                'email'=> $_POST['formAddUser']['email'], 'age'=>$_POST['formAddUser']['age'],
                'gender'=>$_POST['formAddUser']['gender']
                    ));
        }
        
        $formAddUser->email = $user->email;
        $formAddUser->name = $user->name;
        $formAddUser->gender = $user->gender;
        $formAddUser->age = $user->age;
        
        $this->render('viewProfile',array(
            'formAddUser'=>$formAddUser
        ));
    }

    private function error($error) {
        echo $error;
        Yii::app()->end();
    }

    private function isLogged() {
        if (Yii::app()->user->getId()) {
            $this->userId = Yii::app()->user->getId();
            if (Yii::app()->user->getState('type') != 1) {
                $this->redirect(array('site/index'));
            }
        }
        else
            $this->redirect(array('site/index'));
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}