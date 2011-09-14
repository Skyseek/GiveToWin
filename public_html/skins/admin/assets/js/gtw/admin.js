
/**
 * Show GTW Admin About Prompt.
 */
function openAboutPrompt()
{
	$.modal({
		content: '<p>Give To Win Admin was created to be as easy to use & as powerful to as possible.</p>',
		title: 'About Give To Win (Version 0.5)',
		maxWidth: 500,
		buttons: {
			'Close': function(win) { win.closeModal(); }
		}
	});
}


/**
 * Open Delete User Prompt/Warning.
 *
 * @param userId int User ID to Delete;
 */
function openDeleteUserPrompt(userId)
{
	$.modal({
		content: '<p>This user, all there subscriptions, coupons, comments will be deleted.</p>'+
			  '<ul class="simple-list with-icon">'+
			  '    <li><a href="/admin/users/delete-user/id/'+userId+'">Yes, Permanently Delete User</a></li>'+
			  '</ul>',
		title: 'Are you sure you want to delete this user?',
		maxWidth: 500,
		buttons: {
			'Cancel': function(win) { win.closeModal(); }
		}

	});
}
