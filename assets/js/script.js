$(document).ready(function() {
	// Function to get values from URL Get parameters
	$.urlParam = function(name){
		var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);

		if (results == null) {
			return null;
		}

		return decodeURI(results[1]) || 0;
	}

	// Function to initiate interface
	function initiate() {
		$('#overlay-load').removeClass('hidden');
		$('#overlay-correct').addClass('hidden');
		$('button').removeClass('right').removeClass('wrong');
		attempt = 0;
		$('.progress').css({'right': (100 - Math.round(exclude.length / $.urlParam('length')  * 100)) + '%'});

		if (exclude.length >= $.urlParam('length')) {
			if ($.urlParam('cycle') == 'initial') {
				window.location.href = 'interface.php?session_id=' + $.urlParam('session_id') + '&length=' + $.urlParam('length') + '&version=' + ($.urlParam('version') == 'category' ? 'map' : 'category');
				//console.log("I want to redirect you!");
				return;
			} else {
				window.location.href = 'results.php?session_id=' + $.urlParam('session_id');
				return;
			}
		}

		$.get({
			url: 'api.php',
			data: {
				function: 'get_random_app',
				exclude: exclude.join()
			}
		})
		.done(function(data) {
			if (!data.error) {
				$('.app-name').text(data.name);
				$('.app-description').text(data.description);
				$('.app-image').attr('src', '');
				$('.app-image').attr('src', data.image);
				$('#overlay-load').addClass('hidden');

				correctTargetId = data.correctTargetId[$.urlParam('version')];
				appId = data.id;
				timeStart = new Date().getTime();

				console.log(data);
			} else if (data.error == 'no more apps') {
				console.log(data.error);
				if ($.urlParam('cycle') == 'initial') {
					window.location.href = 'interface.php?session_id=' + $.urlParam('session_id') + '&length=' + $.urlParam('length') + '&version=' + ($.urlParam('version') == 'category' ? 'map' : 'category');
					//console.log("I want to redirect you!");
					return;
				} else {
					window.location.href = 'results.php?session_id=' + $.urlParam('session_id');
					return;
				}
			}
		});
	}

	// Function to react to clicks on buttons
	$('button').click(function(e) {
//		console.log($(this).data('targetId'));
//		console.log(correctTargetId);

		attempt ++;

		// Notify server
		$.get({
			url: 'api.php',
			data: {
				function: 'save_entry',
				session_id: $.urlParam('session_id'),
				app_id: appId,
				target_id: $(this).data('targetId'),
				target_type: $.urlParam('version'),
				attempt: attempt,
				time_spent: (new Date().getTime() - timeStart),
				is_correct: ($(this).data('targetId') == correctTargetId ? 1 : 0),
				is_training: 0
			}
		});

		if ($(this).data('targetId') == correctTargetId) {
			exclude.push(appId);
			window.history.pushState("object or string", "Title", '?session_id=' + $.urlParam('session_id') + '&length=' + $.urlParam('length') + '&version=' + $.urlParam('version') + '&cycle=' + $.urlParam('cycle') + '&exclude=' + exclude.join());

			$(this).addClass('right');

//		$('#overlay-correct').removeClass('hidden');
			setTimeout(initiate, 800);
		} else {
			$(this).addClass('wrong');

			//console.log($(this));
			//alert('Incorrect answer. Please try again!');
		}
	});

	$('.info').click(function(e) {
		$('#overlay-info').removeClass('hidden');
	});

	$('.close').click(function(e) {
		$('#overlay-info').addClass('hidden');
		timeStart = new Date().getTime();
	});

	// Initiate
	var exclude = ($.urlParam('exclude') ? $.urlParam('exclude').split(',') : new Array());
	var appId,
		attempt,
		correctTargetId,
		timeStart = null;

	initiate();
});
