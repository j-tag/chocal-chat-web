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
	<link rel="shortcut icon" href="assets/img/favicon.ico">
	<!-- Coloring browser header -->
	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#5e287c">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#5e287c">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#5e287c">

	<title><?= $chocal->lang->getTranslate('JOIN_CHOCAL_CHAT') ?></title>

	<!-- Bootstrap core CSS -->
	<link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<?php
	# Include Bootstrap RTL if language is RTL
	if ($chocal->lang->isRtl()) :?>
		<!-- RTL version of Bootstrap -->
		<link href="assets/css/bootstrap-rtl.min.css" rel="stylesheet">
	<?php endif; ?>

	<!-- Main styles -->
	<link href="assets/css/main.css" rel="stylesheet">

	<?php
	# Include main RTL style if language is RTL
	if ($chocal->lang->isRtl()) :?>
		<!-- RTL version of main styles -->
		<link href="assets/css/main-rtl.css" rel="stylesheet">
	<?php endif; ?>

</head>

<body>

<!-- Register modal -->
<div class="modal fade" id="join-modal" tabindex="-1" role="dialog" aria-labelledby="join-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="join-modal-label"><?= $chocal->lang->getTranslate('JOIN_CHAT') ?></h4>
			</div>

			<form id="join-form" role="form" action="" method="post" enctype="multipart/form-data">
				<div class="modal-body">

					<div id="join-alert">
						<!-- Errors on joining will be shown here -->
					</div>

					<p><?= $chocal->lang->getTranslate('EASILY_JOIN_CHOCAL_CHAT_TO_COMMUNICATE') ?></p>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label for="name"><?= $chocal->lang->getTranslate('YOUR_NAME') ?></label>
								<input id="name" type="text" name="name" class="form-control"
								       placeholder="<?= $chocal->lang->getTranslate('EG_JOHN_ALI_ALEX') ?>" required>
							</div>
						</div>

						<p class="help-block"><?= $chocal->lang->getTranslate('YOUR_NAME_SHOWN_OTHERS') ?></p>
					</div>


					<label for="server-ip"><?= $chocal->lang->getTranslate('SERVER_ADDRESS') ?></label>
					<div id="server-ip" class="input-group">
						<span class="input-group-addon" id="schema-addon">ws://</span>
						<input id="ip" type="text" name="ip" class="form-control"
						       placeholder="<?= $chocal->lang->getTranslate('IE_IP') ?>"
						       aria-describedby="schema-addon" required>
						<span class="input-group-addon" id="url-colon-addon">:</span>
						<input id="port" type="text" name="port" class="form-control"
						       placeholder="<?= $chocal->lang->getTranslate('IE_PORT') ?>"
						       aria-describedby="url-colon-addon" required>

					</div>
					<p class="help-block"><?= $chocal->lang->getTranslate('ASK_ADMIN_TO_GIVE_IP') ?></p>

					<!-- Alert for browsers which don't support HTML5 file APIs -->
					<div id="avatar-incompatible-alert" class="hide alert alert-warning alert-dismissible fade in"
					     role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
								aria-hidden="true">&times;</span></button>
						<?= $chocal->lang->getTranslate('AVATAR_SORRY_BROWSER_DONT_SUPPORT_HTML5_FILE_API') ?></div>

					<!-- Avatar file selector -->
					<div id="avatar-picker-area" class="form-group">
						<label for="avatar-picker"><?= $chocal->lang->getTranslate('YOUR_AVATAR_MAX_SIZE') ?></label>
						<input id="avatar-picker" type="file" name="avatar">
						<p class="help-block"><?= $chocal->lang->getTranslate('OPTIONALLY_CAN_SET_AVATAR') ?></p>
					</div>

					<!-- Avatar preview area -->
					<div id="avatar-preview-area" class="hide text-center">
						<p><?= $chocal->lang->getTranslate('YOUR_AVATAR_PICTURE') ?></p>
						<img id="avatar-preview" class="img-circle" src="assets/img/no-avatar.png" width="60"
						     height="60" alt="User Avatar">
					</div>

					<!-- Avatar invalid image error -->
					<div id="avatar-invalid-image-alert" class="hide alert alert-danger" role="alert">
						<p><?= $chocal->lang->getTranslate('INVALID_AVATAR_SELECTED') ?></p>
					</div>


				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default"
					        data-dismiss="modal"><?= $chocal->lang->getTranslate('CANCEL') ?></button>
					<button type="submit"
					        class="btn btn-success"><?= $chocal->lang->getTranslate('JOIN_NOW_ALL_CAPITAL') ?></button>
				</div>

			</form>

		</div>
	</div>
</div> <!-- /Register modal -->

