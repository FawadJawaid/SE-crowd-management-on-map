<div class="container-fluid" id="main-body">
    
    <h1 id="in-main-h1">Visit Logs</h1>
    <div id="in-main"> 
<div id="dashlink">    
<?php echo CHtml::link('Active',array('administrator/jpTransactions','status'=>'1')); ?> | 
<?php echo CHtml::link('Inactive',array('administrator/jpTransactions','status'=>'0')); ?> |
<?php echo CHtml::link('All',array('administrator/jpTransactions')); ?>
</div>
    <table class="table table-hover">
        <thead>
            <tr >
                <th>IP</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($statistics as $stat): ?>
            <tr >
                <td><?php echo $stat->ip; ?></td>
                <td><?php echo $stat->long; ?></td>
                <td><?php echo $stat->lati; ?></td>
                <td><?php echo $stat->datetime; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        
    </div>
</div>