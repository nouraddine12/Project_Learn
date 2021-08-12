$(function(){

	'use strict';

	// Hide Placeholder
	$('[placeholder]').focus(function(){
		$(this).attr('data-text', $(this).attr('placeholder'));
		$(this).attr('placeholder', '');
	}).blur(function(){
		$(this).attr('placeholder', $(this).attr('data-text'));
		

	});


	// Add Astrisk On Required Field

	//$('input').each(function(){
	//	if($(this).attr('required') === 'required'){
	//		$(this).after('<span class="asterisk">*</span>')
	//	}
	//})

	//Conver Password Field To Text Field On Hover
	var passField = $('.password');
	$('.show-pass').hover(function() {
		
		passField.attr('type', 'text');

	}, function() {

		passField.attr('type', 'password');

	});



	// Confirmation MessaGE on Link 

	$('.confirm').click(function(){
		return confirm('Are You Sure?');
	});
});

