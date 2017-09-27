<?php

    require_once('header.php');

    if(!isset($_SESSION['userName'])){
        // Already Logged In
        header('Location: ../login/login.php');
    }

    if(!isset($_GET['videoId'])){
      header('Location: index.php'); 
    }

    $videoId=$_GET['videoId'];
    $videoTitle="";
    $noOfViews=0;
    $videoDesc="DESC";
    $videoFile = "../../resources/uploads/" . $_SESSION['userId'] . "/";
    $uploaderId = 0;

    $uploaderInstructorLevel = 0;
    $uploaderName = "Anonymouns";
    $uploaderSubscribers = 0;
    $uploaderEmail="";
    $uploaderProfilePic="";


    $totalVideoLikes = 0;
    $totalVideoDislikes = 0;
    $likedByYou=0;
    $dislikeByYou=0;

    $likedByYouQ="select * from userViewVideos where userId=" . $_SESSION['userId'] . " and videoId=" . $videoId . " and likeVideo=1";
    $likedByYouQResult = mysql_query ($likedByYouQ) or trigger_error("Query fails. Contact us to report the issue.");
    $likedByYou = mysql_affected_rows();

    $dislikedByYouQ="select * from userViewVideos where userId=" . $_SESSION['userId'] . " and videoId=" . $videoId . " and dislikeVideo=1";
    $dislikedByYouQResult = mysql_query ($dislikedByYouQ) or trigger_error("Query fails. Contact us to report the issue.");
    $dislikeByYou = mysql_affected_rows();




    $totalLikeQ="select * from userViewVideos where videoId=" . $videoId . " and likeVideo=1";
    $totalLikeQResult = mysql_query ($totalLikeQ) or trigger_error("Query fails. Contact us to report the issue.");
    $totalVideoLikes = mysql_affected_rows();

    $totalDislikeQ = "select * from userViewVideos where videoId=" . $videoId . " and dislikeVideo=1";
    $totalDislikeQResult = mysql_query ($totalDislikeQ) or trigger_error("Query fails. Contact us to report the issue.");
    $totalVideoDislikes = mysql_affected_rows();


    // Check if valid
    $findVideoQuery="select * from videos where id=" . $videoId . ";";
    $findVideoQueryResult = mysql_query ($findVideoQuery) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
        while($row = mysql_fetch_array($findVideoQueryResult, MYSQL_NUM)){
          $noOfViews = $row[6];
          $videoDesc = $row[2];
          $videoTitle=$row[1];
          $videoFile .= $row[3];
          $uploaderId = $row[4];
        }
    }else{
      header('Location: index.php');
    }

    //echo " Uploader Id: " . $uploaderId . "<br>";

    // Get Detail of Uploader
    $uploaderInfoQuery="SELECT * from users where id=" . $uploaderId . ";";
    $uploaderInfoQueryResult = mysql_query ($uploaderInfoQuery) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
      while($uploaderRow = mysql_fetch_array($uploaderInfoQueryResult, MYSQL_NUM)){
        $uploaderName = $uploaderRow[2];
        $uploaderEmail = $uploaderRow[3];
      }
    }

    //echo " Uploader Email: " . $uploaderName . "<br>";

    //Get Uploader Details
    $uploaderDetailsQuery="SELECT * from userDetails where userId=" . $uploaderId . ";";
    $uploaderDetailsQueryResult = mysql_query ($uploaderDetailsQuery) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
      while($uploaderDetailsRow = mysql_fetch_array($uploaderDetailsQueryResult, MYSQL_NUM)){
        $uploaderInstructorLevel = $uploaderDetailsRow[4];
      }
    }

    $uploaderProfileQ = "select * from userProfile where email='" . $uploaderEmail . "'";
    //echo $uploaderProfileQ . "<br>";
    $uploaderProfileQResult = mysql_query ($uploaderProfileQ) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
        while($uploaderProfileQResultRow = mysql_fetch_array($uploaderProfileQResult, MYSQL_NUM)){
          $uploaderProfilePic ="../../resources/uploads/" . $uploaderEmail . "/" . $uploaderProfileQResultRow[1];
        }
    }

    //echo " Uploader Profile Pic: " . $uploaderProfilePic . "<br>";

    // Get Uploader Subscribers
    $uploaderSubscriberQuery="SELECT count(*) from subscribers where userId=" . $uploaderId . ";";
    $uploaderSubscriberQueryResult = mysql_query ($uploaderSubscriberQuery) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
      while($uploaderSubscriberRow = mysql_fetch_array($uploaderSubscriberQueryResult, MYSQL_NUM)){
        $uploaderSubscribers = $uploaderSubscriberRow[0];
      }
    }

    $likeVideo = 0;
    $dislikeVideo = 0;
    $watchLater = 0;
    $viewCounter = 0;

    // Increment the Video View Count
    $updateUserViewCount="select * from userViewVideos where userId=" . $_SESSION['userId'] . " and videoId=" . $videoId . ";";
    $updateUserViewCountResult = mysql_query ($updateUserViewCount) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
      while($updateUserViewCountRow = mysql_fetch_array($updateUserViewCountResult, MYSQL_NUM)){
        $viewCounter = $updateUserViewCountRow[2];
        $likeVideo = $updateUserViewCountRow[3];
        $dislikeVideo = $updateUserViewCountRow[4];
        $watchLater = $updateUserViewCountRow[5];


        if($_SESSION['userId'] != $uploaderId){
        
          //echo " " . $viewCounter . "<br>";
          $viewCounter = $viewCounter+1 ;  
          //echo " " . $viewCounter . "<br>";

          // Update the video View Details
          $updateViewQ="UPDATE userViewVideos SET viewCount=" . $viewCounter . " where userId=" . $_SESSION['userId'] . " and videoId=" . $videoId . ";";
          $updateVideoDateTimeQuery="UPDATE userViewVideos SET lastViewDateTime='" . $datetime . "' where userId=" . $_SESSION['userId'] . " and videoId=" . $videoId . ";";

          mysql_query ($updateViewQ) or trigger_error("Query fails. Contact us to report the issue.");
          mysql_query ($updateVideoDateTimeQuery) or trigger_error("Query fails. Contact us to report the issue.");

          //echo " How Many <br>";
        }
      }
    }else{
      if($_SESSION['userId'] != $uploaderId){
      
        // Insert new Record
        $insertViewRecord="INSERT INTO userViewVideos values(" . $_SESSION['userId'] . "," . $videoId . ",1,0,0,0,'" . $datetime .  "');";
        $insertViewRecordResult = mysql_query ($insertViewRecord) or trigger_error("Query fails. Contact us to report the issue.");

      }

    }

    // // Get New View Count
    $viewCounter = 0;
    $viewCountAnkitQ="select * from userViewVideos where videoId=" . $videoId . ";";
    $viewCountAnkitQResult = mysql_query ($viewCountAnkitQ) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
      while($viewCountAnkitQResultRow = mysql_fetch_array($viewCountAnkitQResult, MYSQL_NUM)){
        $viewCounter += $viewCountAnkitQResultRow[2];
      }
    }

    $updateViewCounterVideotableViews="UPDATE videos SET noOfViews=" . $viewCounter . " where id=" . $videoId . ";";
    $updateViewTimeVideotableViews="UPDATE videos SET lastViewDateTime='" . $datetime . "' where id=" . $videoId . ";";

    mysql_query ($updateViewCounterVideotableViews) or trigger_error("Query fails. Contact us to report the issue.");
    mysql_query ($updateViewTimeVideotableViews) or trigger_error("Query fails. Contact us to report the issue.");

    //die("Finish");

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
      }
      case 3:
      {
        $uploaderInstructorLevel="Teacher3";
        break;
      }
      default:
      {
        $uploaderInstructorLevel="Teacher0";
        break;
      }
    }

