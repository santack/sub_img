<div class="c-subheader justify-content-between px-3">
    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active"><a href="admin">Admin</a></li>
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
                    Admin Details
                    <div class="card-header-actions">
                        <a class="card-header-action">
                            <i class="cil-arrow-circle-top c-icon minimize-card"></i>
                        </a>
                        <?php if ($this->session->userdata("login_data")['role_id'] == 1) { ?>
                            <a class="card-header-action" href="<?= base_url() ?>admin/add">
                                <i class="cil-plus c-icon"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body">
                    <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered datatable dataTable no-footer" style="border-collapse: collapse !important">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc">No.</th>
                                                <th class="sorting">Username</th>
                                                <th class="sorting">Name</th>
                                                <th class="sorting">Role</th>
                                                <!-- <th class="sorting"></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($admin as $row) {
                                            ?>
                                                <tr>
                                                    <td><a href="<?= base_url() ?>admin/edit/<?= $row['admin_id'] ?>"><?= $i ?></a></td>
                                                    <td><a href="<?= base_url() ?>admin/edit/<?= $row['admin_id'] ?>"><?= $row['username'] ?></a></td>
                                                    <td><a href="<?= base_url() ?>admin/edit/<?= $row['admin_id'] ?>"><?= $row['name'] ?></a></td>
                                                    <td><a href="<?= base_url() ?>admin/edit/<?= $row['admin_id'] ?>"><?= $row['role'] ?></a></td>

                                                    <!-- <td><button class="btn btn-danger delete-button" data-id="<?= $row["admin_id"] ?>" data-path="admin"><i class="fa fa-trash"></i> Delete</button></td> -->

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