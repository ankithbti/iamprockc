<?php

    require_once('header.php');

    if(!isset($_SESSION['userName'])){
        // Already Logged In
        header('Location: ../login/login.php');
    }
?>

<body class="inner-page">



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
      <a class="navbar-brand myBrandLogo" href="../home/home.php"><img src="../../resources/images/logo.png" alt=""></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navHeadings" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
          <a href="#"><i class="fa fa-inr"></i>&nbsp;<span class="label label-danger"><?php echo $currenC; ?></span><br>CurrenC</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-inr"></i>&nbsp;<span class="label label-danger"><?php echo $earnings; ?></span><br>Earnings</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-flask"></i>&nbsp;<span class="label label-danger"><?php echo $instructorLevel; ?></span><br>InstructorLevel</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-leanpub"></i>&nbsp;<span class="label label-danger"><?php echo $studentLevel; ?></span><br>StudentLevel</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-user-plus"></i>&nbsp;<span class="label label-danger"><?php echo "0"; ?></span><br>FriendReq</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-bell"></i>&nbsp;<span class="label label-danger"><?php echo "0"; ?></span><br>Notifications</a>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right userImageNav">
        <li class="dropdown">
          <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo "<img src=" . "\"" . $userProfilePic . "\">"; ?>&nbsp;<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="myClass.php">My Class</a></li>
            <li><a href="myPlan.php">My Plan</a></li>
            <li><a href="myTeacher.php">My Teacher</a></li>
            <li><a href="myChoice.php">My Choice</a></li>
            <li><a href="myHistory.php">My History</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="../login/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="container-fluid">
       
