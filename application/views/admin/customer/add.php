<div class="c-subheader justify-content-between px-3">
	<ol class="breadcrumb border-0 m-0 px-0 px-md-3">
		<li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>customer">Customer</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url() ?>customer/add">Create New Customer</a></li>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Create New Customer
                        <div class="card-header-actions">
                            <a class="card-header-action">
                                <i class="cil-arrow-circle-top c-icon minimize-card"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" enctype="multipart/form-data" action="<?= base_url()?>customer/add">
                            <div class="form-group">
                                <label for="">Company Name</label>
                                <input type="text" class="form-control" name="company_name" placeholder="Company Name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Company SSM No</label>
                                <input type="text" class="form-control" name="company_ssm_no" placeholder="Company SSM No" required>
                            </div>
                            <div class="form-group">
                                <label for="">Contact</label>
                                <input type="number" class="form-control" name="contact" placeholder="Contact" required>
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Address" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="">URL</label>
                                <input type="url" class="form-control" name="url" placeholder="URL" required>
                                <small class="smallalert"> * CUSTOMER SHORT NAME FOR BACKEND LOGIN WEBSITE **</small>
                            </div>
                            <?php if ($this->session->userdata("login_data")['role_id'] == 1) { ?>
                                <div class="form-group">
                                    <label for="">Dealer</label>
                                    <select class="form-control filter" name="dealer_id">
                                        <?php
                                        foreach ($dealer as $row) {
                                        ?>
                                        <option class="filter" value="<?= $row['admin_id'] ?>"><?= $row['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label for="">Package</label>
                                <select class="form-control filter" name="package_id">
                                    <?php
                                    foreach ($package as $row) {
                                    ?>
                                    <option class="filter" value="<?= $row['package_id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Type</label>
                                <select class="form-control filter" name="type">
                                    <option class="filter" value="0">New</option>
                                    <option class="filter" value="1">Outlet</option>
                                </select>
                            </div>

                            <?php if (isset($error)) { ?>
                                <p style="color: #fe5d70; font-style:italic;"><?= $error; ?>	</p>					
                            <?php } ?>
                            
                            <div class="form-group">
                                <button class="btn btn-primary float-right" type="submit"> Submit</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>