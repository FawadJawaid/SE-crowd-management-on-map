<?php

class AdministratorController extends Controller {
    private $userId;
    public function actionIndex() {
        $this->isLogged();
        $dbConnection = Yii::app()->db;
        $command = $dbConnection->createCommand("SELECT icm_users.name,count(*) as no FROM icm_website,icm_users 
            WHERE icm_website.icm_users_id=icm_users.id 
            GROUP BY icm_users_id");
        $dbData = $command->queryAll();
        
        $barData;
        $barLabel;
        $i=1;
        $barData[0] = 0;
        $barLabel[0] = "";
        foreach($dbData as $d) {
            $barData[$i] =  $d['no'];
            $barLabel[$i] = $d['name'];     
            $i++;
        }
        
        $this->render('index',array(
            'barData'=>$barData,
            'barLabel'=>$barLabel
        ));
    }
    
    
    public function actionAddUser() {
        $this->isLogged();
        
        
        if( isset ($_POST['formAddUser']) ) {
            $storeUser = new Users();
            $storeUser->attributes = $_POST['formAddUser'];
            $storeUser->rec_time();
            if($storeUser->save()) {
                $this->redirect(array('administrator/viewUsers'));
            }
        }
        
        $formAddUser = new formAddUser();
        
        $this->render('addUser',array(
            'formAddUser'=>$formAddUser,
            'userType'=>$this->formatDD(UsersType::model()->findAll())
        ));
    }
    
    public function actionViewUsers() {
        $this->isLogged();
        $users = Users::model()->findAll();
        
        $this->render('viewUsers',array(
            'users'=>$users
        ));
    }
    
    public function actionViewWebsites() {
        $this->isLogged();

        $status = "1";

        if (isset($_REQUEST['status'])) {
            $status = "0";
        }
        if (isset($_REQUEST['del'])) {
            $id = $_REQUEST['del'];
            Website::model()->updateByPk($id, array('status' => '0'));
        }
        if (isset($_REQUEST['act'])) {
            $id = $_REQUEST['act'];
            Website::model()->updateByPk($id, array('status' => '1'));
        }

        $websites = Website::model()->findAll('status=?', array($status));
        
        $this->render('viewWebsites',array(
            'websites'=>$websites
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

    private function isLogged() {
        if (Yii::app()->user->getId()) {
            $this->userId = Yii::app()->user->getId();
            if (Yii::app()->user->getState('type') != 2) {
                $this->redirect(array('site/index'));
            }
        }
        else
            $this->redirect(array('site/index'));
    }
    private function formatDD($object) {
        $result;
        foreach ($object as $obj)
            $result[$obj->id] = $obj->name;
        return $result;
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