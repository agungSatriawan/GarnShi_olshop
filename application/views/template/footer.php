  <footer id="footer" class="mt-5">
      <div class="container">
          <div class="row d-flex flex-wrap justify-content-between py-5">
              <div class="col-md-3 col-sm-6">
                  <div class="footer-menu footer-menu-001">
                      <div class="footer-intro mb-4">
                          <a href="index.php">
                              <img class="image-footer" src="<?= base_url('assets/') ?>images/gs.png" alt="logo">
                              <h3 class="d-inline"> Gar&Shi</h3>
                          </a>
                      </div>
                      <p>Terinspirasi dari keindahan pantai putih, koleksi terbaru Gar&Shi hadir dengan perpaduan warna-warna lembut dan siluet yang elegan. Sempurna untuk menemani momen spesial Anda.
                      </p>
                      <div class="social-links">
                          <ul class="list-unstyled d-flex flex-wrap gap-3">
                              <li>
                                  <a href="https://www.facebook.com/people/GarShi/61569421666258/" class="text-secondary">
                                      <svg width="24" height="24" viewBox="0 0 24 24">
                                          <use xlink:href="#facebook"></use>
                                      </svg>
                                  </a>
                              </li>
                              <li>
                                  <a href="https://shopee.co.id/garnshi" class="text-secondary">
                                      <img src="<?= base_url('assets/images/background/shopee-svgrepo-com.png') ?>" alt="" width="24">
                                      <!-- <svg width="24" height="24" viewBox="0 0 24 24">
                                          <use xlink:href="#shopping-bag"></use>
                                      </svg> -->
                                  </a>
                              </li>
                              <li>
                                  <a href="https://www.youtube.com/@Garshi-c3s" class="text-secondary">
                                      <svg width="24" height="24" viewBox="0 0 24 24">
                                          <use xlink:href="#youtube"></use>
                                      </svg>
                                  </a>
                              </li>

                              <li>
                                  <a href="https://www.instagram.com/garnshi_" class="text-secondary" alt="instagram garnshi">
                                      <svg width="24" height="24" viewBox="0 0 24 24">
                                          <use xlink:href="#instagram"></use>
                                      </svg>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 col-sm-6">
                  <div class="footer-menu footer-menu-002">
                      <h5 class="widget-title  mb-4">Quick Links</h5>
                      <ul class="menu-list list-unstyled  border-animation-left fs-6">
                          <li class="menu-item">
                              <a href="index.php" class="item-anchor">Home</a>
                          </li>
                          <li class="menu-item">
                              <a href="index.php" class="item-anchor">About</a>
                          </li>
                          <li class="menu-item">
                              <a href="index.php" class="item-anchor">Services</a>
                          </li>
                          <li class="menu-item">
                              <a href="styles.html" class="item-anchor">Single item</a>
                          </li>
                          <li class="menu-item">
                              <a href="#" class="item-anchor">Contact</a>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="col-md-3 col-sm-6">
                  <div class="footer-menu footer-menu-003">
                      <h5 class="widget-title  mb-4">Help & Info</h5>
                      <ul class="menu-list list-unstyled  border-animation-left fs-6">
                          <li class="menu-item">
                              <a href="<?= base_url('home/pesanan') ?>" class="item-anchor">Track Your Order</a>
                          </li>
                          <li class="menu-item">
                              <a href="#" class="item-anchor">Returns + Exchanges</a>
                          </li>
                          <li class="menu-item">
                              <a href="#" class="item-anchor">Shipping + Delivery</a>
                          </li>
                          <li class="menu-item">
                              <a href="#" class="item-anchor">Contact Us</a>
                          </li>
                          <li class="menu-item">
                              <a href="<?= base_url() ?>" class="item-anchor">Find us easy</a>
                          </li>
                          <li class="menu-item">
                              <a href="index.php" class="item-anchor">Faqs</a>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="col-md-3 col-sm-6">
                  <div class="footer-menu footer-menu-004 border-animation-left">
                      <h5 class="widget-title  mb-4">Contact Us</h5>
                      <p>Do you have any questions or suggestions? <a href="mailto:cs@garnshi.com" class="item-anchor">cs@garnshi.com</a></p>
                      <p>Do you need support? Give us a call. <a href="tel:+6282114179247" class="item-anchor">+6282 1141 79247</a>
                      </p>
                  </div>
              </div>
          </div>
      </div>
      <div class="border-top py-4">
          <div class="container">
              <div class="row">
                  <div class="col-md-6 d-flex flex-wrap">
                      <div class="shipping">
                          <span>We ship with:</span>
                          <img src="<?= base_url('assets/') ?>images/arct-icon.png" alt="icon">
                          <img src="<?= base_url('assets/') ?>images/dhl-logo.png" alt="icon">
                      </div>
                      <div class="payment-option">
                          <span>Payment Option:</span>
                          <img src="<?= base_url('assets/') ?>images/visa-card.png" alt="card">
                          <img src="<?= base_url('assets/') ?>images/paypal-card.png" alt="card">
                          <img src="<?= base_url('assets/') ?>images/master-card.png" alt="card">
                      </div>
                  </div>
                  <div class="col-md-6 text-end">
                      <p>© Copyright <?= date('Y') ?> Gar&Shi. All rights reserved.</p>
                  </div>
              </div>
          </div>
      </div>
  </footer>


  <div class="floating_btn">
      <?php
        $nomor_hp = "+6282114179247";
        $pesan = "Saya ingin bertanya tentang Gar&Shi";

        // Encode karakter khusus dalam pesan
        $pesan_encoded = urlencode($pesan);

        // Bentuk URL lengkap
        $url = "https://api.whatsapp.com/send?phone=" . $nomor_hp . "&text=" . $pesan_encoded;
        ?>
      <a target="_blank" href="<?= $url ?>">

          <div class="contact_icon">
              <i class="fa-brands fa-whatsapp"></i>
          </div>
      </a>
      <small class="d-block mt-2">Klik yuu</small>

      <!-- <p class="text_icon">Cuss.. klik ya,</p> kita ngobrol disini</p> -->
  </div>