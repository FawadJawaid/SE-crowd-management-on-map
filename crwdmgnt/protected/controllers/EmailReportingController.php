<?php

class EmailReportingController extends Controller {

    public function actionIndex() {

        //change this to your email. 
        $to = "abdullahmateen87@gmail.com";
        $from = "m2@maaking.com";
        $subject = "Hello! This is HTML email";
        
        $bootstrap = file_get_contents('http://evmms.com//css/bootstrap/css/bootstrap.css');
        

        //begin of HTML message 
        $message = '

    <h2 id="in-main-h1">Visit Logs</h2>
    <h4 >http://thesoft2009.blogspot.com</h4>
    <div id="in-main"> 
        <center>
            <div id="graph-div">
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr >
                            <th>IP</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                                                    <tr style="padding: 8px;  line-height: 1.428571429;  vertical-align: top;  border-top: 1px solid #ddd;" >
                                <td style="padding: 8px;  line-height: 1.428571429;  vertical-align: top;  border-top: 1px solid #ddd;">119.159.14.140</td>
                                <td style="padding: 8px;  line-height: 1.428571429;  vertical-align: top;  border-top: 1px solid #ddd;">71.9698</td>
                                <td style="padding: 8px;  line-height: 1.428571429;  vertical-align: top;  border-top: 1px solid #ddd;">30.5949</td>
                                <td style="padding: 8px;  line-height: 1.428571429;  vertical-align: top;  border-top: 1px solid #ddd;">2014-03-25 20:34:22</td>
                            </tr>
                                                    <tr style="padding: 8px;  line-height: 1.428571429;  vertical-align: top;  border-top: 1px solid #ddd;" >
                                <td style="padding: 8px;  line-height: 1.428571429;  vertical-align: top;  border-top: 1px solid #ddd;" >119.159.14.140</td>
                                <td style="padding: 8px;  line-height: 1.428571429;  vertical-align: top;  border-top: 1px solid #ddd;" >71.9698</td>
                                <td style="padding: 8px;  line-height: 1.428571429;  vertical-align: top;  border-top: 1px solid #ddd;" >30.5949</td>
                                <td style="padding: 8px;  line-height: 1.428571429;  vertical-align: top;  border-top: 1px solid #ddd;" >2014-03-25 20:35:18</td>
                            </tr>
                                                   
                                            </tbody>
                </table>
                </div>
            </div>
        </center>

    </div>






';
        //end of message 
        // To send the HTML mail we need to set the Content-type header. 
        $headers = "From: " . $from  . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        //options to send to cc+bcc 
        //$headers .= "Cc: [email]maa@p-i-s.cXom[/email]"; 
        //$headers .= "Bcc: [email]email@maaking.cXom[/email]"; 
        // now lets send the email. 
        mail($to, $subject, $message, $headers);

    }
    
    private function getData() {
        $statsData = EmailAlert::model()->findAll();
        $statsData ;
        foreach($statsData as $stat) {
            
        }
    }

    public function actionViewTest() {

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
}