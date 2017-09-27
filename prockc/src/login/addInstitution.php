<?php
	require_once('../header.php');

    if(!isset($_SESSION['email'])){
        header('Location: login.php');
    }

    $profilePic = "../../resources/images/user_default_logo.png";

    // Try to check if this User has profile Pic
    $getProfilePicQuery = "select * from userProfile where email='" . $_SESSION['email'] . "';";
    $result = mysql_query ($getProfilePicQuery) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
        while($row = mysql_fetch_array($result, MYSQL_NUM)){
            $profilePic = "../../resources/uploads/" . $_SESSION['email'] . "/" . $row[1];
        }
    }

    // Try to check if this User has profile Pic
    $instQuery = "select * from userInstitutions where email='" . $_SESSION['email'] . "';";
    $result = mysql_query ($instQuery) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
        header('Location: prockcHome.php');
    }

?>
<body>
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
        <img src="../../resources/images/school.png" id="frnd_img" alt="">
    </div>
    <div class="left_text">
        <h4>Welocme 
            <span>to The World of</span>
            PROckc
        </h4>
    </div>

    <div class="box_content allInp    selecW">
        <h4>Institutional Information.</h4>
        <form action="prockcHome.php" method="POST">
            <div class="choose_file">
                <img src="../../resources/images/ss.png" alt="" style="
                    width: 190px;
                    margin-right: 0;">
                <div class="choose-inner">
                    <div class="wrp_in col-md-6">
                        <input type="radio" name="institutionalPresence" id="radio1" value="yes">
                        <label for="radio1">Yes</label>
                    </div>
                    <div class="wrp_in col-md-6">
                        <input type="radio" checked="checked" name="institutionalPresence" id="radio2" value="no">
                        <label for="radio2">No</label>
                    </div>
                </div>
            </div>

            <select name="" id="">
                <option value="">City</option>
            </select>
            <select name="" id="">
                <option value="">State</option>
            </select>
            <select name="" id="">
                <option value="">Pin</option>
            </select>
            <select name="" id="">
                <option value="">Country</option>
            </select>
            <select name="" id="">
                <option value="">Approx No. Of Student</option>
            </select>
            <div class="button_block">
                <button class="btn">Submit</button>
                </form>
                <?php echo "<button class=\"btn skip\" onclick=\"window.location='" . 
                "prockcHome.php';\">Skip</button>"; ?>
            </div>
            
    </div>


    </div>

</body>
<?php
	require_once('../footer.php');
?>