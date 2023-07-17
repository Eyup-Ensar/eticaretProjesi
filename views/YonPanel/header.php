<?php $Harici = new HariciFonksiyonlar(); $PanelHarici = new PanelHarici(); ob_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

 <title>MVC | E-TİCARET | KONTROL PANELİ</title>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="<?php echo URL; ?>/views/design/js/jquery.min.js"></script>
<script src="<?php echo URL; ?>/views/design/js/bizim.js"></script>
  <!-- Custom styles for this template-->
  <link href="<?php echo URL; ?>/views/YonPanel/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo URL; ?>/views/YonPanel/css/bizim.css" rel="stylesheet">
  <script src="<?php echo URL; ?>/views/YonPanel/js/sweetalert.js"></script>
</head>

<?php 

  $ackapat = $PanelHarici->listele("ayarlar", false);

  $ackapat = $ackapat[0]["menuAcKapat"];
  
?>

<body id="page-top" class="<?php echo ($ackapat) ? 'sidebar-toggled' : '';?>"> 
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion menu <?php echo ($ackapat) ? 'toggled' : '';?>" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" style="height: 62px;" href="<?php echo URL."/panel" ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <img src="<?php echo URL."/views/YonPanel/img/store.svg" ?>" style="color:#31323b">
        </div>
        <div class="sidebar-brand-text mx-3" style="color:#31323b;">MVC Ticaret</div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <?php $PanelHarici->MenuKontrol($ackapat); ?>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0 menuackapat" id="sidebarToggle">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#999" class="arrow <?php echo $ackapat ? '' : '' ?>">
            <path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/>
            <path d="M7.38 21.01c.49.49 1.28.49 1.77 0l8.31-8.31c.39-.39.39-1.02 0-1.41L9.15 2.98c-.49-.49-1.28-.49-1.77 0s-.49 1.28 0 1.77L14.62 12l-7.25 7.25c-.48.48-.48 1.28.01 1.76z"/>
          </svg>
        </button>
      </div>
    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">