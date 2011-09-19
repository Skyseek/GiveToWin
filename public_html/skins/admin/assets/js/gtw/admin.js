
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


/**
 * Open Delete Charity Prompt/Warning.
 *
 * @param charityId int Charity ID to Delete;
 */
function openDeleteCharityPrompt(charityId)
{
	$.modal({
		content: '<p>This charity, all there fundraisers, donations, comments will be deleted.</p>'+
			  '<ul class="simple-list with-icon">'+
			  '    <li><a href="/admin/charities/delete/id/'+charityId+'">Yes, Permanently Delete this Charity</a></li>'+
			  '</ul>',
		title: 'Are you sure you want to delete this charity?',
		maxWidth: 500,
		buttons: {
			'Cancel': function(win) { win.closeModal(); }
		}

	});
}


/**
 * Open Delete City Prompt/Warning.
 *
 * @param cityId int City ID to Delete;
 */
function openDeleteCityPrompt(cityId)
{
	$.modal({
		content: '<p>This city, all there fundraiser schedule, offer schedules, and user subscriptions will be deleted.</p>'+
			  '<ul class="simple-list with-icon">'+
			  '    <li><a href="/admin/cities/delete/id/'+cityId+'">Yes, Permanently Delete this City</a></li>'+
			  '</ul>',
		title: 'Are you sure you want to delete this city?',
		maxWidth: 500,
		buttons: {
			'Cancel': function(win) { win.closeModal(); }
		}

	});
}



/**
 * Open Delete Company Prompt/Warning.
 *
 * @param companyId int Company ID to Delete;
 */
function openDeleteCompanyPrompt(companyId)
{
	$.modal({
		content: '<p>This company, all it\'s offers, offer schedules, and comment will be deleted.</p>'+
			  '<ul class="simple-list with-icon">'+
			  '    <li><a href="/admin/companies/delete/id/'+companyId+'">Yes, Permanently Delete this Company</a></li>'+
			  '</ul>',
		title: 'Are you sure you want to delete this company?',
		maxWidth: 500,
		buttons: {
			'Cancel': function(win) { win.closeModal(); }
		}

	});
}


/**
 * Open Delete Fundraiser Prompt/Warning.
 *
 * @param fundraiserId int Fundraiser ID to Delete;
 */
function openDeleteFundraiserPrompt(fundraiserId)
{
	$.modal({
		content: '<p>This fundraiser, it\'s schedule, and donations will be deleted.</p>'+
			  '<ul class="simple-list with-icon">'+
			  '    <li><a href="/admin/fundraisers/delete/id/'+fundraiserId+'">Yes, Permanently Delete this Fundraiser</a></li>'+
			  '</ul>',
		title: 'Are you sure you want to delete this fundraiser?',
		maxWidth: 500,
		buttons: {
			'Cancel': function(win) { win.closeModal(); }
		}

	});
}


/**
 * Open Delete Offer Prompt/Warning.
 *
 * @param offerId int Offer ID to Delete;
 */
function openDeleteOfferPrompt(offerId)
{
	$.modal({
		content: '<p>This offer, it\'s schedule, and coupons will be deleted.</p>'+
			  '<ul class="simple-list with-icon">'+
			  '    <li><a href="/admin/offers/delete/id/'+offerId+'">Yes, Permanently Delete this Offer</a></li>'+
			  '</ul>',
		title: 'Are you sure you want to delete this offer?',
		maxWidth: 500,
		buttons: {
			'Cancel': function(win) { win.closeModal(); }
		}

	});
}
