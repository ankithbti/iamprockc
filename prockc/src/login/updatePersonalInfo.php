<?php
	require_once('../header.php');
    unset($_SESSION['otpEmail']);

    if(!isset($_SESSION['email'])){
        header('Location: login.php');
    }

    $profilePic = '';
    // Try to check if this User has profile Pic
    $getProfilePicQuery = "select * from userProfile where email='" . $_SESSION['email'] . "';";
    $result = mysql_query ($getProfilePicQuery) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
        while($row = mysql_fetch_array($result, MYSQL_NUM)){
            $profilePic = "../../resources/uploads/" . $_SESSION['email'] . "/" . $row[1];
        }
    }

    if(strlen($profilePic) > 0){
        // No Need
        header('Location: addInstitution.php');
    }
?>
<body>

<div>

    <?php
        if(isset($_SESSION['gRegisterSuccess'])){
    ?>

    <div class="alert alert-success" id="autoClose-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Hurray: </strong>
        <?php echo $_SESSION['gRegisterSuccess']; ?>
    </div>

    <?php
        unset($_SESSION['gRegisterSuccess']);
        }
    ?>


</div>


    <header class="inner_header">
        <div class="logo2"><img src="../../resources/images/logo.png" alt=""></div>

        <button>
        <?php
            if(strlen($profilePic) > 0){
                echo "<img alt=\"\" src=\"" . $profilePic . "\"/>";
            }else{
                echo "<img src=\"../../resources/images/userc.png\" alt=\"\">";
            }
        ?>
        Welcome <?php echo $_SESSION['email']; ?></button>
    </header>

    <div class="right_img">
        <!-- <img src="../../resources/images/men.png" alt=""> -->
    </div>
    <div class="left_text">
        <h4>Welocme 
            <span>to The World of</span>
            PROckc
        </h4>
    </div>
    <div class="box_content allInp loginInp">
        <h4>Personal Information</h4>
        <form action="savePersonalInfo.php" method="POST" enctype="multipart/form-data">
            <div class="input_wrap">
                <div class="choose_file">
                    <?php
                        if(strlen($profilePic) > 0){
                            echo "<img id=\"upImg\" alt=\"\" src=\"" . $profilePic . "\"/>";
                        }else{
                            echo "<img src=\"../../resources/images/placholder.png\" id=\"upImg\" alt=\"\"/>";
                        }
                    ?>
                    
                    <div class="choose-inner">
                        <input type="file" name="profilePicFile" id="choose_f" required>
                        <!-- <input type="file" name="file"> -->
                        <div class="div_choose"><span>Choose File</span> <img src="../../resources/images/upload.png" alt=""></div>
                    </div>
                </div>
                <!-- <input type="date" placeholder="Date Of Birth" id="dob" name="dob"> -->
                <input name ="dob" placeholder="Date of Birth" class="textbox-n" type="text" onfocus="(this.type='date')" id="dob" required>
                <input type="text" name="educationQualification" placeholder="Educational Qualification" id="educ" required>
                <div class="radio_sec">
                    <div class="wrp_in pull-left">
                        You are
                    </div>
                    <div class="wrp_in col-md-3">
                        <input type="radio" name="userType" checked="checked" id="radio1" value="student">
                        <label for="radio1">Student</label>
                    </div>
                    <div class="wrp_in col-md-3">
                        <input type="radio" name="userType" id="radio2" value="teacher">
                        <label for="radio2">Teacher</label>
                    </div>
                    <div class="wrp_in col-md-2">
                        <input type="radio" name="userType" id="radio3" value="both">
                        <label for="radio3">Both</label>
                    </div>
                </div>
                <!-- <select name="" id="" class="mb20">
                    <option value="">Add Topic of Interest</option>
                </select>
                <textarea name="" id="" placeholder="Add Topic of Interest"></textarea> -->
                <div class="radio_sec">
                    <div class="wrp_in pull-left">
                        Gender
                    </div>
                    <div class="wrp_in col-md-3">
                        <input type="radio" name="gender" checked="checked" id="radio4" value="male">
                        <label for="radio4">Male</label>
                    </div>
                    <div class="wrp_in col-md-3">
                        <input type="radio" name="gender" id="radio5" value="female">
                        <label for="radio5">Female</label>
                    </div>
                    <div class="wrp_in col-md-2">
                        <input type="radio" name="gender" id="radio6" value="other">
                        <label for="radio6">Other</label>
                    </div>
                </div>
                <div class="button_block">
                    <button class="btn">Submit</button>
                    </form>
                    <?php echo "<button class=\"btn skip\" onclick=\"window.location='" . 
                "addInstitution.php';\">Skip</button>"; ?>
                </div>
            </div>
    </div>
</body>
<?php
	require_once('../footer.php');
?>