<?php $this->load->view('admin-panel/partials/header');    ?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
        <div class="theme-setting-wrapper">
            <div id="settings-trigger"><i class="ti-settings"></i></div>
            <div id="theme-settings" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <p class="settings-heading">SIDEBAR SKINS</p>
                <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                    <div class="img-ss rounded-circle bg-light border me-3"></div>Light
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
                </div>
                <p class="settings-heading mt-2">HEADER SKINS</p>
                <div class="color-tiles mx-0 px-4">
                    <div class="tiles success"></div>
                    <div class="tiles warning"></div>
                    <div class="tiles danger"></div>
                    <div class="tiles info"></div>
                    <div class="tiles dark"></div>
                    <div class="tiles default"></div>
                </div>
            </div>
        </div>
        <?php $this->load->view('admin-panel/partials/sidebar');  ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add Inpatient</h4>
                                <form method="POST" name="addinpatientform" id="addinpatientform"
                                    action="<?= base_url('create-inpatient')  ?>">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" value="<?= set_value('first_name') ?>"
                                            name="first_name" id="first_name" placeholder="First Name">
                                        <?= form_error('first_name') ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" value="<?= set_value('last_name') ?>"
                                            name="last_name" id="last_name" placeholder="Last Name">
                                        <?= form_error('last_name') ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input id="mobile" type="text" name="mobile" class="form-control"
                                            value="<?= set_value('mobile') ?>" placeholder="Mobile">
                                        <?= form_error('mobile') ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input id="address" type="text" name="address" class="form-control"
                                            value="<?= set_value('address') ?>">
                                        <?= form_error('address') ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label><br>
                                        <div class="d-inline">
                                            <input type="radio" id="statusActive" name="status" checked="" value="1">
                                            <label for="statusActive">Active
                                            </label>
                                        </div>
                                        <div class="d-inline">
                                            <input type="radio" id="statusInactive" name="status" value="0">
                                            <label for="statusBlock">Inactive
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="room_no">Room No</label>
                                        <input id="room_no" type="text" name="room_no" class="form-control"
                                            value="<?= set_value('room_no') ?>">
                                        <?= form_error('room_no') ?>
                                    </div>
                                    <input type="submit" name="submit" class="btn btn-primary me-2" value="Submit">
                                    <a href="<?= base_url('inpatients-list') ?>" class="btn btn-dark">Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('admin-panel/partials/footer'); ?>