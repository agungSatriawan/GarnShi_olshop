<?php

if (count($cart) < 1) {
    redirect('home');
}
?>

<section id="billboard" class="bg-light py-5">
    <div class="container">

        <div class="row box-detail p-5 table-responsive">
            <!-- <div class="swiper main-swiper py-4" data-aos="fade-up" data-aos-delay="600"> -->
            <!-- <div class="swiper-wrapper d-flex border-animation-left"> -->
            <div class="col-sm-12 my-3">
                <small> <?= $this->session->flashdata('message'); ?></small>
                <p><i class="fa-solid fa-location-dot"></i> Shipping address</p>
                <?php if (count($alamat) == 0) : ?>
                    <button data-toggle="modal" data-target="#addAddress" class="btn btn-primary">Add Shipping Address</button>
                    <!-- Modal -->
                    <div class="modal fade" id="addAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Shipping Address</h5>
                                    <button type="button" data-target="#addAddress" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?= form_open('product/checkout') ?>
                                <div class="modal-body">
                                    <div class="form-group my-3">
                                        <label for="recipient">Recipient's name</label>
                                        <input name="nama" type="text" class="form-control" value="<?= set_value('nama') ?>" id="recipient" placeholder="Enter Recipient's name">
                                        <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="hp">Phone Number</label>
                                        <input value="<?= set_value('telp') ?>" name="telp" type="text" class="form-control" id="hp" placeholder="Enter Phone Number">
                                        <?= form_error('telp', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="prov">Province</label>
                                        <select name="prov" id="prov_kurir" class="form-control kurir">

                                            <option value="">Select Province</option>

                                            <?php foreach ($prov_kurir as $pk) : ?>
                                                <option value="<?= $pk['province_id'] ?>"><?= strtoupper($pk['province']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('prov', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="city">Regency/City</label>
                                        <select name="kabkot" id="kab_kurir" class="form-control kurir">
                                            <option value="">Select Regency/City</option>

                                        </select>
                                        <?= form_error('kabkot', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="kec">Subdistrict</label>
                                        <select name="kec" id="kec_kurir" class="form-control kurir">
                                            <option value="">Select Subdistrict</option>

                                        </select>
                                        <?= form_error('kec', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="kel">Village</label>
                                        <select name="kel" id="kel_kurir" class="form-control kurir">
                                            <option value="">Select Village</option>

                                        </select>
                                        <?= form_error('kel', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="address">Address</label>
                                        <textarea class="form-control editor" name="address" id=""><?= set_value('address') ?></textarea>
                                        <?= form_error('address', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary close" data-dismiss="modal" data-target="#addAddress">Close</button>
                                    <button type="submit" name="addAddress" class="btn btn-primary">Save changes</button>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <?php foreach ($alamat as $a) : ?>
                        <?php if ($a['status'] == 1) : ?>
                            <div class="row p5 box-detail">
                                <div class="col-sm-2 p-3">
                                    <p><?= $a['nama'] ?></p>
                                    <p><?= $a['telp'] ?></p>
                                </div>
                                <div class="col-sm-10 p-3">
                                    <p><?= $a['address'] ?></p>
                                </div>
                            </div>

                        <?php endif ?>
                    <?php endforeach; ?>
                <?php endif ?>
            </div>
            <div class="col-sm-12 my-3 mt-5">
                <table class="table">
                    <thead>
                        <th class="text-center align-align-middle"><input type="checkbox" disabled checked class="largerCheckbox"></th>
                        <th class="text-center">Product</th>
                        <th class="text-center">Unit price</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Total price</th>

                    </thead>
                    <tbody class="tb_cart">
                        <?php $index = 0; ?>
                        <?php foreach ($cart as $co) : ?>
                            <tr>
                                <td class="text-center align-middle "><input type="checkbox" class="largerCheckbox" disabled checked data-id="<?= $co['id'] ?>"></td>
                                <td>
                                    <img class="img img-flex" src="<?= base_url('assets/images/product/' . $co['image_varian']) ?>" alt="" width="100">
                                    <div class="detailcheckout d-inline-block">
                                        <p class="d-block"><?= $co['product_name'] ?></p>
                                        <small class="d-block"><?= $co['color'] ?></small>
                                        <small class="d-block"><?= $co['size'] ?></small>
                                    </div>


                                </td>
                                <td class="text-center  align-middle">
                                    <p>Rp. <span class="harga-satuan satuan" name="quant[<?= $index ?>]"><?= number_format($co['price']) ?></span></p>
                                </td>
                                <td class="text-center  align-middle">




                                    <div class="quantity">

                                        <input type="number" disabled name="quant[<?= $index ?>]" class="input-box input-number qty-product" value="<?= $co['qty'] ?>" min="1" max="1000">

                                    </div>

                                </td>
                                <td class="text-end  align-middle">
                                    <p class="jumlah" name="quant[<?= $index ?>]">Rp. <span><?= number_format($co['price'] * $co['qty']) ?></span></p>
                                </td>

                            </tr>




                            <?php $index++; ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-center">Total</th>
                            <th class="text-center"><span class="totalQty"></span></th>
                            <th class="text-end"><span class="totalPrice"></span></th>

                        </tr>
                        <tr>
                            <td>
                                <!-- <p>Pengiriman</p>
                                 <div class="row">
                                     <div class="col">
                                         <select name="prov" id="prov_kurir" class="form-control kurir">
                                             <option value="">Pilih Provinsi</option>
                                             <?php foreach ($prov_kurir as $pk) : ?>
                                                 <option value="<?= $pk['province_id'] ?>"><?= $pk['province'] ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                     </div>
                                     <div class="col">
                                         <select name="kab" id="kab_kurir" class="form-control kurir">
                                             <option value="">Pilih Kabupaten</option>

                                         </select>
                                     </div>
                                     <div class="col">
                                         <select name="kurir" id="kurir_kurir" class="form-control kurir">
                                             <option value="">Pilih Kurir</option>
                                             <option value="jne">JNE</option>
                                             <option value="tiki">TIKI</option>
                                             <option value="pos">PT POS</option>

                                         </select>
                                     </div>
                                 </div>

                                 <table class="table detail-cost">
                                     <thead>
                                         <tr>
                                             <th>Service Name</th>
                                             <th>Description</th>
                                             <th>Estimated day</th>
                                             <th>Shipping cost</th>
                                         </tr>
                                     </thead>
                                     <tbody class="tb-cost">
                                         <tr>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                         </tr>
                                     </tbody>
                                 </table> -->
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- <div class="col-sm-3 my-3 mt-5">

             </div> -->
            <div class="col-sm-2 my-3 mt-5">
                <label for="">Select Courier</label>
                <select name="kurir" id="kurir_kurir" class="form-control pilihKurir">
                    <option value="">Pilih Kurir</option>
                    <option value="jne">JNE</option>
                    <option value="tiki">TIKI</option>
                    <option value="pos">PT POS</option>
                </select>
            </div>
            <div class="col-sm-8">
                <table class="table detail-cost table-sm table-hover" id="test_table" data-click-to-select="true">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Service Name</th>
                            <th>Description</th>
                            <th>Estimated day</th>
                            <th>Shipping cost</th>
                        </tr>
                    </thead>
                    <tbody class="tb-cost">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-end">
                <div class="col-sm-2 text-end">
                    <p class="costPrice"></p>
                </div>
            </div>

            <div class="row justify-content-end">
                <div class="col-2">
                    <p>Biaya Admin</p>
                </div>
                <div class="col-1">
                    <p> : </p>
                </div>
                <div class="col-2 text-end">
                    <p>Rp. 2000</p>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-2">
                    <p>Biaya Penanganan</p>
                </div>
                <div class="col-1">
                    <p> : </p>
                </div>
                <div class="col-2 text-end">
                    <p>Rp. 2000</p>
                </div>
            </div>

            <div class="row justify-content-end my-3">
                <div class="col-3">
                    <h4 class="txt-center">Total</h4>
                </div>
                <div class="col-3">
                    <h4 class="totalAll text-end"></h4>
                </div>
            </div>
            <div class="row my-3 justify-content-end">
                <div class="col-3 text-end">
                    <button class="btn btn-primary btn-order" disabled>Make an order</button>
                </div>
            </div>


            <!-- </div> -->
            <div class="swiper-pagination"></div>
            <!-- </div> -->
        </div>
    </div>
</section>

<!-- <section class="features py-5">
     <div class="container">
         <div class="row">
             <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="0">
                 <div class="py-5">
                     <svg width="38" height="38" viewBox="0 0 24 24">
                         <use xlink:href="#calendar"></use>
                     </svg>
                     <h4 class="element-title text-capitalize my-3">Book An Appointment</h4>
                     <p>At imperdiet dui accumsan sit amet nulla risus est ultricies quis.</p>
                 </div>
             </div>
             <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="300">
                 <div class="py-5">
                     <svg width="38" height="38" viewBox="0 0 24 24">
                         <use xlink:href="#shopping-bag"></use>
                     </svg>
                     <h4 class="element-title text-capitalize my-3">Pick up in store</h4>
                     <p>At imperdiet dui accumsan sit amet nulla risus est ultricies quis.</p>
                 </div>
             </div>
             <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="600">
                 <div class="py-5">
                     <svg width="38" height="38" viewBox="0 0 24 24">
                         <use xlink:href="#gift"></use>
                     </svg>
                     <h4 class="element-title text-capitalize my-3">Special packaging</h4>
                     <p>At imperdiet dui accumsan sit amet nulla risus est ultricies quis.</p>
                 </div>
             </div>
             <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="900">
                 <div class="py-5">
                     <svg width="38" height="38" viewBox="0 0 24 24">
                         <use xlink:href="#arrow-cycle"></use>
                     </svg>
                     <h4 class="element-title text-capitalize my-3">free global returns</h4>
                     <p>At imperdiet dui accumsan sit amet nulla risus est ultricies quis.</p>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <section class="categories overflow-hidden">
     <div class="container">
         <div class="open-up" data-aos="zoom-out">
             <div class="row">
                 <div class="col-md-4">
                     <div class="cat-item image-zoom-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/cat-item1.jpg" alt="categories" class="product-image img-fluid">
                             </a>
                         </div>
                         <div class="category-content">
                             <div class="product-button">
                                 <a href="index.html" class="btn btn-common text-uppercase">Shop for men</a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="cat-item image-zoom-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/cat-item2.jpg" alt="categories" class="product-image img-fluid">
                             </a>
                         </div>
                         <div class="category-content">
                             <div class="product-button">
                                 <a href="index.html" class="btn btn-common text-uppercase">Shop for women</a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="cat-item image-zoom-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/cat-item3.jpg" alt="categories" class="product-image img-fluid">
                             </a>
                         </div>
                         <div class="category-content">
                             <div class="product-button">
                                 <a href="index.html" class="btn btn-common text-uppercase">Shop accessories</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <section id="new-arrival" class="new-arrival product-carousel py-5 position-relative overflow-hidden">
     <div class="container">
         <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
             <h4 class="text-uppercase">Our New Arrivals</h4>
             <a href="index.html" class="btn-link">View All Products</a>
         </div>
         <div class="swiper product-swiper open-up" data-aos="zoom-out">
             <div class="swiper-wrapper d-flex">
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder position-relative">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-1.jpg" alt="categories" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="element-title text-uppercase fs-5 mt-3">
                                     <a href="index.html">Dark florish onepiece</a>
                                 </h5>
                                 <a href="#" class="text-decoration-none" data-after="Add to cart"><span>$95.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder position-relative">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-2.jpg" alt="categories" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Baggy Shirt</a>
                                 </h5>
                                 <a href="#" class="text-decoration-none" data-after="Add to cart"><span>$55.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder position-relative">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-3.jpg" alt="categories" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Cotton off-white shirt</a>
                                 </h5>
                                 <a href="#" class="text-decoration-none" data-after="Add to cart"><span>$65.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder position-relative">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-4.jpg" alt="categories" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Crop sweater</a>
                                 </h5>
                                 <a href="#" class="text-decoration-none" data-after="Add to cart"><span>$50.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder position-relative">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-10.jpg" alt="categories" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Crop sweater</a>
                                 </h5>
                                 <a href="#" class="text-decoration-none" data-after="Add to cart"><span>$70.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="swiper-pagination"></div>
         </div>
         <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
                 <use xlink:href="#arrow-left"></use>
             </svg></div>
         <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
                 <use xlink:href="#arrow-right"></use>
             </svg></div>
     </div>
 </section>

 <section class="collection bg-light position-relative py-5">
     <div class="container">
         <div class="row">
             <div class="title-xlarge text-uppercase txt-fx domino">Collection</div>
             <div class="collection-item d-flex flex-wrap my-5">
                 <div class="col-md-6 column-container">
                     <div class="image-holder">
                         <img src="<?= base_url('assets/') ?>images/single-image-2.jpg" alt="collection" class="product-image img-fluid">
                     </div>
                 </div>
                 <div class="col-md-6 column-container bg-white">
                     <div class="collection-content p-5 m-0 m-md-5">
                         <h3 class="element-title text-uppercase">Classic winter collection</h3>
                         <p>Dignissim lacus, turpis ut suspendisse vel tellus. Turpis purus, gravida orci, fringilla a. Ac sed eu
                             fringilla odio mi. Consequat pharetra at magna imperdiet cursus ac faucibus sit libero. Ultricies quam
                             nunc, lorem sit lorem urna, pretium aliquam ut. In vel, quis donec dolor id in. Pulvinar commodo mollis
                             diam sed facilisis at cursus imperdiet cursus ac faucibus sit faucibus sit libero.</p>
                         <a href="#" class="btn btn-dark text-uppercase mt-3">Shop Collection</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <section id="best-sellers" class="best-sellers product-carousel py-5 position-relative overflow-hidden">
     <div class="container">
         <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
             <h4 class="text-uppercase">Best Selling Items</h4>
             <a href="index.html" class="btn-link">View All Products</a>
         </div>
         <div class="swiper product-swiper open-up" data-aos="zoom-out">
             <div class="swiper-wrapper d-flex">
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-4.jpg" alt="categories" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Dark florish onepiece</a>
                                 </h5>
                                 <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>$95.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-3.jpg" alt="product" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Baggy Shirt</a>
                                 </h5>
                                 <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>$55.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-5.jpg" alt="categories" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Cotton off-white shirt</a>
                                 </h5>
                                 <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>$65.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-6.jpg" alt="categories" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Handmade crop sweater</a>
                                 </h5>
                                 <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>$50.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-9.jpg" alt="categories" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Dark florish onepiece</a>
                                 </h5>
                                 <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>$70.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-10.jpg" alt="categories" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Cotton off-white shirt</a>
                                 </h5>
                                 <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>$70.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="swiper-pagination"></div>
         </div>
         <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
                 <use xlink:href="#arrow-left"></use>
             </svg></div>
         <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
                 <use xlink:href="#arrow-right"></use>
             </svg></div>
     </div>
 </section>

 <section class="video py-5 overflow-hidden">
     <div class="container-fluid">
         <div class="row">
             <div class="video-content open-up" data-aos="zoom-out">
                 <div class="video-bg">
                     <img src="<?= base_url('assets/') ?>images/video-image.jpg" alt="video" class="video-image img-fluid">
                 </div>
                 <div class="video-player">
                     <a class="youtube" href="https://www.youtube.com/embed/pjtsGzQjFM4">
                         <svg width="24" height="24" viewBox="0 0 24 24">
                             <use xlink:href="#play"></use>
                         </svg>
                         <img src="<?= base_url('assets/') ?>images/text-pattern.png" alt="pattern" class="text-rotate">
                     </a>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <section class="testimonials py-5 bg-light">
     <div class="section-header text-center mt-5">
         <h3 class="section-title">WE LOVE GOOD COMPLIMENT</h3>
     </div>
     <div class="swiper testimonial-swiper overflow-hidden my-5">
         <div class="swiper-wrapper d-flex">
             <div class="swiper-slide">
                 <div class="testimonial-item text-center">
                     <blockquote>
                         <p>“More than expected crazy soft, flexible and best fitted white simple denim shirt.”</p>
                         <div class="review-title text-uppercase">casual way</div>
                     </blockquote>
                 </div>
             </div>
             <div class="swiper-slide">
                 <div class="testimonial-item text-center">
                     <blockquote>
                         <p>“Best fitted white denim shirt more than expected crazy soft, flexible</p>
                         <div class="review-title text-uppercase">uptop</div>
                     </blockquote>
                 </div>
             </div>
             <div class="swiper-slide">
                 <div class="testimonial-item text-center">
                     <blockquote>
                         <p>“Best fitted white denim shirt more white denim than expected flexible crazy soft.”</p>
                         <div class="review-title text-uppercase">Denim craze</div>
                     </blockquote>
                 </div>
             </div>
             <div class="swiper-slide">
                 <div class="testimonial-item text-center">
                     <blockquote>
                         <p>“Best fitted white denim shirt more than expected crazy soft, flexible</p>
                         <div class="review-title text-uppercase">uptop</div>
                     </blockquote>
                 </div>
             </div>
         </div>
     </div>
     <div class="testimonial-swiper-pagination d-flex justify-content-center mb-5"></div>
 </section>

 <section id="related-products" class="related-products product-carousel py-5 position-relative overflow-hidden">
     <div class="container">
         <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
             <h4 class="text-uppercase">You May Also Like</h4>
             <a href="index.html" class="btn-link">View All Products</a>
         </div>
         <div class="swiper product-swiper open-up" data-aos="zoom-out">
             <div class="swiper-wrapper d-flex">
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-5.jpg" alt="product" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Dark florish onepiece</a>
                                 </h5>
                                 <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>$95.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-6.jpg" alt="product" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Baggy Shirt</a>
                                 </h5>
                                 <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>$55.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-7.jpg" alt="product" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Cotton off-white shirt</a>
                                 </h5>
                                 <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>$65.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-8.jpg" alt="product" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Handmade crop sweater</a>
                                 </h5>
                                 <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>$50.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="product-item image-zoom-effect link-effect">
                         <div class="image-holder">
                             <a href="index.html">
                                 <img src="<?= base_url('assets/') ?>images/product-item-1.jpg" alt="product" class="product-image img-fluid">
                             </a>
                             <a href="index.html" class="btn-icon btn-wishlist">
                                 <svg width="24" height="24" viewBox="0 0 24 24">
                                     <use xlink:href="#heart"></use>
                                 </svg>
                             </a>
                             <div class="product-content">
                                 <h5 class="text-uppercase fs-5 mt-3">
                                     <a href="index.html">Handmade crop sweater</a>
                                 </h5>
                                 <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>$70.00</span></a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="swiper-pagination"></div>
         </div>
         <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
                 <use xlink:href="#arrow-left"></use>
             </svg></div>
         <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
                 <use xlink:href="#arrow-right"></use>
             </svg></div>
     </div>
 </section>

 <section class="blog py-5">
     <div class="container">
         <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
             <h4 class="text-uppercase">Read Blog Posts</h4>
             <a href="index.html" class="btn-link">View All</a>
         </div>
         <div class="row">
             <div class="col-md-4">
                 <article class="post-item">
                     <div class="post-image">
                         <a href="index.html">
                             <img src="<?= base_url('assets/') ?>images/post-image1.jpg" alt="image" class="post-grid-image img-fluid">
                         </a>
                     </div>
                     <div class="post-content d-flex flex-wrap gap-2 my-3">
                         <div class="post-meta text-uppercase fs-6 text-secondary">
                             <span class="post-category">Fashion /</span>
                             <span class="meta-day"> jul 11, 2022</span>
                         </div>
                         <h5 class="post-title text-uppercase">
                             <a href="index.html">How to look outstanding in pastel</a>
                         </h5>
                         <p>Dignissim lacus,turpis ut suspendisse vel tellus.Turpis purus,gravida orci,fringilla...</p>
                     </div>
                 </article>
             </div>
             <div class="col-md-4">
                 <article class="post-item">
                     <div class="post-image">
                         <a href="index.html">
                             <img src="<?= base_url('assets/') ?>images/post-image2.jpg" alt="image" class="post-grid-image img-fluid">
                         </a>
                     </div>
                     <div class="post-content d-flex flex-wrap gap-2 my-3">
                         <div class="post-meta text-uppercase fs-6 text-secondary">
                             <span class="post-category">Fashion /</span>
                             <span class="meta-day"> jul 11, 2022</span>
                         </div>
                         <h5 class="post-title text-uppercase">
                             <a href="index.html">Top 10 fashion trend for summer</a>
                         </h5>
                         <p>Turpis purus, gravida orci, fringilla dignissim lacus, turpis ut suspendisse vel tellus...</p>
                     </div>
                 </article>
             </div>
             <div class="col-md-4">
                 <article class="post-item">
                     <div class="post-image">
                         <a href="index.html">
                             <img src="<?= base_url('assets/') ?>images/post-image3.jpg" alt="image" class="post-grid-image img-fluid">
                         </a>
                     </div>
                     <div class="post-content d-flex flex-wrap gap-2 my-3">
                         <div class="post-meta text-uppercase fs-6 text-secondary">
                             <span class="post-category">Fashion /</span>
                             <span class="meta-day"> jul 11, 2022</span>
                         </div>
                         <h5 class="post-title text-uppercase">
                             <a href="index.html">Crazy fashion with unique moment</a>
                         </h5>
                         <p>Turpis purus, gravida orci, fringilla dignissim lacus, turpis ut suspendisse vel tellus...</p>
                     </div>
                 </article>
             </div>
         </div>
     </div>
 </section>

 <section class="logo-bar py-5 my-5">
     <div class="container">
         <div class="row">
             <div class="logo-content d-flex flex-wrap justify-content-between">
                 <img src="<?= base_url('assets/') ?>images/logo1.png" alt="logo" class="logo-image img-fluid">
                 <img src="<?= base_url('assets/') ?>images/logo2.png" alt="logo" class="logo-image img-fluid">
                 <img src="<?= base_url('assets/') ?>images/logo3.png" alt="logo" class="logo-image img-fluid">
                 <img src="<?= base_url('assets/') ?>images/logo4.png" alt="logo" class="logo-image img-fluid">
                 <img src="<?= base_url('assets/') ?>images/logo5.png" alt="logo" class="logo-image img-fluid">
             </div>
         </div>
     </div>
 </section>

 <section class="newsletter bg-light" style="background: url(<?= base_url('assets/') ?> /images/pattern-bg.png) no-repeat;">
     <div class="container">
         <div class="row justify-content-center">
             <div class="col-md-8 py-5 my-5">
                 <div class="subscribe-header text-center pb-3">
                     <h3 class="section-title text-uppercase">Sign Up for our newsletter</h3>
                 </div>
                 <form id="form" class="d-flex flex-wrap gap-2">
                     <input type="text" name="email" placeholder="Your Email Addresss" class="form-control form-control-lg">
                     <button class="btn btn-dark btn-lg text-uppercase w-100">Sign Up</button>
                 </form>
             </div>
         </div>
     </div>
 </section>

 <section class="instagram position-relative">
     <div class="d-flex justify-content-center w-100 position-absolute bottom-0 z-1">
         <a href="https://www.instagram.com/templatesjungle/" class="btn btn-dark px-5">Follow us on Instagram</a>
     </div>
     <div class="row g-0">
         <div class="col-6 col-sm-4 col-md-2">
             <div class="insta-item">
                 <a href="https://www.instagram.com/templatesjungle/" target="_blank">
                     <img src="<?= base_url('assets/') ?>images/insta-item1.jpg" alt="instagram" class="insta-image img-fluid">
                 </a>
             </div>
         </div>
         <div class="col-6 col-sm-4 col-md-2">
             <div class="insta-item">
                 <a href="https://www.instagram.com/templatesjungle/" target="_blank">
                     <img src="<?= base_url('assets/') ?>images/insta-item2.jpg" alt="instagram" class="insta-image img-fluid">
                 </a>
             </div>
         </div>
         <div class="col-6 col-sm-4 col-md-2">
             <div class="insta-item">
                 <a href="https://www.instagram.com/templatesjungle/" target="_blank">
                     <img src="<?= base_url('assets/') ?>images/insta-item3.jpg" alt="instagram" class="insta-image img-fluid">
                 </a>
             </div>
         </div>
         <div class="col-6 col-sm-4 col-md-2">
             <div class="insta-item">
                 <a href="https://www.instagram.com/templatesjungle/" target="_blank">
                     <img src="<?= base_url('assets/') ?>images/insta-item4.jpg" alt="instagram" class="insta-image img-fluid">
                 </a>
             </div>
         </div>
         <div class="col-6 col-sm-4 col-md-2">
             <div class="insta-item">
                 <a href="https://www.instagram.com/templatesjungle/" target="_blank">
                     <img src="<?= base_url('assets/') ?>images/insta-item5.jpg" alt="instagram" class="insta-image img-fluid">
                 </a>
             </div>
         </div>
         <div class="col-6 col-sm-4 col-md-2">
             <div class="insta-item">
                 <a href="https://www.instagram.com/templatesjungle/" target="_blank">
                     <img src="<?= base_url('assets/') ?>images/insta-item6.jpg" alt="instagram" class="insta-image img-fluid">
                 </a>
             </div>
         </div>
     </div>
 </section> -->