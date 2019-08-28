<?php include('header.php'); ?>

<div class="container-fluid" id="main-body">
    <h2 id="in-main-h1">Websites</h2>
    <div id="widgetform" >
        <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr >
                    <th>Web-Url</th>
                    <th>Web-Type</th>
                    <th>View</th>
                    <th>View/Add Quads</th>

                    
                </tr>
            </thead>
            <tbody>
                <?php foreach($webSites as $website): ?>
                    <tr class="success">
                        <td><?php echo CHtml::link($website->web_url,array('dashboard/webStatistics','unqId'=>$website->unq_id)); ?></td>
                        <td><?php echo $website->web_type; ?></td>
                        <td><?php echo CHtml::link($website->unq_id,array('dashboard/viewCode','unqId'=>$website->unq_id)); ?></td>
                        <td><?php 
                        if(checkQuad($webQuads, $website->unq_id)) {
                            echo CHtml::link('View',array('dashboard/viewWebQuad','unqId'=>$website->unq_id));
                            echo "/";

                        }
                         echo CHtml::link('Add',array('dashboard/addQuad','unqId'=>$website->unq_id));
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


<?php
function checkQuad($arr,$unqId) {
    foreach($arr as $ar) {
        if($ar['icm_website_unq_id']==$unqId) {
            return true;
        }
    }
    return false;
}


?>


