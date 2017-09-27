<?php

    require_once('header.php');

    if(!isset($_SESSION['userName'])){
        // Already Logged In
        header('Location: ../login/login.php');
    }
?>


<body class="inner-page">



<?php

      $className="";
      $classLogo="";
      $classAddress="";
      $classPhysicalPresence=0;
      /// Class Details
      $classQ = "select * from userClass where userId=" . $_SESSION['userId'] . ";";
      $classQResult = mysql_query ($classQ) or trigger_error("Query fails. Contact us to report the issue.");
      if (mysql_affected_rows() > 0){
        while($classQResultRow = mysql_fetch_array($classQResult, MYSQL_NUM)){
              $className = $classQResultRow[2];
              $classLogo = "../../resources/uploads/" . $_SESSION['userId'] . "/" . $classQResultRow[3];
              $classAddress = $classQResultRow[4];
              $classPhysicalPresence = $classQResultRow[6];
        }  
      }


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


        $noOfUploads=0;
        $noOfViews=0;
        $subscribersCount = 0;

        $videoQueries="select * from videos where uploaderId=" . $_SESSION['userId'] ;
        $videoQueriesResult = mysql_query ($videoQueries) or trigger_error("Query fails. Contact us to report the issue.");
        $noOfUploads = mysql_affected_rows();
        if($noOfUploads > 0){
            while($row = mysql_fetch_array($videoQueriesResult, MYSQL_NUM)){
                $noOfViews += $row[6];
            }
        }

        $subscriberQueries="select * from subscribers where userId=" . $_SESSION['userId'] ;
        $subscriberQueriesResult = mysql_query ($subscriberQueries) or trigger_error("Query fails. Contact us to report the issue.");
        $subscribersCount = mysql_affected_rows();

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

<div class="row">

    <div class="col-md-2 col-sm-4">
        <div class="box_s">
                <?php
                    echo "<img src=\"" . $classLogo. "\"\>";
                ?>
            <div class="caption">
                Level  - <?php echo $instructorLevel ; ?>
            </div>
        </div><!-- box -->
    </div><!-- col -->

    <div class="col-md-4">
        <ul class="info">
            <li><a href="#"><?php echo $className ; ?></a></li>
            <li><a href="#">Uploads: <?php echo $noOfUploads ; ?></a></li>
            <li><a href="#">Subscribers: <?php echo $subscribersCount ; ?></a></li>
            <li><a href="#">Total Views: <?php echo $noOfViews ; ?></a></li>
        </ul>
    </div>

    <div class="col-md-6">
      <div class="up_btns  pull-right">
          <button class="pull-right">Uploading Rates &amp; Instutions</button>
          <button class="pull-right">My Uploading Planner</button>
          <button class="pull-right">Share on SOC</button>
          <!-- <button class="pull-right">Grouping of video in playlists</button> -->
      </div><!-- up_btns -->
    </div>

    <div class="col-md-12">
      <div class="upload_btn">
        <br><br>
        <!-- <button onclick="openPop()"><i class="fa fa-upload" aria-hidden="true"></i> Upload Videos</button> -->
        <button type="button" data-toggle="modal" data-target="#uploadVideoModal"><i class="fa fa-upload" aria-hidden="true"></i> Upload Videos</button>
        
      </div>

      <?php
        if($classPhysicalPresence == 1){
      ?>
        
      <div class="address">
          <span>Address:</span>
          <span><?php echo $classAddress ; ?></span>
      </div>
    </div>
    <?php
      }
    ?>
</div>


<hr>


 <h3>My Videos</h3>

<?php
                if(isset($_SESSION['gUploadError'])){
        ?>

                <div class="alert alert-danger" id="autoClose-alert">
                    <button class="close closeButton" data-dismiss="alert">x</button>
                    <strong>Error: </strong>
                    <?php echo $_SESSION['gUploadError']; ?>
                </div>

        <?php
            unset($_SESSION['gUploadError']);
            }
        ?>


        <?php
                if(isset($_SESSION['gUploadSuccess'])){
        ?>

                <div class="alert alert-success" id="autoClose-alert">
                    <button class="close" data-dismiss="alert">x</button>
                    <strong>Hurray: </strong>
                    <?php echo $_SESSION['gUploadSuccess']; ?>
                </div>

        <?php
            unset($_SESSION['gUploadSuccess']);
            }
        ?>





<div class="col-md-6">
<div class="rec_video">

<?php
    
    $showVideosQuery="select * from videos where uploaderId=" . $_SESSION['userId'] . " order by uploadDateTime DESC;";
    $showVideosQueryResult = mysql_query ($showVideosQuery) or trigger_error("Query fails. Contact us to report the issue.");
        if(mysql_affected_rows() > 0){
            while($row = mysql_fetch_array($showVideosQueryResult, MYSQL_NUM)){
                $videoFilePath="../../resources/uploads/" . $_SESSION['userId'] . "/" . $row[3];
?>

<div class="video_sec">
  <a href='<?php echo "video.php?videoId=$row[0]"; ?>'>
      <div class="wrapper">
        <video class="thumbnailVideo">
          <source src="<?php echo $videoFilePath ; ?>"/>
        </video>
        <div class="playpause"></div>
      </div>
    </a>
    <div class="video_content">
        <h4><?php echo $row[1]; ?></h4>
        <p><?php echo $row[2]; ?></p>
        <ul>
            <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?php echo $row[6]; ?> Views</a></li>
            <li><a href="#"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $row[7]; ?> CostPerView</a></li>
        </ul>
    </div>
</div>


<?php


            }
        }else{
            echo "<p>Let's upload your first Video and get recognition and rewards.</p>";
        }

?>

</div>
</div>

  
 </div><!-- container -->


<!-- Modal -->
<div class="modal fade" id="uploadVideoModal" tabindex="-1" role="dialog" aria-labelledby="uploadVideoModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <div class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></div>
        <h4 class="modal-title" id="uploadVideoModal">Upload Video</h4>
      </div>
      <div class="modal-body">
        <form id="upload" enctype="multipart/form-data" method="post">
          <div class="upload">
              <!-- <div class="user_upload"></div> -->
              <div class="next_input">
                  <input type="file" name="videoFile" id="videoFile">
              </div>
          </div>

          <div class="conts-form">
              <p>Video Tags:<input type="text" id="textInput" placeholder="Tags" required/></p>
              <input type="text" id="videoTitle" name="title" placeholder="Enter Title" required />
              <input type="text" id="videoDesc" name="description" placeholder="Description" required />
              <input type="text" id="costPerView" name="costPerView" placeholder="Cost Per View" required/>
              <input type="submit" value="Upload File" onclick="uploadFile();">
              <br>
              <progress id="progressBar" value="0" max="100" style="width:100%;"></progress>
              <br>
              <h3 id="status"></h3>
          </div> 
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<?php
  require_once('footer.php');
?>
    