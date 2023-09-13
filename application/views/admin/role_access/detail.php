<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="c-card">
                <div class="c-cardheaderdetail">
                user Details
                    <div class="c-cardheader-action">
                        <a class="header-action">
                            <i class="fas fa-angle-down minimize-card"></i>
                        </a>
                        <a href="<?= base_url() . 'user/edit/' . $user['user_id'] ?>" class="header-action">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
                <div class="c-cardbody">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <tbody>
                                <tr>
                                    <th scope="row">Created Date</th>
                                    <td><?= $user['created_date'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Name</th>
                                    <td><?= $user['name'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Contact</th>
                                    <td><?= $user['contact'] ?></td>
                                </tr>
                               
                                <tr>
                                    <th scope="row">Email</th>
                                    <td><?= $user['email'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Username</th>
                                    <td><?= $user['username'] ?></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
