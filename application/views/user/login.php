<!doctype html>
<html> 
<head>
<title>Login-form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url();?>public/userlogin/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
 <!-- for Google Signin start-->
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
<!-- for Google Signin end-->
<link href="<?php echo base_url();?>public/userlogin/css/style.css" rel="stylesheet">
</head>
 
<body class="wrapper">
<section class="login">
<div class="container">

<div class="row">
<div class="col-md-6 offset-md-3">
<?php 
          if(isset($msg) && !empty($msg)) {
        ?>
          <div class="alert alert-danger">
            <?php echo $msg; ?>
          </div>
        <?php
          }
?>
<?php $this->load->view('common/flashmessage'); ?>
<form class="login-wrapper" method="post" action="<?php echo base_url(); ?>user/login">
  <div class="form-group">
     <label>Email or Phone Number</label>
      <div class="input-container"> 
      <i class="fas fa-user login-icon"></i>
      <input class="input-field" type="text" placeholder="Type Here..." name="username">
    </div>
  </div>
  <div class="form-group">
    <label>Password</label>
   <div class="input-container">
    <i class="fas fa-unlock-alt login-icon"></i>
    <input class="input-field" type="password" placeholder="Type Here..." name="password">
  </div>
  <input type="submit" name="submit" value="Login" class="btn btn-primary">
 <div class="social icon">
  <span></span>
  <!--<button class="loginBtn loginBtn--facebook">
  Login with Facebook
</button>-->

<a href="<?php echo $fbLoginUrl; ?>"><img src="<?php echo base_url(); ?>public/userlogin/img/icon_facebook.png" />Facebook Login</a><br/>
<!--  <button class="loginBtn loginBtn--google">
  Login with Google
</button>-->
</div> 
</form>
</div>
</div>
</div>
</section>

 <script src="<?php echo base_url();?>public/userlogin/js/jquery.min.js"></script>
 
  <script src="<?php echo base_url();?>public/userlogin/js/bootstrap.min.js"></script>
  <script type="text/javascript">if (window.location.hash =='#_=_')window.location.hash = '';</script>
</body>
</html>
