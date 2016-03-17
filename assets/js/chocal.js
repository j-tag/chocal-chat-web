/**
 * Created by jtag on 3/17/16.
 */

var myUserKey = null;
var myName = null;
var myAvatar = null;
var imageAttachment = null;
var webSocket = null;
var $chatArea = $('.chat-area');
var userIds = [];
var userAvatars = [];
var onlineCounter = 0;

// Scrolls chat area to end
function goToLast() {
    // Scroll down
    $chatArea.animate({
        scrollTop: $chatArea[0].scrollHeight
    }, 1000);
}

// Gets a base64 encoded data and MIME type and return its data URI
function dataMime(data, type) {
    return 'data:' + type + ';base64, ' + data;
}

// Returns current user avatar
function getMyAvatar() {
    return myAvatar == null ? 'assets/img/no-avatar.png' : dataMime(myAvatar.data, myAvatar.type);
}

// Gets a user name and return his avatar
function getAvatar(name) {
    return userAvatars[getInternalUserId(name)];
}

// This function will show a standard Chocal plain message type in chat area
function appendTextMessage(json) {
    var html = null;
    var avatar = null;


    if (json.name == myName) {

        // Sender is this user himself

        html = "<div class=\"media\"><div class=\"media-body well mine\">\n<h4 class=\"media-heading media-name\">" + lang.YOU + "</h4>\n" + json.message + "\n</div>\n<div class=\"media-right media-middle\">\n<img class=\"media-object img-circle\" src=\"" + getMyAvatar() + "\" alt=\"User Avatar\" width=\"60\" height=\"60\">\n</div>\n</div>";

    } else {

        // Sender is another user
        avatar = getAvatar(json.name);

        html = "<div class=\"media\">\n<div class=\"media-left media-middle\">\n<img class=\"media-object img-circle\" src=\"" + avatar + "\" alt=\"User Avatar\" width=\"60\" height=\"60\">\n</div>\n<div class=\"media-body well\">\n<h4 class=\"media-heading media-name\">" + json.name + "</h4>\n" + json.message + "\n</div>\n</div>";

    }

    // Animate content
    $(html).hide().appendTo($chatArea).slideDown();

    // Scroll down
    goToLast();

}

// This function will show a Chocal image message type in chat area
function appendImageMessage(json) {
    var html = null;
    var avatar = null;


    if (json.name == myName) {

        // Sender is this user himself

        html = "<div class=\"media\"><div class=\"media-body well mine\">\n<h4 class=\"media-heading media-name\">" + lang.YOU + "</h4>\n<img src=\"" + dataMime(json.image, json.image_type) + "\" class=\"img-responsive img-rounded center-block\" alt=\"Attachment image\"><br>\n" + json.message + "\n</div>\n<div class=\"media-right media-middle\">\n<img class=\"media-object img-circle\" src=\"" + getMyAvatar() + "\" alt=\"User Avatar\" width=\"60\" height=\"60\">\n</div>\n</div>";

    } else {

        // Sender is another user
        avatar = getAvatar(json.name);

        html = "<div class=\"media\">\n<div class=\"media-left media-middle\">\n<img class=\"media-object img-circle\" src=\"" + avatar + "\" alt=\"User Avatar\" width=\"60\" height=\"60\">\n</div>\n<div class=\"media-body well\">\n<h4 class=\"media-heading media-name\">" + json.name + "</h4>\n<img src=\"" + dataMime(json.image, json.image_type) + "\" class=\"img-responsive img-rounded center-block\" alt=\"Attachment image\"><br>\n" + json.message + "\n</div>\n</div>";

    }

    // Animate content
    $(html).hide().appendTo($chatArea).slideDown();

    // Scroll down
    goToLast();

}

// This function will show a Chocal Chat info message in chat view
function appendInfoMessage(json) {
    var html = "<div class=\"alert alert-info text-center info-message\"><strong>" + json.message + "</strong></div>";
    $(html).hide().appendTo($chatArea).slideDown();
    // Scroll down
    goToLast();
}

