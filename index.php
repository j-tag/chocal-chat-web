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

			<form>
				<div class="modal-body">

					<p>Easily join Chocal Chat to communicate with your local network friends.</p>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label for="name">Your Name</label>
								<input type="text" class="form-control" id="name"
								       placeholder="e.g. John, Ali, Alex Doe">
							</div>
						</div>

						<p class="help-block">Your name will be shown to others.</p>
					</div>


					<label for="server-ip">Server Address</label>
					<div id="server-ip" class="input-group">
						<span class="input-group-addon" id="schema-addon">ws://</span>
						<input type="text" class="form-control" placeholder="i.e. 192.168.1.2"
						       aria-describedby="schema-addon">
						<span class="input-group-addon" id="url-colon-addon">:</span>
						<input type="text" class="form-control" placeholder="i.e. 36911"
						       aria-describedby="url-colon-addon">

					</div>
					<p class="help-block">Ask the Chocal Chat admin to give you the IP address and port number of Chocal
						Server.</p>


					<div class="form-group">
						<label for="avatar">Your Avatar</label>
						<input type="file" id="avatar">
						<p class="help-block">Optionally you can set an Avatar image for yourself.</p>
					</div>


				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<input type="submit" value="JOIN NOW" class="btn btn-success">
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
							<p><textarea class="form-control" rows="3" placeholder="Enter your message..."></textarea>
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
</body>
</html>
