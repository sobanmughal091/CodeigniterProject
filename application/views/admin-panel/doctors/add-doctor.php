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
                                <h4 class="card-title">Add Doctor</h4>
                                <form method="POST" name="adddoctorform" id="adddoctorform"
                                    action="<?= base_url('create-doctor')  ?>">
                                    <div class="form-group">
                                        <label for="doctor_name">Doctor Name</label>
                                        <input type="text" class="form-control" value="<?= set_value('patient_name') ?>"
                                            name="doctor_name" id="doctor_name" placeholder="Doctor Name">
                                        <?= form_error('doctor_name') ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <input id="department" type="text" name="department" class="form-control"
                                            value="<?= set_value('department') ?>" placeholder="Department">
                                        <?= form_error('department') ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_time">Start Timing</label>
                                        <input id="datetimepicker_start" type="text" name="start_time"
                                            value="<?= set_value('start_time') ?>">
                                        <?= form_error('start_time') ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_time">End Timing</label>
                                        <input id="datetimepicker_end" type="text" name="end_time"
                                            value="<?= set_value('end_time') ?>">
                                        <?= form_error('end_time') ?>
                                    </div>
                                    <input type="submit" name="submit" class="btn btn-primary me-2" value="Submit">
                                    <a href="<?= base_url('doctors-list') ?>" class="btn btn-dark">Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('admin-panel/partials/footer'); ?>