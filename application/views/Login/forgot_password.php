
<link href="<?= base_url("assets/style/style.css"); ?>" rel="stylesheet" type="text/css" />
    
   
<div class="container-reset">
  <div class="login">
  	<h1 class="login-heading">
      <strong>Password.</strong> Reset.</h1>
      <?= form_open('Login/forgot_password',['class'=>'form-horizontal']);?>
        <input type="text" name="username" placeholder="Username" required="required" class="input-txt" />
         
          <div class="login-footer">
             
            <button type="submit" class="btn btn--right btn-info">Submit  </button>
    
          </div>
          <?= form_close()?>
      <p> <a class="btn btn-sm btn-warning" href='<?= base_url('index.php/Login/login'); ?>'>Login</a> | <a class="btn btn-sm btn-primary" href='<?= base_url('index.php/Login/login'); ?>' >Create Account</a></p>
        <p> </p>
  </div>
</div>

