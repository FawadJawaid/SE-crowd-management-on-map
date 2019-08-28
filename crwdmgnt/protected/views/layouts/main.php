<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/Globalstyle.css" />
        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/foundation.css"  />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/normalize.css" />



        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=en"></script>
        <script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.js"></script>
        
        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/js/bootstrap.js"></script>

        <script>
            $(document).foundation();
        </script>

        <style>
            div.errorMessage {
                display: block;
                padding: 0.375rem 0.5625rem 0.5625rem;
                margin-top: -1px;
                margin-bottom: 1rem;
                font-size: 1.2 rem;
                font-weight: normal;
                font-style: italic;
                background: none repeat scroll 0% 0% rgb(240, 65, 36);
                color: white;
            }
            #map {
                width:100%;
                height:100%;
                border:5px solid #6f5f5e;
                margin:0px auto 00px auto;
            }
        </style>

    </head>

    <body>

        <?php echo $content; ?>

    </body>
</html>
