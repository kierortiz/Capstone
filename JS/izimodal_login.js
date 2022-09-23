$(function(){

/* Instantiating iziModal */
$("#modal-custom").iziModal({
		overlayClose: false,
		overlayColor: 'rgba(0, 0, 0, 0.6)'
});

$("#modal-custom2").iziModal({
		overlayClose: false,
		overlayColor: 'rgba(0, 0, 0, 0.6)'
});

$("#modal-custom3").iziModal({
		overlayClose: false,
		overlayColor: 'rgba(0, 0, 0, 0.6)'
});

/*$(document).on('click', '.trigger-custom', function (event) {
		event.preventDefault();
		$('#modal-custom').iziModal('open');
});*/

/* JS inside the modal */

$("#modal-custom").on('click', 'header a', function(event) {
		event.preventDefault();
		var index = $(this).index();
		$(this).addClass('active').siblings('a').removeClass('active');
		$(this).parents("div").find("section").eq(index).removeClass('hide').siblings('section').addClass('hide');

		if( $(this).index() === 0 ){
				$("#modal-custom .iziModal-content .icon-close").css('background', '#ddd');
		} else {
				$("#modal-custom .iziModal-content .icon-close").attr('style', '');
		}
});

$("#modal-custom2").on('click', 'header a', function(event) {
		event.preventDefault();
		var index = $(this).index();
		$(this).addClass('active').siblings('a').removeClass('active');
		$(this).parents("div").find("section").eq(index).removeClass('hide').siblings('section').addClass('hide');

		if( $(this).index() === 0 ){
				$("#modal-custom2 .iziModal-content .icon-close").css('background', '#ddd');
		} else {
				$("#modal-custom2 .iziModal-content .icon-close").attr('style', '');
		}
});


$("#modal-custom3").on('click', 'header a', function(event) {
		event.preventDefault();
		var index = $(this).index();
		$(this).addClass('active').siblings('a').removeClass('active');
		$(this).parents("div").find("section").eq(index).removeClass('hide').siblings('section').addClass('hide');

		if( $(this).index() === 0 ){
				$("#modal-custom3 .iziModal-content .icon-close").css('background', '#ddd');
		} else {
				$("#modal-custom3 .iziModal-content .icon-close").attr('style', '');
		}
});
// animation for izimodal do not include onclick cause it will not proceed to form
// $("#modal-custom").on('click', '.submit', function(event) {
// 		event.preventDefault();
//
// 		var fx = "wobble",  //wobble shake
// 				$modal = $(this).closest('.iziModal');
// 				document.getElementById('signupmodal').submit();
// 		if( !$modal.hasClass(fx) ){
// 				$modal.addClass(fx);
// 				setTimeout(function(){
// 						$modal.removeClass(fx);
// 				}, 1500);
// 		}
// });

})
