<div class="c-subheader justify-content-between px-3">
    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>dealer">Dealer</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url() ?>dealer/edit/<?= $admin['admin_id']?>">Edit Dealer
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
                    Edit Dealer Details
                    <div class="card-header-actions">
                        <a class="card-header-action">
                            <i class="cil-arrow-circle-top c-icon minimize-card"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" enctype="multipart/form-data"
                        action="<?= base_url()?>dealer/edit/<?=$admin["admin_id"]?>">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username"
                                value="<?= $admin["username"]?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name"
                                value="<?= $admin["name"]?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <small class="smallalert"> * LEAVE BLANK TO REMIAN OLD PASSWORD **</small>
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
                            <small class="smallalert"> * LEAVE BLANK TO REMIAN OLD PASSWORD **</small>
                        </div>
                        <?php if (isset($error)) { ?>
                        <p style="color: #fe5d70; font-style:italic;"><?= $error; ?> </p>
                        <?php } ?>



                        <div class="form-group">
                            <button class="btn btn-primary float-right" type="submit"> Submit</button>
                        </div>
                    </form>
                </div>

            </div>