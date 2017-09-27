<?php
	require_once('../header.php');
?>
<body>
	<div class="container">

        <?php
                if(isset($_SESSION['gHelpError'])){
        ?>

                <div class="alert alert-danger" id="autoClose-alert">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>Error: </strong>
                    <?php echo $_SESSION['gHelpError']; ?>
                </div>

        <?php
            unset($_SESSION['gHelpError']);
            }
        ?>



        <header>
            <div class="logo"><a href="login.php"><img src="../../resources/images/logo.png" alt=""></a></div>
        </header>
        <div class="box_content allInp loginInp">
            <h4>Happy to Help You!</h4>

            <?php
                if(isset($_SESSION['gHelpSuccess'])){
            ?>

                    <div class="alert alert-success" id="autoClose-alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>Hurray: </strong>
                        <?php echo $_SESSION['gHelpSuccess']; ?>
                    </div>

            <?php
                unset($_SESSION['gHelpSuccess']);
                }
            ?>


            <form action="helpCheck.php" method="POST">
                <div class="input_wrap">
                    <div class="radio_sec">
                        <div class="wrp_in col-md-3">
                            <input type="radio" name="forgotType" checked="checked" id="radio1" value="userName">
                            <label for="radio1">Forgot UserName</label>
                        </div>
                        <br><br><hr>
                        <div class="wrp_in col-md-3">
                            <input type="radio" name="forgotType" id="radio2" value="password">
                            <label for="radio2">Forgot Password</label>
                        </div>
                    </div>
                    <input type="email" placeholder="Email" name="email" required>
                    <input type="hidden" name="submitted">
                    <button class="btn">Retrieve</button>
                    <!-- <div class="text-center need_help"><a href="#" data-html="true" data-toggle="popover" data-content="<a href='#'>Forget Password</a>, <a href='#'>Security Question</a>, <a href='#'>Forget Username</a> " data-placement="bottom">Need Help?</a>
                    </div> -->
                </div>
            </form>
        </div>
	</div>
</body>
<?php
	require_once('../footer.php');
?>