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

	<title><?= $chocal->isJoined() ? "Chocal Chat Web Client" : "Join Chocal Chat" ?></title>

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
<div class="modal fade" id="joinModal" tabindex="-1" role="dialog" aria-labelledby="joinModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="joinModalLabel">Join Chat</h4>
			</div>

			<form role="form" action="index.php" method="post" enctype="multipart/form-data">
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
						<input type="text" name="ip" class="form-control" placeholder="i.e. 192.168.1.2"
						       aria-describedby="schema-addon" required>
						<span class="input-group-addon" id="url-colon-addon">:</span>
						<input type="text" name="port" class="form-control" placeholder="i.e. 36911"
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

	<div class="row">

		<div class="col-md-4">

			<div class="jumbotron">
				<h1>Chocal Chat</h1>
				<p>Use Chocal Chat to communicate with your friends!</p>
				<!-- Button trigger modal -->
				<p class="text-center">
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#joinModal">
						JOIN CHAT
					</button>
				</p>
			</div> <!-- /jumbotron -->

		</div>

		<div class="col-md-8">


			<div class="panel panel-default">

				<div class="panel-heading">
					<h3 class="panel-title">John Doe</h3>
				</div> <!-- / panel-heading -->

				<div class="panel-body">

					<!-- Chat area -->
					<div class="chat-area">

						<div class="media">
							<div class="media-left media-middle">
								<a href="#">
									<img class="media-object img-circle" src="assets/img/no-avatar.png"
									     alt="User avatar">
								</a>
							</div>
							<div class="media-body well">
								<h4 class="media-heading">Media heading</h4>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur autem corporis
								culpa dolorem doloremque, earum ipsa laudantium mollitia nobis non nostrum odio omnis
								placeat, reiciendis repellat suscipit ullam voluptates voluptatibus?
							</div>
						</div>

						<div class="media">
							<div class="media-body well">
								<h4 class="media-heading">Media heading</h4>
								Lorem ipsum
							</div>
							<div class="media-right media-middle">
								<a href="#">
									<img class="media-object img-circle" src="assets/img/no-avatar.png"
									     alt="User avatar">
								</a>
							</div>
						</div>

						<div class="media">
							<div class="media-left media-middle">
								<a href="#">
									<img class="media-object img-circle" src="assets/img/no-avatar.png"
									     alt="User avatar">
								</a>
							</div>
							<div class="media-body well">
								<h4 class="media-heading">Media heading</h4>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur autem corporis
								culpa dolorem doloremque, earum ipsa laudantium mollitia nobis non nostrum odio omnis
								placeat, reiciendis repellat suscipit ullam voluptates voluptatibus?
							</div>
						</div>

						<div class="media">
							<div class="media-left media-middle">
								<a href="#">
									<img class="media-object img-circle" src="assets/img/no-avatar.png"
									     alt="User avatar">
								</a>
							</div>
							<div class="media-body well">
								<h4 class="media-heading">Media heading</h4>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur autem corporis
								culpa dolorem doloremque, earum ipsa laudantium mollitia nobis non nostrum odio omnis
								placeat, reiciendis repellat suscipit ullam voluptates voluptatibus?
							</div>
						</div>

					</div>
					<!-- /Chat area -->

				</div> <!-- /panel-body -->

				<div class="panel-footer">


					<div class="media">
						<div class="media-body">
							<p><textarea id="txtMessage" class="form-control" rows="3"
							             placeholder="Enter your message..."></textarea>
							</p>

						</div>
						<div class="media-right media-middle">
							<img class="media-object img-circle" src="assets/img/no-avatar.png" alt="User avatar">
						</div>
					</div>

					<p>
						<button class="btn btn-success btn-block" type="button">Send</button>
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
	var avatarData = null;

	// This function will bring back any alert related to avatar picker
	function restoreAvatarAlerts() {
		$('#avatar-incompatible-alert').addClass('hide');
		$('#avatar-preview-area').addClass('hide');
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
			};

			reader.readAsBinaryString(file);
			readerPreview.readAsDataURL(file);
		}
	};


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

	});

	/* Web socket */

	function debug(message) {
		$('.chat-area').append(message);
	}

	function sendRegisterMessage() {

		if (websocket != null) {
			var myName = document.getElementById("name").value;
			var msg = JSON.stringify({
				type: "register", name: myName
			});
			websocket.send(msg);
			console.log("string sent :", '"' + msg + '"');
		}
	}

	function sendMessage() {
		var msg = document.getElementById("txtMessage").value;
		if (websocket != null) {
			document.getElementById("txtMessage").value = "";
			var json = {type: "plain", image: "", message: msg, user_key: myUserKey};
			websocket.send(JSON.stringify(json));
			console.log("string sent :", '"' + msg + '"');
		}
	}
	var wsUri = "ws://192.168.1.12:36911";
	var websocket = null;

	function initWebSocket() {
		try {
			if (typeof MozWebSocket == 'function')
				WebSocket = MozWebSocket;
			if (websocket && websocket.readyState == 1)
				websocket.close();
			websocket = new WebSocket(wsUri);
			websocket.onopen = function (evt) {
				debug("CONNECTED");
				sendRegisterMessage();
			};
			websocket.onclose = function (evt) {
				debug("DISCONNECTED");
			};
			websocket.onmessage = function (evt) {
				var message = JSON.parse(evt.data);
				console.log("Message received :", evt.data);
				if (message.type == "accepted") {
					myUserKey = message.user_key;
				}
				debug(message.message);
			};
			websocket.onerror = function (evt) {
				debug('ERROR: ' + evt.data);
			};
		} catch (exception) {
			debug('ERROR: ' + exception);
		}
	}

	function stopWebSocket() {
		if (websocket)
			websocket.close();
	}

	function checkSocket() {
		if (websocket != null) {
			var stateStr;
			switch (websocket.readyState) {
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
					stateStr = "UNKNOW";
					break;
				}
			}
			debug("WebSocket state = " + websocket.readyState + " ( " + stateStr + " )");
		} else {
			debug("WebSocket is null");
		}
	}
</script>
</body>
</html>
