<?php
    require 'backend_header.php';
    require 'db_connect.php';
    $role_id = 2;
    $sql = "SELECT users.*, roles.name as rname FROM users
            INNER JOIN model_has_roles ON users.id = model_has_roles.user_id
            INNER JOIN roles ON model_has_roles.role_id = roles.id
            WHERE model_has_roles.role_id = :v1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $role_id);
    $stmt->execute();
    $users = $stmt->fetchAll();
?>
    
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> User </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            foreach($users as $user){
                                                $u_id = $user['id'];
                                        ?>
                                        <tr>
                                            <td> <?= $i++; ?>. </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-1 float-right"><img src="images/user.png" class="img-fluid mt-2 ml-2"></div>
                                                    <div class="col-11"><span><?= $user['name']; ?></span><p><?= $user['email']; ?></p></div>
                                                </div>
                                            </td>
                                            <td><p><?= $user['phone']; ?></p><span><?= $user['address']; ?></span></td>
                                            <td>
                                                <a href="user_delete.php?id=<?= $u_id; ?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-outline-danger">
                                                    <i class="icofont-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php require 'backend_footer.php'; ?>