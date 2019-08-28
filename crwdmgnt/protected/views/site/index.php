<?php include('header.php'); ?>

<div class="container-fluid" id="main-body">
    <center>
<h2 id="in-main-h1">Interactive Crowd Management</h2>
<div id="main-button">
<?php echo CHtml::link('<button type="button" class="btn btn-default btn-lg">Login</button>',array('site/login') ); ?>

<?php echo CHtml::link('<button type="button" class="btn btn-primary btn-lg">Register</button>',array('site/register') ); ?>
</div>

     <?php echo CHtml::image(Yii::app()->baseUrl.'/images/main.png', '', array('id'=>'main-img-div'))  ?>
    </center>

            
</div>











<?php include('footer.php'); ?>