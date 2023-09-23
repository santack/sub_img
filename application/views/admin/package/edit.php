<div class="c-subheader justify-content-between px-3">
    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>package">Package</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url() ?>package/edit/<?= $package['package_id']?>">Edit Package
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
                    Edit Package Details
                    <div class="card-header-actions">
                        <a class="card-header-action">
                            <i class="cil-arrow-circle-top c-icon minimize-card"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" enctype="multipart/form-data"
                        action="<?= base_url()?>package/edit/<?=$package["package_id"]?>">
                        <div class="form-group">
                            <label for="">Package Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Package Name"
                                value="<?= $package["name"]?>" required>
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