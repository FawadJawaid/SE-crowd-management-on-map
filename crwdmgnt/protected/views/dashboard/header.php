<!Nav-bar Starts>
<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container-fluid" id="navbar">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-8">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Dashboard</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-8">
            <ul class="nav navbar-nav">
                <li><?php echo CHtml::link('Home',array('dashboard/index')); ?></li>
                <li><?php echo CHtml::link('Add Website',array('dashboard/addWebsite')); ?></li>
                <li><?php echo CHtml::link('View Websites',array('dashboard/index')); ?></li>
                <li><?php echo CHtml::link('Email Alert',array('dashboard/EmailAlert')); ?></li>
                <li><?php echo CHtml::link('View/Edit Profile',array('dashboard/ViewProfile')); ?></li>
                <li><?php echo CHtml::link('Logout',array('site/Logout')); ?></li>
            </ul>
        </div>
    </div>
</nav>
<!Nav-bar End>