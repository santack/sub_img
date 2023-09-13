
<div class="c-subheader justify-content-between px-3">
	<ol class="breadcrumb border-0 m-0 px-0 px-md-3">
		<li class="breadcrumb-item">Home</li>
		<li class="breadcrumb-item active"><a href="#">Role Access</a></li>
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
            Role Access
                <div class="card-header-actions">
                    <a class="card-header-action">
                        <i class="cil-arrow-circle-top c-icon minimize-card"></i>
                    </a>
                    <a href="<?= base_url() . 'role_access/add' ?>" class="header-action">
                    <i class="fas fa-plus-circle"></i>
                </a>
                </div>
            </div>
            <div class="card-body">
                <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <br>
                <form method="GET" id="filter_form">
                <div class="row">
                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
                        <label for="" class="c-label">Role</label>
                        <select class="form-control select2 filter_input" name="role_id">
                        <?php foreach($role as $row){ ?>
                            <option value="<?= $row['role_id'] ?>" <?php if($row['role_id'] == $role_id){ ?> selected <?php } ?>>
                                <?= $row['role'] ?> 
                            </option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                </form>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered datatable dataTable no-footer" id="role_access_list_table" data-method="get" data-url="<?= base_url() ?>role_access" style="border-collapse: collapse !important">
                        <thead>
                            <tr role="row">
                                <th class="" data-sort="role" data-filter="role">Role</th>
                                <th class="" data-sort="module" data-filter="module">Module</th>
                                <th class="">Read Control</th>
                                <th class="">Save Control</th>
                                <th class="">Delete Control</th>
                                <th class="">Create Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($access as $row){ 
                                
                                ?>
                                <tr>
                                    <td><?= $row['role'] ?></td>
                                    <td><?= $row['module'] ?></td>
                                    <td>
                                        <?php if($row['read_control'] == 1){ ?>
                                            <a href="<?= base_url() ?>role_access/unset_active/<?= $row['role_access_id']?>/read_control/<?= $page_id ?>" class="btn btn-success">YES</a>
                                        <?php } else { ?>
                                            <a href="<?= base_url() ?>role_access/set_active/<?= $row['role_access_id']?>/read_control/<?= $page_id ?>" class="btn btn-warning" >NO</a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($row['update_control'] == 1){ ?>
                                            <a href="<?= base_url() ?>role_access/unset_active/<?= $row['role_access_id']?>/update_control/<?= $page_id ?>" class="btn btn-success">YES</a>
                                        <?php } else { ?>
                                            <a href="<?= base_url() ?>role_access/set_active/<?= $row['role_access_id']?>/update_control/<?= $page_id ?>" class="btn btn-warning" >NO</a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($row['delete_control'] == 1){ ?>
                                            <a href="<?= base_url() ?>role_access/unset_active/<?= $row['role_access_id']?>/delete_control/<?= $page_id ?>" class="btn btn-success">YES</a>
                                        <?php } else { ?>
                                            <a href="<?= base_url() ?>role_access/set_active/<?= $row['role_access_id']?>/delete_control/<?= $page_id ?>" class="btn btn-warning" >NO</a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($row['create_control'] == 1){ ?>
                                            <a href="<?= base_url() ?>role_access/unset_active/<?= $row['role_access_id']?>/create_control/<?= $page_id ?>" class="btn btn-success">YES</a>
                                        <?php } else { ?>
                                            <a href="<?= base_url() ?>role_access/set_active/<?= $row['role_access_id']?>/create_control/<?= $page_id ?>" class="btn btn-warning" >NO</a>
                                        <?php } ?>
                                    </td>
                                    <!-- <td>
                                        <?php if($row['export_action'] == 1){ ?>
                                            <a href="<?= base_url() ?>role_access/unset_active/<?= $row['role_access_id']?>/export_action/<?= $page_id ?>" class="btn btn-success">YES</a>
                                        <?php } else { ?>
                                            <a href="<?= base_url() ?>role_access/set_active/<?= $row['role_access_id']?>/export_action/<?= $page_id ?>" class="btn btn-warning" >NO</a>
                                        <?php } ?>
                                    </td> -->
                                </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    <div class="custom_pagination" id="role_access_list_page" data-table="role_access_list_table" data-method="get" data-url="<?= base_url() ?>role_access">
                        <?= $page ?>
                    </div>
                </div>
            </div>
                    
                </div>
            </div>
        </div>

<script>

$(document).on("change", ".filter_input", function (e) {
    $('#filter_form').submit();
});

</script>