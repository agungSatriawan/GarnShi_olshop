 <style>
     .tabs {
         width: 100%;
     }

     .tabs input[type=radio] {
         display: none;
     }

     .tabs label {
         transition: background 0.4s ease-in-out, height 0.2s linear;
         display: inline-block;
         cursor: pointer;
         color: #979654;
         width: 20%;
         height: 3em;
         border-top-left-radius: 3px;
         border-top-right-radius: 3px;
         background: #FCFCFC;
         text-align: center;
         line-height: 3em;
     }

     .tabs label:last-of-type {
         border-bottom: none;
     }

     .tabs label:hover {
         background: #979654;
         color: #ffffff;
     }

     @media screen and (max-width: 1600px) {
         .tabs label {
             width: 15%;
         }
     }

     @media screen and (max-width: 900px) {
         .tabs label {
             width: 20%;
         }
     }

     @media screen and (max-width: 600px) {
         .tabs label {
             width: 100%;
             display: block;
             border-bottom: 2px solid #C7C6C4;
             border-radius: 0;
         }
     }

     @media screen and (max-width: 600px) {
         .tabs {
             margin: 0;
         }
     }

     #tab1:checked+label,
     #tab2:checked+label,
     #tab3:checked+label,
     #tab4:checked+label #tab5:checked+label {
         background: #979654;
         color: #FFFFFF;
     }

     .tab-content {
         position: absolute;
         top: -9999px;
         padding: 10px;
     }

     .tab-content-wrapper {
         background: #FCFCFC;
         border-top: #979654 5px solid;
         border-bottom-right-radius: 3px;
         border-bottom-left-radius: 3px;
         border-top-right-radius: 3px;

     }

     @media screen and (max-width: 600px) {

         .tab-content-wrapper,
         .tab1-content-wrapper {
             border: none;
             border-radius: 0;
         }
     }

     #tab1:checked~.tab-content-wrapper #tab-content-1,
     #tab2:checked~.tab-content-wrapper #tab-content-2,
     #tab3:checked~.tab-content-wrapper #tab-content-3,
     #tab4:checked~.tab-content-wrapper #tab-content-4,
     #tab5:checked~.tab-content-wrapper #tab-content-5 {
         position: relative;
         top: 0px;
     }
 </style>
 <section id="billboard" class="bg-light py-3">
     <div class="container">

         <div class="row box-detail p-3">
             <div class="col-sm-12">
                 <div class="swiper main-swiper py-4" data-aos="fade-up" data-aos-delay="600">
                     <div class="swiper-wrapper d-flex border-animation-left">


                         <div class="tabs">
                             <input type="radio" name="tab" id="tab1" checked="checked">
                             <label for="tab1">Semua</label>
                             <input type="radio" name="tab" id="tab2">
                             <label for="tab2">Belum Bayar</label>
                             <input type="radio" name="tab" id="tab3">
                             <label for="tab3">Sedang Dikemas</label>
                             <input type="radio" name="tab" id="tab4">
                             <label for="tab4">Dikirim</label>
                             <input type="radio" name="tab" id="tab5">
                             <label for="tab5">Selesai</label>

                             <div class="tab-content-wrapper">

                                 <div id="tab-content-1" class="tab-content table-responsive-sm">

                                     <?php foreach ($pesanan as $co) : ?>
                                         <?php
                                            $img = explode(",", $co['image']);
                                            $pn = explode(",", $co['product_name']);
                                            $q = explode(",", $co['qty_a']);
                                            $c = explode(",", $co['color']);

                                            ?>
                                         <div class="card my-2">
                                             <div class="card-header">
                                                 <div class="row">
                                                     <div class="col">
                                                         No Invoice : <?= $co['invoice_number'] ?>
                                                     </div>
                                                     <div class="col text-end">
                                                         Estimasi sampai tempat tujuan
                                                         <?= $co['kurir_etd'] ?> hari
                                                         |<b> <?= $co['status'] ?></b>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="card-body">
                                                 <div class="row">

                                                     <!-- image -->
                                                     <div class="col-sm-12">
                                                         <?php for ($i = 0; $i < count($img); $i++) : ?>
                                                             <div class="row">

                                                                 <div class="col-sm-1 p-1">
                                                                     <img class="img" src="<?= base_url('assets/images/product/' . $img[$i]) ?>" alt="" width="50">
                                                                 </div>
                                                                 <div class="col-sm-5 p-1">
                                                                     <small class="d-block font-weight-bold"><b><?= $pn[$i] ?></b></small>
                                                                     <small class="d-block">Variasi: <?= $c[$i] ?></small>

                                                                     <small class="d-block"><?= $q[$i] ?>X</small>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                     <p class="text-end">Rp. <?= number_format($co['jumlah']) ?></p>
                                                                 </div>
                                                             </div>
                                                         <?php endfor ?>
                                                     </div>

                                                     <!-- <div class="col-sm-3">

                                                         <ul>
                                                             <li>
                                                                 <p>Status : <?= $co['status'] ?></p>
                                                             </li>
                                                             <?php for ($j = 0; $j < count($pn); $j++) : ?>
                                                                 <li><?= $pn[$j] ?></li>
                                                             <?php endfor ?>
                                                         </ul>
                                                         <p>Status : <?= $co['status'] ?></p>
                                                         <p>Qty : <?= $co['qty'] ?></p>
                                                     </div> -->






                                                 </div>
                                             </div>
                                             <div class="card-footer text-muted text-end">
                                                 <div class="row justify-content-end">

                                                     <div class="col-sm-6">
                                                         <table class="table table-sm">
                                                             <tr>
                                                                 <td class="text-left">
                                                                     <p class="d-block">Subtotal Pengiriman </p>
                                                                 </td>
                                                                 <td class="titik2">:</td>
                                                                 <td><small class="text-end">Rp. <?= number_format($co['kurir_price']) ?></small></td>
                                                             </tr>
                                                             <tr>
                                                                 <td class="text-left">
                                                                     <p class="d-block">Biaya Penanganan </p>
                                                                 </td>
                                                                 <td class="titik2">:</td>
                                                                 <td><small class="text-end">Rp. <?= number_format($co['penanganan']) ?></small></td>
                                                             </tr>
                                                             <tr>
                                                                 <td class="text-left">
                                                                     <p class="d-block">Biaya Administrasi </p>
                                                                 </td>
                                                                 <td class="titik2">:</td>
                                                                 <td><small class="text-end">Rp. <?= number_format($co['adm']) ?></small></td>
                                                             </tr>
                                                             <tr>
                                                                 <td class="text-left">
                                                                     <p class="text-end d-inline">Total Pesanan </p>
                                                                 </td>
                                                                 <td class="titik2">:</td>
                                                                 <td>
                                                                     <h4 class="text-end">Rp. <?= number_format($co['total']) ?></h4>
                                                                 </td>
                                                             </tr>
                                                         </table>
                                                     </div>
                                                 </div>





                                             </div>
                                         </div>

                                     <?php endforeach; ?>

                                 </div>

                                 <div id="tab-content-2" class="tab-content">

                                     <?php foreach ($pesanan as $co) : ?>

                                         <?php if ($co['status'] == 'Belum Dibayar') : ?>
                                             <div class="card my-2">
                                                 <div class="card-header">
                                                     <div class="row">
                                                         <div class="col">
                                                             No Invoice : <?= $co['invoice_number'] ?>
                                                         </div>
                                                         <div class="col text-end">
                                                             Estimasi sampai tempat tujuan
                                                             <?= $co['kurir_etd'] ?> hari
                                                             |<b> <?= $co['status'] ?></b>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="card-body">
                                                     <div class="row">

                                                         <!-- image -->
                                                         <div class="col-sm-12">
                                                             <?php for ($i = 0; $i < count($img); $i++) : ?>
                                                                 <div class="row">

                                                                     <div class="col-sm-1 p-1">
                                                                         <img class="img" src="<?= base_url('assets/images/product/' . $img[$i]) ?>" alt="" width="50">
                                                                     </div>
                                                                     <div class="col-sm-5 p-1">
                                                                         <small class="d-block font-weight-bold"><b><?= $pn[$i] ?></b></small>
                                                                         <small class="d-block">Variasi: <?= $c[$i] ?></small>

                                                                         <small class="d-block"><?= $q[$i] ?>X</small>
                                                                     </div>
                                                                     <div class="col-sm-6">
                                                                         <p class="text-end">Rp. <?= number_format($co['jumlah']) ?></p>
                                                                     </div>
                                                                 </div>
                                                             <?php endfor ?>
                                                         </div>

                                                         <!-- <div class="col-sm-3">

                                                         <ul>
                                                             <li>
                                                                 <p>Status : <?= $co['status'] ?></p>
                                                             </li>
                                                             <?php for ($j = 0; $j < count($pn); $j++) : ?>
                                                                 <li><?= $pn[$j] ?></li>
                                                             <?php endfor ?>
                                                         </ul>
                                                         <p>Status : <?= $co['status'] ?></p>
                                                         <p>Qty : <?= $co['qty'] ?></p>
                                                     </div> -->






                                                     </div>
                                                 </div>
                                                 <div class="card-footer text-muted text-end">
                                                     <div class="row justify-content-end">

                                                         <div class="col-sm-6">
                                                             <table class="table table-sm">
                                                                 <tr>
                                                                     <td class="text-left">
                                                                         <p class="d-block">Subtotal Pengiriman </p>
                                                                     </td>
                                                                     <td class="titik2">:</td>
                                                                     <td><small class="text-end">Rp. <?= number_format($co['kurir_price']) ?></small></td>
                                                                 </tr>
                                                                 <tr>
                                                                     <td class="text-left">
                                                                         <p class="text-end d-inline">Total Pesanan </p>
                                                                     </td>
                                                                     <td class="titik2">:</td>
                                                                     <td>
                                                                         <h4 class="text-end">Rp. <?= number_format($co['total']) ?></h4>
                                                                     </td>
                                                                 </tr>
                                                             </table>
                                                         </div>
                                                     </div>





                                                 </div>
                                             </div>
                                         <?php endif ?>

                                     <?php endforeach; ?>
                                 </div>
                                 <div id="tab-content-3" class="tab-content">

                                     <?php foreach ($pesanan as $co) : ?>

                                         <?php if ($co['status'] != 'Belum Dibayar') : ?>
                                             <div class="card my-2">
                                                 <div class="card-header">
                                                     <div class="row">
                                                         <div class="col">
                                                             No Invoice : <?= $co['invoice_number'] ?>
                                                         </div>
                                                         <div class="col text-end">
                                                             Estimasi sampai tempat tujuan
                                                             <?= $co['kurir_etd'] ?> hari
                                                             |<b> <?= $co['status'] ?></b>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="card-body">
                                                     <div class="row">

                                                         <!-- image -->
                                                         <div class="col-sm-12">
                                                             <?php for ($i = 0; $i < count($img); $i++) : ?>
                                                                 <div class="row">

                                                                     <div class="col-sm-1 p-1">
                                                                         <img class="img" src="<?= base_url('assets/images/product/' . $img[$i]) ?>" alt="" width="50">
                                                                     </div>
                                                                     <div class="col-sm-5 p-1">
                                                                         <small class="d-block font-weight-bold"><b><?= $pn[$i] ?></b></small>
                                                                         <small class="d-block">Variasi: <?= $c[$i] ?></small>

                                                                         <small class="d-block"><?= $q[$i] ?>X</small>
                                                                     </div>
                                                                     <div class="col-sm-6">
                                                                         <p class="text-end">Rp. <?= number_format($co['jumlah']) ?></p>
                                                                     </div>
                                                                 </div>
                                                             <?php endfor ?>
                                                         </div>

                                                         <!-- <div class="col-sm-3">

                                                         <ul>
                                                             <li>
                                                                 <p>Status : <?= $co['status'] ?></p>
                                                             </li>
                                                             <?php for ($j = 0; $j < count($pn); $j++) : ?>
                                                                 <li><?= $pn[$j] ?></li>
                                                             <?php endfor ?>
                                                         </ul>
                                                         <p>Status : <?= $co['status'] ?></p>
                                                         <p>Qty : <?= $co['qty'] ?></p>
                                                     </div> -->






                                                     </div>
                                                 </div>
                                                 <div class="card-footer text-muted text-end">
                                                     <div class="row justify-content-end">

                                                         <div class="col-sm-6">
                                                             <table class="table table-sm">
                                                                 <tr>
                                                                     <td class="text-left">
                                                                         <p class="d-block">Subtotal Pengiriman </p>
                                                                     </td>
                                                                     <td class="titik2">:</td>
                                                                     <td><small class="text-end">Rp. <?= number_format($co['kurir_price']) ?></small></td>
                                                                 </tr>
                                                                 <tr>
                                                                     <td class="text-left">
                                                                         <p class="text-end d-inline">Total Pesanan </p>
                                                                     </td>
                                                                     <td class="titik2">:</td>
                                                                     <td>
                                                                         <h4 class="text-end">Rp. <?= number_format($co['total']) ?></h4>
                                                                     </td>
                                                                 </tr>
                                                             </table>
                                                         </div>
                                                     </div>





                                                 </div>
                                             </div>
                                         <?php endif ?>

                                     <?php endforeach; ?>
                                 </div>
                                 <div id="tab-content-4" class="tab-content">

                                     <p>No Result</p>
                                 </div>
                                 <div id="tab-content-5" class="tab-content">

                                     <p>No Result</p>
                                 </div>
                             </div>
                         </div>




                     </div>
                     <div class="swiper-pagination"></div>
                 </div>

             </div>

         </div>
     </div>
 </section>