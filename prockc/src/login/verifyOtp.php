<?php
	require_once('../header.php');
?>


<body>

<div>

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


</div>


	<div class="container">
		<header>
            <div class="logo"><a href="login.php"><img src="../../resources/images/logo.png" alt=""></a></div>
        </header>
        <div class="box_content allInp">
            <h4>Account Activation</h4>

            

            <p>Please use OTP sent to your mail for activation.</p>
            <form action="otpCheck.php" method="POST">
                <?php if(!isset($_SESSION['otpEmail'])){?>
                <div class="wrp_in">
                    <input type="email" name="email" id="" placeholder="Email" required>
                </div>
                <?php }else{ ?>
                    <input type="hidden" name="email" value="<?php echo $_SESSION['otpEmail']; ?>"/>
                <?php } ?>
                <div class="input_wrap">
                    <input type="text" placeholder="OTP" name="otp" required>
                    <button class="btn">Activate</button>
                    </div>
                </div>
            </form>
        </div>
	</div>
</body>
<?php
	require_once('../footer.php');
?>