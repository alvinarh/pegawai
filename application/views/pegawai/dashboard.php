<div class="row">
<div class="col-md-4 stretch-card grid-margin" >
                <div class="card card-img-holder text-white" style="background: #4682B4;">
                  <div class="card-body">
                    <a href="<?= base_url('pegawai/Cuti/cutiSakit') ?>" style="text-decoration: none; color: white;">
                    <img src="<?php echo base_url('vendors/adminassets/assets/images/dashboard/circle.svg'); ?>" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Data Cuti Sakit < 14 Hari<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i></h4>
                    <h2 class="mb-5"><?= $cuti_sakit ?></h2>
                      </a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin" >
                <div class="card card-img-holder text-white" style="background: #4682B4;">
                  <div class="card-body">
                    <a href="<?= base_url('pegawai/Cuti/cutiSakit14') ?>" style="text-decoration: none; color: white;">
                    <img src="<?php echo base_url('vendors/adminassets/assets/images/dashboard/circle.svg'); ?>" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Data Cuti Sakit > 14 Hari<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i></h4>
                    <h2 class="mb-5"><?= $cuti_sakit14 ?></h2>
                      </a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin" >
                <div class="card card-img-holder text-white" style="background: #4682B4;">
                  <div class="card-body">
                    <a href="<?= base_url('pegawai/Cuti/cutiMelahirkan') ?>" style="text-decoration: none; color: white;">
                    <img src="<?php echo base_url('vendors/adminassets/assets/images/dashboard/circle.svg'); ?>" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Data Cuti Melahirkan<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i></h4>
                    <h2 class="mb-5"><?= $cuti_melahirkan ?></h2>
                      </a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin" >
                <div class="card card-img-holder text-white" style="background: #4682B4;">
                  <div class="card-body">
                    <a href="<?= base_url('pegawai/Cuti/cutiAlasanPenting') ?>" style="text-decoration: none; color: white;">
                    <img src="<?php echo base_url('vendors/adminassets/assets/images/dashboard/circle.svg'); ?>" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Data Cuti Alasan Penting<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i></h4>
                    <h2 class="mb-5"><?= $cuti_alasanpenting ?></h2>
                      </a>
                  </div>
                </div>
              </div>
</div>

