<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Survey Kepuasan Tamu Mess</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="baseURL" content="<?= BASEURL; ?>" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/ui.jqgrid.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/fonts.googleapis.com.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/select2.min.css" />
    <style>
        .main-container,
        .page-content {
            background-color: lightgray;
        }

        .form-content {
            background-color: white;
            padding: 1rem;
        }

        hr {
            margin-top: 0px;
            margin-bottom: 10px;
        }

        .mb-10 {
            margin-bottom: 20px;
        }

        .mb-5 {
            margin-bottom: 10px;
        }

        .col-xs-1.angket {
            width: 0%;
        }

        .pertanyaan {
            font-size: 14px;
        }

        .offset-3 {
            margin-left: 6%;
        }

        .offset-12 {
            margin-left: 12%;
        }

        textarea {
            width: 80% !important;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .mt-50 {
            margin-top: 50px;
        }

        .mb-50 {
            margin-bottom: 50px;
        }

        .kepuasan {
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 10%;
        }

        .text-kepuasan {
            padding-top: 10px;
        }

        /* .col-xs-4.kepuasan {
            padding: 10px;
            margin: 1px;
        } */

        .kepuasan.sangat-puas:hover {
            background-color: limegreen;
        }

        .kepuasan.sangat-puas.active {
            background-color: limegreen;
        }

        .kepuasan.cukup-puas:hover {
            background-color: yellow;
        }

        .kepuasan.cukup-puas.active {
            background-color: yellow;
        }

        .kepuasan.tidak-puas:hover {
            background-color: salmon;
        }

        .kepuasan.tidak-puas.active {
            background-color: salmon;
        }

        label * {
            cursor: pointer;
        }

        .saran {
            padding-top: 10px;
            border-radius: 10%;
        }

        /* .saran.saran-pelayanan:hover {
            background-color: powderblue;

        }

        .saran.saran-hidangan:hover {
            background-color: navajowhite;

        }

        .saran.saran-fasilitas:hover {
            background-color: thistle;

        }

        .saran.saran-kebersihan:hover {
            background-color: lightsalmon;

        }

        .saran.saran-pelayanan.active {
            background-color: powderblue;

        }

        .saran.saran-hidangan.active {
            background-color: navajowhite;

        }

        .saran.saran-fasilitas.active {
            background-color: thistle;

        }

        .saran.saran-kebersihan.active {
            background-color: lightsalmon;

        } */

        .radio-kepuasan {
            position: absolute;
            left: -9999px;
        }

        .parent-kepuasan * {
            cursor: pointer;
        }
    </style>
</head>

<body class="skin-1">

    <div class="main-container ace-save-state" id="main-container">

        <div class="main-content">
            <div class="main-content-inner">

                <div class="page-content">

                    <div class="row">
                        <div class="col-xs-12 col-md-8 col-md-offset-2 border-1">
                            <!-- PAGE CONTENT START -->