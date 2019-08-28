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
            <a class="navbar-brand" href="#">Interac Crowd Management</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-8">
            <ul class="nav navbar-nav">
                <li><?php echo CHtml::link('Register',array('site/register')); ?></li>
                <li><?php echo CHtml::link('Login',array('site/login')); ?></li>

            </ul>
        </div>
    </div>
</nav>
<!Nav-bar End>