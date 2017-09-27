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
        <div class="col-md-9">
            <div class="filter">
                <input type="text" placeholder="Choice">
                <button>Ok</button>
                <select name="" id="">
                    <option value="">Filter</option>
                    <option value="">Filter</option>
                    <option value="">Filter</option>
                </select>
            </div>
          

            <div class="tab_view">
                <div class="view1">
          
<h4><b>Uploads by Subscribed Channels</b></h4>
<br>

                    <div class="video_sec">
                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                            <ul>
                                <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 299+ Views</a></li>
                                <li><a href="#">Cost of view  <i class="fa fa-inr" aria-hidden="true"></i> 2</a></li>
                                <li><a href="#">Instructor name</a></li>
                                <li><a href="#">Level - 3</a></li>
                                <li><a href="#">50+ subscribers</a></li>
                                <li><a href="#">Your Connects</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- video_sec -->
                    <div class="video_sec">
                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                            <ul>
                                <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 299+ Views</a></li>
                                <li><a href="#">Cost of view  <i class="fa fa-inr" aria-hidden="true"></i> 2</a></li>
                                <li><a href="#">Instructor name</a></li>
                                <li><a href="#">Level - 3</a></li>
                                <li><a href="#">50+ subscribers</a></li>
                                <li><a href="#">Your Connects</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- video_sec -->
                    <div class="video_sec">
                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                            <ul>
                                <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 299+ Views</a></li>
                                <li><a href="#">Cost of view  <i class="fa fa-inr" aria-hidden="true"></i> 2</a></li>
                                <li><a href="#">Instructor name</a></li>
                                <li><a href="#">Level - 3</a></li>
                                <li><a href="#">50+ subscribers</a></li>
                                <li><a href="#">Your Connects</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- video_sec -->
                    <div class="video_sec">
                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                            <ul>
                                <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 299+ Views</a></li>
                                <li><a href="#">Cost of view  <i class="fa fa-inr" aria-hidden="true"></i> 2</a></li>
                                <li><a href="#">Instructor name</a></li>
                                <li><a href="#">Level - 3</a></li>
                                <li><a href="#">50+ subscribers</a></li>
                                <li><a href="#">Your Connects</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- video_sec -->
                </div>
            </div>
        </div>
        <!-- col -->


        </div>
    </div>


<?php
  require_once('footer.php');
?>