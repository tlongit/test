<?php
$contact->addContact();
?>
<div class="mainContent" style="height: 460px">
  <ul class="breadcrumbs">
    <li><a href="#">Home</a></li>
    <li>Contacts</li>
  </ul>
  <div class="clear"></div>
  <div class="half sidebar">
    <h1></h1>
    <div id="contactForm">
        <?php
        if($_SESSION['success']!=''){
            echo '<h3>'.$_SESSION['success'].'</h3>';
            unset ($_SESSION['success']);
        }
        ?>
      <h5>Send me a message</h5>
      <form method="post" onsubmit="return validate(this)" action="" class="form" id="form" name="form">
        <label for="name" style="left: 5px;">Full Name</label>
        <input type="text" id="name" name="name">
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
        <label for="message">Message</label>
        <textarea id="message" name="message" rows="8" cols="1"></textarea>
        <label for="name" style="left: 5px;">Security code:</label>
        <img src="<?php echo DOMAIN."captcha/verify.php"; ?>" alt="security" style="padding: 0;"/>
        <input type="text" id="captcha" name="captcha" style="width: 80px;">
        <input type="submit" class="submit" value="Submit">
      </form>
      
    </div>

    
  </div>
  <div class="half last">
    <h5 class="clear">Contact information</h5>
    <p>Sinh Quan</p>
    <p>Nekto Studio<br>
      1800 Somewhere Parkway<br>
      Internet View, CA 93624<br>
    </p>
    <p><a href="mailto:office@decart-design.com">office@decart-design.com</a></p>
  </div>
  <div class="clearfix"></div>
  

</div>