<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>role_access">Role Access</a></li>
                <li class="breadcrumb-item active">Role Access Controls</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="c-card">
                <div class="c-cardheader">
                    Role Access
                    <div class="c-cardheader-action">
                        <a class="header-action">
                            <i class="fas fa-angle-down minimize-card"></i>
                        </a>
                    </div>
                </div>
                <div class="c-cardbody">
                    <br>
                    <form method="POST" action="<?= base_url('role_access/edit/' . $role_access[0]['role_id']) ?>">
                        <div class="general-info">
                            <table class="table table-striped table-bordered nowrap dataTable">
                                <thead>
                                    <tr> 
                                        <th>
                                            <div class="c-formgroup">
                                                <input type="text" class="form-filter custom_table_filter" placeholder="Modules" onkeyup="singlePageFilter(this)">
                                            </div>
                                        </th>
                                        <th>Read <input type="checkbox" class="master_check" data-control="r"></th>
                                        <th>Create <input type="checkbox" class="master_check" data-control="c"></th>
                                        <th>Update <input type="checkbox" class="master_check" data-control="u"></th>
                                        <th>Delete <input type="checkbox" class="master_check" data-control="d"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($role_access as $row){
                                    ?>
                                    <tr class="filter_row" data-module="<?= $row['module'] ?>"> 
                                        <td><?= $row['module'] ?>  <input type="checkbox" class="module_check" data-id="<?= $row['module_id'] ?>" <?= ($row['total_access'] == 4)? "checked" : "" ?>></td>
                                        <td><input type="checkbox" class="control_check r_check" data-id="<?= $row['module_id'] ?>" name="<?= $row['role_access_id'] ?>_r_access" value="1" <?= ($row['r_access'] == 1)? "checked" : "" ?>></td>
                                        <td><input type="checkbox" class="control_check c_check" data-id="<?= $row['module_id'] ?>" name="<?= $row['role_access_id'] ?>_c_access" value="1" <?= ($row['c_access'] == 1)? "checked" : "" ?>></td>
                                        <td><input type="checkbox" class="control_check u_check" data-id="<?= $row['module_id'] ?>" name="<?= $row['role_access_id'] ?>_u_access" value="1" <?= ($row['u_access'] == 1)? "checked" : "" ?>></td>
                                        <td><input type="checkbox" class="control_check d_check" data-id="<?= $row['module_id'] ?>" name="<?= $row['role_access_id'] ?>_d_access" value="1" <?= ($row['d_access'] == 1)? "checked" : "" ?>></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end of general info -->
                        <button type="submit" class="btn btn-primary float-right role_access_save_action hidden">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function singlePageFilter(e){
        var filter = $(e).val();
        console.log(filter);
        $(".filter_row").each(function(){
            var text = $(this).data("module");
            if (text.toLowerCase().indexOf(filter) >= 0){
                $(this).removeClass("hidden");
            } else {
                $(this).addClass("hidden");
            }
        });
    }

    $(document).ready(function(){
        $(".master_check").change(function(){
            var control = $(this).data("control");
            if ($(this).is(':checked')) {
                $("." + control + "_check").prop("checked", true);
            } else {
                $("." + control + "_check").prop("checked", false);
            }
        });

        $(".module_check").change(function(){
            var module_id = $(this).data("id");
            if ($(this).is(':checked')) {
                $(".control_check[data-id='" + module_id + "']").prop("checked", true);
            } else {
                $(".control_check[data-id='" + module_id + "']").prop("checked", false);
            }
        });
    });
</script>