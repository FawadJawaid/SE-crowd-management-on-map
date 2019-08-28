<?php include('header.php'); ?>

<div class="container-fluid" id="main-body">
    <h2 id="in-main-h1">Websites</h2>
    <div id="widgetform" >
        <?php echo CHtml::link('Active', array('administrator/viewWebsites')); ?> | 
        <?php echo CHtml::link('Deleted', array('administrator/viewWebsites', 'status'=>'del')); ?> 
        <br>
        <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr >
                    <th>Web-Url</th>
                    <th>Web-Type</th>
                    <th>View</th>
                    <th rowspan="1"></th>

                    
                </tr>
            </thead>
            <tbody>
                <?php foreach($websites as $website): ?>
                    <tr class="success">
                        <td><?php echo CHtml::link($website->web_url,array('administrator/webStatistics','unqId'=>$website->unq_id)); ?></td>
                        <td><?php echo $website->web_type; ?></td>
                        <td><?php echo CHtml::link($website->unq_id,array('administrator/viewCode','unqId'=>$website->unq_id)); ?></td>
                        <td ><?php
                            if($website->status == 1)
                                echo CHtml::link('<span class="glyphicon glyphicon-remove">', array('administrator/viewWebsites', 'del'=>$website->unq_id)); 
                            else 
                                echo CHtml::link('<span class="glyphicon glyphicon-ok">', array('administrator/viewWebsites', 'act'=>$website->unq_id)); 
                            
                            ?></td>
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



