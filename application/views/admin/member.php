  <div class="app-main__outer">
      <div class="app-main__inner">
          <section id="fancyTabWidget" class="tabs t-tabs">
              <div class="row">
                  <div class="col">
                      <small> <?= $this->session->flashdata('message'); ?></small>
                  </div>
              </div>

              <div class="row">
                  <div class="col-sm-12 text-center">
                      <h2>Data Member</h2>
                  </div>
              </div>
              <!-- <div class="row mb-3 mt-3 justify-content-end">
                  <div class="col-sm-3">
                      <label for="">Mulai</label>
                      <input type="date" class="form-control mulai rentang">
                  </div>
                  <div class="col-sm-3">
                      <label for="">Sampai</label>
                      <input type="date" class="form-control sampai rentang">
                  </div>
              </div> -->
              <div class="row">

                  <div class="col">
                      <table class="table table-bordered tabledata tableUser">
                          <thead>
                              <tr>
                                  <th class="text-center align-middle">No</th>
                                  <th class="text-center align-middle">Nama</th>
                                  <th class="text-center align-middle">Email</th>
                                  <th class="text-center align-middle">WhatsApp</th>
                                  <th class="text-center align-middle">Alamat</th>
                                  <th class="text-center align-middle">Kelurahan</th>
                                  <th class="text-center align-middle">Kecamatan</th>
                                  <th class="text-center align-middle">Kabupaten</th>
                                  <th class="text-center align-middle">Status</th>

                              </tr>
                          </thead>
                          <tbody class="dataUserRegistered">
                              <?php $no = 1; ?>
                              <?php foreach ($member as $m) : ?>
                                  <tr>
                                      <td class="text-center"><?= $no; ?></td>
                                      <td> <?= $m['firstName'] ?></td>
                                      <td> <?= $m['email'] ?></td>
                                      <td> <?= $m['telp'] ?></td>
                                      <td> <?= $m['address'] ?></td>
                                      <td> <?= $m['kel'] ?></td>
                                      <td> <?= $m['kec'] ?></td>
                                      <td> <?= $m['kabkot'] ?></td>
                                      <td></td>
                                  </tr>
                                  <?php $no++; ?>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>
              </div>

          </section>
      </div>

  </div>
  </div>
  </div>