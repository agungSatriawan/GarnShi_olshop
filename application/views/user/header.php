<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- css bostrap5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- bootsraps icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- My css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <title>SARI KUSUMA 99</title>

    <style>
        @charset "UTF-8";

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Open Sans Condensed", sans-serif;
            font-weight: 700;
        }

        html,
        body {
            background: #eee5e9;
        }

        header {
            width: 95%;
            display: flex;
            justify-content: flex-end;
            flex-flow: row wrap;
        }

        header ul {
            padding: 1.2em 0 0.5em;
        }

        header span {
            padding: 0 0 0 0.5em;
        }

        header span,
        header i {
            color: #2b2d42;
        }

        header i:nth-of-type(2) {
            cursor: pointer;
        }

        .row {
            width: 100%;
            justify-content: flex-start;
            display: flex;
            flex-flow: row wrap;
        }

        .product,
        .product--pink,
        .product--yellow,
        .product--green,
        .product--red,
        .product--orange,
        .product--blue {
            box-shadow: 1px 5px 15px #ccc;
            width: 15em;
            height: auto;
            border-radius: 3px;
            padding: 2em;
            margin: 1em;
            overflow: hidden;
            position: relative;
            flex: auto;
        }

        .product--blue {
            background: linear-gradient(-45deg, #92dce5 50%, rgba(255, 255, 255, 0.5) 50%);
        }

        .product--orange {
            background: linear-gradient(-45deg, #ef6f6c 50%, rgba(255, 255, 255, 0.5) 50%);
        }

        .product--red {
            background: linear-gradient(-45deg, #e84855 50%, rgba(255, 255, 255, 0.5) 50%);
        }

        .product--green {
            background: linear-gradient(-45deg, #70c1b3 50%, rgba(255, 255, 255, 0.5) 50%);
        }

        .product--yellow {
            background: linear-gradient(-45deg, #e8db7d 50%, rgba(255, 255, 255, 0.5) 50%);
        }

        .product--pink {
            background: linear-gradient(-45deg, #ff386d 50%, rgba(255, 255, 255, 0.5) 50%);
        }

        .product img,
        .product--blue img,
        .product--orange img,
        .product--red img,
        .product--green img,
        .product--yellow img,
        .product--pink img {
            max-width: 100%;
            height: auto !important;
            text-align: center;
        }

        .product_inner {
            display: flex;
            align-items: center;
            flex-flow: column wrap;
        }

        .product_inner p {
            color: rgba(255, 255, 255, 0.9);
        }

        .product_inner button {
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: #fff;
            border-radius: 3px;
            padding: 1em 3em;
            margin: 1em 0 0 0;
            background: none;
            cursor: pointer;
            transition: background ease-in 0.25s;
        }

        .product_inner button:hover {
            background: white;
            color: #2b2d42;
        }

        .product_inner button:before {
            font-family: FontAwesome;
            content: "";
            color: #fff;
            position: absolute;
            font-size: 1.5em;
            margin: 0 -1.5em;
        }

        .product_inner button:hover:before {
            color: #2b2d42;
        }

        .product_overlay {
            background: rgba(255, 255, 255, 0.9);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            transform: translateY(-500px);
            opacity: 0;
            display: flex;
            flex-flow: column wrap;
            justify-content: center;
            align-items: center;
        }

        .product_overlay h2 {
            color: rgba(43, 45, 66, 0.7);
            font-size: 1.2em;
            margin: 1em 0;
        }

        .product_overlay i {
            color: rgba(43, 45, 66, 0.7);
            font-size: 1.5em;
        }
    </style>
</head>