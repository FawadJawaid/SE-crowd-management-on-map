<?php include('header.php'); ?>
<div class="container-fluid" id="main-body">
    <h2 id="in-main-h1">Add Website</h2>
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
            
            
            <label>Web-Url</label>
            <?php echo $form->textField($formAddWebsite, 'web_url', array('placeholder' => 'https://www.jacked97.com')); ?>
            <?php echo $form->error($formAddWebsite, 'web_url'); ?>
            
            <label>Web-Type</label>
            <?php echo $form->textField($formAddWebsite, 'web_type', array('placeholder' => 'Games,Entertainment,Movies')); ?>
            <?php echo $form->error($formAddWebsite, 'web_type'); ?>
            
        </div>
    </div>




    <?php echo CHtml::submitButton('Submit', array('id' => 'submit_button')); ?>
    <?php $this->endWidget(); ?>

    <br><br><br><br><br><br>
</div>


</div>




<?php include('footer.php'); ?>





