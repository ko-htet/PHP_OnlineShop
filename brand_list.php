<?php
    require 'db_connect.php';
    require 'backend_header.php';
?>
    
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Brands </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="brand_new.php" class="btn btn-outline-primary">
                        <i class="icofont-plus"></i>
                    </a>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <div class="row">
                                        <tr>
                                            <th><div class="col-1">#</div></th>
                                            <th><div class="col-7">Name</div></th>
                                            <th><div class="col-4">Action</div></th>
                                        </tr></div>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT * FROM brands";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $rows = $stmt->fetchAll();
                                            $i = 1;
                                            foreach($rows as $row){
                                                $id = $row['id'];
                                                $name = $row['name'];
                                                $photo = $row['photo'];
                                            
                                        ?>
                                        <tr>
                                            <td> <?= $i++; ?>. </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-2"><img src="<?= $photo; ?>" class="img-fluid"></div>
                                                    <div class="col-10 pt-2"><?= $name; ?></div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="brand_edit.php?eid=<?= $id; ?>" class="btn btn-warning">
                                                    <i class="icofont-ui-settings"></i>
                                                </a>

                                                <a href="brand_delete.php?did=<?= $id; ?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-outline-danger">
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