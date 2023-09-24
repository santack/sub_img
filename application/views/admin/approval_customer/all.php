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
                                    <label for="">Status</label>
                                    <select class="form-control filter" name="status">
                                        <option class="filter" value="1" <?php if (isset($status) && $status == 1) echo "selected" ?>>Active</option>
                                        <option class="filter" value="0" <?php if (isset($status) && $status == 0) echo "selected" ?>>Inactive</option>
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
                                                <th class="sorting">End Date</th>
                                                <th class="sorting">Expired Date</th>
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
                                                    <td><?= $row['company_name'] ?></td>
                                                    <td><?= $row['package_name'] ?></td>
                                                    <td>
                                                        <form role="form" method="POST" enctype="multipart/form-data" action="<?= base_url()?>approved_customer/edit/<?=$row["user_id"]?>">
                                                            <input type="date" id="created_date" name="created_date" value="<?= date('Y-m-d', strtotime(str_replace('-','/', $row['created_date'])))?>">
                                                            <input type="submit">
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form role="form" method="POST" enctype="multipart/form-data" action="<?= base_url()?>approved_customer/edit/<?=$row["user_id"]?>">
                                                            <input type="date" id="end_date" name="end_date" value="<?= $row['end_date']?>">
                                                            <input type="submit">
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form role="form" method="POST" enctype="multipart/form-data" action="<?= base_url()?>approved_customer/edit/<?=$row["user_id"]?>">
                                                            <input type="date" id="expired_date" name="expired_date" value="<?= $row['expired_date']?>">
                                                            <input type="submit">
                                                        </form>
                                                    </td>
                                                    <td><?= $row['is_active'] == 1 ? 'Active' : 'Inactive' ?></td>
                                                    <td><a href="<?= base_url() ?>approved_customer/renew/<?= $row['user_id'] ?>">Renew</a></td>
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