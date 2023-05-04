'use strict';
(function ($) {
	const base_url = $('base').attr('href');
	var currentIndex = 1;

	/**
	 * get data review of movie by id and pagination by index
	 * @param id
	 * @param index
	 */
	function movieComment(id, index) {
		currentIndex = index;
		$.ajax({
			url: base_url + `movie/${id}/review/${index}`,
			type: 'get',
			beforeSend: function () {
				$(".loader").fadeIn();
				$("#preloder").fadeIn();
			}, success: function (data) {
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
				$('.anime__details__review').empty();
				$('.anime__details__review').append(data);
			}, error: function (data) {
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
			}
		});
	}

	/**
	 * ajax insert review for movie
	 */
	$('#frm_review').submit(function (e) {
		e.preventDefault();
		var form = $(this);
		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			data: form.serialize(),
			beforeSend: function (data) {
				$(".loader").fadeIn();
				$("#preloder").fadeIn();
			}, success: function (data) {
				const myArray = form.serialize().split("&");
				movieComment(myArray[1].charAt(3), currentIndex);
			}, error: function (data) {
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
			}
		})
	});

	/**
	 * action update like and dislike
	 */
	$('.like_and_dislike').click(function (e) {
		e.preventDefault();
		var a = $(this)
		var action = a.attr('href');
		var customer_id = a.attr('customer-id');
		var movie_id = a.attr('movie-id');
		var status = a.attr('status');

		$.ajax({
			url: action + customer_id + '/' + movie_id + '/' + status,
			type: 'get',
			dataType: 'json',
			beforeSend: function (data) {
				$(".loader").fadeIn();
				$("#preloder").fadeIn();
			}, success: function (data) {
				$('.like_and_dislike').removeClass('active')
				a.addClass('active');
				$('#number-dislike').html(data.dislike);
				$('#number-like').html(data.like);
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
			}, error: function (data) {
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
			}
		})
	});

	/**
	 * ajax handle login user
	 */
	$('#frm-login').submit(function (e) {
		e.preventDefault();
		var form = $(this);

		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			data: form.serialize(),
			beforeSend: function () {
				$(".loader").fadeIn();
				$("#preloder").fadeIn();
			}, success: function (data) {
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
				if ('referrer' in document) {
					window.location = document.referrer;
				}
			}, error: function (data) {
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
			}
		})

	});

	/**
	 * ajax handle register new user
	 */
	$('#frm-register').submit(function (e) {
		e.preventDefault();
		var form = $(this);

		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			data: form.serialize(),
			beforeSend: function () {
				$(".loader").fadeIn();
				$("#preloder").fadeIn();
			}, success: function (data) {
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
				if (data === '200') {
					window.location.href = base_url;
				}
			}, error: function (data) {
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
			}
		})

	});

	/**
	 * Login user
	 */
	$('#logout').click(function (e) {
		e.preventDefault();
		var a = $(this);

		$.ajax({
			url: a.attr('href'),
			type: 'get',
			beforeSend: function () {
				$(".loader").fadeIn();
				$("#preloder").fadeIn();
			}, success: function (data) {
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
				location.reload();
			}, error: function (data) {
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
			}
		})
	});

	$('#movie-follow').click(function (e) {
		e.preventDefault();
		var action = $(this).attr('href');
		var customerId = $(this).attr('customer-id');
		var movieId = $(this).attr('movie-id');

		$.ajax({
			url: action,
			type: 'get',
			data: {
				'customerId': customerId,
				'movieId': movieId,
			},beforeSend : function (){
				$(".loader").fadeIn();
				$("#preloder").fadeIn();
			},success : function (data) {
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
				console.log("ok");
			},error : function (data){
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
			}
		})
	});

	/**
	 * update view for movie
	 * @type {number}
	 */
	var playClick = 0;
	$('.plyr__control.plyr__control--overlaid').click(function () {
		playClick += 1;
		var dataMovie = $('video#player');
		if (playClick < 2) {
			$.ajax({
				url: base_url + 'movie/view/' + dataMovie.attr('data-movie-id') + '/' + dataMovie.attr('data-id'),
				type: 'get'
			})
		}
	});

	$('#search-input').keyup(function (){
		var value = $(this).val();
		if (value.length > 1){
			$.ajax({
				url: base_url + 'search/popup',
				type : 'get',
				data : {
					'search' : value,
				},beforeSend : function (){
				},success : function (data){
					$('.search-popup-result').html(data);
				},error : function (data){
					console.error(data);
				}
			})
		}
	})

	/**
	 *
	 * @param time
	 * @returns {string}
	 */
	function formatTimeToString(time) {
		var startTime = new Date(time);
		var endTime = new Date();
		var second = (endTime.getTime() - startTime.getTime()) / 1000;
		var minutes = second / 60;
		var hour = minutes / 60;
		var day = hour / 24;

		if (second < 0) {
			return startTime.toLocaleTimeString('en-US', {
				hour12: false,
				hour: 'numeric',
				minute: 'numeric',
				second: 'numeric'
			}) + ' ' + startTime.toLocaleDateString('en-US', {day: 'numeric', month: 'short', year: 'numeric'});
		}

		if (second < 60) {
			return Math.floor(second) + " Second ago";
		}

		if (minutes < 60) {
			return Math.floor(minutes) + " Minute ago";
		}

		if (hour < 24) {
			return Math.floor(hour) + " Hour ago";
		}

		if (day < 30) {
			return Math.floor(day) + " Day ago";
		}

		return startTime.toLocaleTimeString('en-US', {
			hour12: false,
			hour: 'numeric',
			minute: 'numeric',
			second: 'numeric'
		}) + ' ' + startTime.toLocaleDateString('en-US', {day: 'numeric', month: 'short', year: 'numeric'});
	}

	$(document).ready(function () {
		window.setTimeout(function () {
			$('.list-genre').each(function (index) {
				var genre = $(this).attr('data-genre').split(", ");
				var me = $(this);
				$.each(genre, function (index, value) {
					me.append(`<li>${value}</li>`);
				})
			});
		}, 200);

	});

	/**
	 * auto update time ago of comment movie
	 */
	window.setInterval(function () {
		$('.data-time-comment').each(function (index) {
			$(this).text(formatTimeToString($(this).attr('data-time')));
		});
	}, 1000);

	window.movieComment = movieComment;
	window.formatTimeToString = formatTimeToString;
})(jQuery);
