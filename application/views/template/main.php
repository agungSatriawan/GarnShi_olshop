<style>
    .carousel-indicators button.thumbnail {
        width: 100px;
    }

    .carousel-indicators button.thumbnail:not(.active) {
        opacity: 0.7;
    }

    .carousel-indicators [data-bs-target] {
        width: 100px;
    }

    /* .carousel-indicators {
        position: static;
    } */

    .thumbnail {
        width: 100px;
    }
</style>





<section id="billboard" class="bg-light">
    <div class="bd-example">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-inner">

                <a href="<?= base_url('home/detail/60') ?>">
                    <img src="<?= base_url('assets/') ?>images/product/BANER ATAS.png" class="d-block w-100" alt="...">
                </a>


            </div>

        </div>

        <br>

    </div>
</section>
<section id="billboard" class="bg-light">
    <div class="bd-example">



        <div id="carouselExampleDark" class="carousel carousel-dark slide">


            <div class="carousel-inner">

                <?php $y = 0; ?>
                <?php foreach ($carousel as $c) : ?>

                    <div class="carousel-item <?= $y == 0 ? 'active' : '' ?>" data-bs-interval="5000">
                        <a href="<?= base_url('home/detail/' . $c['description']) ?>">
                            <img src="<?= base_url('assets/') ?>images/product/<?= $c['image'] ?>" class="d-block w-100" alt="...">
                        </a>

                    </div>


                    <?php $y++; ?>
                <?php endforeach; ?>
            </div>


            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>






        <br>

    </div>
</section>




<section id="billboard" class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="section-title text-center mt-4" data-aos="fade-up">New Arrival</h1>

        </div>
        <div class="row">
            <div class="swiper main-swiper py-4" data-aos="fade-up" data-aos-delay="600">
                <div class="swiper-wrapper d-flex border-animation-left">

                    <?php foreach ($product as $p) : ?>
                        <div class="swiper-slide">
                            <div class="banner-item image-zoom-effect">
                                <div class="image-holder">
                                    <a href="<?= base_url('home/detail/' . $p['id']) ?>?s=<?= $p['product_name'] ?>">
                                        <img src="<?= base_url('assets/') ?>images/product/<?= $p['image'] ?>" alt="product" class="img-fluid">
                                    </a>
                                </div>
                                <div class="banner-content py-4 text-truncate">
                                    <h5 class="element-title text-uppercase">
                                        <a href="<?= base_url('home/detail/' . $p['id']) ?>" class="item-anchor"><?= $p['product_name'] ?></a>
                                    </h5>
                                    <div class="detailInfo" style="height: 75px; overflow: hidden;">
                                        <p><?= html_entity_decode($p['description']) ?></p>
                                    </div>
                                    <div class="btn-left">
                                        <a href="<?= base_url('home/detail/' . $p['id']) ?>" class="btn-link fs-6 text-uppercase item-anchor text-decoration-none">Discover Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

        <div class="row justify-content-center">

            <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
                <p>🌊 The Story of "In the Heart of the Sea" 🌊</p>

                <p> Terinspirasi oleh ketenangan laut biru, koleksi ini mengangkat keindahan alam bawah laut yang memikat. Setiap bordir kerang dan bintang laut melambangkan harmoni dan kekuatan, sementara payet mutiara menyimbolkan keanggunan abadi.</p>

                <p> Hijab Paris Japan Premium ini adalah penghormatan untuk wanita yang tenang namun penuh daya—seperti laut itu sendiri. Dengan desain eksklusif dan detail yang memikat, In the Heart of the Sea dirancang untuk membalut Anda dengan keanggunan yang menenangkan, setiap kali Anda memakainya.</p>
                <p>
                    ✨ Hadir dalam edisi terbatas, siap menyelami keindahan?
                </p>
            </div>
        </div>
    </div>
</section>


<section id="billboard" class="bg-light py-5">
    <div class="bd-example">
        <div id="carouselExampleDark2" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-inner">
                <?php $l = 0; ?>
                <?php foreach ($diskon as $c) : ?>
                    <div class="carousel-item <?= $l == 0 ? 'active' : '' ?>">
                        <img src="<?= base_url('assets/') ?>images/product/<?= $c['image'] ?>" class="d-block w-100" alt="...">
                    </div>
                    <?php $l++; ?>
                <?php endforeach; ?>


            </div>
            <div class="carousel-indicators">
                <?php $z = 0; ?>
                <?php foreach ($diskon as $d) : ?>
                    <button type="button" data-bs-target="#carouselExampleDark2" data-bs-slide-to="<?= $z ?>" class="<?= $z == 0 ? 'active' : '' ?> thumbnail" aria-current="true" aria-label="Slide <?= $z ?>">
                        <img src="<?= base_url('assets/') ?>images/product/<?= $d['image'] ?>" class="d-block w-100" alt="...">
                    </button>




                    <?php $z++; ?>
                <?php endforeach; ?>


            </div>
        </div>

        <br>

    </div>
</section>


<section class="video py-5 overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="video-content open-up aos-init aos-animate" data-aos="zoom-out">
                <div class="video-bg">
                    <img src="<?= base_url('assets/images/background/thumbnail.jpeg') ?>" alt="video" class="video-image img-fluid" width="2000">
                </div>
                <div class="video-player">
                    <a class="youtube cboxElement" href="https://www.youtube.com/embed/07WIsCS6sDc?si=mawZOSOJjS5Vqh_s">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#play"></use>
                        </svg>
                        <img src="<?= base_url('assets/images/GARSHI.png') ?>" alt="pattern" class="text-rotate">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>