<!-- Attachment image modal -->
<div class="modal fade" id="attachment-image-modal" tabindex="-1" role="dialog"
     aria-labelledby="attachment-image-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"
				    id="attachment-image-label"><?= $chocal->lang->getTranslate('CHOOSE_IMAGE') ?></h4>
			</div>

			<form id="attachment-image-form" role="form" action="" method="post" enctype="multipart/form-data">
				<div class="modal-body">

					<div id="attachment-image-alert">
						<!-- Errors on adding attachment image will be shown here -->
					</div>

					<!-- Alert for browsers which don't support HTML5 file APIs -->
					<div id="image-attachment-incompatible-alert"
					     class="hide alert alert-warning alert-dismissible fade in"
					     role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
								aria-hidden="true">&times;</span></button>
						<?= $chocal->lang->getTranslate('ATTACHMENT_IMAGE_SORRY_BROWSER_DONT_SUPPORT_HTML5_FILE_API') ?>
					</div>

					<!-- Image file selector -->
					<div id="attachment-image-picker-area" class="form-group">
						<label
							for="attachment-image-picker"><?= $chocal->lang->getTranslate('SELECT_IMAGE_MAX_2_MB') ?></label>
						<input id="attachment-image-picker" type="file">
						<p class="help-block"><?= $chocal->lang->getTranslate('SELECT_JPG_JPEG_PNG_TO_SEND') ?></p>
					</div>


				</div>

				<div class="modal-footer">
					<button id="attachment-image-remover" type="button" class="btn btn-danger"
					        data-dismiss="modal"><?= $chocal->lang->getTranslate('DELETE_IMAGE') ?></button>
					<button type="button"
					        class="btn btn-success"
					        data-dismiss="modal"><?= $chocal->lang->getTranslate('SELECT') ?></button>
				</div>

			</form>

		</div>
	</div>
</div> <!-- /Attachment image modal -->

<div class="container">

	<!-- intro -->
	<div id="intro">

		<div class="jumbotron text-center">
			<img src="assets/img/chocal-logo-256.png" class="img-responsive center-block" alt="Chocal Logo">
			<h1><?= $chocal->lang->getTranslate('CHOCAL_CHAT') ?></h1>
			<p><?= $chocal->lang->getTranslate('USE_CHOCAL_CHAT_TO_COMMUNICATE') ?></p>

			<!-- Country flags -->
			<p>
				<a href="?hl=en" title="English (United States)"><img src="assets/img/flags/en-us.gif"
				                                                      alt="US Flag"></a>
				<a href="?hl=fa" title="پارسی"><img src="assets/img/flags/fa-ir.gif" alt="Iran Flag"></a>
			</p>

			<p>
				<!-- Join button -->
				<button id="join-button" type="button" class="btn btn-primary btn-lg" data-toggle="modal"
				        data-target="#join-modal" autofocus>
					<?= $chocal->lang->getTranslate('JOIN_CHAT_ALL_CAPITAL') ?>
				</button>
			</p>
		</div> <!-- /jumbotron -->

		<div class="text-center alert alert-info">
			<h2><?= $chocal->lang->getTranslate('TIP') ?></h2>
			<p><?= $chocal->lang->getTranslate('PLEASE_CONSIDER_YOU_NEED_MODERN_BROWSER') ?></p>
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

						<div class="col-xs-12 col-sm-4">
							<h3 class="panel-title"><!-- Number of online users will be shown here --></h3>
						</div>

						<div class="col-xs-12 col-sm-8">
							<p class="<?= $chocal->lang->isRtl() ? 'text-left' : 'text-right' ?>">
								<!-- Leave button -->
								<button id="leave-button" type="button" class="btn btn-danger btn-sm">
									<?= $chocal->lang->getTranslate('LEAVE_CHAT') ?>
								</button>
								<!-- Check state button -->
								<button id="check-state-button" type="button" class="btn btn-default btn-sm"
								        data-toggle="popover" data-placement="bottom">
									<?= $chocal->lang->getTranslate('CHECK_STATE') ?>
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
							             placeholder="<?= $chocal->lang->getTranslate('ENTER_YOUR_MESSAGE') ?>"></textarea>
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
								<button id="send-button" class="btn btn-success btn-block"
								        type="button"><?= $chocal->lang->getTranslate('SEND') ?></button>
							</p>
						</div>

						<!-- Attach image button -->
						<div class="col-xs-2">
							<p>
								<a tabindex="0" id="attach-button" class="btn btn-info btn-block" data-toggle="modal"
								   data-placement="top" data-trigger="focus" data-target="#attachment-image-modal"
								   role="button"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span></a>
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
<?php
# Load different languages for JavaScript texts
switch ($chocal->lang->getLang()) :
case 'fa':?>
	<!-- Persian language -->
	<script src="assets/js/lang.fa.js"></script>
<?php break;
default: ?>
	<!-- English language -->
	<script src="assets/js/lang.en.js"></script>
	<?php
	break;
endswitch; ?>
<script src="assets/js/chocal.js"></script>
</body>
</html>
