<?php include('header.php'); ?>
<div class="container-fluid" id="main-body">
    <h2 id="in-main-h1">Add Website Quad</h2>
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
            <?php echo $form->textField($formAddQuad, 'div_id', array('placeholder' => 'main-div')); ?>
            <?php echo $form->error($formAddQuad, 'div_id'); ?>

            
        </div>
    </div>




    <?php echo CHtml::submitButton('Submit', array('id' => 'submit_button')); ?>
    <?php $this->endWidget(); ?>

    <br><br><br><br><br><br>
</div>


</div>




<?php include('footer.php'); ?>





