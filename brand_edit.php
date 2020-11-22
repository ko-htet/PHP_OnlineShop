<?php
    require 'backend_header.php';
    require 'db_connect.php';
    
    $id = $_GET['eid'];

    $sql = "SELECT * FROM brands WHERE id = :v1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
?>
    
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Edit Brand Form </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="brand_list.php" class="btn btn-outline-primary">
                        <i class="icofont-double-left"></i>
                    </a>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <form action="brand_update.php" method="POST" enctype="multipart/form-data">
                                
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <input type="hidden" name="oldphoto" value="<?= $row['photo']; ?>">
                                <div class="form-group row">
                                    <label for="name_id" class="col-sm-2 col-form-label"> Name </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name_id" name="name" value="<?= $row['name']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo_id" class="col-sm-2 col-form-label"> Photo </label>
                                    <div class="col-sm-10">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Old Photo</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">New Photo</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <img src="<?= $row['photo']; ?>" alt="" class="img-fluid mt-2">
                                            </div>
                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                <input type="file" class="mt-2" name="newphoto">
                                            </div>
                                        </div>
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