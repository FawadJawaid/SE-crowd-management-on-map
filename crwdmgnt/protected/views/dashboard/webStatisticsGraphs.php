<?php include('header.php'); ?>
<div class="container-fluid" id="main-body">
    
    <h2 id="in-main-h1">Visit Logs</h2>
    <h4 ><?php echo Website::model()->find('unq_id=?',array($_REQUEST['unqId']))->web_url ; ?></h4>
    <div id="in-main"> 
        <center><?php include('sideBar.php'); ?>

        <div id="graph-div">
            <h3>Visitors - Last 5 Days</h3>
            <?php
            $this->widget(
                    'chartjs.widgets.ChLine', array(
                'width' => 800,
                'height' => 400,
                'htmlOptions' => array(),
                'labels' => $hisLabel,
                'datasets' => array(
                    array(
                        "fillColor" => "rgba(220,220,220,0.5)",
                        "strokeColor" => "rgba(220,220,220,1)",
                        "pointColor" => "rgba(220,220,220,1)",
                        "pointStrokeColor" => "#ffffff",
                        "data" => $hisData
                    )
                ),
                'options' => array()
                    )
            );
            ?>
            </div>
            
            <div id="graph-div">
            <h3>Visitors - Cities</h3>
            <?php
            $this->widget(
                    'chartjs.widgets.ChBars', array(
                'width' => 800,
                'height' => 400,
                'htmlOptions' => array(),
                'labels' => $radLabel,
                'datasets' => array(
                    array(
                        "fillColor" => "#ff00ff",
                        "strokeColor" => "rgba(220,220,220,1)",
                        "data" => $radData
                    )
                ),
                'options' => array()
                    )
            );
            ?>
            </div>
            </center>

    </div>
</div>






<?php include('footer.php'); ?>
