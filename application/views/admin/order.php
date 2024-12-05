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
                      <h2>Data Penjualan</h2>
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
                                  <th class="text-center align-middle">Tanggal</th>
                                  <th class="text-center align-middle">Invoice</th>
                                  <th class="text-center align-middle">Order ID</th>
                                  <th class="text-center align-middle">Status Transaksi</th>
                                  <th class="text-center align-middle">Total Pembelian</th>
                                  <th class="text-center align-middle">Total Pengiriman</th>
                                  <th class="text-center align-middle">Total</th>
                              </tr>
                          </thead>
                          <tbody class="">
                              <?php $no = 1; ?>
                              <?php foreach ($penjualan as $m) : ?>
                                  <tr class="loadDetailOrder" data-toggle="modal" data-target="#dataOrder" data-invoice="<?= $m['invoice'] ?>">
                                      <td class="text-center"><?= $no; ?></td>
                                      <td> <?= $m['date_created'] ?></td>
                                      <td> <?= $m['invoice'] ?></td>
                                      <td> <?= $m['order_id'] ?></td>
                                      <td> <?= $m['transaction_status'] ?></td>
                                      <td class="text-end"> <?= number_format($m['total_belanja']) ?></td>
                                      <td class="text-end"> <?= number_format($m['kurir_price']) ?></td>
                                      <td class="text-end"> <?= number_format($m['total_pesanan']) ?></td>

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

  <!-- Modal -->
  <div class="modal fade" id="dataOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan <span class="no-invoice"></span></h5>
              </div>
              <div class="modal-body">
                  <div class="row">

                      <div class="col"> Product </div>
                      <div class="col text-end"> Jumlah </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="row">

                              <div class="col-sm-1 p-1">
                                  <img class="img" src="<?= base_url('assets/images/product/DSC0309410.jpg') ?>" alt="" width="50">
                              </div>
                              <div class="col-sm-5 p-1">
                                  <small class="d-block font-weight-bold"><b>Hijab</b></small>
                                  <small class="d-block">Variasi: All Size</small>
                                  <small class="d-block">Variasi: Merah</small>

                                  <small class="d-block">5X</small>
                              </div>
                              <div class="col-sm-6">
                                  <p class="text-end">Rp. 500000</p>
                              </div>
                          </div>
                      </div>

                  </div>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
              </div>
          </div>
      </div>
  </div>