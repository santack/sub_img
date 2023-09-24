<style>
/* styles.css */
.input-container {
  display: grid;
  grid-template-columns: repeat(2, 1fr); /* Two columns */
  grid-gap: 10px; /* Add spacing between inputs */
}
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.9);
    z-index: 1;
}

.modal-content {
    display: block;
    margin: 0 auto;
    margin-top: 250px;
    max-width: 750px;
    max-height: 750px;
    object-fit: contain;
    padding: 20px;
}

.close {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 30px;
    color: #fff;
    cursor: pointer;
}

</style>
<div class="c-subheader justify-content-between px-3">
    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active"><a href="report">Report</a></li>
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
                Report Details
                    <div class="card-header-actions">
                        <a class="card-header-action">
                            <i class="cil-arrow-circle-top c-icon minimize-card"></i>
                        </a>
                        <?php if ($this->session->userdata("login_data")['role_id'] == 1) { ?>
                            <a class="card-header-action" href="<?= base_url() ?>admin/add">
                                <i class="cil-plus c-icon"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body">
                    <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <form method="GET" id="filter_form">
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="" class="c-label">Date From</label>
                                    <br>
                                    <input type="date" class="form-control filter" name="dateFrom" value="<?= $dateFrom ?>">
                                </div>
                                <div class="form-group col-3">
                                    <label for="" class="c-label">Date To</label>
                                    <br>
                                    <input type="date" class="form-control filter" name="dateTo" value="<?= $dateTo ?>">
                                </div>

                                <div class="form-group col-3">
                                    <label for="">Status</label>
                                    <select class="form-control filter" name="status">
                                        <option class="filter" value="0" <?php if (isset($status) && $status == 0) echo "selected" ?>>Not Uploaded</option>
                                        <option class="filter" value="1" <?php if (isset($status) && $status == 1) echo "selected" ?>>Uploaded</option>
                                    </select>
                                </div>
                                <?php if ($this->session->userdata("login_data")['role_id'] == 1) {?>
                                    <div class="form-group">
                                        <label for="">Dealer</label>
                                        <select class="form-control filter" name="dealer_id">
                                            <?php
                                            foreach ($dealer as $row) {
                                            ?>
                                           <option class="filter" value="<?= $row['admin_id'] ?>" <?php if (isset($dealer_id) && $row['admin_id'] == $dealer_id) echo "selected" ?>><?= $row['name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                <?php } ?>
                                
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered datatable dataTable no-footer" style="border-collapse: collapse !important">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc">No.</th>
                                                <th class="sorting">Customer Name</th>
                                                <th class="sorting">Package</th>
                                                <th class="sorting" style='width: 20%;'>Images Upload</th>
                                                <!-- <th class="sorting"></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($report as $row) {
                                            ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $row['company_name'] ?></td>
                                                    <td><?= $row['package_name'] ?></td>
                                                    <td>
                                                        <form id="image-upload-form" action="<?= base_url()?>report/add_image" method="POST" enctype="multipart/form-data">
                                                            <div>
                                                                <input type="hidden" name="user_id" value="<?= $row['user_id']?>">
                                                                <input type="file" name="files[]"style="width: 100%" id="image-input" accept="image/*" multiple>
                                                                <input type="submit" style="width:100%;" class="" value="Upload Images">
                                                            </div>
                                                            <!-- <input type="hidden" name="user_id" value="<?= $row['user_id']?>">
                                                            <input type="file" name="files[]" class="form-control" id="image-input" accept="image/*" multiple>
                                                            <input type="submit" class="btn" style="text-align:right" value="Upload Images"> -->
                                                        </form>
                                                        <?php foreach ($row['images'] as $ikey => $image){?>
                                                            <div style="padding-top: 10px;">
                                                                <!-- <a href="" class="img" id="<?= $image['image_true'] ?>">Image <?= $ikey +1 ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                                                                <img id="img-<?= $image["report_image_id"]?>" data-id="<?= $image["report_image_id"]?>" class="img" style="width: 100px; height: 50px; margin-top:5px;"src="<?= $image['image_true'] ?>" alt="">
                                                                <button style=" margin-top:5px;" class="btn btn-danger delete-button" data-id="<?= $image["report_image_id"] ?>" data-path="report_image"><i class="fa fa-trash"></i> Delete</button>
                                                            </div>
                                                           
                                                            <br>
                                                        <?php } ?>
                                                    </td>
                                                  

                                                    <!-- <td><button class="btn btn-danger delete-button" data-id="<?= $row["admin_id"] ?>" data-path="admin"><i class="fa fa-trash"></i> Delete</button></td> -->

                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div id="imageModal" class="modal">
                                        <span class="close">&times;</span>
                                        <img class="modal-content" id="modalImage">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

<script>
$(document).ready(function() {
    // $(document).on("click", ".img", function(e) {
    //     var dataId = $(this).data("id");
      
    //     // Display the value in the console (you can use it as needed)
    //     console.log("data-id: " + dataId);
    //     $(this).css({ // resize the image
    //         height: '1000px',
    //         width: '1000px'
    //     });
    // });
    $(document).on("change", ".filter", function(e) {
        $('#filter_form').submit();
    });
    $(".img").click(function (e) {
        e.preventDefault();
        var imgSrc = $(this).attr("src");
        $("#modalImage").attr("src", imgSrc);
        $("#imageModal").css("display", "block");
    });

    // Click event handler for modal close button
    $(".close").click(function () {
        $("#imageModal").css("display", "none");
    });

    // Click event handler to close modal when clicking outside the modal content
    $(window).click(function (event) {
        if (event.target == document.getElementById("imageModal")) {
            $("#imageModal").css("display", "none");
        }
    });
});
</script>