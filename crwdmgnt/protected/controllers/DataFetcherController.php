<?php

class DataFetcherController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGet() {
        $ip = "";
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }


        if (!(isset($_REQUEST['id'])
                )) {
            $this->error("Too Few Argument...");
        } else {
            $f1 = fopen('http://ip-api.com/json/' . $ip, 'r');
            $fcontent = $contents = stream_get_contents($f1);
            fclose($f1);

            $data = json_decode($fcontent);

            $country = $data->country;
            $city = $data->city;
            $region = $data->regionName;
            $state = $data->timezone;
            $long = $data->lon;
            $lati = $data->lat;

            $uniqId = $_REQUEST['id'];
            /*echo $ip."<br>";
            echo $country."<br>";
            echo $city."<br>";
            echo $region."<br>";
            echo $state."<br>";
            echo $long."<br>";
            echo $lati."<br>";
            echo $uniqId."<br>";
*/
            $storeStatistics = new Statistics();
            $storeStatistics->icm_system_city_id = $this->findCity($region, $country, $state, $city);
            $storeStatistics->long = $long;
            $storeStatistics->lati = $lati;
            $storeStatistics->ip = $ip;
            $storeStatistics->icm_website_unq_id = $uniqId;
            $storeStatistics->rec_time();
            $storeStatistics->save();
        }
    }
    public function actionQuadGet() {
        $ip = "";
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }


        if (!(isset($_REQUEST['id']) && isset($_REQUEST['quad_id'] 
                )) ) {
            $this->error("Too Few Argument...");
        } else {
            $f1 = fopen('http://ip-api.com/json/' . $ip, 'r');
            $fcontent = $contents = stream_get_contents($f1);
            fclose($f1);

            $data = json_decode($fcontent);

            $country = $data->country;
            $city = $data->city;
            $region = $data->regionName;
            $state = $data->timezone;
            $long = $data->lon;
            $lati = $data->lat;

            $uniqId = $_REQUEST['id'];
            $quadId = $_REQUEST['quad_id'];
            /*
            echo $ip."<br>";
            echo $country."<br>";
            echo $city."<br>";
            echo $region."<br>";
            echo $state."<br>";
            echo $long."<br>";
            echo $lati."<br>";
            echo $uniqId."<br>";
             * 
             */
            $storeQuadStats = new QuadStatistics();
            $storeQuadStats->icm_system_city_id = $this->findCity($region, $country, $state, $city);
            $storeQuadStats->long = $long;
            $storeQuadStats->lati = $lati;
            $storeQuadStats->ip = $ip;
            $storeQuadStats->icm_website_quad_id = $quadId;
            $storeQuadStats->rec_time();
            $storeQuadStats->save();
        }
    }
        public function actionGenJs() {

        if (!isset($_REQUEST['id'])) {
            echo 'too few parameters';
            Yii::app()->end();
        }

        $unqId = $_REQUEST['id'];
        $getQuads = WebsiteQuad::model()->findAll('icm_website_unq_id=?', array($unqId));


        header('Content-Type: application/javascript');

        $script = '<script type="text/javascript">';
        $script .= '
            var HttpClient = function() {
                this.get = function(aUrl, aCallback) {
                    anHttpRequest = new XMLHttpRequest();
                    anHttpRequest.onreadystatechange = function() {
                        if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
                            aCallback(anHttpRequest.responseText);
                    }
                    anHttpRequest.open("GET", aUrl, true);
                    anHttpRequest.send(null);
                }
             }
                aClient = new HttpClient();
            aClient.get("http://wiredservices.com.au/crwdmgnt/index.php?r=DataFetcher/Get" + "&id=' . $unqId . '"
                    , function(answer) {
            });
            window.onload = function(){ 
            var checkIfHover = false;
';
        foreach ($getQuads as $quad) {
            $script .= '
                


            document.getElementById("'.$quad->div_name.'").onmouseover = function() {
            checkIfHover = true;
            setTimeout(function() {
                if(checkIfHover === true) {
                aClient = new HttpClient();
            aClient.get("http://wiredservices.com.au/crwdmgnt/index.php?r=DataFetcher/QuadGet" + "&id=' . $unqId . '&quad_id='.$quad->id.'"
                    , function(answer) {
            });
                    }
                }, 3000)
                };
                document.getElementById("'.$quad->div_name.'").onmouseout = function() {
                checkIfHover = false;
                };';
        }
        $script .= '};</script>';

        echo $script;
    }


    public function actionViewStats() {
        $statistics = Statistics::model()->findAll();
        $this->render('viewStats', array(
            'statistics' => $statistics
        ));
    }

    private function error($error) {
        echo $error;
        Yii::app()->end();
    }

    private function findRegion($region) {
        $getRegion = SystemRegion::model()->find('name=?', array($region));
        //print_r($getRegion);
        if ($getRegion != null) {
            return $getRegion->id;
        } else {
            $storeRegion = new SystemRegion();
            $storeRegion->name = $region;
            $storeRegion->save();
            return $storeRegion->id;
        }
        //return $getRegion->id;
    }

    private function findCountry($region, $country) {
        $getCountry = SystemCountry::model()->find('name=?', array($country));
        //print_r($getRegion);
        if ($getCountry != null) {
            return $getCountry->id;
        } else {
            $storeCountry = new SystemCountry();
            $storeCountry->name = $country;
            $storeCountry->icm_system_region_id = $this->findRegion($region);
            $storeCountry->save();
            return $storeCountry->id;
        }
    }

    private function findState($region, $country, $state) {
        $getState = SystemState::model()->find('name=?', array($state));
        //print_r($getRegion);
        if ($getState != null) {
            return $getState->id;
        } else {
            $storeState = new SystemState();
            $storeState->name = $state;
            $storeState->icm_system_country_id = $this->findCountry($region, $country);
            $storeState->save();
            return $storeState->id;
        }
    }

    private function findCity($region, $country, $state, $city) {
        $getCity = SystemCity::model()->find('name=?', array($city));
        //print_r($getRegion);
        if ($getCity != null) {
            return $getCity->id;
        } else {
            $storeCity = new SystemCity();
            $storeCity->name = $city;
            $storeCity->icm_system_state_id = $this->findState($region, $country, $state);
            $storeCity->save();
            return $storeCity->id;
        }
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