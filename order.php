<?php
    require 'backend_header.php';
    require 'db_connect.php';

    $pending = "Order";
    $confirm = "Confirm";
    $cancel = "Cancel";

    $sql = "SELECT * FROM orders WHERE status = :v1 ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $pending);
    $stmt->execute();
    $pending_orders = $stmt->fetchAll();

    $sql = "SELECT * FROM orders WHERE status = :v1 ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $confirm);
    $stmt->execute();
    $confirm_orders = $stmt->fetchAll();

    $sql = "SELECT * FROM orders WHERE status = :v1 ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $cancel);
    $stmt->execute();
    $cancel_orders = $stmt->fetchAll();

?>
    
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Order </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a href="#nav-pending" class="nav-link active" id="nav-pending-tab" 
                                    data-toggle="tab" role="tab" aria-controls="nav-pending" aria-selected="true"> 
                                    Order - Pending </a>
                                    <a href="#nav-confirm" class="nav-link" id="nav-confirm-tab" 
                                    data-toggle="tab" role="tab" aria-controls="nav-confirm" aria-selected="false"> 
                                    Order - Confirm </a>
                                    <a href="#nav-cancel" class="nav-link" id="nav-cancel-tab" 
                                    data-toggle="tab" role="tab" aria-controls="nav-cancel" aria-selected="false"> 
                                    Order - Cancel </a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active py-4" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Voucher No</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i = 1;
                                                    foreach($pending_orders as $pending_order){
                                                ?>
                                                <tr>
                                                    <td> <?= $i++; ?>. </td>
                                                    <td> <?= $pending_order['orderdate']; ?> </td>
                                                    <td> <?= $pending_order['voucherno']; ?> </td>
                                                    <td> <?= $pending_order['total']; ?> </td>
                                                    <td> <?= $pending_order['status']; ?> </td>
                                                    <td>
                                                        <a href="orderdetail.php?voucherno=<?= $pending_order['voucherno']; ?>" class="btn btn-outline-info">
                                                            <i class="icofont-info"></i>
                                                        </a>
                                                        <a href="orderconfirm.php?id=<?= $pending_order['id']; ?>" class="btn btn-outline-success">
                                                            <i class="icofont-check"></i>
                                                        </a>
                                                        <a href="ordercancel.php?id=<?= $pending_order['id']; ?>" class="btn btn-outline-danger">
                                                            <i class="icofont-close"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade py-4" id="nav-confirm" role="tabpanel" aria-labelledby="nav-confirm-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Voucher No</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i = 1;
                                                    foreach($confirm_orders as $confirm_order){
                                                ?>
                                                <tr>
                                                    <td> <?= $i++; ?>. </td>
                                                    <td> <?= $confirm_order['orderdate']; ?> </td>
                                                    <td> <?= $confirm_order['voucherno']; ?> </td>
                                                    <td> <?= $confirm_order['total']; ?> </td>
                                                    <td> <?= $confirm_order['status']; ?> </td>
                                                    <td>
                                                        <a href="orderdetail.php?voucherno=<?= $confirm_order['voucherno']; ?>" class="btn btn-outline-info">
                                                            <i class="icofont-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade py-4" id="nav-cancel" role="tabpanel" aria-labelledby="nav-cancel-tab">
                                <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Voucher No</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i = 1;
                                                    foreach($cancel_orders as $cancel_order){
                                                ?>
                                                <tr>
                                                    <td> <?= $i++; ?>. </td>
                                                    <td> <?= $cancel_order['orderdate']; ?> </td>
                                                    <td> <?= $cancel_order['voucherno']; ?> </td>
                                                    <td> <?= $cancel_order['total']; ?> </td>
                                                    <td> <?= $cancel_order['status']; ?> </td>
                                                    <td>
                                                        <a href="orderdetail.php?voucherno=<?= $cancel_order['voucherno']; ?>" class="btn btn-outline-info">
                                                            <i class="icofont-info"></i>
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
                </div>
            </div>

<?php require 'backend_footer.php'; ?>