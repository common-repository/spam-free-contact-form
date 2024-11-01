<?php
$msgerror = false;
$message = "";
if($_GET['mailsent'] == 1)
{
  $required = array();
  if(trim($_POST[sfcfname]) == "") { array_push($required,"Name"); }
  if(trim($_POST[sfcfemail]) == "") { array_push($required,"Email"); }
  if(trim($_POST[sfcfsubject]) == "") { array_push($required,"Subject"); }
  if(trim($_POST[sfcfmessage]) == "") { array_push($required,"Message"); }
  if(strlen(trim($_POST[sfcfmessage])) < 25) { $msgerror = true; }
  if(count($required) > 0)
  {
    $j = 0;
    $fields = "";
    for($i = 0;$i < count($required); $i++)
    {
      $j++;
      if(trim($required[$j]) != "") {$fields = $fields.$required[$i].", ";} else {$fields = $fields.$required[$i];}
    }
    $message = '<div class="error_left"></div><div class="error_center">Following fields are missing: '.$fields.'</div><div class="error_right"></div><div class="clear"></div>';
  }
  else if($msgerror == true) {
    $message = '<div class="error_left"></div><div class="error_center">Message too short, try again</div><div class="error_right"></div><div class="clear"></div>';
  }
  else {
    $recipient = get_option('sfcf_email_option');
    $from = $_POST[sfcfname]."[".$_POST[sfcfemail]."]";
    mail($recipient, $_POST[sfcfsubject], $_POST[sfcfmessage], $from);
    $message = '<div class="success_left"></div><div class="success_center">Message sent successfully</div><div class="success_right"></div><div class="clear"></div>';
  }
}
?>
<div id="contact-form">
<form name="contact-form" method="post" action="./?mailsent=1">
<div id="messagebox"><?php echo $message; ?></div>
<label>Name: </label><br />
<input name="sfcfname" id="sfcfname" size="40" value="<?php echo $_POST[sfcfname]; ?>" /><br /><br />
<label>Email: </label><br />
<input name="sfcfemail" id="sfcfemail" size="40" value="<?php echo $_POST[sfcfemail]; ?>" /><br /><br />
<label>Subject: </label><br />
<input name="sfcfsubject" id="sfcfsubject" size="40" value="<?php echo $_POST[sfcfsubject]; ?>" /><br /><br />
<label>Message: </label><br />
<textarea rows="7" cols="35" name="sfcfmessage" id="sfcfmessage"><?php echo $_POST[sfcfmessage]; ?></textarea><br /><br />
<input type="submit" name="sfcfsubmit" id="sfcfsubmit" value=" Send Message " />
</form>
</div>