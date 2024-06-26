<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Actividad 1 - backend</title>
    <?php
    echo '<link href="../partial/vendors/simplebar/css/simplebar.css" media="screen" rel="stylesheet" type="text/css" />';
    echo '<link href="../partial/css/vendors/simplebar.css" media="screen" rel="stylesheet" type="text/css" />';
    echo '<link href="../partial/css/style.css" media="screen" rel="stylesheet" type="text/css" />';
    echo '<link href="../partial/css/examples.css" media="screen" rel="stylesheet" type="text/css" />';
    echo '<link href="../partial/css/select2.min.css" rel="stylesheet" type="text/css" />';
    ?>
    <style>
        .campoRequerido {
            color: red;
        }
    </style>
</head>
<body>
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="assets/brand/coreui.svg#full"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="assets/brand/coreui.svg#signet"></use>
        </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="../index.php">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg> PRINCIPAL</a></li>
        <li class="nav-item"><a class="nav-link" href="../platform/List.php">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
                </svg> Plataforma</a>

        </li>
        <li class="nav-item"><a class="nav-link" href="../director/List.php">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                </svg> Director</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../actor/List.php">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-notes"></use>
                </svg> Actor</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../idioma/List.php">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-star"></use>
                </svg> Idioma</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../serie/List.php">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                </svg> Serie</a>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 18/6/2024
 * Time: 21:42
 */
