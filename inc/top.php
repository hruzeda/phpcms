<?php
/**
 * PHP Version 7.2.6
 * Top include for all pages
 *
 * @category Include
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://nolinkyet.com.br
 */ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">

  <meta name="description" content="Centro Cultural localizado na cidade de Campinas cuja missão é
    apoiar na formação dos estudantes universitários e de ensino médio.">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta property="og:title" content=""/>
  <meta property="og:description" content=""/>
  <meta property="og:image" content=""/>
  <meta property="og:image" content="www.meusite.com.br/imagem.jpg">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="800">
  <meta property="og:image:height" content="600">
  <meta property="og:type" content="article">
  <meta property="article:author" content="Autor do artigo">
  <meta property="article:section" content="Seção do artigo">
  <meta property="article:tag" content="Tags do artigo">
  <meta property="article:published_time" content="date_time">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Centro Castelo</title>

  <link rel="stylesheet" type="text/css" href="css/style.css"/>

  <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
</head>

<body>
<div id="fb-root"></div>

<script>(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.0';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

<div class="container">
  <header class="blog-header py-3">
        <?php
        require_once ROOT . 'inc/admin/alert.php';
        require_once ROOT . 'inc/admin/modal.php';
        require_once ROOT . 'inc/admin/login.php';

        if (LOGGED_USER != null) {
            require_once ROOT . 'inc/admin/index.php';
        } ?>

    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="index.php">
          <img src="img/logo.png"/>
        </a>
      </div>
      <div class="col-4"></div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <!--<form class="form-inline" method="post" action="">
          <div class="form-group">
            <input type="text" class="form-control" id="busca" name="email"
              placeholder="Busca...">
          </div>
          <div class="form-group ml-2">
            <button type="submit" class="btn btn-dark">
              <span class="fas fa-search"></span>
            </button>
          </div>
        </form>-->
      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex">
      <a class="py-2 px-3 mx-1 active" href="index.php">Início</a>
      <!--<a class="py-2 px-3 mx-1" href="#">O Centro</a>
      <a class="py-2 px-3 mx-1" href="#">Residência</a>-->
    </nav>
  </div>
</div>

<main role="main" class="container">
