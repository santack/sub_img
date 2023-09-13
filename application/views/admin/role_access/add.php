<div class="c-subheader justify-content-between px-3">
	<!-- <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
		<li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>receipt">Receipt</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url() ?>receipt/add">Create New Receipt</a></li>
	</ol> -->
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
                    Create New Role Access
                        <div class="card-header-actions">
                            <a class="card-header-action">
                                <i class="cil-arrow-circle-top c-icon minimize-card"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                    <br>
                    <form action="<?= base_url() . 'role_access/add' ?>" method="post">
                        <?php if (isset($error)){ ?>
                            <div class="alert alert-danger alert-dismissable">
                                <?= $error; ?>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="">Role ID</label>
                            <select name="role_id" class="form-control select2">
                                <?php foreach($role as $row){ ?>
                                <option value="<?= $row['role_id'] ?>"><?= $row['role'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Module ID</label>
                            <select name="module_id" class="form-control select2">
                                <?php foreach($module as $row){ ?>
                                <option value="<?= $row['module_id'] ?>"><?= $row['module'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-customPrimary float-right role_access_save_action hidden">Save</button>
                        </div>
                    </form>
                    </div>
                    
                </div>
            </div>
        </div>