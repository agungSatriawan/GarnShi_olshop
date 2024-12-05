<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NB9PNP0S79"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-NB9PNP0S79');
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="Agung">
    <meta name="description" content="Belanja Busana dan Baju Muslim, Jilbab, Kerudung, dan Baju Anak di toko retail dan grosir online. Ready Stock, Siap Kirim dan Boleh Tukar." />
    <meta name="keywords" content="Toko Online, Jilbab, Kerudung, Busana Muslim, Baju Muslim, Baju Anak Muslim" />
    <meta name="description" content="Terinspirasi dari keindahan pantai putih, koleksi terbaru GarnShi hadir dengan perpaduan warna-warna lembut dan siluet yang elegan. Sempurna untuk menemani momen spesial Anda.
">
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/') ?>images/gs.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>css/vendor.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/') ?>style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Marcellus&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <!-- fontawesome -->
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/fontawesome.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/brands.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/solid.css') ?>">
    <!-- fontawesome -->
    <!-- datatable -->

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="<?= base_url('assets/css/lightbox.css') ?>" rel="stylesheet" />


    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="<?= base_url('assets/css/mystyle.css') ?>">
    <?php if ($this->uri->segment(1) == 'auth') : ?>
        <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
    <?php endif ?>
    <!-- sandbox -->
    <!-- <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-lenX9leqcQ--CnhT"></script> -->

    <!-- production -->
    <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-pl4utAWgWhQ6v5xX"></script>

</head>