<div class="col-md-9">
            <div class="filter">
                <input type="text" placeholder="Search any video">
                <button><i class="fa fa-search" aria-hidden="true"></i></button>
                <!-- <select name="" id="">
                    <option value="">Filter</option>
                    <option value="">Filter</option>
                    <option value="">Filter</option>
                </select> -->
            </div>
            <div class="tab_list">

                <!-- <ul class="nav nav-tabs"> -->
                <ul>
                  <li class="active"><a href="#myListTab" data-toggle="tab">MyList</a></li>
                  <li><a href="#mySavedTab" data-toggle="tab">MySaved</a></li>
                  <li><a href="#trendingTab" data-toggle="tab">Trending</a></li>
                  <li><a href="#latestTab" data-toggle="tab">Latest</a></li>
                  <li><a href="#promotionalTab" data-toggle="tab">Promotional</a></li>
                </ul>


                <!-- <ul>
                    <li class="active"><a href="#myListTab">Mylist</a></li>
                    <li><a href="#trendingTab">Trending</a></li>
                    <li><a href="#">Promotional</a></li>
                    <li><a href="#">Saved</a></li>
                    <li><a href="#">Latest</a></li>
                </ul> -->
            </div>
            <div class="tab_view">
              <div class="tab-content">

                <div class="tab-pane active" id="myListTab">

                  <?php


                    $subscribersQ="select * from subscribers where subscriberId=" . $_SESSION['userId'];
                    $subscribersQResult = mysql_query ($subscribersQ) or trigger_error("Query fails. Contact us to report the issue.");
                    if (mysql_affected_rows() > 0){
                        while($subscribersQResultRow = mysql_fetch_array($subscribersQResult, MYSQL_NUM)){

                          $subscribedUserId=$subscribersQResultRow[0];


                          $videoQuery="SELECT * from videos where uploaderId=" . $subscribedUserId . " order by uploadDateTime DESC";
                          $videoQueryResult = mysql_query ($videoQuery) or trigger_error("Query fails. Contact us to report the issue.");

                    
                          if (mysql_affected_rows() > 0){

                            while($row = mysql_fetch_array($videoQueryResult, MYSQL_NUM)){
                          
                              $noOfViews = $row[6];
                              $videoDesc = $row[2];
                              $videoTitle=$row[1];
                              $videoFile = "../../resources/uploads/" . $_SESSION['userId'] . "/";
                              $videoFile .= $row[3];
                              $uploaderId = $row[4];
                              $costOfView = $row[7];

                              $uploaderInstructorLevel = 0;
                              $uploaderName = "Anonymouns";
                              $uploaderSubscribers = 0;

                              $viewCounter = 0;

                              // Get Detail of Uploader
                              $uploaderInfoQuery="SELECT * from users where id=" . $uploaderId . ";";
                              $uploaderInfoQueryResult = mysql_query ($uploaderInfoQuery) or trigger_error("Query fails. Contact us to report the issue.");
                              if (mysql_affected_rows() > 0){
                                while($uploaderRow = mysql_fetch_array($uploaderInfoQueryResult, MYSQL_NUM)){
                                  $uploaderName = $uploaderRow[2];
                                }
                              }

                              //Get Uploader Details
                              $uploaderDetailsQuery="SELECT * from userDetails where userId=" . $uploaderId . ";";
                              $uploaderDetailsQueryResult = mysql_query ($uploaderDetailsQuery) or trigger_error("Query fails. Contact us to report the issue.");
                              if (mysql_affected_rows() > 0){
                                while($uploaderDetailsRow = mysql_fetch_array($uploaderDetailsQueryResult, MYSQL_NUM)){
                                  $uploaderInstructorLevel = $uploaderDetailsRow[4];
                                }
                              }

                              // Get Uploader Subscribers
                              $uploaderSubscriberQuery="SELECT count(*) from subscribers where userId=" . $uploaderId . ";";
                              $uploaderSubscriberQueryResult = mysql_query ($uploaderSubscriberQuery) or trigger_error("Query fails. Contact us to report the issue.");
                              if (mysql_affected_rows() > 0){
                                while($uploaderSubscriberRow = mysql_fetch_array($uploaderSubscriberQueryResult, MYSQL_NUM)){
                                  $uploaderSubscribers = $uploaderSubscriberRow[0];
                                }
                              }

                              switch($uploaderInstructorLevel){
                                case 0:
                                {
                                  $uploaderInstructorLevel="Teacher0";
                                  break;
                                }
                                case 1:
                                {
                                  $uploaderInstructorLevel="Teacher1";
                                  break; 
                                }
                                case 2:
                                {
                                  $uploaderInstructorLevel="Teacher2";
                                  break;
                                  break;
                                }
                                case 3:
                                {
                                  $uploaderInstructorLevel="Teacher3";
                                  break;
                                  break;
                                }
                                default:
                                {
                                  $uploaderInstructorLevel="Teacher0";
                                  break;
                                }
                              }

                            ?>

                            <div class="video_sec">

                              <a href='<?php echo "video.php?videoId=$row[0]"; ?>' class="img-rounded">
                                <!-- <img src="../../resources/images/video_fig.png" alt=""> -->
                                <div class="wrapper">
                                  <video class="thumbnailVideo">
                                    <source src="<?php echo $videoFile ; ?>"/>
                                  </video>
                                  <div class="playpause"></div>
                                </div>
                              </a>
                              <div class="video_content">
                                  <h4><?php echo $videoTitle ; ?></h4>
                                  <p><?php echo $videoDesc ; ?></p>
                                  <ul>
                                      <li><span title="#OfViews" class="label label-danger"><i class="fa fa-eye"></i>&nbsp;<?php echo $noOfViews ; ?></span></li>
                                      <li><span title="CostOfView" class="label label-danger"><i class="fa fa-inr"></i>&nbsp;<?php echo $costOfView ; ?></span></li>
                                      <li><a href="uploaderProfile.php?userId=<?php echo $subscribedUserId ; ?>"><span title="UploaderName" class="label label-danger"><i class="fa fa-user"></i>&nbsp;<?php echo $uploaderName ; ?></span></a></li>
                                      <li><span title="InstructorLevel" class="label label-danger"><i class="fa fa-flask"></i>&nbsp;<?php echo $uploaderInstructorLevel ; ?></span></li>
                                      <li><span title="Subscribers" class="label label-danger"><i class="fa fa-users"></i>&nbsp;<?php echo $uploaderSubscribers ; ?></span></li>
                                      <li><span title="Your Connects" class="label label-danger"><i class="fa fa-user-circle-o"></i>&nbsp;<?php echo $uploaderSubscribers ; ?></span></li>
                                  </ul>
                              </div>

                            </div>

                            <?php
                            
                                    }
                                }
                              }
                            }else{
                                  echo "<h4>Subscribe Instructors to create your List.</h4>";
                            }
                            ?>


                </div>

                <div class="tab-pane" id="mySavedTab">

                <?php
                  $savedVideosQ="select * from userViewVideos where userId=" . $_SESSION['userId'] . " and watchLater=1";
                  $savedVideosQResult = mysql_query ($savedVideosQ) or trigger_error("Query fails. Contact us to report the issue");
                  if (mysql_affected_rows() > 0){
                    while($savedVideosQResultRow = mysql_fetch_array($savedVideosQResult, MYSQL_NUM)){

                      $savedVideoId=$savedVideosQResultRow[1];


                      $videoDetailQ="select * from videos where id=" . $savedVideoId . " order by uploadDateTime DESC";
                      $videoDetailQResult = mysql_query ($videoDetailQ) or trigger_error("Query fails. Contact us to report the issue");
                      if (mysql_affected_rows() > 0){
                          while($videoDetailQResultRow = mysql_fetch_array($videoDetailQResult, MYSQL_NUM)){

                              $noOfViews = $videoDetailQResultRow[6];
                              $videoDesc = $videoDetailQResultRow[2];
                              $videoTitle=$videoDetailQResultRow[1];
                              $videoFile = "../../resources/uploads/" . $_SESSION['userId'] . "/";
                              $videoFile .= $videoDetailQResultRow[3];
                              $uploaderId = $videoDetailQResultRow[4];
                              $costOfView = $videoDetailQResultRow[7];

                              $uploaderInstructorLevel = 0;
                              $uploaderName = "Anonymouns";
                              $uploaderSubscribers = 0;

                              $viewCounter = 0;

                              // Get Detail of Uploader
                              $uploaderInfoQuery="SELECT * from users where id=" . $uploaderId . ";";
                              $uploaderInfoQueryResult = mysql_query ($uploaderInfoQuery) or trigger_error("Query fails. Contact us to report the issue.");
                              if (mysql_affected_rows() > 0){
                                while($uploaderRow = mysql_fetch_array($uploaderInfoQueryResult, MYSQL_NUM)){
                                  $uploaderName = $uploaderRow[2];
                                }
                              }

                              //Get Uploader Details
                              $uploaderDetailsQuery="SELECT * from userDetails where userId=" . $uploaderId . ";";
                              $uploaderDetailsQueryResult = mysql_query ($uploaderDetailsQuery) or trigger_error("Query fails. Contact us to report the issue.");
                              if (mysql_affected_rows() > 0){
                                while($uploaderDetailsRow = mysql_fetch_array($uploaderDetailsQueryResult, MYSQL_NUM)){
                                  $uploaderInstructorLevel = $uploaderDetailsRow[4];
                                }
                              }

                              // Get Uploader Subscribers
                              $uploaderSubscriberQuery="SELECT count(*) from subscribers where userId=" . $uploaderId . ";";
                              $uploaderSubscriberQueryResult = mysql_query ($uploaderSubscriberQuery) or trigger_error("Query fails. Contact us to report the issue.");
                              if (mysql_affected_rows() > 0){
                                while($uploaderSubscriberRow = mysql_fetch_array($uploaderSubscriberQueryResult, MYSQL_NUM)){
                                  $uploaderSubscribers = $uploaderSubscriberRow[0];
                                }
                              }

                              switch($uploaderInstructorLevel){
                                case 0:
                                {
                                  $uploaderInstructorLevel="Teacher0";
                                  break;
                                }
                                case 1:
                                {
                                  $uploaderInstructorLevel="Teacher1";
                                  break; 
                                }
                                case 2:
                                {
                                  $uploaderInstructorLevel="Teacher2";
                                  break;
                                  break;
                                }
                                case 3:
                                {
                                  $uploaderInstructorLevel="Teacher3";
                                  break;
                                  break;
                                }
                                default:
                                {
                                  $uploaderInstructorLevel="Teacher0";
                                  break;
                                }
                              }

                              ?>

                                <div class="video_sec">

                                  <a href='<?php echo "video.php?videoId=$videoDetailQResultRow[0]"; ?>'>
                                    <!-- <img src="../../resources/images/video_fig.png" alt=""> -->
                                    <div class="wrapper">
                                      <video class="thumbnailVideo">
                                        <source src="<?php echo $videoFile ; ?>"/>
                                      </video>
                                      <div class="playpause"></div>
                                    </div>
                                  </a>
                                  <div class="video_content">
                                      <h4><?php echo $videoTitle ; ?></h4>
                                      <p><?php echo $videoDesc ; ?></p>
                                      <ul>
                                          <li><span title="#OfViews" class="label label-danger"><i class="fa fa-eye"></i>&nbsp;<?php echo $noOfViews ; ?></span></li>
                                          <li><span title="CostOfView" class="label label-danger"><i class="fa fa-inr"></i>&nbsp;<?php echo $costOfView ; ?></span></li>
                                          <li><a href="uploaderProfile.php?userId=<?php echo $uploaderId ; ?>"><span title="UploaderName" class="label label-danger"><i class="fa fa-user"></i>&nbsp;<?php echo $uploaderName ; ?></span></a></li>
                                          <li><span title="InstructorLevel" class="label label-danger"><i class="fa fa-flask"></i>&nbsp;<?php echo $uploaderInstructorLevel ; ?></span></li>
                                          <li><span title="Subscribers" class="label label-danger"><i class="fa fa-users"></i>&nbsp;<?php echo $uploaderSubscribers ; ?></span></li>
                                          <li><span title="Your Connects" class="label label-danger"><i class="fa fa-user-circle-o"></i>&nbsp;<?php echo $uploaderSubscribers ; ?></span></li>
                                      </ul>
                                  </div>

                                </div>


                              <?php

                          }
                      }


                    }
                ?>


                <?php
                  }else{
                    echo "<h4>No Watch Later Videos yet.</h4>";
                  }
                ?>

                </div>

                <div class="tab-pane" id="latestTab">
                  

                  <?php


                    $videoQuery="SELECT * from videos order by uploadDateTime DESC";
                    $videoQueryResult = mysql_query ($videoQuery) or trigger_error("Query fails. Contact us to report the issue.");

                    
                    if (mysql_affected_rows() > 0){

                        

                        while($row = mysql_fetch_array($videoQueryResult, MYSQL_NUM)){
                          
                          $noOfViews = $row[6];
                          $videoDesc = $row[2];
                          $videoTitle=$row[1];
                          $videoFile = "../../resources/uploads/" . $_SESSION['userId'] . "/";
                          $videoFile .= $row[3];
                          $uploaderId = $row[4];
                          $costOfView = $row[7];

                          $uploaderInstructorLevel = 0;
                          $uploaderName = "Anonymouns";
                          $uploaderSubscribers = 0;

                          $viewCounter = 0;

                          // Get Detail of Uploader
                          $uploaderInfoQuery="SELECT * from users where id=" . $uploaderId . ";";
                          $uploaderInfoQueryResult = mysql_query ($uploaderInfoQuery) or trigger_error("Query fails. Contact us to report the issue.");
                          if (mysql_affected_rows() > 0){
                            while($uploaderRow = mysql_fetch_array($uploaderInfoQueryResult, MYSQL_NUM)){
                              $uploaderName = $uploaderRow[2];
                            }
                          }

                          //Get Uploader Details
                          $uploaderDetailsQuery="SELECT * from userDetails where userId=" . $uploaderId . ";";
                          $uploaderDetailsQueryResult = mysql_query ($uploaderDetailsQuery) or trigger_error("Query fails. Contact us to report the issue.");
                          if (mysql_affected_rows() > 0){
                            while($uploaderDetailsRow = mysql_fetch_array($uploaderDetailsQueryResult, MYSQL_NUM)){
                              $uploaderInstructorLevel = $uploaderDetailsRow[4];
                            }
                          }

                          // Get Uploader Subscribers
                          $uploaderSubscriberQuery="SELECT count(*) from subscribers where userId=" . $uploaderId . ";";
                          $uploaderSubscriberQueryResult = mysql_query ($uploaderSubscriberQuery) or trigger_error("Query fails. Contact us to report the issue.");
                          if (mysql_affected_rows() > 0){
                            while($uploaderSubscriberRow = mysql_fetch_array($uploaderSubscriberQueryResult, MYSQL_NUM)){
                              $uploaderSubscribers = $uploaderSubscriberRow[0];
                            }
                          }

                          switch($uploaderInstructorLevel){
                            case 0:
                            {
                              $uploaderInstructorLevel="Teacher0";
                              break;
                            }
                            case 1:
                            {
                              $uploaderInstructorLevel="Teacher1";
                              break; 
                            }
                            case 2:
                            {
                              $uploaderInstructorLevel="Teacher2";
                              break;
                              break;
                            }
                            case 3:
                            {
                              $uploaderInstructorLevel="Teacher3";
                              break;
                              break;
                            }
                            default:
                            {
                              $uploaderInstructorLevel="Teacher0";
                              break;
                            }
                          }

                          ?>

                          <div class="video_sec">

                            <a href='<?php echo "video.php?videoId=$row[0]"; ?>'>
                              <!-- <img src="../../resources/images/video_fig.png" alt=""> -->
                              <div class="wrapper">
                                <video class="thumbnailVideo">
                                  <source src="<?php echo $videoFile ; ?>"/>
                                </video>
                                <div class="playpause"></div>
                              </div>
                            </a>
                            <div class="video_content">
                                <h4><?php echo $videoTitle ; ?></h4>
                                <p><?php echo $videoDesc ; ?></p>
                                <ul>
                                    <li><span title="#OfViews" class="label label-danger"><i class="fa fa-eye"></i>&nbsp;<?php echo $noOfViews ; ?></span></li>
                                    <li><span title="CostOfView" class="label label-danger"><i class="fa fa-inr"></i>&nbsp;<?php echo $costOfView ; ?></span></li>
                                    <li><a href="uploaderProfile.php?userId=<?php echo $uploaderId ; ?>"><span title="UploaderName" class="label label-danger"><i class="fa fa-user"></i>&nbsp;<?php echo $uploaderName ; ?></span></a></li>
                                    <li><span title="InstructorLevel" class="label label-danger"><i class="fa fa-flask"></i>&nbsp;<?php echo $uploaderInstructorLevel ; ?></span></li>
                                    <li><span title="Subscribers" class="label label-danger"><i class="fa fa-users"></i>&nbsp;<?php echo $uploaderSubscribers ; ?></span></li>
                                    <li><span title="Your Connects" class="label label-danger"><i class="fa fa-user-circle-o"></i>&nbsp;<?php echo $uploaderSubscribers ; ?></span></li>
                                </ul>
                            </div>

                          </div>

                          <?php
                          
                        }
                    }else{
                      echo "<h4>No Video has been uploaded yet.</h4>";
                    }
                  ?>

                  
                </div>

                <div class="tab-pane" id="trendingTab">

                  <?php


                    $videoQuery="SELECT * from videos order by noOfViews DESC";
                    $videoQueryResult = mysql_query ($videoQuery) or trigger_error("Query fails. Contact us to report the issue.");

                    if (mysql_affected_rows() > 0){

                        while($row = mysql_fetch_array($videoQueryResult, MYSQL_NUM)){
                          
                          $noOfViews = $row[6];
                          $videoDesc = $row[2];
                          $videoTitle=$row[1];
                          $videoFile = "../../resources/uploads/" . $_SESSION['userId'] . "/";
                          $videoFile .= $row[3];
                          $uploaderId = $row[4];
                          $costOfView = $row[7];

                          $uploaderInstructorLevel = 0;
                          $uploaderName = "Anonymouns";
                          $uploaderSubscribers = 0;

                          $viewCounter = 0;

                          // Get Detail of Uploader
                          $uploaderInfoQuery="SELECT * from users where id=" . $uploaderId . ";";
                          $uploaderInfoQueryResult = mysql_query ($uploaderInfoQuery) or trigger_error("Query fails. Contact us to report the issue.");
                          if (mysql_affected_rows() > 0){
                            while($uploaderRow = mysql_fetch_array($uploaderInfoQueryResult, MYSQL_NUM)){
                              $uploaderName = $uploaderRow[2];
                            }
                          }

                          //Get Uploader Details
                          $uploaderDetailsQuery="SELECT * from userDetails where userId=" . $uploaderId . ";";
                          $uploaderDetailsQueryResult = mysql_query ($uploaderDetailsQuery) or trigger_error("Query fails. Contact us to report the issue.");
                          if (mysql_affected_rows() > 0){
                            while($uploaderDetailsRow = mysql_fetch_array($uploaderDetailsQueryResult, MYSQL_NUM)){
                              $uploaderInstructorLevel = $uploaderDetailsRow[4];
                            }
                          }

                          // Get Uploader Subscribers
                          $uploaderSubscriberQuery="SELECT count(*) from subscribers where userId=" . $uploaderId . ";";
                          $uploaderSubscriberQueryResult = mysql_query ($uploaderSubscriberQuery) or trigger_error("Query fails. Contact us to report the issue.");
                          if (mysql_affected_rows() > 0){
                            while($uploaderSubscriberRow = mysql_fetch_array($uploaderSubscriberQueryResult, MYSQL_NUM)){
                              $uploaderSubscribers = $uploaderSubscriberRow[0];
                            }
                          }

                          switch($uploaderInstructorLevel){
                            case 0:
                            {
                              $uploaderInstructorLevel="Teacher0";
                              break;
                            }
                            case 1:
                            {
                              $uploaderInstructorLevel="Teacher1";
                              break; 
                            }
                            case 2:
                            {
                              $uploaderInstructorLevel="Teacher2";
                              break;
                              break;
                            }
                            case 3:
                            {
                              $uploaderInstructorLevel="Teacher3";
                              break;
                              break;
                            }
                            default:
                            {
                              $uploaderInstructorLevel="Teacher0";
                              break;
                            }
                          }

                          ?>

                          <div class="video_sec">

                            <a href='<?php echo "video.php?videoId=$row[0]"; ?>'>
                              <!-- <img src="../../resources/images/video_fig.png" alt=""> -->
                              <div class="wrapper">
                                <video class="thumbnailVideo">
                                  <source src="<?php echo $videoFile ; ?>"/>
                                </video>
                                <div class="playpause"></div>
                              </div>
                            </a>
                            <div class="video_content">
                                <h4><?php echo $videoTitle ; ?></h4>
                                <p><?php echo $videoDesc ; ?></p>
                                <ul>
                                    <li><span title="#OfViews" class="label label-danger"><i class="fa fa-eye"></i>&nbsp;<?php echo $noOfViews ; ?></span></li>
                                    <li><span title="CostOfView" class="label label-danger"><i class="fa fa-inr"></i>&nbsp;<?php echo $costOfView ; ?></span></li>
                                    <li><a href="uploaderProfile.php?userId=<?php echo $uploaderId ; ?>"><span title="UploaderName" class="label label-danger"><i class="fa fa-user"></i>&nbsp;<?php echo $uploaderName ; ?></span></a></li>
                                    <li><span title="InstructorLevel" class="label label-danger"><i class="fa fa-flask"></i>&nbsp;<?php echo $uploaderInstructorLevel ; ?></span></li>
                                    <li><span title="Subscribers" class="label label-danger"><i class="fa fa-users"></i>&nbsp;<?php echo $uploaderSubscribers ; ?></span></li>
                                    <li><span title="Your Connects" class="label label-danger"><i class="fa fa-user-circle-o"></i>&nbsp;<?php echo $uploaderSubscribers ; ?></span></li>
                                </ul>
                            </div>

                          </div>

                          <?php
                          
                        }
                    }else{
                      echo "<h4>No Video has been uploaded yet.</h4>";
                    }
                  ?>

                </div>

                <div class="tab-pane" id="promotionalTab">
                  <h4>No Promotional Video has been uploaded yet.</h4>
                  <!-- <div class="video_sec">
                      <img src="../../resources/images/video_fig.png" alt="">
                      <div class="video_content">
                          <h4>Promotional</h4>
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
                  </div> -->
                </div>

              </div>
            </div>

        </div>
        <!-- col -->
        <div class="col-md-3">
            <div class="box_brown">
                <ul>
                    <li><a href="myClass.php"><i class="fa fa-angle-right" aria-hidden="true"></i> My Class</a></li>
                    <li><a href="myPlan.php"><i class="fa fa-angle-right" aria-hidden="true"></i> My Plan</a></li>
                    <!-- <li><a href="myTheme.php"><i class="fa fa-angle-right" aria-hidden="true"></i> My Theme</a></li> -->
                    <li><a href="myChoice.php"><i class="fa fa-angle-right" aria-hidden="true"></i> My Choice</a></li>
                    <li><a href="myTeacher.php"><i class="fa fa-angle-right" aria-hidden="true"></i> My Teacher</a></li>
                    <li><a href="myHistory.php"><i class="fa fa-angle-right" aria-hidden="true"></i> My History</a></li>
                </ul>
            </div>
            <!-- <h3 class="prockc_h3">@prockc</h3> -->
            <!-- <div class="box_brown inline_box">
                <ul>
                    <li>
                        <a href="#"><img src="../../resources/images/msg.png" alt=""> <span>2</span></a></a>
                    </li>
                    <li>
                        <a href="#"><img src="../../resources/images/chat.png" alt=""> <span>2</span></a></li>
                </ul>
            </div> -->
            <div class="box_brown">
            <h4>Activities on SOC</h4>
                <ul>
                    <li><a href="">Ankit posted a picture.</a></li>
                    <li><a href="">Vignesh is now friend with Prashant.</a></li>
                </ul>
            </div>

            <div class="box_brown mb30">
            <h4>Activities on  WEC</h4>
                <ul>
                    <li><a href="">Prashant scheduled a Wec session for tomorrow.</a></li>
                </ul>
            </div>



        </div>
    </div>
<?php
  require_once('footer.php');
?>
