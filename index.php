<?php
/**
 * Created by PhpStorm.
 * User: jtag
 * Date: 3/13/16
 * Time: 3:22 PM
 */

use chocal\ChocalWeb;

require_once "ChocalWeb.php";

$chocal = new ChocalWeb();
?>
<!DOCTYPE html>
<html lang="<?= $chocal->lang->getLang() ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="Chocal Chat web client">
	<meta name="author" content="Hesam Gholami">
	<!--	TODO: <link rel="icon" href="favicon.ico"> -->

	<title>Join Chocal Chat</title>

	<!-- Bootstrap core CSS -->
	<link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Main styles -->
	<link href="assets/css/main.css" rel="stylesheet">

	<!-- HTML5 shim for IE8 support of HTML5 -->
	<!--[if lt IE 9]>
	<script src="vendor/afarkas/html5shiv/dist/html5shiv.min.js"></script>
	<![endif]-->
</head>

<body>

<!-- Register modal -->
<div class="modal fade" id="join-modal" tabindex="-1" role="dialog" aria-labelledby="join-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="join-modal-label">Join Chat</h4>
			</div>

			<form id="join-form" role="form" action="" method="post" enctype="multipart/form-data">
				<div class="modal-body">

					<p>Easily join Chocal Chat to communicate with your local network friends.</p>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label for="name">Your Name</label>
								<input id="name" type="text" name="name" class="form-control"
								       placeholder="e.g. John, Ali, Alex Doe" required>
							</div>
						</div>

						<p class="help-block">Your name will be shown to others.</p>
					</div>


					<label for="server-ip">Server Address</label>
					<div id="server-ip" class="input-group">
						<span class="input-group-addon" id="schema-addon">ws://</span>
						<input id="ip" type="text" name="ip" class="form-control" placeholder="i.e. 192.168.1.2"
						       aria-describedby="schema-addon" required>
						<span class="input-group-addon" id="url-colon-addon">:</span>
						<input id="port" type="text" name="port" class="form-control" placeholder="i.e. 36911"
						       aria-describedby="url-colon-addon" required>

					</div>
					<p class="help-block">Ask the Chocal Chat admin to give you the IP address and port number of Chocal
						Server.</p>

					<!-- Alert for browsers which don't support HTML5 file APIs -->
					<div id="avatar-incompatible-alert" class="hide alert alert-warning alert-dismissible fade in"
					     role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
								aria-hidden="true">&times;</span></button>
						Sorry!, but your browser don't support new web technologies to upload an avatar picture. If you
						want to have an avatar picture consider using a better web browser.
					</div>

					<!-- Avatar file selector -->
					<div id="avatar-picker-area" class="form-group">
						<label for="avatar">Your Avatar (Maximum file size is 256kb)</label>
						<input id="avatar-picker" type="file" name="avatar">
						<p class="help-block">Optionally you can set an Avatar image for yourself.</p>
					</div>

					<!-- Avatar preview area -->
					<div id="avatar-preview-area" class="hide text-center">
						<p>Your Avatar picture:</p>
						<img id="avatar-preview" class="img-circle" src="assets/img/no-avatar.png" width="60"
						     height="60" alt="User Avatar">
					</div>

					<!-- Avatar invalid image error -->
					<div id="avatar-invalid-image-alert" class="hide alert alert-danger" role="alert">
						<p>Invalid Avatar picture is selected.</p>
					</div>


				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-success">JOIN NOW</button>
				</div>

			</form>

		</div>
	</div>
</div> <!-- /Register modal -->


<div class="container">

	<!-- intro -->
	<div id="intro">

		<div class="jumbotron">
			<h1>Chocal Chat</h1>
			<p>Use Chocal Chat to communicate with your friends!</p>

			<p class="text-center">
				<!-- Join button -->
				<button id="join-button" type="button" class="btn btn-primary btn-lg" data-toggle="modal"
				        data-target="#join-modal">
					JOIN CHAT
				</button>
			</p>
		</div> <!-- /jumbotron -->

	</div><!-- / intro -->

	<!-- Row for chat view -->
	<div id="chat-row" class="hide row">

		<div class="col-md-4">

			<div class="jumbotron">
				<h1>Chocal Chat</h1>
				<p>Use Chocal Chat to communicate with your friends!</p>

				<p class="text-center">
					<!-- Leave button -->
					<button id="leave-button" type="button" class="btn btn-danger btn-lg">
						Leave Chat
					</button>
				</p>
			</div> <!-- /jumbotron -->

		</div>

		<div class="col-md-8">


			<div class="panel panel-default">

				<div class="panel-heading">
					<h3 class="panel-title"><!-- User name will be appear here --></h3>
				</div> <!-- / panel-heading -->

				<div class="panel-body">

					<!-- Chat area -->
					<div class="chat-area">

						<!-- Chat messages will be appear here -->

					</div>
					<!-- /Chat area -->

				</div> <!-- /panel-body -->

				<div class="panel-footer">


					<div class="media">
						<div class="media-body">
							<p><textarea id="txt-message" class="form-control" rows="3"
							             placeholder="Enter your message..."></textarea>
							</p>

						</div>
						<div class="media-right media-middle">
							<img id="send-avatar-image" class="media-object img-circle" src="assets/img/no-avatar.png"
							     alt="User avatar" width="60" height="60">
						</div>
					</div>

					<p>
						<button id="send-button" class="btn btn-success btn-block" type="button">Send</button>
					</p>

				</div> <!-- panel-footer -->

			</div> <!-- /panel -->


		</div>

	</div> <!-- /row -->


