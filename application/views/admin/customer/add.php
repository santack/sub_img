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
                                <label for="">Type</label>
                                <select class="form-control type"  name="type">
                                    <option class="filter" value="0">New</option>
                                    <option class="filter" value="1">Outlet</option>
                                </select>
                            </div>
                            <div class="form-group" id="user-select" style="display: none;">
                                <label for="">User</label>
                                <select class="form-control customer" name="user_id">
                                    <option class="filter" value="0">Please Select Customer</option>
                                    <?php
                                    foreach ($user as $row) {
                                    ?>
                                    <option class="filter" value="<?= $row['user_id'] ?>"><?= $row['company_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="">Company Name</label>
                                <input type="text" class="form-control company_name" name="company_name" placeholder="Company Name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Company SSM No</label>
                                <input type="text" class="form-control company_ssm_no" name="company_ssm_no" placeholder="Company SSM No" required>
                            </div>
                            <div class="form-group">
                                <label for="">Contact</label>
                                <input type="number" class="form-control contact" name="contact" placeholder="Contact" required>
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control address" name="address" placeholder="Address" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="">URL</label>
                                <input type="url" class="form-control url" name="url" placeholder="URL" required>
                                <small class="smallalert"> * CUSTOMER SHORT NAME FOR BACKEND LOGIN WEBSITE **</small>
                            </div>
                            <?php if ($this->session->userdata("login_data")['role_id'] == 1) { ?>
                                <div class="form-group">
                                    <label for="">Dealer</label>
                                    <select class="form-control dealer_id" name="dealer_id">
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
                                <select class="form-control package_id" name="package_id">
                                    <?php
                                    foreach ($package as $row) {
                                    ?>
                                    <option class="filter" value="<?= $row['package_id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
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

        <script>
            $(document).on("change", ".type", function(e) {
                var val = $(this).val();
                if(val == 1) {
                    $('#user-select').css('display', 'block');
                } else {
                    $('#user-select').css('display', 'none');
                }
            });

            $(document).on("change", ".customer", function(e) {
                var val = $(this).val();
                console.log('val is ' , val);
                if(val != 0) {
                    $.ajax({
                    url:'<?=base_url()?>/customer/get_customer_detail',
                    data: 'user_id='+val,
                    type: "POST",
                    dataType: "json",
                    success:function(data)
                    {
                        $('.company_name').val(data.company_name);
                        $('.company_ssm_no').val(data.company_ssm_no);
                        $('.contact').val(data.contact);
                        $('.address').val(data.address);
                        $('.email').val(data.email);
                        $('.url').val(data.url);
                        $('.dealer_id').val(data.dealer_id);
                        $('.package_id').val(data.package_id);
                    }, 
                    error: function () {
                        console.log("error");
                    }
                });
                }
                
            });
        </script>