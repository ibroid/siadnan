<div class="page-body">
    <?= $this->load->component('page_title', compact('breadcumb', 'page_name')) ?>
    <div class="container-fluid">
        <?= $this->session->flashdata('flash_alert') ?>
        <?= $this->session->flashdata('flash_error') ?>
    </div>
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-xl-7">
                        <form accept="<?= base_url('referensi/add_pengajuan') ?>" class="row g-3 needs-validation mega-inline card" novalidate="" method="POST" enctype="multipart/form-data">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Persyaratan Untuk <?= $pengajuan->nama_pengajuan ?></h4>
                                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="list-group" id="list-tab" role="tablist">
                                            <a class="list-group-item list-group-item-action list-hover-primary " id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home" aria-selected="true">Home</a>
                                            <a class="list-group-item list-group-item-action list-hover-primary" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile" aria-selected="false" tabindex="-1">Profile</a>
                                            <a class="list-group-item list-group-item-action list-hover-primary" id="list-messages-list" data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages" aria-selected="false" tabindex="-1">Contact Us</a>
                                            <a class="list-group-item list-group-item-action list-hover-primary" id="list-settings-list" data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings" aria-selected="false" tabindex="-1">Settings</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade list-behaviors active show" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                                <div class="d-flex mb-xl-4 list-behavior-1">
                                                    <div class="flex-shrink-0"><img class="tab-img img-fluid" src="../assets/images/blog/img.png" alt="home"></div>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-xl-0 mb-sm-4">We provide end to end digital solutions, right from designing your website/application development: Domain, Web Hosting, Email Hosting Registration, Search Engine Optimization and other Internet Marketing, Renewal of Services timely and effectively.</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex list-behavior-1 mb-xl-4">
                                                    <div class="flex-shrink-0"><img class="tab-img img-fluid" src="../assets/images/blog/blog.jpg" alt="home"></div>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-0">When someone visits your homepage, your design should inspire them to stay. Therefore, your value proposition should be established on the homepage for visitors to select to stay on your website.Building trust, expressing value, and guiding visitors to the next step all depend on a page's design.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade dark-list" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                                                <div class="flex-space align-items-center list-light-dark contact-profile"><img class="tab-img" src="../assets/images/avtar/3.jpg" alt="profile">
                                                    <ul class="d-flex flex-column gap-2">
                                                        <li> <strong>Visit Us: </strong> 2600 Hollywood Blvd,Florida, United States- 33020</li>
                                                        <li><strong>Mail Us:</strong>contact@us@gmail.com</li>
                                                        <li><strong>Contact Number: </strong>(954) 357-7760</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                                                <ul class="d-flex flex-column gap-1">
                                                    <li>Us Technology offers web &amp; mobile development solutions for all industry verticals.Include a short form using fields that'll help your business understand who's contacting them.</li>
                                                    <li> <strong>Visit Us: </strong> 2600 Hollywood Blvd,Florida, United States- 33020</li>
                                                    <li> <strong>Mail Us:</strong>contact@us@gmail.com</li>
                                                    <li><strong>Contact Number: </strong>(954) 357-7760</li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                                                <ul class="d-flex flex-column gap-2">
                                                    <li><strong>Available pages in Theme: </strong></li>
                                                    <li>
                                                        --&gt; Typography:
                                                        Typography is the art of arranging letters and text in a way that makes the copy legible, clear, and visually appealing to the reader.
                                                    </li>
                                                    <li>
                                                        --&gt; Tooltip:
                                                        A tooltip is a brief, informative message that appears when a user interacts with an element in a graphical user interface (GUI).
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <a class="btn btn-secondary" href="<?= base_url('referensi/pengajuan') ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button class="btn btn-primary" type="submit">Simpan <i class="fa fa-save"></i></button>
                            </div>
                        </form>
                        <br><br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>