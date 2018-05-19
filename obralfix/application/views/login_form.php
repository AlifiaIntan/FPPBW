<html>
<?php
if (isset($this->session->userdata['logged_in'])) {

header("location: http://localhost/login/index.php/user_authentication/user_login_process");
}
?>
<head>


  <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('../assets/images/bg/header1.png');">
		<h2 class="ltext-105 cl0 txt-left">
		Login
		</h2>
	</section>


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body>
<?php
if (isset($logout_message)) {
echo "<div class='message'>";
echo $logout_message;
echo "</div>";
}
?>
<?php
if (isset($message_display)) {
echo "<div class='message'>";
echo $message_display;
echo "</div>";
}
?>
<div id="main">
<div id="login">
<hr/>
<?php echo form_open('user_authentication/user_login_process'); ?>


<div class="container">
  <div class="d-flex justify-content-center">
    <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
      <form>
        <h4 class="mtext-105 cl2 txt-center p-b-30">
          Please Login
        </h4>

        <?php if (isset($message)) { ?>
            <CENTER><h3 style="color:green;">Data inserted successfully</h3></CENTER><br>
      <?php } ?>

        <div class="bor8 m-b-20 how-pos4-parent">
          <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="username" placeholder="Username" required="required">
        </div>

        <div class="bor8 m-b-20 how-pos4-parent">
          <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="password" placeholder="Password" required="required">
        </div>

        <?php
        echo "<div class='error_msg'>";
        if (isset($error_message)) {
        echo $error_message;
        }
        echo validation_errors();
        echo "</div>";
        ?>

        <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
          Submit
        </button>

      </form>
    <a href ="<?= base_url('Home/Register') ?>">Register  </a>
<br>

    </div>

</div>

</div>
</div>
</body>
</html>