// This function will show errors in an alert box in join form and chat page
function showErrorMessage(json) {
    var $joinAlert = $('#join-alert');
    var $chatAlert = $('#chat-alert');

    var html = "<div id=\"error-alert\" class=\"alert alert-danger alert-dismissible fade in\" role=\"alert\">\n<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n<p>" + json.message + "</p>\n</div>";

    $(html).hide().appendTo($joinAlert).slideDown().delay(5000).slideUp();
    $(html).hide().appendTo($chatAlert).slideDown().delay(5000).slideUp();
}

// Will update online users number
function updateOnlineUsers() {
    var text = lang.WE_HAVE_X_ONLINE_USERS;
    $('.panel-title').text(text.replace('%1', onlineCounter.toString()));
}

// Returns internal id of user
function getInternalUserId(name) {

    for (var index = 0; index < userIds.length; index++) {
        if (userIds[index] == name) {
            // Found id
            return index;
        }
    }

    return null;
}

// Will add new user to online list
function newUser(name, image, image_type) {
    var $list = $('#online-list');
    var avatar = image == null ? 'assets/img/no-avatar.png' : dataMime(image, image_type);

    // Create an internal id for user
    userIds.push(name);

    // Save user avatar
    userAvatars[getInternalUserId(name)] = avatar;

    var html = "<li id=\"u" + getInternalUserId(name) + "\" class=\"list-group-item\">\n<h4 class=\"list-group-item-heading media-name\">\n<img class=\"img-circle\" src=\"" + avatar + "\" alt=\"User Avatar\" width=\"60\" height=\"60\">&nbsp;" + name + "\n</h4>\n</li>";

    // Show with slide effect
    $(html).hide().appendTo($list).slideDown();

    // Highlight current user name in online list
    if (name == myName) {
        $('#u' + getInternalUserId(name)).addClass('active');
    }

    onlineCounter++;
    updateOnlineUsers();
}

// Will remove a user from online list
function removeUser(name) {
    var index = getInternalUserId(name);
    $('#u' + index).slideUp();
    userIds[index] = undefined;

    onlineCounter--;
    updateOnlineUsers();
}

// Gets an array of users and show them in online list
function initOnlineUsers(users) {
    var user = null;

    for (var index = 0; index < users.length; index++) {
        user = users[index];
        newUser(user.name, user.image, user.image_type);
    }

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
    // Set avatar picture
    if (myAvatar == null) {
        $('#send-avatar-image').attr('src', 'assets/img/no-avatar.png');
    } else {
        $('#send-avatar-image').attr('src', dataMime(myAvatar.data, myAvatar.type));
    }
    // Change page title
    document.title = lang.CHOCAL_CHAT_WEB_CLIENT;

    // Show current online users
    initOnlineUsers(message.online_users);
}

// This function will called right after web socket connection
function sendRegisterMessage(userName, avatar) {

    if (webSocket != null) {
        var json = null;

        if (avatar == null) {
            json = {
                type: 'register',
                name: userName
            };
        } else {
            json = {
                type: 'register',
                name: userName,
                image: avatar.data,
                image_type: avatar.type
            };
        }

        var msg = JSON.stringify(json);
        webSocket.send(msg);
        console.info('Register request sent:', json);
    }

}

// This function will handle update messages
function handleUpdate(json) {
    switch (json.update) {
        case 'userJoined':
            newUser(json.name, json.image, json.image_type);
            break;
        case 'userLeft':
            removeUser(json.name);
            break;
        default:
            break;
    }
}

