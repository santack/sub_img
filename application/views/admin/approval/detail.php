<div class="c-subheader justify-content-between px-3">
	<ol class="breadcrumb border-0 m-0 px-0 px-md-3">
		<li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>customer">Customer</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url() ?>/customer/detail/<?= $customer['user_id']?>">Customer Details</a></li>
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
                        Customer Details
                        <div class="card-header-actions">
                            <a class="card-header-action">
                                <i class="cil-arrow-circle-top c-icon minimize-card"></i>
                            </a>
                            <a class="card-header-action" href="<?php echo site_url('customer/edit') . '/' . $customer['user_id'] ?>">
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
                                                                <th scope="row">Company Name</th>
                                                                <td><?= $customer["company_name"]?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Company SSM No</th>
                                                                <td><?= $customer["company_ssm_no"]?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Contact</th>
                                                                <td><?= $customer["contact"]?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Address</th>
                                                                <td><?= $customer["address"]?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Email</th>
                                                                <td><?= $customer["email"]?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">URL</th>
                                                                <td><?= $customer["url"]?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Package</th>
                                                                <td><?= $customer["package_name"]?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Type</th>
                                                                <td><?= isset($customer['type']) && $customer['type'] == 1 ? "Outlet" : "New" ?></td>
                                                            </tr>
                                                            <!-- <tr>
                                                                <th scope="row">Status</th>
                                                                <td><?= isset($admin['is_active']) && $admin['is_active'] == 1 ? "Active" : "Inactive"?></td>
                                                            </tr> -->
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
       