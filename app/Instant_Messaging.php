<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php 
//just has sending of message to the database, will make the inbox/ reciever of message by tonight
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<div id="interationResults" style="font-size:15px; padding:10px;"></div>

<div class="interactionContainers" id = "private_message">
<form action="javascript:sendPM();" name="pmForm" method="post">
<font size="+1">Sending Private Message to<strong><em><?php echo "username_of_recievr";?></em></strong></font><br/><br/>
Subject:
<input name="pmSubject" id="pmSubject" type="text" maxlength="64" style="width:98%" value="Enter Subject:"/>
Message:
 <textarea name="pmTextArea" id="pmTextArea" rows="8" style="width:98%">Enter message...</textarea>
<input name="pm_sender_id" id="pm_sender_id" type="hidden" value="<?php echo $_SESSION['id']; ?>"/>
<input name="pm_sender_name" id="pm_sender_name" type="hidden" value="<?php echo $_SESSION['firstname']; ?>"/>	

<input name="pm_rec_id" id="pm_rec_id" type="hidden" value="<?php echo $id; ?>"/>

<input name="pm_rec_name" id="pm_rec_name" type="hidden" value="<?php echo $username; ?>"/>
<input name="pmWipit" id="pmWipit" type="hidden" value="<?php echo $thisRandNum; ?>"/>
<span id="PMStatus" style="color:#F00;"></span>
<br/><input name="pmSubmit" type="submit" value="Send"/> or <a href="#" onclick="return false" onmousedown="javascript:toggleInteractContainers('private_message');">Close</a>
<span id="pmFormProcessGif" style="display:none;"><img src="" width="28" height="10" alt="Loading"/></span>
</form>
</div>

<script language="javascript" type="text/javascript">
$('#pmForm').submit(function(){$('input(type=submit)', this).attr('disabled', 'disabled');});
function sendPM(){
	var pmSubject = $("#pmSubject");
	var pmTextArea = $("#pmTextArea");
	var sendername = $("#pm_sender_name");
	var senderid = $("#pm_sender_id");
	var recName = $("#pm_rec_name");
	var recID = $("#pm_rec_id");
	var pm_wipit = $("#pmWipit");
	var url = "scripts_for_profile/private_msg_parse.php";
	if ( pmSubject.val()==""){
		$("#interactionResults").html('<img src = "" at= "Error" width="31" height="30"/>&nbsp; Please type in your message.').show().fadeOut(6000);
	} else if ( pmTextArea.val()==""){
		$("#interactionResults").html('<img src = "" at= "Error" width="31" height="30"/>&nbsp; Please type in your message.').show().fadeOut(6000);
	} else {
		$("#pmFormProcessGif").show();
		$.post(url, {subject, pmSubject.val(), message: pmTextArea.val(), senderName: sendername.val(), senderID: senderid.val(), rcpntName: recName.val(), rcpntID: recID.val(), thisWipit: pm_wipit.val()}, function(data) {
			$('#private_message').slideUp("fast");
			$("#interactionResults").html(data).show().fadeOut(10000);
			document.pmForm.pmTextArea.value='';
			document.pmForm.pmSubject.value='';
			$("#pmFormProcessGif").hide();
		});
	}

}
<body>
</body>
</html>
