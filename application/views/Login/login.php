<link href="<?= base_url("assets/style/main.css"); ?>" rel="stylesheet" type="text/css" />
    
    

    <div class="row">
        <div id="back">
                <div class="backRight"></div>
                <div class="backLeft"></div>
        </div>
		  
        <div id="slideBox">
            <div class="topLayer">
                <div class="left">
                <div class="content">
                    <h2>Sign Up</h2>
                    <!-- <form method="post" onsubmit="return false;"> -->
                    <?= form_open('Login/create_account_post',['class'=>'']);?>
                    <div class="form-group">
                        <input type="text" name="username" value="" class="form-control" placeholder="username" /> 
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control" value="" placeholder="*************" />
                    </div>
                    <button type="submit" class="btn-submit">Sign up</button>
                    <!-- </form> -->
                    <?= form_close()?>
                    <button id="goLeft" class="off btn-signup" >Login</button>
                    
                    
                </div>
                </div>
                <div class="right">
                <div class="content">
                    <h2>Login</h2>
                    <!-- <form method="post" onsubmit="return false;"> -->
                    <?= form_open('Login/login_post', ['class'=>'']);?>
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" value="" placeholder="username" required autofocus />
                    </div>
                    <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" value="" placeholder="password" required />
                    </div>

                    
                    <button id="login" type="submit" class="btn-submit" >Login</button>
                    

                    <?= form_close()?>
                     <a href="<?= base_url('index.php/Login/forgot_password');?>" class="" ><span class="forgot_p">Forgot Password</span></a>
                    
                    <button id="goRight" class="off btn-signup" >Sign Up</button>


                    
                    
                    <!-- </form> -->
                </div>
                </div>
            </div>
        </div>




    </div>

<script>
    $(document).ready(function(){
  $('#goRight').on('click', function(){
    $('#slideBox').animate({
      'marginLeft' : '0'
    });
    $('.topLayer').animate({
      'marginLeft' : '100%'
    });
  });
  $('#goLeft').on('click', function(){
    $('#slideBox').animate({
      'marginLeft' : '50%'
    });
    $('.topLayer').animate({
      'marginLeft': '0'
    });
  });
});
</script>
<script src="<?= base_url("assets/scripts/jquery.min.js?va="); ?>" type="text/javascript"></script>













    
