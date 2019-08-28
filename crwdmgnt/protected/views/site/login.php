<?php include('header.php'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<div class="container-fluid" id="main-body">
<h2 id="in-main-h1">Login Page</h2>
<div id="widgetform" >
    
    <label>Email</label>
    <?php echo $form->textField($login,'email',array('placeholder'=>'Email')); ?>
    <?php echo $form->error($login,'email'); ?>
    
    
    
    <label>Password</label>
    <?php echo $form->passwordField($login,'password',array('placeholder'=>'Password')); ?>
    <?php echo $form->error($login,'password'); ?>
   
    
    <br>
        
    <?php echo CHtml::submitButton('Login',array('id'=>'submit_button')); ?>
</div>

            
</div>










<?php $this->endWidget(); ?>


<?php include('footer.php'); ?>