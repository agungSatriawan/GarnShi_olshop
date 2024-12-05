<div class="p-4">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h2>Data Pembayaran</h2>
        </div>
    </div>
    <div class="row mb-3">

        <div class="flash mt-5 mb-3">
            <?= $this->session->flashdata('message') ?>
        </div>
    </div>
    <div class="row justify-content-end mb-3">
        <div class="col-sm-2">
            <label class="mt-3" for="">Tanggal Transaksi</label>
        </div>
        <div class="col-sm-2">
            <div class="input-group date">
                <input type="text" name="tanggal_transaksi" class="form-control datepicker mt-2 tanggal_transaksi" value="<?= date('d-m-Y') ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col table-responsive">
            <table class="table table-bordered table-sm  tabledata mt-3">
                <thead>
                    <tr>
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">Nama</th>
                        <th class="text-center align-middle">Tanggal Lahir</th>
                        <th class="text-center align-middle">Usia</th>
                        <th class="text-center align-middle">Jenis Kelamin</th>
                        <th class="text-center align-middle">Terapi</th>
                        <th class="text-center align-middle">Tanggal Terapi</th>
                        <th class="text-center align-middle">Status Pembayaran</th>
                        <th class="text-center align-middle">Action</th>
                    </tr>
                </thead>
                <tbody class="loadDataTransaksi">
                    <?php $i = 1; ?>
                    <?php foreach ($pembayaran as $d) : ?>
                        <tr>
                            <td class="align-middle text-center"><?= $i ?></td>
                            <td class="align-middle"><?= $d['nama'] ?></td>
                            <td class="align-middle text-center"><?= $d['tgl_lahir'] ?></td>
                            <td class="align-middle text-center"><?= hitung_umur($d['tgl_lahir']) ?></td>
                            <?php if ($d['jk'] == 'p') : ?>
                                <td class="align-middle text-center">Laki laki</td>
                            <?php elseif ($d['jk'] == 'w') : ?>
                                <td class="align-middle text-center">Perempuan</td>
                            <?php else : ?>
                                <td class="align-middle text-center"></td>
                            <?php endif; ?>

                            <td class="align-middle"><?= $d['layanan'] ?></td>
                            <td class="align-middle"><?= $d['tanggal_terapi'] ?></td>
                            <?php if ($d['status_payment'] == 1) : ?>
                                <td class="align-middle text-success">Selesai</td>
                            <?php else : ?>
                                <td class="align-middle text-danger">Menunggu</td>
                            <?php endif ?>


                            <td class="align-middle p-2 text-nowrap">

                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-primary detNota" data-rekam="<?= $d['id_reservasi'] ?>" data-bs-toggle="modal" data-bs-target="#pembayaran<?= $d['id_reservasi'] ?>">Lihat Nota</button>
                                        <!-- Modal -->
                                        <div class="modal fade" data-bs-focus="false" id="pembayaran<?= $d['id_reservasi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body-wrapper">
                                                        <div class="modal-body modal-body-<?= $d['id_reservasi'] ?>">

                                                            <div class="sidebar-header d-flex  align-items-center px-3 py-4">
                                                                <div class="logo">
                                                                    <!-- <img class="rounded-pill img-fluid" width="65" src="<?= base_url('assets/image/logo1.jpeg') ?>" alt=""> -->
                                                                </div>


                                                                <div class="ms-2">
                                                                    <h5 class="fs-6 mb-0">
                                                                        <a class="text-decoration-none" href="#">Sari Kusuma 99</a>
                                                                    </h5>
                                                                    <p class="mt-1 mb-0">Sehat Optimal | Ibadah Sempurna</p>
                                                                </div>
                                                                <hr>

                                                            </div>

                                                            <div class="row mb-5">
                                                                <div class="col">
                                                                    <div class="smaller">
                                                                        <div class="row text-dark">
                                                                            <div class="col-sm-2">
                                                                                <p>Nama</p>
                                                                            </div>
                                                                            <div class="col-sm-1 text-center">
                                                                                <p>:</p>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <p><?= $d['nama'] ?></p>
                                                                            </div>
                                                                            <div class="col-sm-1"></div>
                                                                            <div class="col-sm-2">
                                                                                <p>Tanggal Lahir</p>
                                                                            </div>
                                                                            <div class="col-sm-1 text-center">
                                                                                <p>:</p>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <p><?= $d['tgl_lahir'] ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row text-dark">
                                                                            <div class="col-sm-2">
                                                                                <p>Email</p>
                                                                            </div>
                                                                            <div class="col-sm-1 text-center">
                                                                                <p>:</p>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <p><?= $d['email'] ?></p>
                                                                            </div>
                                                                            <div class="col-sm-1"></div>
                                                                            <div class="col-sm-2">
                                                                                <p>Agama</p>
                                                                            </div>
                                                                            <div class="col-sm-1 text-center">
                                                                                <p>:</p>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <p><?= $d['agama'] ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row text-dark">
                                                                            <div class="col-sm-2">
                                                                                <p>Whatsapp</p>
                                                                            </div>
                                                                            <div class="col-sm-1 text-center">
                                                                                <p>:</p>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <p><?= $d['whatsapp'] ?></p>
                                                                            </div>
                                                                            <div class="col-sm-1"></div>
                                                                            <div class="col-sm-2">
                                                                                <p>Jenis Kelamin</p>
                                                                            </div>
                                                                            <div class="col-sm-1 text-center">
                                                                                <p>:</p>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <?php if ($d['jk'] == 'p') : ?>
                                                                                    <p>Pria</p>
                                                                                <?php else : ?>
                                                                                    <p>Wanita</p>
                                                                                <?php endif; ?>

                                                                            </div>
                                                                        </div>
                                                                        <div class="row text-dark">
                                                                            <div class="col-sm-2">
                                                                                <p>Alamat</p>
                                                                            </div>
                                                                            <div class="col-sm-1 text-center">
                                                                                <p>:</p>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <p><?= $d['alamat'] ?></p>
                                                                            </div>
                                                                            <div class="col-sm-1"></div>
                                                                            <div class="col-sm-2">
                                                                                <p>Kota</p>
                                                                            </div>
                                                                            <div class="col-sm-1 text-center">
                                                                                <p>:</p>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <p><?= $d['kota'] ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row text-dark">
                                                                            <div class="col-sm-2">
                                                                                <p>Provinsi</p>
                                                                            </div>
                                                                            <div class="col-sm-1 text-center">
                                                                                <p>:</p>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <p><?= $d['provinsi'] ?></p>
                                                                            </div>
                                                                            <div class="col-sm-1"></div>
                                                                            <div class="col-sm-2">
                                                                                <p>Negara</p>
                                                                            </div>
                                                                            <div class="col-sm-1 text-center">
                                                                                <p>:</p>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <p><?= $d['negara'] ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-2">Tanggal Terapi</div>
                                                                <div class="col-sm-1 text-center">:</div>
                                                                <div class="col-sm-3"><?= $d['tanggal_terapi'] ?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-2">Tanggal</div>
                                                                <div class="col-sm-1 text-center">:</div>
                                                                <div class="col-sm-3"><?= date('d-m-Y H:i:sa') ?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-2">Layanan</div>
                                                                <div class="col-sm-1 text-center">:</div>
                                                                <div class="col-sm-3"><?= $d['layanan'] ?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Pelayanan</th>
                                                                                <th>Harga</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="detail_nota">
                                                                            <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>
                                                                        </tbody>
                                                                        <tfoot class="detail_nota_footer"></tfoot>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="row metodePembayaran">
                                                                <h5>Metode Pembayaran</h5>
                                                                <div class="col-sm-1 text-center">
                                                                    <button class="btn btn-primary cash" data-reservasi="<?= $d['id_reservasi'] ?>">Cash</button>

                                                                    <button class="btn btn-info ewalet">e-Wallet</button>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="<?= base_url('admin/pembayaran') ?>" class="btn btn-info print" data-reservasi="<?= $d['id_reservasi'] ?>">Print</a>

                                                        <!-- <button class="btn btn-info print">Print</button> -->

                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>





                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>









</div>
</section>