<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h3>Selamat Datang di Sistem Administrasi untuk Pengajuan</h3>
          <!-- <?= $pengaturan->ptb ?> -->
        </div>
        <div class="col-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">
                <svg class="stroke-icon">
                  <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                </svg></a></li>
            <li class="breadcrumb-item">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <?php if ($admin) { ?>
    <div class="container-fluid">
      <div class="row started-main">

        <div class="col-sm-3">
          <div class="card course-box widget-course">
            <div class="card-body">
              <div class="course-widget">
                <div class="course-icon">
                  <svg class="fill-icon">
                    <use href="../assets/svg/icon-sprite.svg#course-1"></use>
                  </svg>
                </div>
                <div>
                  <h4 class="mb-0">Total : <?= $berkas->where("status", null)->count() ?>
                  </h4><span class="f-light">Berkas Belum Diperiksa</span><a class="btn btn-light f-light" href="<?= base_url("/pemeriksaan") ?>">Tinjau Sekarang<span class="ms-2">
                      <svg class="fill-icon f-light">
                        <use href="../assets/svg/icon-sprite.svg#arrowright"></use>
                      </svg></span></a>
                </div>
              </div>
            </div>
            <ul class="square-group">
              <li class="square-1 warning"></li>
              <li class="square-1 primary"></li>
              <li class="square-2 warning1"></li>
              <li class="square-3 danger"></li>
              <li class="square-4 light"></li>
              <li class="square-5 warning"></li>
              <li class="square-6 success"></li>
              <li class="square-7 success"></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card course-box widget-course">
            <div class="card-body">
              <div class="course-widget">
                <div class="course-icon warning">
                  <svg class="fill-icon">
                    <use href="../assets/svg/icon-sprite.svg#course-2"></use>
                  </svg>
                </div>
                <div>
                  <h4 class="mb-0">Total : <?= $pengajuans->where("status", 1)->count() ?></h4><span class="f-light">Belum Lengkap</span><a class="btn btn-light f-light" href="<?= base_url("/pemeriksaan") ?>">Lanjut Tinjau<span class="ms-2">
                      <svg class="fill-icon f-light">
                        <use href="../assets/svg/icon-sprite.svg#arrowright"></use>
                      </svg></span></a>
                </div>
              </div>
            </div>
            <ul class="square-group">
              <li class="square-1 warning"></li>
              <li class="square-1 primary"></li>
              <li class="square-2 warning1"></li>
              <li class="square-3 danger"></li>
              <li class="square-4 light"></li>
              <li class="square-5 warning"></li>
              <li class="square-6 success"></li>
              <li class="square-7 success"></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-header card-no-border">
              <div class="header-top">
                <h5>Total Pengabulan</h5>
                <div class="dropdown icon-dropdown">
                  <button class="btn dropdown-toggle" id="userdropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown"><a class="dropdown-item" href="#">Weekly</a><a class="dropdown-item" href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a></div>
                </div>
              </div>
            </div>
            <div class="card-body py-lg-3">
              <ul class="user-list">
                <li>
                  <div class="user-icon primary">
                    <div class="user-box"><i class="font-primary" data-feather="user-plus"></i></div>
                  </div>
                  <div>
                    <h5 class="mb-1"><?= $pengajuans->where("status", 4)->count() ?> Pengajuan</h5><span class="font-primary d-flex align-items-center"><i class="icon-arrow-up icon-rotate me-1"> </i><span class="f-w-500">Dikabulkan</span></span>
                  </div>
                </li>
                <li>
                  <div class="user-icon success">
                    <div class="user-box"><i class="font-success" data-feather="user-minus"></i></div>
                  </div>
                  <div>
                    <h5 class="mb-1"><?= $pengajuans->where("status", 3)->count() ?> Pengajuan</h5><span class="font-danger d-flex align-items-center"><i class="icon-arrow-down icon-rotate me-1"></i><span class="f-w-500">Ditolak</span></span>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <div class="container-fluid">
    <?php foreach ($dashboard_pengadilan as $dp) { ?>
      <h5>Dashboard <?= ucwords(strtolower($dp->nama_satker))  ?></h5>
      <div class="row mt-3">
        <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
          <div class="card widget-1" style="background-image: none;">
            <div class="card-body">
              <div class="widget-content">
                <div class="widget-round primary">
                  <div class="bg-round">
                    <svg class="svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#tag"> </use>
                    </svg>
                    <svg class="half-circle svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                    </svg>
                  </div>
                </div>
                <div>
                  <h4><?= $dp->pengajuan->count() ?></h4><span class="f-light">Total Pengajuan</span>
                </div>
              </div>
              <div class="font-primary f-w-500"><i class="icon-arrow-up icon-rotate me-1"></i><span>+70%</span></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
          <div class="card widget-1" style="background-image: none;">
            <div class="card-body">
              <div class="widget-content">
                <div class="widget-round secondary">
                  <div class="bg-round">
                    <svg class="svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#cart"> </use>
                    </svg>
                    <svg class="half-circle svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                    </svg>
                  </div>
                </div>
                <div>
                  <h4><?= $dp->pengajuan->where("status", 3)->count() ?></h4><span class="f-light">Perlu Perbaikan</span>
                </div>
              </div>
              <div class="font-secondary f-w-500"><i class="icon-arrow-up icon-rotate me-1"></i><span>+50%</span></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
          <div class="card widget-1" style="background-image: none;">
            <div class="card-body">
              <div class="widget-content">
                <div class="widget-round warning">
                  <div class="bg-round">
                    <svg class="svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#return-box"> </use>
                    </svg>
                    <svg class="half-circle svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                    </svg>
                  </div>
                </div>
                <div>
                  <h4><?= $dp->pengajuan->where("status", 2)->count() ?></h4><span class="f-light">Sedang Proses</span>
                </div>
              </div>
              <div class="font-warning f-w-500"><i class="icon-arrow-down icon-rotate me-1"></i><span>-20%</span></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
          <div class="card widget-1" style="background-image: none;">
            <div class="card-body">
              <div class="widget-content">
                <div class="widget-round success">
                  <div class="bg-round">
                    <svg class="svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#rate"> </use>
                    </svg>
                    <svg class="half-circle svg-fill">
                      <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                    </svg>
                  </div>
                </div>
                <div>
                  <h4><?= $dp->pengajuan->where("status", "4")->count() ?></h4><span class="f-light">Dikabulkan</span>
                </div>
              </div>
              <div class="font-success f-w-500"><i class="icon-arrow-up icon-rotate me-1"></i><span>+70%</span></div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
  <!-- <div class="container-fluid">
    <div class="row starter-main">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>Pengajuan Dalam Proses</h5>
            <div class="card-header-right">
              <ul class="list-unstyled card-option">
                <li><i class="fa fa-spin fa-cog"></i></li>
                <li><i class="view-html fa fa-code"></i></li>
                <li><i class="icofont icofont-maximize full-card"></i></li>
                <li><i class="icofont icofont-minus minimize-card"></i></li>
                <li><i class="icofont icofont-refresh reload-card"></i></li>
                <li><i class="icofont icofont-error close-card"></i></li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="basic-6">
                <thead>
                  <tr>
                    <th rowspan="2">Nama</th>
                    <th colspan="6" class="text-center">Information Pegawai</th>
                  </tr>
                  <tr>
                    <th>Jabatan</th>
                    <th>Pangkat</th>
                    <th>TMT</th>
                    <th>Status</th>
                    <th>Golongan</th>
                    <th>Pengajuan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="media"><img class="rounded-circle img-30 me-3" src="../assets/images/user/1.jpg" alt="Generic placeholder image">
                        <div class="media-body align-self-center">
                          <div>Tiger Nixon</div>
                        </div>
                      </div>
                    </td>
                    <td>System Architect</td>
                    <td>$320,800</td>
                    <td>Edinburgh</td>
                    <td>
                      <div class="progress-showcase">
                        <div class="progress sm-progress-bar">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </td>
                    <td>5421</td>
                    <td>t.nixon@datatables.net</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="media"><img class="rounded-circle img-30 me-3" src="../assets/images/user/2.png" alt="Generic placeholder image">
                        <div class="media-body align-self-center">
                          <div>Garrett Winters</div>
                        </div>
                      </div>
                    </td>
                    <td>Accountant</td>
                    <td>$170,750</td>
                    <td>Tokyo</td>
                    <td>
                      <div class="progress-showcase">
                        <div class="progress sm-progress-bar">
                          <div class="progress-bar bg-secondary" role="progressbar" style="width: 40%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </td>
                    <td>8422</td>
                    <td>g.winters@datatables.net</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="media"><img class="rounded-circle img-30 me-3" src="../assets/images/user/3.png" alt="Generic placeholder image">
                        <div class="media-body align-self-center">
                          <div>Ashton Cox</div>
                        </div>
                      </div>
                    </td>
                    <td>Junior Technical Author</td>
                    <td>$86,000</td>
                    <td>San Francisco</td>
                    <td>
                      <div class="progress-showcase">
                        <div class="progress sm-progress-bar">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 60%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </td>
                    <td>1562</td>
                    <td>a.cox@datatables.net</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="media"><img class="rounded-circle img-30 me-3" src="../assets/images/user/4.jpg" alt="Generic placeholder image">
                        <div class="media-body align-self-center">
                          <div>Cedric Kelly</div>
                        </div>
                      </div>
                    </td>
                    <td>Senior Javascript Developer</td>
                    <td>$433,060</td>
                    <td>Edinburgh</td>
                    <td>
                      <div class="progress-showcase">
                        <div class="progress sm-progress-bar">
                          <div class="progress-bar bg-secondary" role="progressbar" style="width: 80%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </td>
                    <td>6224</td>
                    <td>c.kelly@datatables.net</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="media"><img class="rounded-circle img-30 me-3" src="../assets/images/user/5.jpg" alt="Generic placeholder image">
                        <div class="media-body align-self-center">
                          <div>Airi Satou</div>
                        </div>
                      </div>
                    </td>
                    <td>Accountant</td>
                    <td>$162,700</td>
                    <td>Tokyo</td>
                    <td>
                      <div class="progress-showcase">
                        <div class="progress sm-progress-bar">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </td>
                    <td>5407</td>
                    <td>a.satou@datatables.net</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="media"><img class="rounded-circle img-30 me-3" src="../assets/images/user/6.jpg" alt="Generic placeholder image">
                        <div class="media-body align-self-center">
                          <div>Brielle Williamson</div>
                        </div>
                      </div>
                    </td>
                    <td>Integration Specialist</td>
                    <td>$372,000</td>
                    <td>New York</td>
                    <td>
                      <div class="progress-showcase">
                        <div class="progress sm-progress-bar">
                          <div class="progress-bar bg-info" role="progressbar" style="width: 55%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </td>
                    <td>4804</td>
                    <td>b.williamson@datatables.net</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="media"><img class="rounded-circle img-30 me-3" src="../assets/images/user/7.jpg" alt="Generic placeholder image">
                        <div class="media-body align-self-center">
                          <div>Herrod Chandler</div>
                        </div>
                      </div>
                    </td>
                    <td>Sales Assistant</td>
                    <td>$137,500</td>
                    <td>San Francisco</td>
                    <td>
                      <div class="progress-showcase">
                        <div class="progress sm-progress-bar">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </td>
                    <td>9608</td>
                    <td>h.chandler@datatables.net</td>
                  </tr>

                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div> -->
</div>