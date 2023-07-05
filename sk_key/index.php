<!DOCTYPE html>
<html class="loading">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>GHOST CHECKER</title>
    <link
        href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700"
        rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/app-lite.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/core/colors/palette-gradient.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="theme-assets/js/ghost.js"></script>
    <style>
    @import url("http://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700");

    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .modal-content {
        display: flex;
        display: -ms-flexbox;
        display: -moz-box;
        display: -webkit-flex;
        display: -webkit-box;
        position: relative;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        border: 1px solid transparent;
        border-radius: .35rem;
        outline: 0;
        background-color: #fff;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -moz-box-orient: vertical;
        -moz-box-direction: normal;
        -ms-flex-direction: column;
        -webkit-box-shadow: 0 10px 50px 0 rgba(70, 72, 85, .8) !important;
        box-shadow: 0 10px 50px 0 rgba(70, 72, 85, .8) !important;
    }

    .modal-dialog {
        position: relative;
        width: auto;
        margin: .5rem;
        pointer-events: none;
    }

    .modal-dialog-centered {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        min-height: -webkit-calc(100% - (.5rem * 2));
        min-height: -moz-calc(100% - (.5rem * 2));
        min-height: calc(100% - (.5rem * 2));
        -webkit-box-align: center;
        -webkit-align-items: center;
        -moz-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 500px;
            margin: 1.75rem auto;
        }

        .modal-dialog-centered {
            min-height: -webkit-calc(100% - (1.75rem * 2));
            min-height: -moz-calc(100% - (1.75rem * 2));
            min-height: calc(100% - (1.75rem * 2));
        }
    }

    .modal.fade .modal-dialog {
        -webkit-transition: -webkit-transform .3s ease-out;
        -moz-transition: transform .3s ease-out, -moz-transform .3s ease-out;
        -o-transition: -o-transform .3s ease-out;
        transition: -webkit-transform .3s ease-out;
        transition: transform .3s ease-out;
        transition: transform .3s ease-out, -webkit-transform .3s ease-out, -moz-transform .3s ease-out, -o-transform .3s ease-out;
        -webkit-transform: translate(0, -25%);
        -moz-transform: translate(0, -25%);
        -ms-transform: translate(0, -25%);
        -o-transform: translate(0, -25%);
        transform: translate(0, -25%);
    }

    @media screen and (prefers-reduced-motion: reduce) {
        .modal.fade .modal-dialog {
            -webkit-transition: none;
            -moz-transition: none;
            -o-transition: none;
            transition: none;
        }
    }

    .modal.show .modal-dialog {
        -webkit-transform: translate(0, 0);
        -moz-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        -o-transform: translate(0, 0);
        transform: translate(0, 0);
    }

    .fade {
        -webkit-transition: opacity .15s linear;
        -moz-transition: opacity .15s linear;
        -o-transition: opacity .15s linear;
        transition: opacity .15s linear;
    }

    @media screen and (prefers-reduced-motion: reduce) {
        .fade {
            -webkit-transition: none;
            -moz-transition: none;
            -o-transition: none;
            transition: none;
        }
    }

    .modal {
        position: fixed;
        z-index: 1050;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: none;
        overflow: hidden;
        outline: 0;
    }

    .modal-open .modal {
        overflow-x: hidden;
        overflow-y: auto;
    }

    body {
        font-family: 'Muli', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.45;
        margin: 0;
        text-align: left;
        color: #6b6f80;
        background-color: #f9fafd;
    }

    html body {
        height: 100%;
        background-color: #f4f5fa;
        direction: ltr;
    }

    .modal-open {
        overflow: hidden;
    }

    html {
        font-family: sans-serif;
        line-height: 1.15;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        -ms-overflow-style: scrollbar;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        font-size: 14px;
        width: 100%;
        height: 100%;
    }

    .modal-body {
        position: relative;
        padding: 1rem;
        -webkit-box-flex: 1;
        -webkit-flex: 1 1 auto;
        -moz-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
    }

    *,
    :before,
    :after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    button {
        border-radius: 0;
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
        margin: 0;
        overflow: visible;
        text-transform: none;
    }

    .close {
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1;
        float: right;
        opacity: .5;
        color: #000;
        text-shadow: 0 1px 0 #fff;
    }

    button,
    [type="button"] {
        -webkit-appearance: button;
    }

    button.close {
        padding: 0;
        border: 0;
        background-color: transparent;
        -webkit-appearance: none;
    }

    .close:not(:disabled):not(.disabled) {
        cursor: pointer;
    }

    .close:hover {
        text-decoration: none;
        opacity: .75;
        color: #000;

    }

    .row {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        margin-right: -15px;
        margin-left: -15px;
        -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    .col-8,
    .col-lg-8 {
        position: relative;
        width: 100%;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
    }

    .col-8 {
        max-width: 100%;
        -webkit-box-flex: 0;
        -webkit-flex: 0 0 100%;
        -moz-box-flex: 0;
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
    }

    @media (min-width: 992px) {
        .col-lg-8 {
            max-width: 100%;
            -webkit-box-flex: 0;
            -webkit-flex: 0 0 100%;
            -moz-box-flex: 0;
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
        }
    }

    .col-4,
    .col-lg-4 {
        position: relative;
        width: 100%;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
    }

    .col-4 {
        max-width: 50%;
        -webkit-box-flex: 0;
        -webkit-flex: 0 0 50%;
        -moz-box-flex: 0;
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
    }

    @media (min-width: 992px) {
        .col-lg-4 {
            max-width: 50%;
            -webkit-box-flex: 0;
            -webkit-flex: 0 0 50%;
            -moz-box-flex: 0;
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
        }
    }



    @media screen and (prefers-reduced-motion: reduce) {
        .btn {
            -webkit-transition: none;
            -moz-transition: none;
            -o-transition: none;
            transition: none;
        }
    }

    .btn-outline-light {
        color: #babfc7;
        border-color: #babfc7;
        background-color: transparent;
        background-image: none;
    }

    .shadow-none {
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
    }

    .btn {
        font-weight: 600;
        letter-spacing: .8px;
    }

    .btn:not(:disabled):not(.disabled) {
        cursor: pointer;
    }

    .btn:hover {
        text-decoration: none;
    }

    .btn-outline-light:hover {
        color: #2a2e30;
        border-color: #babfc7;
        background-color: #babfc7;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    form .form-group {
        margin-bottom: 1.5rem;
    }

    select {
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
        margin: 0;
        text-transform: none;
    }

    input {
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
        margin: 0;
        overflow: visible;
    }

    .badge {
        font-size: 85%;
        font-weight: 700;
        line-height: 1;
        display: inline-block;
        padding: .35em .4em;
        text-align: center;
        vertical-align: baseline;
        white-space: nowrap;
        border-radius: .25rem;
    }



    .badge {
        font-weight: 400;
        color: #fff;
    }

    .form-control {
        font-size: 1rem;
        line-height: 1.25;
        display: block;
        width: 100%;
        padding: .75rem 1.5rem;
        -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        -moz-transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -o-transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        color: #4e5154;
        border: 1px solid #babfc7;
        border-radius: .25rem;
        background-color: #fff;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
    }

    @media screen and (prefers-reduced-motion: reduce) {
        .form-control {
            -webkit-transition: none;
            -moz-transition: none;
            -o-transition: none;
            transition: none;
        }
    }

    form .form-control {
        color: #3b4781;
        border: 1px solid #cacfe7;
    }

    select.form-control {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    select.form-control:not([size]):not([multiple]) {
        height: -webkit-calc(2.75rem + 2px);
        height: -moz-calc(2.75rem + 2px);
        height: calc(2.75rem + 2px);
    }


    /* These were inline style tags. Uses id+class to override almost everything */
    #style-iP3zI.style-iP3zI {
        background: #000000;
    }

    #style-Y4993.style-Y4993 {
        margin-bottom: 20px;
    }

    #style-D3z98.style-D3z98 {
        color: #fff;
    }

    #style-CovT9.style-CovT9 {
        position: absolute;
        margin-left: 0px;
        color: #FFFFFF;
    }

    #ccpN.style-cg7tQ {
        border-color: #35c0dc;
        background: transparent;
        color: #FFFFFF;
    }

    #style-kIavL.style-kIavL {
        position: absolute;
        margin-left: 0px;
        color: #FFFFFF;
    }

    #eccv.style-fD2RM {
        border-color: #35c0dc;
        background: transparent;
        color: #FFFFFF;
    }

    #style-OUXJB.style-OUXJB {
        display: none;
    }

    #style-w4dtO.style-w4dtO {
        width: 20px;
    }

    #style-bBSP7.style-bBSP7 {
        position: absolute;
        margin-left: 0px;
        color: #FFFFFF;
    }

    #style-HGKtd.style-HGKtd {
        border-color: #35c0dc;
        background: transparent;
        color: #FFFFFF;
    }

    #style-wdNO2.style-wdNO2 {
        background: #000000;
    }

    #style-Xk2ke.style-Xk2ke {
        background: #000000;
    }

    #style-98N3D.style-98N3D {
        background: #000000;
    }

    #style-xWlrZ.style-xWlrZ {
        background: #000000;
    }

    #style-QN1oj.style-QN1oj {
        background: #000000;
    }

    #style-xMoWL.style-xMoWL {
        background: #000000;
    }

    #style-t9tJi.style-t9tJi {
        background: #000000;
    }

    #style-wUPSk.style-wUPSk {
        background: #000000;
    }

    #style-vqlXX.style-vqlXX {
        background: #000000;
    }

    #style-YG9S8.style-YG9S8 {
        background: #000000;
    }

    #style-fEcTq.style-fEcTq {
        background: #000000;
    }

    #style-1WIIz.style-1WIIz {
        background: #000000;
    }

    #style-4kErL.style-4kErL {
        background: #000000;
    }

    #style-ReQ2v.style-ReQ2v {
        position: absolute;
        margin-left: 0px;
        color: #FFFFFF;
    }

    #style-5ZMfy.style-5ZMfy {
        border-color: #35c0dc;
        background: transparent;
        color: #FFFFFF;
    }

    #style-JrFYH.style-JrFYH {
        background: #000000;
    }

    #style-mUbvl.style-mUbvl {
        background: #000000;
    }

    #style-gRkEL.style-gRkEL {
        background: #000000;
    }

    #style-EDrPd.style-EDrPd {
        background: #000000;
    }

    #style-gj8Ky.style-gj8Ky {
        background: #000000;
    }

    #style-izG2P.style-izG2P {
        background: #000000;
    }

    #style-oycYO.style-oycYO {
        background: #000000;
    }

    #style-8Box3.style-8Box3 {
        background: #000000;
    }

    #style-izyiC.style-izyiC {
        background: #000000;
    }

    #style-AGscl.style-AGscl {
        background: #000000;
    }

    #style-O9c6j.style-O9c6j {
        background: #000000;
    }

    #style-2YxhS.style-2YxhS {
        background: #000000;
    }

    #style-esynw.style-esynw {
        position: absolute;
        color: #FFFFFF;
    }

    #style-HH1RW.style-HH1RW {
        border-color: #35c0dc;
        background: transparent;
        color: #FFFFFF;
    }

    #style-XIwT2.style-XIwT2 {
        display: none;
    }

    #gerar.style-eVS8h {
        width: 100%;
        margin-top: 10px;
    }




    /* autogen ghost edits starts here  */
    body.vertical-layout[data-color="bg-gradient-x-purple-blue"] .content-wrapper-before {
        background-image: linear-gradient(to right, rgb(9, 0, 172), rgb(0, 169, 245));
    }

    .form-control:focus {
        color: rgb(255, 245, 230);
        border-color: rgb(14, 12, 157);
        outline-color: initial;
        background-color: rgb(0, 0, 0);
        box-shadow: none;
    }

    .btn-bg-gradient-x-red-pink {
        color: rgb(255, 255, 255);
        border-color: initial;
        background-image: linear-gradient(90deg, rgb(205, 0, 0) 0%, rgb(141, 0, 59) 50%, rgb(205, 0, 0) 100%);
    }


    .btn-bg-gradient-x-blue-cyan {
        color: rgb(255, 255, 255);
        border-color: initial;
        background-image: linear-gradient(90deg, rgb(56, 45, 162) 0%, rgb(0, 218, 247) 50%, rgb(56, 45, 162) 100%);
    }

    .btn-danger {
        color: #fff;
        background-color: #ff000f;
    }


    .card-body {
        background-color: #000000;
    }

    .card .card-title,
    .card-body h5,
    .mb-2 {
        color: white;
    }

    .mb-2,
    .form-control {
        background: black;
    }

    #gate {
        color: white
    }

    .badge-danger {
        background-color: #ff000f;
    }

    .badge-primary {
        background-color: #0500ff;
    }

    .badge-success {
        background-color: #170c81;
    }

    .badge-info {
        background-color: rgb(0, 186, 231);
    }

    .btn-success {
        background-color: #1cff00;
    }

    .btn-primary {
        background-color: #0500ff;
    }


    .form-control {
        color: rgb(255, 245, 230);
        border-color: rgb(57, 66, 71);
        background-color: rgb(0, 0, 0);
    }

    @-webkit-keyframes Border {
        0% {
            border-color: crimson;
        }

        20% {
            border-color: orange;
        }

        40% {
            border-color: goldenrod;
        }

        60% {
            border-color: green;
        }

        80% {
            border-color: DarkBlue;
        }

        100% {
            border-color: purple
        }
    }

    .card-body {
        border: 1px solid #62008c;
    }

    .anime {
        position: relative;
        border: 0px !important;
        box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.4);
        overflow: hidden;
    }

    .anime span:nth-child(1) {
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 1px;
        background: linear-gradient(to right, #171618, #3bff3b);
        animation: animate1 20s linear infinite;
    }

    @keyframes animate1 {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .anime span:nth-child(2) {
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        width: 1px;
        background: linear-gradient(to bottom, #171618, #0d00ff);
        animation: animate2 20s linear infinite;
        animation-delay: 1s;
    }

    @keyframes animate2 {
        0% {
            transform: translateY(-100%);
        }

        100% {
            transform: translateY(100%);
        }
    }

    .anime span:nth-child(3) {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 1px;
        background: linear-gradient(to left, #171618, #ff3b3b);
        animation: animate3 20s linear infinite;
    }

    @keyframes animate3 {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    .anime span:nth-child(4) {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 1px;
        background: linear-gradient(to top, #171618, #00ffe7);
        animation: animate4 20s linear infinite;
        animation-delay: 1s;
    }

    @keyframes animate4 {
        0% {
            transform: translateY(100%);
        }

        100% {
            transform: translateY(-100%);
        }
    }

    .center-fixed {
        margin-left: -75px;
    }

    @media only screen and (max-width: 600px) {
        .center-fixed {
            margin-left: -15px;
        }
    }
    </style>
</head>

<body class="vertical-layout" data-color="bg-gradient-x-purple-blue" style="background-color:black"> <div style='width:100%; background-color:black; text-align:center; font-size: 15px; padding: 20px; color:white; border-bottom: 2px solid red;'>TRY OUR SK BASED CC CHECKER<a href="http://ghostchecker.site" ><span style='color:#ff0000;'> CLICK HERE</span></a></div>
    <div class="app-content content">
   
        <div class="content-wrapper">
            
            <div class="content-wrapper-before mb-3">
            </div>

            <div class="content-body">
                <div class="mt-2"></div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body text-center anime">
                                <span> </span>
                                <span> </span>
                                <span> </span>
                                <span> </span>
                                <h4 class="mb-2"><strong>MASS SK KEY CHECKER</strong></h4>

                                <textarea rows="16" id="lista" class="form-control text-center form-checker mb-2"
                                    placeholder=""></textarea>
                                <br>

                                <button class="btn btn-play btn-glow btn-bg-gradient-x-blue-cyan text-white"
                                    style="width: 49%; float: left;" onclick="enviar()"><i class="fa fa-play"></i>
                                    START</button>
                                <button class="btn btn-stop btn-glow btn-bg-gradient-x-red-pink text-white"
                                    style="width: 49%; float: right;" disabled><i class="fa fa-stop"></i> STOP</button>



                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">

                                <h5 style="margin-bottom:-0.2rem"> TOTAL :<span
                                        class="badge badge-dark float-right " id="total">0</span></h5>
                                <hr>

                                <h5 style="margin-bottom:-0.2rem"> LIVE :<span
                                        class="badge badge-success float-right charge" id="cLive">0</span></h5>
                                <hr>

                                <h5 style="margin-bottom:-0.2rem"> RATE LIMITED :<span
                                        class="badge badge-info float-right cvvs" id="cLimit">0</span></h5>
                                <hr>

                                <h5 style="margin-bottom:-0.2rem"> DEAD :<span
                                        class="badge badge-danger float-right " id="cDie">0</span></h5>

                            </div>
                        </div>

                    </div>

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right">
                                    <button type="show" class="btn btn-primary btn-sm show-charge"><i
                                            class="fa fa-eye-slash"></i></button>
                                    <button class="btn btn-success btn-sm btn-copy1"><i class="fa fa-copy"></i></button>
                                </div>

                                <center>

                                    <h4 class="card-title mb-1" style='text-align:left;'><i
                                            class="fa fa-check-circle text-success"></i> LIVE
                                    </h4>

                                    <div id="bode2" style='text-align:left;'>
                                        <span id=".aprovadas" class="aprovadas"></span>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right">
                                    <button type="show" class="btn btn-primary btn-sm show-live"><i
                                            class="fa fa-eye-slash"></i></button>
                                    <button class="btn btn-success btn-sm btn-copy2"><i class="fa fa-copy"></i></button>
                                </div>

                                <center>

                                    <h4 class="card-title mb-1" style='text-align:left;'><i
                                            class="fa fa-check text-success"></i> RATE LIMITED</h4>
                                    <div id='bode2' style='text-align:left;'>
                                        <span id=".ratelimited" class="ratelimited"></span>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right">
                                    <button type='hidden' class="btn btn-primary btn-sm show-dies"><i
                                            class="fa fa-eye"></i></button>
                                    <button class="btn btn-danger btn-sm btn-trash"><i class="fa fa-trash"></i></button>
                                </div>

                                <center>

                                    <h4 class="card-title mb-1" style='text-align:left;'><i
                                            class="fa fa-times text-danger"></i> DEAD</h4>
                                    <div style='text-align:left;' id="bode2">
                                        <span id=".reprovadas" class="reprovadas"></span>
                                    </div>


                            </div>
                        </div>
                    </div>

                    </section>

                </div>
            </div>

            <script src="theme-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>



            </style>
            <footer>
                <p> <b>
                        <div class=text-danger>EDITED BY GHOST
                    </b></a>
        </div>
        </p>
        </footer>

       

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script title="ajax do checker">
        function enviar() {
            var linha = $("#lista").val();
            var linhaenviar = linha.split("\n");
            var total = linhaenviar.length;
            var ap = 0;
            var ed = 0;
            var rp = 0;
            var rl = 0;
            linhaenviar.forEach(function(value, index) {
                setTimeout(
                    function() {
                        $.ajax({
                            url: 'api.php?sk=' + value,
                            type: 'GET',
                            async: true,
                            success: function(resultado) {
                                if (resultado.match("LIVE")) {
                                    removelinha();
                                    ap++;
                                    aprovadas(resultado + "");
                                } else if (resultado.match("DEAD")) {
                                    removelinha();
                                    rp++;
                                    reprovadas(resultado + "");
                                } else if (resultado.match("RATE LIMITED")) {
                                    removelinha();
                                    rl++;
                                    ratelimited(resultado + "");
                                }
                                $('#carregadas').html(total);
                                var fila = parseInt(ap) + parseInt(rp) + parseInt(rl);
                                $('#cLive').html(ap);
                                $('#cWarn').html(ed);
                                $('#cDie').html(rp);
                                $('#total').html(fila);
                                $('#cLive2').html(ap);
                                $('#cWarn2').html(ed);
                                $('#cDie2').html(rp);
                                $('#cLimit').html(rl);
                            }
                        });
                    }, 2500 * index);
            });
        }

        function aprovadas(str) {
            $(".aprovadas").append(str + "<br>");
        }

        function reprovadas(str) {
            $(".reprovadas").append(str + "<br>");
        }

        function ratelimited(str) {
            $(".ratelimited").append(str + "<br>");
        }

        function removelinha() {
            var lines = $("#lista").val().split('\n');
            lines.splice(0, 1);
            $("#lista").val(lines.join("\n"));
        }
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.1/js/bootstrap.min.js"
            integrity="sha512-vyRAVI0IEm6LI/fVSv/Wq/d0KUfrg3hJq2Qz5FlfER69sf3ZHlOrsLriNm49FxnpUGmhx+TaJKwJ+ByTLKT+Yg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
        </script>
        <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/js/mdb.min.js">
        < /body> < /
        html >