// This function will be called at join operation
function initWebSocket(ip, port) {
    try {
        if (typeof MozWebSocket == 'function')
            WebSocket = MozWebSocket;
        if (webSocket && webSocket.readyState == 1)
            webSocket.close();
        var wsUri = 'ws://' + ip + ':' + port;
        webSocket = new WebSocket(wsUri);
        webSocket.onopen = function (/*evt*/) {
            console.info('Connected to web socket.');
            // After connection we should send register request message
            sendRegisterMessage(myName, myAvatar);
        };
        webSocket.onclose = function (/*evt*/) {
            console.error('Web socket disconnected.');
            // TODO : Show error in page
        };
        webSocket.onmessage = function (evt) {
            var message = JSON.parse(evt.data);
            console.log('Message received:', message);

            // Normal text message
            if (message.type == 'plain') {
                appendTextMessage(message);
            }

            // Image message
            if (message.type == 'image') {
                appendImageMessage(message);
            }

            // Update message
            if (message.type == 'update') {
                handleUpdate(message);
            }

            // Info message
            if (message.type == 'info') {
                appendInfoMessage(message);
            }

            // Error message
            if (message.type == 'error') {
                showErrorMessage(message);
            }

            // Handle acceptation message
            if (message.type == 'accepted') {
                accepted(message);
            }

        };
        webSocket.onerror = function (evt) {
            console.error('Web socket error:', evt.data);
        };
    } catch (exception) {
        console.error('Error:', exception);
    }
}

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
        var match = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))) {
            // File type is invalid
            $('#avatar-invalid-image-alert').removeClass('hide');
            return;
        }

        var reader = new FileReader();

        reader.onload = function (readerEvt) {
            // Convert binary string Base64 encoded data to ASCII string
            var binaryString = readerEvt.target.result;
            myAvatar = {
                data: btoa(binaryString),
                type: fileType
            };
            // Show preview
            $('#avatar-preview-area').removeClass('hide');
            $('#avatar-preview').attr('src', dataMime(myAvatar.data, myAvatar.type));

        };

        reader.readAsBinaryString(file);
    }
};

// This function will handle choosing of an Attachment picture
var handleAttachmentImageSelect = function (evt) {
    var files = evt.target.files;
    var file = files[0];

    if (files && file) {

        var $attachButton = $('#attach-button');

        // Check file size
        if (file.size > 2097152 /* Equals to 2048 kb */) {
            // File size is invalid
            $attachButton.popover({
                title: lang.INVALID_FILE_SIZE,
                content: lang.FILE_SIZE_MUST_NOT_BE_MORE_THAN_2MB,
                placement: 'top',
                trigger: 'focus'
            });
            $attachButton.popover('show');
            return;
        } else {
            $attachButton.popover('destroy');
        }

        // Check file type
        var fileType = file.type;
        var match = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))) {
            // File type is invalid
            $attachButton.popover({
                title: lang.INVALID_FILE_TYPE,
                content: lang.FILE_MUST_BE_AN_IMAGE_IN_JPG_JPEG_PNG_FORMAT,
                placement: 'top',
                trigger: 'focus'
            });
            $attachButton.popover('show');
            return;
        } else {
            $attachButton.popover('destroy');
        }

        var reader = new FileReader();

        reader.onload = function (readerEvt) {
            // Convert binary string Base64 encoded data to ASCII string
            var binaryString = readerEvt.target.result;
            imageAttachment = {
                data: btoa(binaryString),
                type: fileType
            };
            // Show success message
            $attachButton.popover({
                title: lang.FILE_SELECTED,
                content: lang.ATTACHMENT_IMAGE_SELECTED_YOU_CAN_PRESS_SEND,
                placement: 'top',
                trigger: 'focus'
            });
            $attachButton.popover('show');
        };

        reader.readAsBinaryString(file);
    }
};

var joinChat = function (evt) {
    evt.preventDefault();
    // Get form data
    var data = $('#join-form').find(':input').serializeArray();
    myName = data[0].value;
    var ip = data[1].value;
    var port = data[2].value;

    // Try to connect to web socket
    initWebSocket(ip, port);
};

