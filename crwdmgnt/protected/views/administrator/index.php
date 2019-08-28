<?php include('header.php'); ?>
<div class="container-fluid" id="main-body">
    
    <h2 id="in-main-h1">Administrator</h2>
    <h4 ></h4>
    <div id="in-main"> 
        <center>
        <div id="graph-div">
            
            <div id="graph-div">
            <h3>User - Websites</h3>
            <?php
            $this->widget(
                    'chartjs.widgets.ChBars', array(
                'width' => 800,
                'height' => 400,
                'htmlOptions' => array(),
                'labels' => $barLabel,
                'datasets' => array(
                    array(
                        "fillColor" => "#ff00ff",
                        "strokeColor" => "rgba(220,220,220,1)",
                        "data" => $barData
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