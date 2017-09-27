<?php
    require_once('header.php');
    if(!isset($_SESSION['userName'])){
        // Already Logged In
        header('Location: ../login/login.php');
    }
?>

<body>
  


<?php

      $userProfilePic="../../resources/images/user_default_logo.png";
      $currenC=0;
      $earnings=0;
      $instructorLevel="Novice";
      $studentLevel="Novice";

      $profileQuery = "select * from userProfile where email='" . $_SESSION['email'] . "'";
      $profileResult = mysql_query ($profileQuery) or trigger_error("Query fails. Contact us to report the issue.");
      if (mysql_affected_rows() > 0){
          while($row = mysql_fetch_array($profileResult, MYSQL_NUM)){
            $userProfilePic="../../resources/uploads/" . $_SESSION['email'] . "/" . $row[1];
          }
      }

      $detailQuery = "select * from userDetails where userId=" . $_SESSION['userId'] ;
      $detailResult = mysql_query ($detailQuery) or trigger_error("Query fails. Contact us to report the issue.");
      if (mysql_affected_rows() > 0){
          while($row = mysql_fetch_array($detailResult, MYSQL_NUM)){
            $currenC = $row[1];
            $earnings = $row[2];

            switch($row[3]){
              case 0:
              {
                $studentLevel="Beginner";
                break;
              }
              case 1:
              {
                $studentLevel="Novice";
                break; 
              }
              case 2:
              {
                $studentLevel="Learner";
                break;
                break;
              }
              case 3:
              {
                $studentLevel="Graduate";
                break;
                break;
              }
              default:
              {
                $studentLevel="Beginner";
                break;
              }
            }
          }

          switch($row[4]){
              case 0:
              {
                $instructorLevel="Teacher0";
                break;
              }
              case 1:
              {
                $instructorLevel="Teacher1";
                break; 
              }
              case 2:
              {
                $instructorLevel="Teacher2";
                break;
                break;
              }
              case 3:
              {
                $instructorLevel="Teacher3";
                break;
                break;
              }
              default:
              {
                $instructorLevel="Teacher0";
                break;
              }
            }
      }

?>

<nav class="navbar navbar-youc">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand myBrandLogo" href="home.php"><img src="../../resources/images/logo.png" alt=""></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navHeadings" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
          <a href="#"><i class="fa fa-inr"></i>&nbsp;<span class="label label-info"><?php echo $currenC; ?></span><br>CurrenC</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-inr"></i>&nbsp;<span class="label label-info"><?php echo $earnings; ?></span><br>Earnings</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-flask"></i>&nbsp;<span class="label label-info"><?php echo $instructorLevel; ?></span><br>InstructorLevel</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-leanpub"></i>&nbsp;<span class="label label-info"><?php echo $studentLevel; ?></span><br>StudentLevel</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-user-plus"></i>&nbsp;<span class="label label-info"><?php echo "0"; ?></span><br>FriendReq</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-bell"></i>&nbsp;<span class="label label-info"><?php echo "0"; ?></span><br>Notifications</a>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right userImageNav">
        <li class="dropdown">
          <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo "<img src=" . "\"" . $userProfilePic . "\">"; ?>&nbsp;<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">My Profile</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="../login/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
        <div class="login_page">
        <div class="content_left">
            <div class="box">
                <div class="box_header">Welcome <?php echo strtoupper($_SESSION['userName']) ; ?></div>
                <!-- <div class="box_content">
                    <img src="../../resources/images/no_content.png" alt="">
                </div> -->
            </div>


             <!-- <div class="box">
                <div class="box_header text-left">BC <span></span></div>
                <div class="box_content">
                     <h4>Friend List</h4>

                     <ul>
                         <li>Test <span class="online"></span></li>
                         <li>Test <span class="online"></span></li>
                         <li>Test <span class="online"></span></li>
                         <li>Test <span class="online"></span></li>
                         <li>Test <span class="online"></span></li>
                     </ul>
                </div>
            </div> --><!-- box -->


        </div><!-- content -->

        <div class="content_center">
            <h1>Prockc World</h1>
            <div class="box_button_wrap">
            <a href="../youc/index.php">
            <div class="three_box_button">
               <span> YOUC </span>
            </div><!-- three_box_button -->
            </a>
              <div class="three_box_button">
                <span>WEC</span>
            </div><!-- three_box_button -->
              <div class="three_box_button">
                <span>SOC</span> 
            </div><!-- three_box_button -->
            </div><!-- box_button_wrap -->
        </div><!-- content -->

        <div class="content_right">
         <!-- <div class="box">
                <div class="box_header ">Your Upcoming Events </div>
                <div class="box_content">
                      <ul>
                         <li>Test</li>
                         <li>Test</li>
                         <li>Test</li>
                         <li>Test</li>
                         <li>Test</li>
                     </ul>
                </div>
            </div> -->

        </div><!-- content -->
        </div><!-- login -->
    </div>

<?php
  require_once('footer.php');
?>