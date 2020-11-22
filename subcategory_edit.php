<?php
    require 'db_connect.php';
    require 'backend_header.php';
    
    $id = $_GET['eid'];
    $sql = "SELECT * FROM subcategories WHERE id = :v1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $id);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
    
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Edit Subcategory Form </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="subcategory_list.php" class="btn btn-outline-primary">
                        <i class="icofont-double-left"></i>
                    </a>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <form action="subcategory_update.php" method="POST" enctype="multipart/form-data">
                                
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <div class="form-group row">
                                    <label for="name_id" class="col-sm-2 col-form-label"> Name </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name_id" name="name" value="<?= $row['name']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo_id" class="col-sm-2 col-form-label"> Category </label>
                                    <div class="col-sm-10">
                                      <select class="custom-select" name="category_id">
                                            <option selected>Choose Category</option>
                                            <?php
                                                $sql = "SELECT * FROM categories";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $rows = $stmt->fetchAll();
                                                
                                                $i = 1;
                                                foreach($rows as $res){
                                                    $name = $res['name'];
                                                    if($res['id'] == $row['category_id']){
                                                        ?>
                                                            <option value="<?= $i++; ?>" selected><?= $name; ?></option>
                                                        <?php
                                                    }else{
                                                        ?>
                                                            <option value="<?= $i++; ?>"><?= $name; ?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                      </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="icofont-save"></i>
                                            Update
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

<?php require 'backend_footer.php'; ?>