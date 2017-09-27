<?php

    require_once('header.php');

    if(!isset($_SESSION['userName'])){
        // Already Logged In
        header('Location: ../login/login.php');
    }

    if(!isset($_GET['userId'])){
        header('Location: index.php');
    }

    $yearStr=date("Y");
    $monthStr=date("m");

    $instructorId=$_GET['userId'];

?>

<body class="inner-page" onload="loadUserProfile(<?php echo $instructorId . "," . $yearStr . "," . $monthStr ; ?>);">

<?php

      $className="";
      $classLogo="";
      $classAddress="";
      $classPhysicalPresence=0;
      /// Class Details
      $classQ = "select * from userClass where userId=" . $instructorId . ";";
      $classQResult = mysql_query ($classQ) or trigger_error("Query fails. Contact us to report the issue.");
      if (mysql_affected_rows() > 0){
        while($classQResultRow = mysql_fetch_array($classQResult, MYSQL_NUM)){
              $className = $classQResultRow[2];
              $classLogo = "../../resources/uploads/" . $instructorId . "/" . $classQResultRow[3];
              $classAddress = $classQResultRow[4];
              $classPhysicalPresence = $classQResultRow[6];
        }  
      }

        $noOfUploads=0;
        $noOfViews=0;
        $subscribersCount = 0;

        $videoQueries="select * from videos where uploaderId=" . $instructorId . ";";
        $videoQueriesResult = mysql_query ($videoQueries) or trigger_error("Query fails. Contact us to report the issue.");
        $noOfUploads = mysql_affected_rows();
        if($noOfUploads > 0){
            while($row = mysql_fetch_array($videoQueriesResult, MYSQL_NUM)){
                $noOfViews += $row[6];
            }
        }

        $subscriberQueries="select * from subscribers where userId=" . $instructorId ;
        $subscriberQueriesResult = mysql_query ($subscriberQueries) or trigger_error("Query fails. Contact us to report the issue.");
        $subscribersCount = mysql_affected_rows();


        $uploaderInstructorLevel = 0;


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

    <div class="col-md-10">
        <ul class="info">
            <li><a href="#"><?php echo $className; ?></a></li>
            <li><a href="#">Total Uploads: <?php echo $noOfUploads ; ?></a></li>
            <li><a href="#">Uploader Subscriber : <?php echo $subscribersCount ; ?></a></li>
            <li><a href="#">Uploader Total view : <?php echo $noOfViews ; ?></a></li>
            <li><a href="#">Uploader Joining Date : 1 jan 2017</a></li>
            <li><a href="#">Category : Motivational, Sports, History, Politics</a></li>
            <li><a href="#">Uploader institution Level : class 1 - class 10</a></li>
            <li><a href="#">Uploader Upcoming videos : video on every tuesday</a></li>
        
        </ul>
    </div>
<div class="clearfix"></div>


<div class="col-md-12">
    <div class="text-center">

        <div id="calender">
          <div class="calendar pignose-calendar"></div>
          <div class="next-upload">
              <div class="cont">
                  <h4><span class="monthPlaceholder"></span> Plan</h4>
                  <div id="eventDetails" align="left">
                  </div>
              </div>
          </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="col-md-6">
    <div class="up_btns">
        <button><i class="fa fa-share-alt"></i> Share Uploader info on soc</button>
        <button><i class="fa fa-share-alt"></i> WEC Page Of Uploader</button>
        <button><i class="fa fa-share-alt"></i> Recommend to friends</button>
    </div><!-- up_btns -->

<hr>

<div class="testimonian">
    <h3 style="text-decoration: underline;">Uploader Testimonials</h3>
    <div id="testimonialPlaceHolderIndication"></div>
<?php
  $testimonialsQ="SELECT * from userTestimonials where userId=" . $instructorId . " ORDER BY testimonialDateTime DESC;";
  $testimonialsQRes = mysql_query ($testimonialsQ) or trigger_error("Query fails. Contact us to report the issue.");
  if (mysql_affected_rows() > 0){
      while($testimonialsQResRow = mysql_fetch_array($testimonialsQRes, MYSQL_NUM) ){
          $testimonialId=$testimonialsQResRow[0];
          $testimonialGivenByUserId=$testimonialsQResRow[2];
          $testimonialGivenDateTime=$testimonialsQResRow[3];
          $testimonialText=$testimonialsQResRow[4];

          // UserName
          $commentUserName="";
          $commentUserEmail="";
          $commentUserProfilePic="";

          // Get User Photo userName
          $userNameQ = "select * from users where id=" . $testimonialGivenByUserId;
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
    <div class="testMonials">
        <?php echo '<img src="' . $commentUserProfilePic . '" alt="">' ; ?>
        <div class="body_tt">
            <p><?php echo $testimonialText ;  ?></p>
            <hr>
            <p>By: <?php echo $commentUserName ; ?> @ <?php echo $testimonialGivenDateTime ; ?></p>
            <?php
              if($_SESSION['userId'] == $testimonialGivenByUserId){
            ?>
            <?php echo '<a href="javascript:;" onClick="removeTestimonial(' . $testimonialId . ');">' ; ?><i class="fa fa-trash"></i> Delete</a>
            <?php
              }
            ?>
        </div>
    </div>

<?php
    }
  }else{
    echo "<h3>No Testimonials yet!!!</h3>";
  }

?>

<?php
  if($_SESSION['userId'] != $instructorId){
?>
<button class="testimUp" type="button" data-toggle="modal" data-target="#addTestimonial"><i class="fa fa-plus" aria-hidden="true"></i> Add Testimonial</button>
<?php
  }
?>

</div><!-- testimonian -->

</div>

<div class="col-md-6">
<div id="chart">
    <canvas id="myChart" width="400" height="400"></canvas>
</div>
</div><!-- cold -->

<!-- Modal -->
<div class="modal fade" id="addTestimonial" tabindex="-1" role="dialog" aria-labelledby="uploadVideoModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <div class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></div>
        <h4 class="modal-title" id="uploadVideoModal">Testimonial</h4>
      </div>
      <div class="modal-body">
          <div class="conts-form">
              <textarea id="testimonialText" placeholder="Testimonial Text"></textarea>
              <input type="button" value="Submit" onclick="submitTestimonial(<?php echo $instructorId . "," . $_SESSION['userId']; ?>);">
          </div>
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