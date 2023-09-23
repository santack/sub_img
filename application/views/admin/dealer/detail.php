<div class="c-subheader justify-content-between px-3">
	<ol class="breadcrumb border-0 m-0 px-0 px-md-3">
		<li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>dealer">Dealer</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url() ?>/dealer/detail/<?= $admin['admin_id']?>">Dealer Details</a></li>
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
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="c-card-header">
                        Dealer Details
                        <div class="card-header-actions">
                            <a class="card-header-action">
                                <i class="cil-arrow-circle-top c-icon minimize-card"></i>
                            </a>
                            <a class="card-header-action" href="<?php echo site_url('dealer/edit') . '/' . $admin['admin_id'] ?>">
                                <i class="cil-pencil c-icon"></i>
                            </a>
                        </div>
                    </div>
                    <div class="c-card-body">
                        <div class="view-info">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="general-info">
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table m-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">Usename</th>
                                                                <td><?= $admin["username"]?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Name</th>
                                                                <td><?= $admin["name"]?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Status</th>
                                                                <td><?= isset($admin['is_active']) && $admin['is_active'] == 1 ? "Active" : "Inactive"?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       