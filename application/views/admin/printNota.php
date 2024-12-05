   <?php foreach ($pembayaran as $d) : ?>
       <div class="modal-body-wrapper">
           <div class="modal-body">

               <div class="sidebar-header d-flex  align-items-center px-3 py-4">
                   <img class="rounded-pill img-fluid" width="65" src="<?= base_url('assets/image/logo1.jpeg') ?>" alt="">
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
                   <div class="col-sm-1">Tanggal</div>
                   <div class="col-sm-1 text-center">:</div>
                   <div class="col-sm-3"><?= date('d-m-Y H:i:sa') ?></div>
               </div>
               <div class="row">
                   <div class="col-sm-1">Layanan</div>
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
                       <button class="btn btn-primary cash">Cash</button>

                       <button class="btn btn-info">Online</button>
                   </div>

               </div>

           </div>
       </div>
   <?php endforeach; ?>