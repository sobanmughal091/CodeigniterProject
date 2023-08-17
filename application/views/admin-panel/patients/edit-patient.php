<?php $this->load->view('admin-panel/partials/header');    ?>
<div class="container-scroller">
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
                                    <h4 class="card-title">Patient Registeration form</h4>
                                    <form method="POST" name="editpatientform" id="editpatientform"
                                        action="<?= base_url('update-patient/' . $patient->id)  ?>">
                                        <div class="form-group">
                                            <label for="firstname">First Name</label>
                                            <input type="text" class="form-control"
                                                value="<?= set_value('firstname', $patient->first_name) ?>"
                                                name="firstname" id="firstname" placeholder="First Name">
                                            <?= form_error('firstname') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" class="form-control"
                                                value="<?= set_value('lastname', $patient->last_name) ?>"
                                                name="lastname" id="lastname" placeholder="Last Name">
                                            <?= form_error('lastname') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control"
                                                value="<?= set_value('email', $patient->email) ?>" name="email"
                                                id="email" placeholder="Email">
                                            <?= form_error('email') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="number" class="form-control"
                                                value="<?= set_value('mobile', $patient->mobile) ?>" name="mobile"
                                                id="mobile" placeholder="Mobile">
                                            <?= form_error('mobile') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="id-card">ID Card</label>
                                            <input type="number" class="form-control"
                                                value="<?= set_value('id-card', $patient->id_card) ?>" name="id-card"
                                                id="id-card" placeholder="ID Card">
                                            <?= form_error('id-card') ?>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary me-2">Submit</button>
                                        <a href="<?= base_url('patients-list') ?>" class="btn btn-dark">Back</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('admin-panel/partials/footer'); ?>