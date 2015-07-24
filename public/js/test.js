var pre = $('<pre>', {class: 'test-pre'}).text('Text in pre tag.      Tag working.')
	.css({'border-left': '3px solid grey', 'text-align': 'left'});

$('.wrapper').append(pre);
var _token = $('input[name=_token]').val();
/**
* Ajax Options
*/

var options = {
	method: "PUT",
	url: 'http://localhost/task/2',
	data: {
		'name': '',
		'description': 'NEW DESC 2',
		'type': 'Work',
		'due': 'Year',




		'_token': _token
	},
	dataType: 'jsonp',


	success: function(res) {
		try {
			pre.text(JSON.stringify($.parseJSON(res.responseText), undefined, 4));
		}
		catch (e) {
			console.log(e.stack);
			$('.wrapper').html(res || 'no response');
		}
	},
	error: function(res) {
		try {
			pre.text(JSON.stringify($.parseJSON(res.responseText), undefined, 4));
		}
		catch (e) {
			console.log(e.stack);
			$('.wrapper').html(res || 'no response');
		}
	}
}

$.ajax(options);