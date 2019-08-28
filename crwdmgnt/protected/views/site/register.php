<?php include('header.php'); ?>
<div class="container-fluid" id="main-body">
    <h2 id="in-main-h1">Register</h2>
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
            <?php if($error != null) echo $error; ?>
            
            <label>Name</label>
            <?php echo $form->textField($formAddUser, 'name', array('placeholder' => 'abdullah')); ?>
            <?php echo $form->error($formAddUser, 'name'); ?>
            
            <label>Email</label>
            <?php echo $form->textField($formAddUser, 'email', array('placeholder' => 'abdullahmateen87@gmail.com')); ?>
            <?php echo $form->error($formAddUser, 'email'); ?>
            
            <label>Password</label>
            <?php echo $form->passwordField($formAddUser, 'password', array('placeholder' => '*******')); ?>
            <?php echo $form->error($formAddUser, 'password'); ?>
            
            <label>Age</label>
            <?php echo $form->textField($formAddUser, 'age', array('placeholder' => '18')); ?>
            <?php echo $form->error($formAddUser, 'age'); ?>
            
            <label>gender</label>
            <?php echo $form->dropDownList($formAddUser, 'gender', array('m'=>'Male','f'=>'Female')); ?>
            <?php echo $form->error($formAddUser, 'gender'); ?>
            <br><br>
            
        </div>
    </div>




    <?php echo CHtml::submitButton('Register', array('id' => 'submit_button')); ?>
    <?php $this->endWidget(); ?>

    <br><br><br><br><br><br>
</div>


</div>




<?php include('footer.php'); ?>





