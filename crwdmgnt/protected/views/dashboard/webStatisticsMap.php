<?php include('header.php'); ?>
<div class="container-fluid" id="main-body">

    <h2 id="in-main-h1">Visit Logs</h2>
    <h4 ><?php echo Website::model()->find('unq_id=?',array($_REQUEST['unqId']))->web_url ; ?></h4>
    <div id="in-main"> 
        <center><?php include('sideBar.php'); ?>
<p><a id="filter-button">Filter Data</a> | <?php echo CHtml::link('Reset Filter', array('administrator/webStatistics','unqId'=>$_REQUEST['unqId'])); ?></p>
            <div class="filter-forms" style="display: none;">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'login-form',
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                ));
                ?>
                <p>Date Range</p>
                <div style="margin: 2%">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'date1',
                    'value' => date('d/m/Y'),
                    'options' => array(
                        'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'showButtonPanel' => true,
                    ),
                    'htmlOptions' => array(
                        'style' => 'height: 10%;width: 10%;'
                    ),
                ));
                ?>
                </div>
                To
                <br>
                <div style="margin: 2%">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'date2',
                    'value' => date('d/m/Y'),
                    'options' => array(
                        'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'showButtonPanel' => true,
                    ),
                    'htmlOptions' => array(
                        'style' => 'height: 10%;width: 10%;'
                    ),
                ));
                ?>
                </div>
                <div style="float: right"><?php echo CHtml::submitButton('Filter'); ?></div>
                <?php $this->endWidget(); ?>
            </div>
            <div id="graph-div">
        <div id="map">&nbsp;</div>
        </div>
        </center>
    </div>
</div>
<?php include('footer.php'); ?>
<script>
    function infoOpen(i)
    {

        google.maps.event.trigger(gmarkers[i], 'click');
    }
    var gmarkers = [];
    var markers = [];
    markers = [
        <?php $i=0; foreach($statsData as $data): ?>
                <?php if($i!=0) echo ','; ?>
        <?php echo "['".$i."', 'IP:".$data->ip."'+'<br>DateTime:".$data->datetime."', ".$data->lati.", ".$data->long."]"; ?>
        
        <?php $i++; endforeach; ?>
    ];

    $(document).ready(function() {
        var myOptions = {
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false
        };

        var map = new google.maps.Map(document.getElementById("map"), myOptions);
        var image = new google.maps.MarkerImage('img/marker.png',
                new google.maps.Size(65, 32),
                new google.maps.Point(0, 0),
                new google.maps.Point(18, 42));
        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        var bounds = new google.maps.LatLngBounds();

        for (i = 0; i < markers.length; i++) {
            var pos = new google.maps.LatLng(markers[i][2], markers[i][3]);
            var content = markers[i][1];
            bounds.extend(pos);
            marker = new google.maps.Marker({
                position: pos,
                map: map
            });
            gmarkers.push(marker);
            google.maps.event.addListener(marker, 'click', (function(marker, content) {
                return function() {
                    infowindow.setContent(content);
                    infowindow.open(map, marker);
                }
            })(marker, content));
        }


        map.fitBounds(bounds);
    });
</script>
<script>
    $(window).resize(function() {
        var h = $(window).height(),
                offsetTop = 190; // Calculate the top offset

        $('#map').css('height', (h - offsetTop));
    }).resize();
</script>
<script>
    $(document).ready(function() {
        $('#filter-button').click(function() {
            $('.filter-forms').toggle("slow");
        });
    });
</script>



