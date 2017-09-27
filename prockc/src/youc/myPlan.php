<?php

    require_once('header.php');

    if(!isset($_SESSION['userName'])){
        // Already Logged In
        header('Location: ../login/login.php');
    }

?>

<body class="inner-page" onload="loadDatePicker();">

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

<span id="checkPoint"></span>

<div class="container-fluid">

<div class="col-md-12">
    <div class="text-center">
        <div id="calender">
          <div class="calendar pignose-calendar">
            
          </div>
          
          
          <div class="next-upload">
              <div class="cont">
                  <h4 id="activityHead">Schedule Activities</h4>
                  <p><input readonly id="selectDate" type="text" /></p>
                  <p><input id="selectTime" type="text" class="time" placeholder="Select Time" /></p>
                  <input type="text" placeholder="About Activity" id="activityTitle">
                  <div class="clarfix"></div>
                  <button class="calBtn" id="activityPlanButton" onclick="javascript:submitActivity(<?php echo $_SESSION['userId'];?>);">Plan</button>
                  <button class="calBtn" id="resetButton" onclick="javascript:resetActivity();">Reset</button>
              </div>
          </div>

        </div>
      </div>
</div>
</div>

<div id="activityTimeline">
<div class="container">
  <hr>
  <h3>Planned Activities</h3>
  <section id="cd-timeline" class="cd-container">

    <!-- <div class="cd-timeline-block">
      <div class="cd-timeline-img cd-picture">
        <img src="../../resources/vertical-timeline/img/cd-icon-picture.svg" alt="Picture">
      </div>

      <div class="cd-timeline-content">
        <h2>Title of section 1</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
        <a href="#0" class="cd-read-more">Read more</a>
        <span class="cd-date">Jan 14</span>
      </div>
    </div> -->


<?php
  $currDate = date('Y-m-d');

  $activityTitle='';
  $activityDate=$currDate;
  $activityTime='';
  $activityId=0;

  $selectActivityQ="SELECT * from userPlannedActivities where userId=" . $_SESSION['userId'] . " and activityDate >= '" . $currDate . "' ORDER BY creationDateTime DESC;";
  $selectActivityQRes = mysql_query ($selectActivityQ) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
        while($selectActivityQResRow = mysql_fetch_array($selectActivityQRes, MYSQL_NUM) ){
            $activityTitle=$selectActivityQResRow[5];
            $activityDate=$selectActivityQResRow[3];
            $activityTime=$selectActivityQResRow[4];
            $activityId=$selectActivityQResRow[0];

?>
    <div class="cd-timeline-block">
      <div class="cd-timeline-img cd-movie">
        <img src="../../resources/vertical-timeline/img/cd-icon-movie.svg" alt="Video">
      </div>

      <div class="cd-timeline-content">
        <h2><?php echo  $activityTitle ; ?></h2>
        <a href="javascript:;" class="cd-read-more marginToRight" onclick="updateActivity(<?php echo $activityId ; ?>);">Update</a>
        <a href="javascript:;" class="cd-read-more marginToRight" onclick="deleteActicvity(<?php echo $activityId ; ?>);">Delete</a>
        <span class="cd-date"><?php echo $activityDate . " " . $activityTime ;  ?></span>
      </div>
    </div>

    
<?php
       }
    }else{
      echo "<p>There are currently no planned activities.</p>";
    }
?>

    <!-- <div class="cd-timeline-block">
      <div class="cd-timeline-img cd-location">
        <img src="../../resources/vertical-timeline/img/cd-icon-location.svg" alt="Location">
      </div> 

      <div class="cd-timeline-content">
        <h2>Title of section 4</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
        <a href="#0" class="cd-read-more">Read more</a>
        <span class="cd-date">Feb 14</span>
      </div> 
    </div> -->


  </section>
</div>
</div>


<?php
  require_once('footer.php');
?>