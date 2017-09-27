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
                <input type="text" placeholder="Search video">
                <button>Ok</button>
                <select name="" id="">
                    <option value="">Short by</option>
                    <option value="">Filter</option>
                    <option value="">Filter</option>
                </select>
            </div>
          
            <div class="tab_view">
                <div class="view1">
                    
                    <div class="lbl big" id="selectAll">
                        <input type="checkbox" name="" id="ssz">
                        <label for="ssz" ></label> &nbsp;Select All
                    </div>

                    <br>
                    <br>

                    <div class="video_sec">
                         <div class="lbl">
                        <input type="checkbox" name="" id="sz4">
                        <label for="sz4"></label>
                    </div>



                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>

                            <ul>
                           <li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> 2/21/2017, 9:00 Pm</a></li>
                           <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 299+ Views</a></li>
                           <li><a href="#"><i class="fa fa-heart" aria-hidden="true"></i> 100+ Likes</a></li>
                           </ul>

                            <div class="video_manager">
                            

<select class="delete" name="" id="">
                                <option value="">Monetise</option>
                                <option value="">Regular</option>
                                <option value="">Philantroph</option>
                                <option value="">Paragon</option>
                                

                            </select>
                                                        <button class="delete">Delete</button>
                              <button class="delete">Edit</button>
                            
                            <select class="delete" name="" id="">
                                <option value="">Visiblity</option>
                                <option value="">Public</option>
                                <option value="">Friends</option>
                                <option value="">Class</option>
                                <option value="">Private</option>

                            </select>


                                </div>

                           
                        </div>
                    </div>
                    <!-- video_sec -->

                     <div class="video_sec">
                          <div class="lbl">
                        <input type="checkbox" name="" id="ss4">
                        <label for="ss4"></label>
                    </div>


                        <img src="../../resources/images/video_fig.png" alt="">
                         <div class="video_content">
                            <h4>TITLE</h4>

                            <ul>
                           <li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> 2/21/2017, 9:00 Pm</a></li>
                           <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 299+ Views</a></li>
                           <li><a href="#"><i class="fa fa-heart" aria-hidden="true"></i> 100+ Likes</a></li>
                           </ul>

                            <div class="video_manager">
                            

<select class="delete" name="" id="">
                                <option value="">Monetise</option>
                                <option value="">Regular</option>
                                <option value="">Philantroph</option>
                                <option value="">Paragon</option>
                                

                            </select>
                                                        <button class="delete">Delete</button>
                              <button class="delete">Edit</button>
                            
                            <select class="delete" name="" id="">
                                <option value="">Visiblity</option>
                                <option value="">Public</option>
                                <option value="">Friends</option>
                                <option value="">Class</option>
                                <option value="">Private</option>

                            </select>


                                </div>

                           
                        </div>
                    </div>
                    <!-- video_sec -->

                     <div class="video_sec">
                       <div class="lbl">
                        <input type="checkbox" name="" id="k1">
                        <label for="k1"></label>
                    </div>

                        <img src="../../resources/images/video_fig.png" alt="">
                         <div class="video_content">
                            <h4>TITLE</h4>

                            <ul>
                           <li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> 2/21/2017, 9:00 Pm</a></li>
                           <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 299+ Views</a></li>
                           <li><a href="#"><i class="fa fa-heart" aria-hidden="true"></i> 100+ Likes</a></li>
                           </ul>

                            <div class="video_manager">
                            

<select class="delete" name="" id="">
                                <option value="">Monetise</option>
                                <option value="">Regular</option>
                                <option value="">Philantroph</option>
                                <option value="">Paragon</option>
                                

                            </select>
                                                        <button class="delete">Delete</button>
                              <button class="delete">Edit</button>
                            
                            <select class="delete" name="" id="">
                                <option value="">Visiblity</option>
                                <option value="">Public</option>
                                <option value="">Friends</option>
                                <option value="">Class</option>
                                <option value="">Private</option>

                            </select>


                                </div>

                           
                        </div>
                    </div>
                    <!-- video_sec -->

                     <div class="video_sec">
 <div class="lbl">
                        <input type="checkbox" name="" id="k2">
                        <label for="k2"></label>
                    </div>
                        <img src="../../resources/images/video_fig.png" alt="">
                         <div class="video_content">
                            <h4>TITLE</h4>

                            <ul>
                           <li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> 2/21/2017, 9:00 Pm</a></li>
                           <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 299+ Views</a></li>
                           <li><a href="#"><i class="fa fa-heart" aria-hidden="true"></i> 100+ Likes</a></li>
                           </ul>

                            <div class="video_manager">
                            

<select class="delete" name="" id="">
                                <option value="">Monetise</option>
                                <option value="">Regular</option>
                                <option value="">Philantroph</option>
                                <option value="">Paragon</option>
                                

                            </select>
                                                        <button class="delete">Delete</button>
                              <button class="delete">Edit</button>
                            
                            <select class="delete" name="" id="">
                                <option value="">Visiblity</option>
                                <option value="">Public</option>
                                <option value="">Friends</option>
                                <option value="">Class</option>
                                <option value="">Private</option>

                            </select>


                                </div>

                           
                        </div>
                    </div>
                    <!-- video_sec -->
                     <div class="video_sec">
                      <div class="lbl">
                        <input type="checkbox" name="" id="k4">
                        <label for="k4"></label>
                    </div>

                        <img src="../../resources/images/video_fig.png" alt="">
                        <div class="video_content">
                            <h4>TITLE</h4>

                            <ul>
                           <li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> 2/21/2017, 9:00 Pm</a></li>
                           <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 299+ Views</a></li>
                           <li><a href="#"><i class="fa fa-heart" aria-hidden="true"></i> 100+ Likes</a></li>
                           </ul>

                            <div class="video_manager">
                            

<select class="delete" name="" id="">
                                <option value="">Monetise</option>
                                <option value="">Regular</option>
                                <option value="">Philantroph</option>
                                <option value="">Paragon</option>
                                

                            </select>
                                                        <button class="delete">Delete</button>
                              <button class="delete">Edit</button>
                            
                            <select class="delete" name="" id="">
                                <option value="">Visiblity</option>
                                <option value="">Public</option>
                                <option value="">Friends</option>
                                <option value="">Class</option>
                                <option value="">Private</option>

                            </select>


                                </div>

                           
                        </div>
                    </div>
                    <!-- video_sec -->
                    
                  




            </div>
        </div>
        <!-- col -->


        </div>
    </div>


<?php
  require_once('footer.php');
?>