<?php

    require_once('header.php');

    if(!isset($_SESSION['userName'])){
        // Already Logged In
        //header('Location: ../login/login.php');
    }

    $classQ = "select * from userClass where userId=" . $_SESSION['userId'] . ";";
    $classQResult = mysql_query ($classQ) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
      header('Location: myClassReal.php');
    }


?>


<body class="inner-page" onload="arrangeVideoTabs();">



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
        
        <?php
            if(isset($_SESSION['gClassCreationError'])){
                echo "Alas ! Class has not been created..... : " . $_SESSION['gClassCreationError'];
                unset($_SESSION['gClassCreationError']);
                die("");
            }

        ?>

        <div class="box_content allInp loginInp selecW Topmd">
        <h4>My Class</h4>
        <form action="classCreation.php" method="POST" enctype="multipart/form-data">
            
            <div class="inp_wrap rel">
                <input type="text" name="className" required placeholder="ClassName/InstitutionName"/> 
            </div>
            <div class="inp_wrap rel">
                <input type="text" name="subjectTags" required placeholder="SubjectTags">
            </div>

             <!-- <div class="inp_wrap rel">
                <input type="text" name="taregtAudience" required placeholder="Target audience">
            </div> -->

            <div class="inp_wrap  rel">
                <select required name="taregtAudience" style="margin-top: 10px;">
                    <option value="" selected disabled hidden>Target Audience</option>
                    <option value="1">Everyone</option>
                    <option value="2">Play group</option>
                    <option value="3">Class 1-8</option>
                    <option value="4">Class 9-10</option>
                    <option value="5">Class 11-12</option>
                    <option value="6">Graduate</option>
                    <option value="7">Post Graduate</option>
                </select>
            </div>


            <div class="inp_wrap  rel">
                <select required name="entityType" id="" style="margin-top: 10px;">
                    <option value="" selected disabled hidden>Entity Type</option>
                    <option value="1">Single Entity</option>
                    <option value="2">Group</option>
                </select>
            </div>

            <!-- <div class="radio_block rel">
                <p>Do you have a physical presence</p>  
                 <div class="wrp_in ">
                        <input type="radio" name="physicalPresence" value="1">
                        <label for="radio1">Yes</label>
                    </div> 
                     <div class="wrp_in ">
                        <input type="radio" name="physicalPresence" value="2">
                        <label for="radio2">No</label>
                    </div>
            </div> -->

            <div class="inp_wrap rel">
                <p>If you have a physical Presence, please provide your address</p>  
                <input type="text" name="classAddress" placeholder="Address">
            </div>
            
            <div class="choose_logo">
                <span>Choose a Logo </span>
                <div class="choosez">
                    <input type="file" name="classLogo" required/>
                </div>    
            </div>

            <div class="radio_block rel">
                <p>Choose a default financial plan</p>  
                 <div class="wrp_in ">
                        <input type="radio" name="defaultPlan" id="radio3" value="1" checked="">
                        <label for="radio3">Regular</label>
                    </div> 
                     <div class="wrp_in ">
                        <input type="radio" name="defaultPlan" id="radio4" value="2">
                        <label for="radio4">Paragon</label>
                    </div> 
                     <div class="wrp_in ">
                        <input type="radio" name="defaultPlan" id="radio5" value="3">
                        <label for="radio5">Philantroph</label>
                    </div>     

                    <div class="rd_inst">
                       <a href="#"> Read Instructions</a>
                    </div>             
                </div>
            <div class="clearfix"></div>
        
            <br><br>
            <div class="button_block">
                <button class="btn skip">SUBMIT</button>
            </div>
    </div>
    <input type="hidden" name="classCreationSubmit"/>
    </form>

                      </div><!-- youtube_page -->

            




    </div>

<?php
  require_once('footer.php');
?>