</div> <!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="vendor/components/jquery/jquery.min.js"></script>
<!-- Bootstrap js components -->
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Chocal scripts -->
<script type="text/javascript">

	var myUserKey = null;
	var myName = null;
	var myAvatar = null;
	var avatarData = null;
	var webSocket = null;
	var $chatArea = $('.chat-area');

	// This function will bring back any alert related to avatar picker
	function restoreAvatarAlerts() {
		$('#avatar-incompatible-alert').addClass('hide');
		$('#avatar-preview-area').addClass('hide');
		$('#avatar-preview').attr('src', 'assets/img/no-avatar.png');
		$('#avatar-invalid-image-alert').addClass('hide');

		$('#avatar-picker').removeAttr('disabled');
	}

	// This function will handle choosing of an Avatar picture when joining chat
	var handleAvatarFileSelect = function (evt) {
		var files = evt.target.files;
		var file = files[0];
		restoreAvatarAlerts();

		if (files && file) {

			// Check file size
			if (file.size > 262144 /* Equals to 256 kb */) {
				// File size is invalid
				$('#avatar-invalid-image-alert').removeClass('hide');
				return;
			}

			// Check file type
			var fileType = file.type;
			var match = ["image/jpeg", "image/png", "image/jpg"];
			if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))) {
				// File type is invalid
				$('#avatar-invalid-image-alert').removeClass('hide');
				return;
			}

			var reader = new FileReader();
			var readerPreview = new FileReader();

			reader.onload = function (readerEvt) {
				// Convert binary string Base64 encoded data to ASCII string
				var binaryString = readerEvt.target.result;
				avatarData = btoa(binaryString);
			};

			readerPreview.onload = function (readerEvt) {
				// Show preview
				$('#avatar-preview-area').removeClass('hide');
				$('#avatar-preview').attr('src', readerEvt.target.result);
				myAvatar = readerEvt.target.result;
			};

			reader.readAsBinaryString(file);
			readerPreview.readAsDataURL(file);
		}
	};

	var joinChat = function (evt) {
		evt.preventDefault();
		// Get form data
		var data = $("#join-form").find(":input").serializeArray();
		myName = data[0].value;
		var ip = data[1].value;
		var port = data[2].value;

		// Try to connect to web socket
		initWebSocket(ip, port);
	};

	// This function will called when user pressed the leave button
	var leaveChat = function () {
		// Kinda reset anything

		// Close web socket
		webSocket.close();
		// Refresh browser to reset everything back
		location.reload();
	};

	// Will send a plain text message to Chocal Server
	function sendTextMessage() {
		if (webSocket != null) {
			// Get text area
			var $textArea = $('#txt-message');
			// Get value of text area
			var text = $textArea.val();
			// Clear text area
			$textArea.val("");
			// Generate json object
			var json = {type: "plain", image: "", message: text, user_key: myUserKey};
			// Send message
			webSocket.send(JSON.stringify(json));
			// Return focus back to text area
			$textArea.focus();
			// Log data
			console.log("Data sent:", JSON.stringify(json));
		}
	}

	// General function to send messages
	function send() {
		// TODO : Decide to send plain text message or an image message

		// Plain text message
		sendTextMessage();
	}

	// Page load up function
	$(function () {

		// Set Avatar picker event handler
		if (window.File && window.FileReader && window.FileList && window.Blob) {
			document.getElementById('avatar-picker').addEventListener('change', handleAvatarFileSelect, false);
		} else {
			// The File APIs are not fully supported in this browser
			$('#avatar-incompatible-alert').removeClass('hide');
			$('#avatar-picker').attr('disabled', true);
		}

		// Set join form submit button event listener
		$("#join-form").on('submit', joinChat);

		// Set leave chat button event listener
		$("#leave-button").on('click', leaveChat);

		// Set send button event listener
		$("#send-button").on('click', send);

	});

	function goToLast() {
		// Scroll down
		$chatArea.animate({
			scrollTop: $chatArea[0].scrollHeight
		}, 1000);
	}

	// This function will run when server sent back request acceptation message
	function accepted(message) {
		// Set user key
		myUserKey = message.user_key;

		// Close join dialog and initialize messaging

		// Close join dialog
		$('#join-modal').modal('hide');
		// Hide join chat button and show leave button
		$('#intro').addClass('hide');
		$('#chat-row').removeClass('hide');
		// Show user name on top of panel
		$('.panel-title').html(myName);
		// Set avatar picture
		if (myAvatar == null) {
			$('#send-avatar-image').attr('src', "assets/img/no-avatar.png");
		} else {
			$('#send-avatar-image').attr('src', myAvatar);
		}
		// Change page title
		document.title = 'Chocal Chat Web Client';
	}


	// This function will called right after web socket connection
	function sendRegisterMessage(userName, avatarData) {
		if (webSocket != null) {
			var msg = JSON.stringify({
				type: "register", name: userName, image: avatarData
			});
			webSocket.send(msg);
			console.log('Register request sent:', msg);
		}
	}

	// This function will show a standard Chocal plain message type in chat area
	function appendTextMessage(json) {
		var html = null;
		var avatar = null;


		if (json.name == myName) {

			// Sender is this user himself
			avatar = myAvatar == null ? "assets/img/no-avatar.png" : myAvatar;

			html = "<div class=\"media\"><div class=\"media-body well mine\">\n<h4 class=\"media-heading media-name\">" + "You" + "</h4>\n" + json.message + "\n</div>\n<div class=\"media-right media-middle\">\n<img class=\"media-object img-circle\" src=\"" + avatar + "\" alt=\"User Avatar\" width=\"60\" height=\"60\">\n</div>\n</div>";

		} else {

			// Sender is another user
			avatar = "assets/img/no-avatar.png";// TODO : Get avatar path from php side

			html = "<div class=\"media\">\n<div class=\"media-left media-middle\">\n<img class=\"media-object img-circle\" src=\"" + avatar + "\" alt=\"User Avatar\" width=\"60\" height=\"60\">\n</div>\n<div class=\"media-body well\">\n<h4 class=\"media-heading media-name\">" + json.name + "</h4>\n" + json.message + "\n</div>\n</div>";

		}

		// Animate content
		$(html).hide().appendTo($chatArea).slideDown();

		// Scroll down
		goToLast();

	}

	// This function will show a Chocal Chat info message in chat view
	function appendInfoMessage(json) {
		var html = "<div class=\"alert alert-info text-center info-message\">" + json.message + "</div>";
		$(html).hide().appendTo($chatArea).slideDown();
		// Scroll down
		goToLast();
	}

	// This function will be called at join operation
	function initWebSocket(ip, port) {
		try {
			if (typeof MozWebSocket == 'function')
				WebSocket = MozWebSocket;
			if (webSocket && webSocket.readyState == 1)
				webSocket.close();
			var wsUri = "ws://" + ip + ":" + port;
			webSocket = new WebSocket(wsUri);
			webSocket.onopen = function (evt) {
				console.info("Connected to web socket.");
				// After connection we should send register request message
				sendRegisterMessage(myName, avatarData);
			};
			webSocket.onclose = function (evt) {
				console.error("Web socket disconnected.");
			};
			webSocket.onmessage = function (evt) {
				var message = JSON.parse(evt.data);
				console.log("Message received:", message);

				// Normal text message
				if (message.type == "plain") {
					appendTextMessage(message);
				}

				// Info message
				if (message.type == "info") {
					appendInfoMessage(message);
				}

				// Handle acceptation message
				if (message.type == "accepted") {
					accepted(message);
				}

			};
			webSocket.onerror = function (evt) {
				console.error("Web socket error:", evt.data);
			};
		} catch (exception) {
			console.error('Error:', exception);
		}
	}

	function stopWebSocket() {
		if (webSocket)
			webSocket.close();
	}

	function checkSocket() {
		if (webSocket != null) {
			var stateStr;
			switch (webSocket.readyState) {
				case 0:
				{
					stateStr = "CONNECTING";
					break;
				}
				case 1:
				{
					stateStr = "OPEN";
					break;
				}
				case 2:
				{
					stateStr = "CLOSING";
					break;
				}
				case 3:
				{
					stateStr = "CLOSED";
					break;
				}
				default:
				{
					stateStr = "UNKNOWN";
					break;
				}
			}
			console.log("WebSocket state :", webSocket.readyState, "( " + stateStr + " )");
		} else {
			console.warn("WebSocket is null");
		}
	}
</script>
</body>
</html>