function stopWebSocket() {
    if (webSocket)
        webSocket.close();
}

// This function will called when user pressed the leave button
function leaveChat() {
    // Kinda reset anything

    // Close web socket
    stopWebSocket();
    // Refresh browser to reset everything back
    location.reload();
}

// Will send an image message to Chocal Server
function sendImageMessage() {
    if (webSocket != null) {
        // Check there is any image or not
        if (imageAttachment == null) {
            return;
        }

        // Get text area
        var $textArea = $('#txt-message');
        // Get value of text area
        var text = $textArea.val();
        // Check there is a value or not
        if (text.length < 1) {
            // Return focus back to text area
            $textArea.focus();
            return;
        }
        // Clear text area
        $textArea.val('');

        // Generate json object
        var json = {
            type: 'image',
            image: imageAttachment.data,
            image_type: imageAttachment.type,
            message: text,
            user_key: myUserKey
        };
        // Send message
        webSocket.send(JSON.stringify(json));
        // Clear image data
        imageAttachment = null;
        // Return focus back to text area
        $textArea.focus();
        // Log data
        console.log('Data sent:', json);
    }
}

// Will send a plain text message to Chocal Server
function sendTextMessage() {
    if (webSocket != null) {
        // Get text area
        var $textArea = $('#txt-message');
        // Get value of text area
        var text = $textArea.val();
        // Check there is a value or not
        if (text.length < 1) {
            // Return focus back to text area
            $textArea.focus();
            return;
        }
        // Clear text area
        $textArea.val('');
        // Generate json object
        var json = {
            type: 'plain',
            image: '',
            message: text,
            user_key: myUserKey
        };
        // Send message
        webSocket.send(JSON.stringify(json));
        // Return focus back to text area
        $textArea.focus();
        // Log data
        console.log('Data sent:', json);
    }
}

// General function to send messages
function send() {

    if (imageAttachment != null) {
        // Image message
        sendImageMessage();
    } else {
        // Plain text message
        sendTextMessage();
    }
}


// This function will check web socket status
function checkSocket() {
    var $checkStateButton = $('#check-state-button');
    var strState;

    if (webSocket != null) {

        switch (webSocket.readyState) {
            case 0:
                strState = lang.TRYING_TO_CONNECT_TO_CHOCAL_SERVER;
                break;
            case 1:
                strState = lang.CONNECTION_TO_CHOCAL_SERVER_ESTABLISHED;
                break;
            case 2:
                strState = lang.CLOSING_CONNECTION_TO_CHOCAL_SERVER;
                break;
            case 3:
                strState = lang.NOT_CONNECTED_TO_ANY_SERVER;
                break;
            default:
                strState = lang.CANT_DEFINE_STATE_SOMETHING_WRONG;
                break;
        }
        console.log('WebSocket state :', webSocket.readyState, '(', strState, ')');
    } else {
        strState = lang.SEEMS_YOUR_BROWSER_DONT_SUPPORT_WEB_SOCKET;
        console.warn('WebSocket is null');
    }

    // Show state as a popover on button
    $checkStateButton.attr('data-content', strState);
}

// Page load up function
$(function () {

    // Set Avatar picker and image attachment event handler
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        $('#avatar-picker').on('change', handleAvatarFileSelect);
        $('#attach-button').on('change', handleAttachmentImageSelect);
    } else {
        // The File APIs are not fully supported in this browser
        $('#avatar-incompatible-alert').removeClass('hide');
        $('#avatar-picker').attr('disabled', true);
        $('#attach-button').attr('disabled', true);
    }

    // Set join form submit button event listener
    $('#join-form').on('submit', joinChat);

    // Set leave chat button event listener
    $('#leave-button').on('click', leaveChat);

    // Set send button event listener
    $('#send-button').on('click', send);

    // Set check state button event listener
    $('#check-state-button').on('click', checkSocket);

    // Initialize popovers
    $('[data-toggle="popover"]').popover();

});
