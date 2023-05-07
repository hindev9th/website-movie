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
			}, beforeSend: function () {
				$(".loader").fadeIn();
				$("#preloder").fadeIn();
			}, success: function (data) {
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
				console.log("ok");
			}, error: function (data) {
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

	/**
	 * Auto search when key up
	 */
	$('#search-input').keyup(function () {
		var value = $(this).val();
		if (value.length > 1) {
			$.ajax({
				url: base_url + 'search/popup',
				type: 'get',
				data: {
					'search': value,
				}, beforeSend: function () {
				}, success: function (data) {
					$('.search-popup-result').html(data);
				}, error: function (data) {
					console.error(data);
				}
			})
		}
	})

	// $('.header-genre-item').click(function (e) {
	// 	e.preventDefault();
	// 	var genre = $(this).text();
	// 	$.ajax({
	// 		url: base_url + 'genre',
	// 		type: 'get',
	// 		data: {
	// 			genre: genre,
	// 		}, beforeSend: function () {
	// 			// $(".loader").fadeIn();
	// 			// $("#preloder").fadeIn();
	// 		}, success: function (data) {
	// 			$("html").html(data)
	//
	// 			$(".loader").fadeOut();
	// 			$("#preloder").delay(200).fadeOut("slow");
	// 		}, error: function (data) {
	// 			$(".loader").fadeOut();
	// 			$("#preloder").delay(200).fadeOut("slow");
	// 			console.log(data);
	// 		}
	// 	})
	// });

	/**
	 * begin filter category ajax
	 * @param value
	 * @param filter
	 * @param order
	 * @param index
	 */
	function filterMovies(value, filter, order, index) {
		$.ajax({
			url: base_url + 'genre/filter',
			type: 'get',
			dataType: 'json',
			data: {
				search: value,
				filter: filter,
				order: order,
				index: index,
			}, beforeSend: function () {
				$(".loader").fadeIn();
				$("#preloder").fadeIn();
			}, success: function (data) {
				updateCategoryFilterResult(data);
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
			}, error: function (data) {
				$(".loader").fadeOut();
				$("#preloder").delay(200).fadeOut("slow");
				console.log(data);
			}
		})
	}

	$('.genre-item').click(function () {
		var value = $('.search-value').val();
		var all = $(".genre-item:checkbox:checked").map(function () {
			return this.value;
		}).get();
		var select = $('.filter-select').val();
		var index = $('.current-page').text();

		filterMovies(value, all.join(), select, index);
	})

	$('.filter-select').change(function () {
		var value = $('.search-value').val();
		var all = $(".genre-item:checkbox:checked").map(function () {
			return this.value;
		}).get();
		var select = this.value;
		var index = $('.current-page').text();

		filterMovies(value, all.join(), select, index);

	});

	$(document).on('click', '.next-page-genre', function (e) {
		e.preventDefault();
		var value = $('.search-value').val();
		var all = $(".genre-item:checkbox:checked").map(function () {
			return this.value;
		}).get();
		var select = $('.filter-select').val();
		var index = $('.current-page').text();
		index = parseInt(index);
		filterMovies(value, all.join(), select, index + 1);
	})

	$(document).on('click', '.page-genre', function (e) {
		e.preventDefault();
		var value = $('.search-value').val();
		var all = $(".genre-item:checkbox:checked").map(function () {
			return this.value;
		}).get();
		var select = $('.filter-select').val();
		var index = $(this).text();

		filterMovies(value, all.join(), select, index);
	});

	function updateCategoryFilterResult(data) {
		var html = ``;
		var pagi = ``;

		for (var item of data.data) {
			html += `<div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg"
                     data-setbg="${base_url}assets/img/anime/${item.image}" style="background-image : url(${base_url}assets/img/anime/${item.image});">
                    <div class="ep">${item.episodes + ' / ' + (item.totalEpisode > 0 ? item.totalEpisode : '?')}</div>
                    <div class="comment"><i class="fa fa-comments"></i> ${item.reviewCount}
                    </div>
                    <div class="view"><i class="fa fa-eye"></i> ${item.views}</div>
                  </div>
                  <div class="product__item__text">
                    <ul class="list-genre" data-genre="<?= $item->genre ?>">
                    </ul>
                    <h5><a href="${base_url + 'movie/' + item.url}">${item.name}</a></h5>
                  </div>
                </div>
              </div>`
		}


		var countRow = data.countAll / 18;
		var current_page = data.current_page;
		var iFirst = current_page >= 4 && countRow > 5 ? current_page - 2 : 1;
		var end = countRow > (iFirst + 4) ? iFirst + 4 : countRow;
		var num = 0;

		for (var i = iFirst; i <= end; i++) {
			num++;
			pagi += `<a href="#" class="page-genre ${current_page == i ? 'current-page' : ''}">${i}</a>`
			if (num === 5) {
				pagi += `<a href="#" class="next-page-genre"><i class="fa fa-angle-double-right"></i></a>`
			}
		}

		$('#movie-filter').html(html);
		$('.product__pagination').html(pagi);
	}

	/**
	 * end filter category
	 */

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
