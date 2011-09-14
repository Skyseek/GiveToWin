$(document).ready(function()
{
	// We'll catch form submission to do it in AJAX, but this works also with JS disabled
	$('#login-form').submit(function(event)
	{
		// Stop full page load
		event.preventDefault();

		// Check fields
		var login = $('#login').val();
		var pass = $('#pass').val();

		if (!login || login.length == 0)
		{
			$('#login-block').removeBlockMessages().blockMessage('Please enter your email', {type: 'warning'});
		}
		else if (!pass || pass.length == 0)
		{
			$('#login-block').removeBlockMessages().blockMessage('Please enter your password', {type: 'warning'});
		}
		else
		{
			var submitBt = $(this).find('button[type=submit]');
			//submitBt.disableBt();

			// Target url
			var target = $(this).attr('action');
			if (!target || target == '')
			{
				// Page url without hash
				target = document.location.href.match(/^([^#]+)/)[1];
			}

			// Start timer
			var sendTimer = new Date().getTime();

			//Set Message
			$('#login-block').removeBlockMessages().blockMessage('Please wait, cheking login...', {type: 'loading'});

			//Send
			var userAPI		= jQuery.Zend.jsonrpc({url: '/api/json.php'});
			var response	= userAPI.login(login, pass, 'admin');
			
			if(response.success) {
				// Small timer to allow the 'cheking login' message to show when server is too fast
				var receiveTimer = new Date().getTime();
				if (receiveTimer-sendTimer < 500)
				{
					setTimeout(function()
					{
						document.location.href = response.data['redirect'];
					}, 500-(receiveTimer-sendTimer));
				}
				else
					document.location.href = response.data['redirect'];
			} else {
				submitBt.enableBt();
				$('#login-block').removeBlockMessages().blockMessage(response.messages[0], {type: 'error'});
			}
		}
	});
});
