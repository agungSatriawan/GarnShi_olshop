<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title><?= $title ?></title>
    <style>
        ::selection {
            color: #ffffff;
            background-color: #31285C;
        }

        * {
            padding: 0;
            margin: 0;
            font-family: 'Outfit', sans-serif;
            box-sizing: border-box;
            text-decoration: none;
        }

        a {
            color: #31285C;
        }



        body {
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: #F0F0F0;
            padding-top: 20px;
        }

        .wrapper {
            width: 400px;
            min-height: 100px;
            background-color: #FFFFFF;
            border-radius: 5px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .input-field {
            width: 100%;
            height: 45px;
            border: none;
            padding: 10px;
            background-color: #eeeeee;
            color: gray;
            outline: none;
            font-size: 15px;
            margin-bottom: 20px;
            transition: .5s;
            border-radius: 5px;
        }

        input:hover {}


        .heading {
            color: #3B3663;
            margin-bottom: 20px;
        }

        .heading p {
            color: #AAA8BB;
        }

        .heading i {
            font-size: 30px;
            color: #4D61FC;
        }

        label {
            color: #AAA8BB;
            font-weight: 400;
        }

        button {
            width: 100%;
            height: 45px;
            border: none;
            color: #FFFFFF;
            background-color: #31285C;
            border-radius: 5px;
            font-size: 17px;
            font-weight: 500;
            transition: 0.3s;
        }

        button:hover {
            background-color: #31283B;
        }

        .row {
            min-width: 5px;
            min-height: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .custom-checkbox {
            width: 17px;
            height: 17px;
            border-radius: 5px;
            background-color: #eeeeee;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            margin-right: 5px;
        }

        input[type=checkbox]:checked~.custom-checkbox {
            background-color: #31285C;
        }

        input[type=checkbox]:checked~.custom-checkbox::before {
            font-family: "Font Awesome 5 Free";
            content: "\f00c";
            display: inline-block;
            font-weight: 900;
            color: #ffffff;
        }

        footer {
            text-align: center;
            margin: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <div class="heading">
            <h2>Lupa Password</h2>
            <p>Masukan Email Terdaftar</p>
        </div>
        <div class="flash mt-5 mb-3">
            <?= $this->session->flashdata('message') ?>
        </div>

        <form method="POST" action="<?= base_url('login/forgotPassword') ?>">
            <div class="input-group">
                <input type="text" id="username" autocomplete="off" name="username" class="input-field" placeholder="Username">
                <?= form_error('username', '<small class="text-danger mt-1">', '</small>') ?>
            </div>
            <div class="row">
                <div class="col-sm-6">

                    <a href="<?= base_url('login') ?>" target="_blank">Login</a>
                </div>
            </div>





            <div class="input-group">
                <button type="submit">Kirim <i class="fa-solid fa-arrow-right"></i></button>
            </div>
    </div>
    </form>


    <footer>
        <!-- Created With ❤️ by <a href="https://instagram.com/_bh.oopendra" target="_black">Bhoopendra</a> -->
    </footer>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>