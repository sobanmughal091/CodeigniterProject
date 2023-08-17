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
                                    <h4 class="card-title">Edit Patient Bill</h4>
                                    <form method="POST" name="editpatientbillform" id="editpatientbillform" action="<?= base_url('update-bill/') . $bill->id  ?>">
                                        <div class="form-group">
                                            <label for="patient_name">Patient Name</label>
                                            <input type="text" class="form-control" name="patient_name" id="patient_name" value="<?= set_value('patient_name', $bill->patient_name) ?>" placeholder="Patient Name">
                                            <?= form_error('patient_name') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="net_total">Net Total</label>
                                            <input type="number" class="form-control" name="net_total" id="net_total" value="<?= set_value('net_total', $bill->total_charges) ?>" placeholder="Net total">
                                            <?= form_error('net_total') ?>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary me-2">Submit</button>
                                        <a href="<?= base_url('bill-list') ?>" class="btn btn-dark">Back</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('admin-panel/partials/footer'); ?>