?>

<body class="inner-page" onload="initializeVideoPlayer();">


<?php

      $userProfilePic="../../resources/images/user_default_logo.png";
      $currenC=0;
      $earnings=0;
      $instructorLevel="Novice";
      $studentLevel="Novice";
      $userName=$_SESSION['userName'];

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
              }
              case 3:
              {
                $studentLevel="Graduate";
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
              }
              case 3:
              {
                $instructorLevel="Teacher3";
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
      </div>
    </div>

    <br>

    <div class="container-fluid">
      <div class="col-md-9">
        <h3 style="margin-bottom:2px; "><?php echo $videoTitle ; ?></h3>
        <hr style="margin-top: 5px;">

        <div class="media-wrapper" id="videoPlayerBox">
          <!-- <video controls="controls" width="100%"> -->
          <video id="youcMainVideo" width="100%">
            <source src="<?php echo $videoFile ; ?>">
          </video>
          <div id="videoControlBar">
            <a href="javascript:;" id="playPauseVideoBtn" class="floatMeLeft"><i class="fa fa-play"></i></a>
            <input class="floatMeLeft" id="videoSeekSlider" type="range" min="0" max="100" value="0" step="1"/>
            <span class="floatMeLeft2" id="currentTimeText">00:00</span><span class="floatMeLeft2">&nbsp;/&nbsp;</span>
            <span class="floatMeLeft" id="durationTimeText">00:00</span>
            <a class="floatMeLeft" href="javascript:;" id="muteButton"><i class="fa fa-volume-up"></i></a>
            <input class="floatMeLeft" id="volumeSeekSlider" type="range" min="0" max="100" value="100" step="1"/>
            <a class="floatMeLeft" href="javascript:;" id="fullScreenBtn"><i class="fa fa-arrows-alt"></i></a>
            <span style="clear:both"></span>
          </div>
        </div>


        <?php
          $videoCommentsCount=0;
          $videoCommentCountQ="SELECT * from videoCommentDetails where videoId=" . $videoId . ";";
          $videoCommentCountQResult = mysql_query ($videoCommentCountQ) or trigger_error("Query fails. Contact us to report the issue.");
          $videoCommentsCount = mysql_affected_rows();

        ?>


        <div class="total_views">
            <p>Views: <span id="totalViews" class="label label-danger"><?php echo $viewCounter ;?></span>&nbsp;&nbsp;Likes: <span class="label label-success" id="totalLikes"><?php echo $totalVideoLikes ; ?></span>&nbsp;&nbsp;Dislikes: <span class="label label-warning" id="totalDislikes"><?php echo $totalVideoDislikes ; ?></span>&nbsp;&nbsp;Comments: <span class="label label-info" id="totalComments"><?php echo $videoCommentsCount ; ?></span>
            </p>
            <hr>
        </div>


        <?php
          if($uploaderId == $_SESSION['userId']){
            // Don't show these buttons
          }else{
        ?>

        <div class="buttons">

          <?php
            if($likedByYou == 0){
              //if($dislikeByYou == 0){
          ?>
            <button class=" btns like" id="videoLikeButton" onclick="onVideoLikeClick(<?php echo $videoId . "," . $_SESSION['userId'] ?>)"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Like</button>
          <?php
              //}
            }else{
          ?>
            <button class=" btns like" id="videoLikeButton" onclick="onVideoUndoLikeClick(<?php echo $videoId . "," . $_SESSION['userId'] ?>)"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Liked</button>
          <?php
            }
          ?>
    

          <?php
            if($dislikeByYou == 0){
              //if($likedByYou == 0){
          ?>
          <button class=" btns like" id="videoDislikeButton" onclick="onVideoDisklikeClick(<?php echo $videoId . "," . $_SESSION['userId'] ?>)"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> Dislike</button>
          <?php
              //}
            }else{
          ?>
              <button class=" btns like" id="videoDislikeButton" onclick="onVideoUndoDislikeClick(<?php echo $videoId . "," . $_SESSION['userId'] ?>)"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Disliked</button>
           <?php
            }
          ?>

          <button class=" btns like" onclick="onVideoShareClick(<?php echo $videoId . "," . $_SESSION['userId'] ?>)"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</button>

          <?php
            $checkSubscQ="select * from subscribers where userId=" . $uploaderId . " and subscriberId=" . $_SESSION['userId'] .";";
            $checkSubscQResult = mysql_query ($checkSubscQ) or trigger_error("Query fails. Contact us to report the issue.");
            if (mysql_affected_rows() > 0){
          ?>
            <button class=" btns like" id="subscribeButton" onclick="unSubscribeInstructor(<?php echo $_SESSION['userId'] . "," . $uploaderId ; ?>);"><i class="fa fa-heart" aria-hidden="true"></i> Subscribed</button>
          <?php        
            }else{
          ?>
          <button class=" btns like" id="subscribeButton" onclick="subscribeInstructor(<?php echo $_SESSION['userId'] . "," . $uploaderId ; ?>);"><i class="fa fa-heart-o" aria-hidden="true"></i> Subscribe</button>

          <?php
            }
          ?>
        </div>

        <?php
        }
        ?>

        <div class="botton_btn">
            <ul>
                <li>
                    <a href="uploaderProfile.php?userId=<?php echo $uploaderId ; ?>">
                      <img width="50px" src="<?php echo $uploaderProfilePic ; ?>">
                      <p>
                        <span><?php echo $uploaderName ; ?></span>
                        <span><?php echo $uploaderInstructorLevel ; ?></span>
                      </p>
                    </a>
                </li>
                
              <?php

                if($_SESSION['userId'] != $uploaderId){

                  $userViewVideoQ = "select * from userViewVideos where videoId=" . $videoId . " and userId=" . $_SESSION['userId'] . " and watchLater=1";
                  $userViewVideoQResult = mysql_query ($userViewVideoQ) or trigger_error("Query fails. Contact us to report the issue.");
                  if(mysql_affected_rows() > 0){
                ?>
                    <li>
                      <a href="javascript:;" id="watchLaterSpan" onclick="onRemoveFromWatchLaterClicked(<?php echo $videoId . "," . $_SESSION['userId'] ?>)">
                      <img width="50px" src="../../resources/images/watch.png" alt="">
                      <p><span>Saved</span></p>
                      </a>
                  </li>        
                <?php
                  }else{
                ?>
                    <li>
                      <a href="javascript:;" id="watchLaterSpan" onclick="onWatchLaterClicked(<?php echo $videoId . "," . $_SESSION['userId'] ?>)">
                      <img width="50px" src="../../resources/images/watch.png" alt="">
                      <p><span>Watch Later</span></p>
                      </a>
                  </li>
                <?php
                  }
                }
              ?>

                <?php
                  if($_SESSION['userId'] != $uploaderId){
                ?>
                <li>
                    <a href="#">
                    <img width="40px" src="../../resources/images/user.png" alt="">
                    <p><span>Connect with Uploader</span></p>
                    </a>
                </li>

                <?php
                  }
                ?>
            </ul>
        </div>

        <div class="total_views">
            <p>About Video</p>
            <p><span id="roughWork"></span></p>
        </div>

        <div class="about_video">
            <h4><?php echo $videoDesc ; ?></h4>
        </div>


        <div class="comment_sec">
      <div class="comment_header">
        Comments <span class="badge" id="totalCommentsSecond"><?php echo $videoCommentsCount ; ?></span>
      </div>

      <div id="comments">

<?php
  if($_SESSION['userId'] != $uploaderId){
?>
      <div class="comment_box" id="addCommentBlock">

          <div class="user">
              <?php echo '<img src="' . $userProfilePic . '" alt="">' ; ?>
          </div><!-- user -->
          <div class="comment">
              <h4><?php echo $_SESSION['userName']; ?></h4>
              <!-- <div class="date">17/09/2010</div> -->
              <textarea name="" id="videoCommentText" placeholder="Enter your Comment...."></textarea>
              <button class="button" onclick="submitComment(<?php echo "'" . $_SESSION['userName'] . "'," . $_SESSION['userId'] . ",'" . $userProfilePic . "'," . $videoId ?>);">Post</button>
          </div><!-- comment -->
      </div><!-- comment -->
<?php
  }
?>

      <?php
        $videoCommentCountQ="SELECT * from videoCommentDetails where videoId=" . $videoId . ";";
        $videoCommentCountQResult = mysql_query ($videoCommentCountQ) or trigger_error("Query fails. Contact us to report the issue.");
        if(mysql_affected_rows() > 0){
          while($videoCommentCountQResultRow = mysql_fetch_array($videoCommentCountQResult, MYSQL_NUM) ){

            $currCommentId=$videoCommentCountQResultRow[0];
            $commentUserId=$videoCommentCountQResultRow[1];
            $commentText=$videoCommentCountQResultRow[3];
            $commentDateTime=$videoCommentCountQResultRow[4];

            $commentUserName="";
            $commentUserEmail="";
            $commentUserProfilePic="";

            // Get User Photo userName
            $userNameQ = "select * from users where id=" . $commentUserId;
            $userNameQRes = mysql_query ($userNameQ) or trigger_error("Query fails. Contact us to report the issue.");
            if (mysql_affected_rows() > 0){
                while($userNameQResRow = mysql_fetch_array($userNameQRes, MYSQL_NUM)){
                  $commentUserName=$userNameQResRow[1];
                  $commentUserEmail=$userNameQResRow[3];
                  //"../../resources/uploads/" . $_SESSION['email'] . "/" . $userNameQResRow[1];
                }
            }

            $profileQuery = "select * from userProfile where email='" . $commentUserEmail . "'";
            $profileResult = mysql_query ($profileQuery) or trigger_error("Query fails. Contact us to report the issue.");
            if (mysql_affected_rows() > 0){
                while($row = mysql_fetch_array($profileResult, MYSQL_NUM)){
                  $commentUserProfilePic="../../resources/uploads/" . $commentUserEmail . "/" . $row[1];
                }
            }

        ?>

        <?php echo '<div class="comment_box" id="userComment_' . $currCommentId . '">'; ?>
              <div class="user">
                  <?php echo '<img src="' . $commentUserProfilePic . '" alt="">' ; ?>
              </div><!-- user -->
              <div class="comment">
                  <h4><?php echo $commentUserName ; ?></h4>
                   <div class="date"><?php echo $commentDateTime ; ?></div>
                 <p><?php echo $commentText ; ?></p>
                 <?php
                  if($_SESSION['userId'] == $commentUserId){
                 ?>
                 <ul>
                     <li> 
                     <?php echo '<a href="javascript:;" onClick="removeComment(' . $currCommentId . ',' . $videoId . ');">'; ?>
                     <i class="fa fa-trash"></i> Delete</a>
                     </li>
                 </ul>
                 <?php
                  }
                 ?>
              </div><!-- comment -->
        </div><!-- comment -->

        <?php

            }
          }

        ?>

            </div>
        </div><!-- comment_sec -->

      </div>
      <div class="col-md-3">

        <div class="rec_pro">
          <h4>Recommended video</h4>
          <div class="vid_list">
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
                    }
                    case 3:
                    {
                      $uploaderInstructorLevel="Teacher3";
                      break;
                    }
                    default:
                    {
                      $uploaderInstructorLevel="Teacher0";
                      break;
                    }
                  }

                  ?>


                  <div class="list">
                    <a href='<?php echo "video.php?videoId=$row[0]"; ?>'>
                      <img class="thumb" src="../../resources/images/video_fig.png" alt="">
                    </a>
                    <div class="cont">
                        <h5><?php echo $videoTitle ; ?></h5>
                        <p><?php echo $videoDesc ; ?></p>
                    </div>
                  </div><!-- list -->

                  <?php
                          
                        }
                    }else{
                      echo "<h4>No Video has been uploaded yet.</h4>";
                    }
                  ?>

          </div>
        </div><!-- cec -->


      </div>
    </div>

<?php
  require_once('footer.php');
?>
