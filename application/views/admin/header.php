<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Language" content="en" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components." />
    <meta name="msapplication-tap-highlight" content="no" />
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/') ?>images/gs.png" />
    <!-- tabsheet -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- fontawesome -->
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/fontawesome.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/brands.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/solid.css') ?>">




    <!-- <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
      integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc="
      crossorigin="anonymous"
    /> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" /> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,300,700" />

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="<?= base_url('assets/css/lightbox.css') ?>" rel="stylesheet" />


    <link href="<?= base_url('assets/css/mainDashboard.css') ?>" rel="stylesheet" />

    <!-- tabsheet -->
    <style>
        .container {
            margin-top: 30px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Source Sans Pro";
            font-weight: 700;
        }

        .fancyTab {
            text-align: center;
            padding: 15px 0;
            background-color: #eee;
            box-shadow: 0 0 0 1px #ddd;
            top: 15px;
            transition: top 0.2s;
        }

        .fancyTab.active {
            top: 0;
            transition: top 0.2s;
        }

        .whiteBlock {
            display: none;
        }

        .fancyTab.active .whiteBlock {
            display: block;
            height: 2px;
            bottom: -2px;
            background-color: #fff;
            width: 99%;
            position: absolute;
            z-index: 1;
        }

        .fancyTab a {
            font-family: "Source Sans Pro";
            font-size: 1.65em;
            font-weight: 300;
            transition: 0.2s;
            color: #333;
        }

        /*.fancyTab .hidden-xs {
  white-space:nowrap;
}*/

        .fancyTabs {
            border-bottom: 2px solid #ddd;
            margin: 15px 0 0;
        }

        li.fancyTab a {
            padding-top: 15px;
            top: -15px;
            padding-bottom: 0;
            list-style: none;
        }

        li.fancyTab.active a {
            padding-top: inherit;
        }

        .fancyTab .fa {
            font-size: 40px;
            width: 100%;
            padding: 15px 0 5px;
            color: #666;
        }

        .fancyTab.active .fa {
            color: #cfb87c;
        }

        .fancyTab a:focus {
            outline: none;
        }

        .fancyTabContent {
            border-color: transparent;
            box-shadow: 0 -2px 0 -1px #fff, 0 0 0 1px #ddd;
            padding: 30px 15px 15px;
            position: relative;
            background-color: #fff;
        }

        .nav-tabs>li.fancyTab.active>a,
        .nav-tabs>li.fancyTab.active>a:focus,
        .nav-tabs>li.fancyTab.active>a:hover {
            border-width: 0;
            list-style: none;
        }

        .nav-tabs>li.fancyTab:hover {
            background-color: #f9f9f9;
            box-shadow: 0 0 0 1px #ddd;
            list-style: none;
        }

        .nav-tabs>li.fancyTab.active:hover {
            background-color: #fff;
            box-shadow: 1px 1px 0 1px #fff, 0 0px 0 1px #ddd, -1px 1px 0 0px #ddd inset;
            list-style: none;
        }

        .nav-tabs>li.fancyTab:hover a {
            border-color: transparent;
            list-style: none;
        }

        .nav.nav-tabs .fancyTab a[data-toggle="tab"] {
            background-color: transparent;
            border-bottom: 0;
        }

        .nav-tabs>li.fancyTab:hover a {
            border-right: 1px solid transparent;
            list-style: none;
        }

        a {
            list-style: none;
        }

        .nav-tabs>li.fancyTab>a {
            margin-right: 0;
            border-top: 0;
            padding-bottom: 30px;
            margin-bottom: -30px;
        }

        .nav-tabs>li.fancyTab {
            margin-right: 0;
            margin-bottom: 0;
        }

        .nav-tabs>li.fancyTab:last-child a {
            border-right: 1px solid transparent;
        }

        .nav-tabs>li.fancyTab.active:last-child {
            border-right: 0px solid #ddd;
            box-shadow: 0px 2px 0 0px #fff, 0px 0px 0 1px #ddd;
        }

        .fancyTab:last-child {
            box-shadow: 0 0 0 1px #ddd;
        }

        .tabs .nav-tabs li.fancyTab.active a {
            box-shadow: none;
            top: 0;
        }

        .fancyTab.active {
            background: #fff;
            box-shadow: 1px 1px 0 1px #fff, 0 0px 0 1px #ddd, -1px 1px 0 0px #ddd inset;
            padding-bottom: 30px;
        }

        .arrow-down {
            display: none;
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 22px solid #ddd;
            position: absolute;
            top: -1px;
            left: calc(50% - 20px);
        }

        .arrow-down-inner {
            width: 0;
            height: 0;
            border-left: 18px solid transparent;
            border-right: 18px solid transparent;
            border-top: 12px solid #fff;
            position: absolute;
            top: -22px;
            left: -18px;
        }

        .fancyTab.active .arrow-down {
            display: block;
        }

        @media (max-width: 1200px) {
            .fancyTab .fa {
                font-size: 36px;
            }

            .fancyTab .hidden-xs {
                font-size: 22px;
            }
        }

        @media (max-width: 992px) {
            .fancyTab .fa {
                font-size: 33px;
            }

            .fancyTab .hidden-xs {
                font-size: 18px;
                font-weight: normal;
            }
        }

        @media (max-width: 768px) {
            .fancyTab>a {
                font-size: 18px;
            }

            .nav>li.fancyTab>a {
                padding: 15px 0;
                margin-bottom: inherit;
            }

            .fancyTab .fa {
                font-size: 30px;
            }

            .nav-tabs>li.fancyTab>a {
                border-right: 1px solid transparent;
                padding-bottom: 0;
            }

            .fancyTab.active .fa {
                color: #333;
            }
        }
    </style>

</head>