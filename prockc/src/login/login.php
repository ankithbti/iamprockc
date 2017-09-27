<?php
	require_once('../header.php');
    unset($_SESSION['otpEmail']);

    if(isset($_SESSION['userName'])){
        // Already Logged In
        header('Location: prockcHome.php');
    }

?>
<body>
	<div class="container">

        <?php
                if(isset($_SESSION['gRegisterError'])){
        ?>

                <div class="alert alert-danger" id="autoClose-alert">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>Error: </strong>
                    <?php echo $_SESSION['gRegisterError']; ?>
                </div>

        <?php
            unset($_SESSION['gRegisterError']);
            }
        ?>


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

		<header>
            <div class="logo"><a href="login.php"><img src="../../resources/images/logo.png" alt=""></a></div>
            <button class="join">Join</button>
            <div class="join_popup allInp">
                <form action="registerCheck.php" method="POST">
                    <div class="wrp_in">
                        <input type="text" placeholder="First Name" name="fName" id="" required>
                    </div>
                    <div class="wrp_in">
                        <input type="text" placeholder="Middle Name" name="mName" id="">
                    </div>
                    <div class="wrp_in">
                        <input type="text" placeholder="Last Name" name="lName" id="">
                    </div>
                    <div class="wrp_in">
                        <select name="" id="" class="pull-right">
                            <option value="">Country</option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="wrp_in">
                        <input type="text" name="userName" id="" placeholder="Username" required>
                    </div>
                    <div class="wrp_in">
                        <input type="password" name="password" id="password" onchange="validatePassword();" placeholder="Password" required>
                    </div>
                    <div class="wrp_in">
                        <input type="password" name="confirmPassword" id="confirm_password" onkeyup="validatePassword();" placeholder="Confirm Password" required>
                    </div>
                    <div class="wrp_in">
                        <input type="email" name="email" id="" placeholder="Email" required>
                    </div>
                    <div class="wrp_in w100 number">
                        <div class="number_val"><span>
                    <select name="" id="number_selc">
                    <option value="">+91</option>	
                    </select>
                    </span></div>
                        <input type="text" name="mobileNumber" id="" placeholder="Mobile" required>
                    </div>
                    <br>
                    <!-- <div class="wrp_in">
                        <input type="radio" name="rd" checked="" id="radio1" placeholder="Email">
                        <label for="radio1">SMS OTP</label>
                    </div>

                    <div class="wrp_in">
                        <input type="radio" name="rd" id="radio2" placeholder="Email">
                        <label for="radio2">Call OTP</label>
                    </div>

                    <div class="wrp_in w100">
                        <input type="text" name="" id="" placeholder="Enter OTP">
                    </div> -->
					<button type="submit" class="btn">SIGNUP</button>
                </form>
            </div>
        </header>
        <div class="box_content allInp loginInp">
            <h4>Sign In</h4>

            <div>

            <?php
                    if(isset($_SESSION['gError'])){
            ?>
    
                    <div class="alert alert-danger" id="autoClose-alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>Error: </strong>
                        <?php echo $_SESSION['gError']; ?>
                    </div>

            <?php
                unset($_SESSION['gError']);
                }
            ?>



            </div>

            <form action="loginCheck.php" method="POST">
                <div class="input_wrap">
                    <input type="text" placeholder="Username" name="userName" required>
                    <input type="password" placeholder="Password" name="password" required>
                    <button class="btn">Login</button>
                    <!-- <div class="text-center need_help"><a href="needHelp.php" data-html="true" data-toggle="popover" data-content="<a href='#'>Forget Password</a>, <a href='#'>Security Question</a>, <a href='#'>Forget Username</a> " data-placement="bottom">Need Help?</a>
                    </div> -->
                    <div class="text-center need_help"><a href="needHelp.php">Need Help?</a>
                    </div>
                </div>
            </form>
        </div>
	</div>
</body>
<?php
	require_once('../footer.php');
?>