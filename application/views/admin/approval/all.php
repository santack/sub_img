<div class="c-subheader justify-content-between px-3">
    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active"><a href="customer">Customer</a></li>
    </ol>
    <!-- <div class="c-subheader-nav d-md-down-none mfe-2">
		<a class="c-subheader-nav-link" href="#">
			<i class="cil-settings c-icon"></i>
			&nbsp;Settings
		</a>
	</div> -->
</div>
<main class="c-main">

    <div class="container-fluid">

        <div class="fade-in">
            <div class="card">
                <div class="card-header">
                Customer Details
                    <div class="card-header-actions">
                        <a class="card-header-action">
                            <i class="cil-arrow-circle-top c-icon minimize-card"></i>
                        </a>
                      
                        <a class="card-header-action" href="<?= base_url() ?>customer/add">
                            <i class="cil-plus c-icon"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <form method="GET" id="filter_form">
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="" class="c-label">Date From</label>
                                    <br>
                                    <input type="date" class="form-control filter" name="dateFrom" value="<?= $dateFrom ?>">
                                </div>
                                <div class="form-group col-3">
                                    <label for="" class="c-label">Date To</label>
                                    <br>
                                    <input type="date" class="form-control filter" name="dateTo" value="<?= $dateTo ?>">
                                </div>

                                <div class="form-group col-3">
                                    <label for="">Status</label>
                                    <select class="form-control filter" name="status">
                                        <option class="filter" value="0" <?php if (isset($status) && $status == 0) echo "selected" ?>>Pending</option>
                                        <option class="filter" value="1" <?php if (isset($status) && $status == 1) echo "selected" ?>>Approve</option>
                                        <option class="filter" value="2" <?php if (isset($status) && $status == 2) echo "selected" ?>>Reject</option>
                                        <option class="filter" value="3" <?php if (isset($status) && $status == 3) echo "selected" ?>>Renew</option>
                                    </select>
                                </div>
                                
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered datatable dataTable no-footer" style="border-collapse: collapse !important">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc">No.</th>
                                                <th class="sorting">Dealer Name</th>
                                                <th class="sorting">Customer Name</th>
                                                <th class="sorting">Package</th>
                                                <th class="sorting">Start Date</th>
                                                <th class="sorting">New/ Outlet</th>
                                                <th class="sorting">Status</th>
                                                <th class="sorting">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($customer as $row) {
                                            ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $row['dealer_name'] ?></td>
                                                    <td><?= $row['name'] ?></td>
                                                    <td><?= $row['package_name'] ?></td>
                                                    <td><?= $row['created_date'] ?></td>
                                                    <td><?= isset($row['type']) && $row['type'] == 1 ? "Outlet" : "New" ?></td>
                                                    <td><?= $row['status'] ?></td>
                                                    <?php if ($row['user_status'] == 0) {?>
                                                        <td><a href="<?= base_url() ?>approval/approve/<?= $row['user_id'] ?>">Approve</a> | <a href="<?= base_url() ?>approval/reject/<?= $row['user_id'] ?>">Reject</a></td>
                                                    <?php } else {?>
                                                        <td>-</td>
                                                    <?php } ?>
                                                    <!-- <td><a href="<?= base_url() ?>customer/edit/<?= $row['user_id'] ?>"><?= isset($row['is_active']) && $row['is_active'] == 1 ? "Active" : "Inactive" ?></a></td> -->

                                                    <!-- <td><button class="btn btn-danger delete-button" data-id="<?= $row["user_id"] ?>" data-path="admin"><i class="fa fa-trash"></i> Delete</button></td> -->

                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <script>
                $(document).on("change", ".filter", function(e) {
                    $('#filter_form').submit();
                });
            </script>