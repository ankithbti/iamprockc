<?php

    require_once('header.php');

    if(!isset($_SESSION['userName'])){
        // Already Logged In
        //header('Location: ../login/login.php');
    }
?>

<body class="inner-page">


<div class="mob_over" onclick="closeMenu()"></div>
<div class="menu_mob" >
                <ul>
                    <li><a href="#">CurrenC</a></li><li>
                    <a href="#">Earning</a></li><li>
                    <a href="#">Instructor Level</a></li><li>
                    <a href="#">Student Level</a></li><li>
                    <a href="#">Notification</a></li><li>
                    <a href="#">Friend Req</a></li>
                </ul>
            </div><!-- menu -->

             <div class="user_menu  ">
        <ul>
          <li><a href="#">Setting</a></li>
          <li><a href="#">Details</a></li>
          <li><a href="#">Dummy Text</a></li>
          <li><a href="#">Dummy Text</a></li>
          <li><a href="#">Dummy Text</a></li>
        </ul>
      </div>

    <div class="container-fluid">
        <header>
            <div class="logo"><img src="../../resources/images/logo.png" alt=""></div>
            <div class="menu">
                <ul>
                    <li><a href="#">CurrenC</a></li><li>
                        <a href="#">Earning</a></li><li>
                        <a href="#">Instructor Level</a></li><li>
                        <a href="#">Student Level</a></li><li>
                        <a href="#">Notification</a></li><li>
                        <a href="#">Friend Req</a></li>
                </ul>
            </div>
            <div class="toggle" onclick="openMenu()"><i class="fa fa-bars"></i></div>

            <!-- menu -->
            <div class="pic_user">
                <img src="http://www.ullamodels.com/media/images/profile/1103_JOSETIO_MG_9289.jpg" alt="">
            </div>
        </header>
          

        <div class="box_content allInp loginInp selecW Topmd">
        <h4>My Theme</h4>
        <div class="clearfix"></div>
        <div id="flatClearable"></div>

        <button class="apply pull-left">Preview</button>
        &nbsp;&nbsp;
        <button class="apply">Apply</button>

         </div><!-- youtube_page -->

    </div>


<?php
  require_once('footer.php');
?>