<div class="col-md-8">
    <div class="card-group">
        
        <div class="card p-4">
            <div class="card-body">
                
                <div class="" style="display:flex;">
                    <h5 class="text-muted">Admin Panel</h5>
                    <ul class="c-header-nav mfs-auto rm-flex">
                        <li class="c-header-nav-item c-d-legacy-none">
                            <button class="c-class-toggler c-header-nav-btn" type="button" id="headertooltip" data-target="body" data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom" title="" data-original-title="Toggle Light/Dark Mode" aria-describedby="tooltip615585">
                            <i class="cil-moon c-icon c-d-dark-none"></i>
                            <i class="cil-sun c-icon c-d-default-none"></i>
                            </button>
                        </li>
                    </ul>
                </div>
                <br>
                <form method="POST" action="<?= base_url()?>access/login">
                    <?php if (isset($error)) { ?>
                        <div class="alert-message"  role="alert">
                            <?= $error; ?>						
                        </div>
                    <?php }?>
                    <!-- <p class="text-muted">.DEV Admin Panel</p> -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="cil-user c-icon"></i>
                            </span>
                        </div>
                        <input class="form-control" type="text" name="username" placeholder="Username">
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="cil-lock-locked c-icon"></i>
                            </span>
                        </div>
                        <input class="form-control" type="password" name="password" placeholder="Password">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary px-4 w-100" type="submit">SIGN IN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>