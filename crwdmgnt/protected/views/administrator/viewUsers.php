<?php include('header.php'); ?>

<div class="container-fluid" id="main-body">

    <h2 id="in-main-h1">Users</h2>
    <div id="in-main"> 
        <center>
            <div id="graph-div">
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr >
                            <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr >
                                <td><?php echo $user->id; ?></td>
                                <td><?php echo $user->name; ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->gender; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
</div>
            </div>
        </center>

    </div>
</div>



<?php include('footer.php'); ?>


