<?php include('header.php'); ?>
<div class="container-fluid" id="main-body">
    <h2 id="in-main-h1">Add Email Alert</h2>
    <div id="widgetform" >

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>
        <div id="input-subfield">
            
            <p style="color: red"><?php echo $msg; ?></p>
            <label>Web-Url</label>
            <?php echo $form->dropDownList($formAddEmailAlert, 'icm_website_unq_id', $ddData); ?>
            <?php echo $form->error($formAddEmailAlert, 'icm_website_unq_id'); ?>
            
            <label>Web-Type</label>
            <?php echo $form->dropDownList($formAddEmailAlert, 'alert_type', array('1'=>'Daily','2'=>'Weekly','3'=>'Monthly')); ?>
            <?php echo $form->error($formAddEmailAlert, 'alert_type'); ?>
            
        </div>
    </div>




    <?php echo CHtml::submitButton('Submit', array('id' => 'submit_button')); ?>
    <?php $this->endWidget(); ?>

    <br><br><br><br><br><br>
</div>


</div>




<?php include('footer.php'); ?>





