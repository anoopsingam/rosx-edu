<?php
require './config.php';
$app = new app();
login::checkLogin();
$db = new database();
$user=login::UserInfo($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= url::myurl().'/'.$app->logo?>">
    <link rel="icon" type="image/png" href="<?= url::myurl().'/'.$app->logo?>">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <?= includes::css()?>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Sora:wght@300;400;500;600;700;800&display=swap');


    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Sora', sans-serif;
    }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="/Dashboard">
                <img src="<?= url::myurl().'/'.$app->logo?>" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold"><?= $app->name;?></span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link active"
                        aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"
                                                    opacity="0.598981585"></path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboards</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">PAGES</h6>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link " aria-controls="pagesExamples"
                        role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <!-- Include Relavent SVG -->
                        </div>
                        <span class="nav-link-text ms-1">Pages</span>
                    </a>
                    <div class="collapse " id="pagesExamples">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false"
                                    href="#profileExample">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal"> Profile <b class="caret"></b></span>
                                </a>
                                <div class="collapse " id="profileExample">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link " href="../../pages/pages/profile/overview.html">
                                                <span class="sidenav-mini-icon text-xs"> P </span>
                                                <span class="sidenav-normal"> Profile Overview </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="../../pages/pages/profile/teams.html">
                                                <span class="sidenav-mini-icon text-xs"> T </span>
                                                <span class="sidenav-normal"> Teams </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="../../pages/pages/profile/projects.html">
                                                <span class="sidenav-mini-icon text-xs"> A </span>
                                                <span class="sidenav-normal"> All Projects </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false"
                                    href="#usersExample">
                                    <span class="sidenav-mini-icon"> U </span>
                                    <span class="sidenav-normal"> Users <b class="caret"></b></span>
                                </a>
                                <div class="collapse " id="usersExample">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link " href="../../pages/pages/users/reports.html">
                                                <span class="sidenav-mini-icon text-xs"> R </span>
                                                <span class="sidenav-normal"> Reports </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="../../pages/pages/users/new-user.html">
                                                <span class="sidenav-mini-icon text-xs"> N </span>
                                                <span class="sidenav-normal"> New User </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false"
                                    href="#accountExample">
                                    <span class="sidenav-mini-icon"> A </span>
                                    <span class="sidenav-normal"> Account <b class="caret"></b></span>
                                </a>
                                <div class="collapse " id="accountExample">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link " href="../../pages/pages/account/settings.html">
                                                <span class="sidenav-mini-icon text-xs"> S </span>
                                                <span class="sidenav-normal"> Settings </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="../../pages/pages/account/billing.html">
                                                <span class="sidenav-mini-icon text-xs"> B </span>
                                                <span class="sidenav-normal"> Billing </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="../../pages/pages/account/invoice.html">
                                                <span class="sidenav-mini-icon text-xs"> I </span>
                                                <span class="sidenav-normal"> Invoice </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="../../pages/pages/account/security.html">
                                                <span class="sidenav-mini-icon text-xs"> S </span>
                                                <span class="sidenav-normal"> Security </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false"
                                    href="#projectsExample">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal"> Projects <b class="caret"></b></span>
                                </a>
                                <div class="collapse " id="projectsExample">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link " href="../../pages/pages/projects/general.html">
                                                <span class="sidenav-mini-icon text-xs"> G </span>
                                                <span class="sidenav-normal"> General </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="../../pages/pages/projects/timeline.html">
                                                <span class="sidenav-mini-icon text-xs"> T </span>
                                                <span class="sidenav-normal"> Timeline </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="../../pages/pages/projects/new-project.html">
                                                <span class="sidenav-mini-icon text-xs"> N </span>
                                                <span class="sidenav-normal"> New Project </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="../../pages/pages/pricing-page.html">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal"> Pricing Page </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="../../pages/pages/messages.html">
                                    <span class="sidenav-mini-icon"> M </span>
                                    <span class="sidenav-normal"> Messages </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="../../pages/pages/rtl-page.html">
                                    <span class="sidenav-mini-icon"> R </span>
                                    <span class="sidenav-normal"> RTL </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="../../pages/pages/widgets.html">
                                    <span class="sidenav-mini-icon"> W </span>
                                    <span class="sidenav-normal"> Widgets </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="../../pages/pages/charts.html">
                                    <span class="sidenav-mini-icon"> C </span>
                                    <span class="sidenav-normal"> Charts </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="../../pages/pages/sweet-alerts.html">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Sweet Alerts </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="../../pages/pages/notifications.html">
                                    <span class="sidenav-mini-icon"> N </span>
                                    <span class="sidenav-normal"> Notifications </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#admission_dropdown" class="nav-link "
                        aria-controls="admission_dropdown" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                <path fill-rule="evenodd"
                                    d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Admissions</span>
                    </a>
                    <div class="collapse " id="admission_dropdown">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link " href="<?= func::href("/Admission/new")?>">
                                    <span class="sidenav-mini-icon"> N </span>
                                    <span class="sidenav-normal"> New Admission </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="<?= func::href("/Admission/QuickAdmission")?>">
                                    <span class="sidenav-mini-icon"> Q </span>
                                    <span class="sidenav-normal"> Quick Admission </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="<?= func::href("/Admission/Manage")?>">
                                    <span class="sidenav-mini-icon"> Ap </span>
                                    <span class="sidenav-normal"> Admission Data </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#fee_transactions" class="nav-link "
                        aria-controls="fee_transactions" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-wallet-fill" viewBox="0 0 16 16">
                                <path
                                    d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542.637 0 .987-.254 1.194-.542.226-.314.306-.705.306-.958a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2h-13z" />
                                <path
                                    d="M16 6.5h-5.551a2.678 2.678 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5c-.963 0-1.613-.412-2.006-.958A2.679 2.679 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6z" />
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Fee & Transactions</span>
                    </a>
                    <div class="collapse " id="fee_transactions">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link " href="<?= func::href("/FeeStructure/new")?>">
                                    <span class="sidenav-mini-icon"> N </span>
                                    <span class="sidenav-normal"> Add Fee Structure </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="<?= func::href("/FeeStructure/Manage")?>">
                                    <span class="sidenav-mini-icon"> M </span>
                                    <span class="sidenav-normal"> Manage Fee Structure</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="<?= func::href("/Transaction/New")?>">
                                    <span class="sidenav-mini-icon"> C </span>
                                    <span class="sidenav-normal"> Collect Fee ₹ </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="<?= func::href("/Transaction/Reports")?>">
                                    <span class="sidenav-mini-icon"> C </span>
                                    <span class="sidenav-normal"> Transaction Reports </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="<?= func::href("/Transaction/Statement")?>">
                                    <span class="sidenav-mini-icon"> C </span>
                                    <span class="sidenav-normal"> Transaction Statement <i class="fa fa-file"
                                            aria-hidden="true"></i> </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="<?= func::href("/Transaction/Statement/Class")?>">
                                    <span class="sidenav-mini-icon"> C </span>
                                    <span class="sidenav-normal">Class Fee Statement</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="<?= func::href("/Transaction/Delete")?>">
                                    <span class="sidenav-mini-icon"> D </span>
                                    <span class="sidenav-normal"> Delete Transaction </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#expense_dropdown" class="nav-link "
                        aria-controls="expense_dropdown" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cash-coin" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                <path
                                    d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                <path
                                    d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Expenses</span>
                    </a>
                    <div class="collapse " id="expense_dropdown">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link " href="<?= func::href("/Expense/Manage/Ho")?>">
                                    <span class="sidenav-mini-icon"> M </span>
                                    <span class="sidenav-normal"> Manage H.O </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="<?= func::href("/Expense/Manage/Payee")?>">
                                    <span class="sidenav-mini-icon"> M </span>
                                    <span class="sidenav-normal"> Manage Payee </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="<?= func::href("/Expense/Manage")?>">
                                    <span class="sidenav-mini-icon"> M </span>
                                    <span class="sidenav-normal"> Manage Expenses</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="sidenav-footer mx-3 mt-3 pt-3">
            <div class="card card-background shadow-none card-background-mask-primary" id="sidenavCard">
                <div class="full-background"
                    style="background-image: url('../../assets/img/curved-images/curved9.jpg')"></div>
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
                        <i class="ni ni-diamond text-dark text-gradient text-lg top-0" aria-hidden="true"
                            id="sidenavCardIcon"></i>
                    </div>
                    <div class="docs-info">
                        <h6 class="text-white up mb-0">Need help?</h6>
                        <p class="text-xs font-weight-bold">Please mail us</p>
                        <a href="mailto:support@starktechlabs.in" target="_blank"
                            class="btn btn-white btn-sm w-100 mb-0">Mail</a>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky"
            id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">

                <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </div>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div
                        class="ms-md-auto pe-md-3 d-flex align-items-center text-info font-weight-bolder badge bg-dark badge-pill m-1">
                        <?=$user['username']?>
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="/Auth/signOut" class="nav-link text-body font-weight-bold px-0 m-2">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <span class="d-sm-inline d-none">Sign Out</span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none ps-x3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid py-4">