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
                        <?php foreach ($statsData as $stat): ?>
                            <tr >
                                <td><?php echo $stat->ip; ?></td>
                                <td><?php echo $stat->long; ?></td>
                                <td><?php echo $stat->lati; ?></td>
                                <td><?php echo $stat->datetime; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
</div>
            </div>
        </center>

    </div>
</div>



<?php include('footer.php'); ?>
<script>
    $(document).ready(function() {
        $('#filter-button').click(function() {
            $('.filter-forms').toggle("slow");
        });
    });
</script>

