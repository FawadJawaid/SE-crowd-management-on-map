<?php include('header.php'); ?>

<div class="container-fluid" id="main-body">
    <h2 id="in-main-h1">Quadrants</h2>
    <div id="widgetform" >
        <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr >
                    <th>id</th>
                    <th>Div Name</th>

                    
                </tr>
            </thead>
            <tbody>
                <?php foreach($webQuad as $quad): ?>
                    <tr class="success">
                        
                        <td><?php echo $quad->id ?></td>
                       <td><?php echo $quad->div_name ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>
    </div>

    <br><br><br><br>
    <br><br>
</div>
<?php include('footer.php'); ?>



?>
