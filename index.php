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

					<div id="join-alert">
						<!-- Errors on joining will be shown here -->
					</div>

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
				        data-target="#join-modal" autofocus>
					JOIN CHAT
				</button>
			</p>
		</div> <!-- /jumbotron -->

		<div class="text-center alert alert-info">
			<h2>Tip</h2>
			<p>Please consider that this web page is using modern web technologies and will not work with old browsers
				especially that crappy ie!</p>
		</div>

	</div><!-- / intro -->

	<!-- Row for chat view -->
	<div id="chat-row" class="hide row">

		<div class="col-sm-3">

			<div class="online-list">
				<ul id="online-list" class="list-group">
					<!-- Online users will be listed here -->
				</ul>
			</div>

		</div>

		<div class="col-sm-9">

			<div id="chat-alert">
				<!-- Errors will be shown here -->
			</div>

			<div class="panel panel-default">

				<div class="panel-heading">

					<div class="row">

						<div class="col-xs-6">
							<h3 class="panel-title"><!-- Number of online users will be shown here --></h3>
						</div>

						<div class="col-xs-6">
							<p class="text-right">
								<!-- Leave button -->
								<button id="leave-button" type="button" class="btn btn-danger btn-sm">
									Leave Chat
								</button>
								<!-- Check state button -->
								<button id="check-state-button" type="button" class="btn btn-default btn-sm"
								        data-toggle="popover" data-placement="bottom">
									Check State
								</button>
							</p>
						</div>

					</div><!-- /row -->

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

					<div class="row">

						<!-- Send button -->
						<div class="col-xs-10">
							<p>
								<button id="send-button" class="btn btn-success btn-block" type="button">Send</button>
							</p>
						</div>

						<!-- Attach image button -->
						<div class="col-xs-2">
							<p>
								<input id="attach-button" type="file" class="btn btn-info btn-block">
							</p>
						</div>

					</div> <!-- /row -->


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
<script src="assets/js/lang.en.js"></script><!-- TODO: Load different languages -->
<script src="assets/js/chocal.js"></script>
</body>
</html>
