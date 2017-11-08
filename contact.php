
<?php 
if (array_key_exists('submit', $_POST)) {
$to = 'sfs.womenandchildren@yahoo.com';	
$subject = 'A SYNDICATE IN SUPPORTING WOMEN AND CHILDREN INITIATIVE';

// list expected fields
$expected = array('name','email' ,'comments');
// set required fields
$required = array('name', 'email','comments');
// create empty array for any missing fields
$missing = array();

// assume that there is nothing suspect
$suspect = false;
// create a pattern to locate suspect phrases
$pattern = '/Content-Type:|Bcc:|Cc:/i';

// function to check for suspect phrases
function isSuspect($val, $pattern, &$suspect) {
// if the variable is an array, loop through each element
// and pass it recursively back to the same function
if (is_array($val)) {
foreach ($val as $item) {
isSuspect($item, $pattern, $suspect);
}
}
else {
// if one of the suspect phrases is found, set Boolean to true
if (preg_match($pattern, $val)) {
$suspect = true;
}
}
}
// check the $_POST array and any subarrays for suspect content
isSuspect($_POST, $pattern, $suspect);

if ($suspect) {
$mailSent = false;
unset($missing);
}
else {

//User Input
foreach ($_POST as $key => $value) {
// assign to temporary variable and strip whitespace if not an array
$temp = is_array($value) ? $value : trim($value);
// if empty and required, add to $missing array
if (empty($temp) && in_array($key, $required)) {
array_push($missing, $key);
}
// otherwise, assign to a variable of the same name as $key
elseif (in_array($key, $expected)) {
${$key} = $temp;
}
}
}

// validate the email address
if (!empty($email)) {
// regex to ensure no illegal characters in email address
$checkEmail = '/^[^@]+@[^\s\r\n\'";,@%]+$/';
// reject the email address if it doesn't match
if (!preg_match($checkEmail, $email)) {
array_push($missing, 'email');
}
}


//build message
// go ahead only if all required fields OK
if (!$suspect && empty($missing)) {
// build the message
$message = "Name: $name\n\n";
$message .= "Email: $email\n\n";
$message .= "Comments: $comments";
// limit line length to 70 characters
$message = wordwrap($message, 70);



// send it
$mailSent = mail($to, $subject, $message);
if ($mailSent) {
// $missing is no longer needed if the email is sent, so unset it
unset($missing);
}
}

}
?>

<?php include('header.inc'); ?>
		</div>
		<div class="banner-top">
			<div class="header-bottom">
			  <div class="header_bottom_right_images">
			    <?php
if ($_POST && isset($missing)) {
?>
  <p class="warning">Please complete the missing item(s) indicated.</p>
<?php
}
elseif ($_POST && !$mailSent) {
?>
<p class="warning">Sorry, there was a problem sending your message.
Please try later.</p>
<?php
}
elseif ($_POST && $mailSent) {
?>
<p><strong>Your message has been sent. Thank you for Contacting Us.
</strong></p>
<?php } ?>                   
                 <div class="box_wrapper">
                                 
			<h1>E-mail address:<span style="text-transform:lowercase">sfs.womenandchildren@yahoo.com </span></a></h1>
                                
				</div>
              <div class="box_wrapper">
                                 
							  	  <h1>Phone Number: +2348065867049</h1>
                                
				</div>   
			    <div class="content-wrapper">		  
					   <div class="content-top">
						  	 <div class="box_wrapper">
						  	   <div class="contact-form">
                                   
						  	     <h3>Contact Us</h3>
					    <form method="post">
					    	<div>
						    	<span><label>NAME<?php
                                 if (isset($missing) && in_array('name', $missing)) { ?>
                                 <span class="warning">Please enter your Name</span><?php } ?> </label></span>
						    	<span><input name="userName" type="text" class="textbox" placeholder="Name"<?php if (isset($missing)) {
                                   echo 'value="'.htmlentities($_POST['name']).'"';
                                } ?> /></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL<?php
                                 if (isset($missing) && in_array('email', $missing)) { ?>
                                 <span class="warning">Please enter your Email</span><?php } ?></label></span>
						    	<span><input name="userEmail" type="text" class="textbox" placeholder="E-mail"<?php if (isset($missing)) {
                                   echo 'value="'.htmlentities($_POST['email']).'"';
                                } ?> /></span>
						    </div>
						    
						    <div>
						    	<span><label>COMMENTS<?php
if (isset($missing) && in_array('comments', $missing)) { ?>
<span class="warning">Please enter your Comment</span><?php } ?></label></span>
						    	<span><textarea name="userMsg" placeholder="Your Comments"><?php if (isset($missing)) { echo htmlentities($_POST['comments']);
} ?> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" value="SUBMIT"></span>
						  </div>
					    </form>
				  </div>

                
                <div class="clear">
                
                </div>
                
                
						 </div>
					 </div>
	  			   </div>
		</div>
		<?php include('nav.inc'); ?>
		<div class="clear"></div>
		<?php include('footer.inc'); ?>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>

    	
    	
            