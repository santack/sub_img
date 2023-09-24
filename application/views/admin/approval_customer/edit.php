<div class="c-subheader justify-content-between px-3">
    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>customer">Customer</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url() ?>customer/edit/<?= $customer['user_id']?>">Edit Customer
                Details</a></li>
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
                    Edit Customer Details
                    <div class="card-header-actions">
                        <a class="card-header-action">
                            <i class="cil-arrow-circle-top c-icon minimize-card"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" enctype="multipart/form-data"
                        action="<?= base_url()?>approval_customer/edit/<?=$customer["user_id"]?>">
                        <div class="form-group">
                            <label for="">Company Name</label>
                            <input type="text" class="form-control" name="company_name" placeholder="Company Name" value="<?= $customer["company_name"]?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Company SSM No</label>
                            <input type="text" class="form-control" name="company_ssm_no" placeholder="Company SSM No" value="<?= $customer["company_ssm_no"]?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Contact</label>
                            <input type="number" class="form-control" name="contact" placeholder="Contact" value="<?= $customer["contact"]?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Address" value="<?= $customer["address"]?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $customer["email"]?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">URL</label>
                            <input type="url" class="form-control" name="url" placeholder="URL" value="<?= $customer["url"]?>" required>
                            <small class="smallalert"> * CUSTOMER SHORT NAME FOR BACKEND LOGIN WEBSITE **</small>
                        </div>

                        <?php if ($this->session->userdata("login_data")['role_id'] == 1) { ?>
                            <div class="form-group">
                                <label for="">Dealer</label>
                                <select class="form-control filter" name="dealer_id">
                                    <?php
                                    foreach ($dealer as $row) {
                                    ?>
                                    <option class="filter" value="<?= $row['admin_id'] ?>" <?php if (isset($customer['dealer_id']) && $row['admin_id'] == $customer['dealer_id']) echo "selected" ?>><?= $row['name'] ?></option>
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
                                <option class="filter" value="<?= $row['package_id'] ?>"  <?php if (isset($customer['package_id']) && $row['package_id'] == $customer['package_id']) echo "selected" ?>><?= $row['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Type</label>
                            <select class="form-control filter" name="type">
                                <option class="filter" value="0" <?php if (isset($customer["type"]) && 0 == $customer["type"]) echo "selected" ?>>New</option>
                                <option class="filter" value="1" <?php if (isset($customer["type"]) && 1 == $customer["type"]) echo "selected" ?>>Outlet</option>
                            </select>
                        </div>
                        <?php if (isset($error)) { ?>
                        <p style="color: #fe5d70; font-style:italic;"><?= $error; ?> </p> <?php if (isset($ad_id) && $row['admin_id'] == $ad_id) echo "selected" ?>
                        <?php } ?>



                        <div class="form-group">
                            <button class="btn btn-primary float-right" type="submit"> Submit</button>
                        </div>
                    </form>
                </div>

            </div>