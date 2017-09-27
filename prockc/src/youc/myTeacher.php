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
            <h4><b>Subscribed Channels</b></h4>
<br> 
    <div class="teacher_block">
            <div class="hoistory">
                <ul>
                    <li class="active"><a href="#">Teacher 1</a></li>
                 </ul>
             </div>
          
            <div class="tab_view">
                <div class="view1 inline_vid">

            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>


<h4>Recent Videos</h4>
                    <div class="video_sec inline">
                    
                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                             
                        </div>
                    </div>
                    <!-- video_sec -->
                    
                    <div class="video_sec inline">
                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                             
                        </div>
                    </div>
                    <!-- video_sec -->
                    
                    <div class="video_sec inline">
                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                             
                        </div>
                    </div>
                    <!-- video_sec -->
                    
                    <div class="video_sec inline">
                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                             
                        </div>
                    </div>
                    <!-- video_sec -->
                    
                    <!-- video_sec -->
                </div>
            </div>
        </div>






        <div class="teacher_block">
            <div class="hoistory">
                <ul>
                    <li class="active"><a href="#">Teacher 2</a></li>
                 </ul>
             </div>
          
            <div class="tab_view">
                <div class="view1 inline_vid">

            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>


<h4>Recent Videos</h4>
                    <div class="video_sec inline">
                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                             
                        </div>
                    </div>
                    <!-- video_sec -->
                    
                    <div class="video_sec inline">
                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                             
                        </div>
                    </div>
                    <!-- video_sec -->
                    
                    <div class="video_sec inline">
                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                             
                        </div>
                    </div>
                    <!-- video_sec -->
                    
                    <div class="video_sec inline">
                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                             
                        </div>
                    </div>
                    <!-- video_sec -->
                    
                    <!-- video_sec -->
                </div>
            </div>
        </div>



        </div>
        <!-- col -->


        </div>
    </div>



<?php
  require_once('footer.php');
?>