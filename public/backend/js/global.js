var Url = (function(w){

	return {
		'get':function(){
			return $('meta[name=base_url]').attr('content');
		}
	}

})(window);

var Loader = (function(w, u){

	return {
		'show':function(){
			$('body').append(`<div class="loader"><i class="fa fa-circle-o-notch fa-spin fa-4x"></i></div>`);
			$('body').css('overflow', 'hidden');
		},
		'hide':function(){
			$('body').css('overflow', 'inherit');
			$('.loader').remove();
		}
	}

})(window, Url);

var Modal = (function(){

	$lmodal = {};

	$lmodal.open = function(url, options = null){
		return Request.get(url).then(function(response){
			if(response.status == true){
				Modal.close();
				$('body').append(response.modal);
				$('#myModal').modal();
			} else {
				// toastr.error('Error opening popup!');
			}
		});
	};

	$lmodal.close = function(){
		$('#myModal').modal('hide');
		$('#myModal').remove();
	}

	return $lmodal;

})(window, Request);

var Request = (function(w, u, $, l, m){

	$lrequest = {};

	$lrequest.get = function(url, params = null, options = null){

		return $.ajax({
			url:u.get()+url,
			type:'get',
			dataType: 'json',
			beforeSend:function(){
				l.show();
			},
			success:function(response){
				console.log(response);
			},
			complete:function(){
				l.hide();
			}
		});
	};

	$lrequest.post = function(url, params = null, options = null){

		return $.ajax({
			url:u.get()+url,
			type:'post',
			data:params,
			processData:false,
			contentType:false,
			dataType: 'json',
			beforeSend:function(){
				l.show();
			},
			success:function(response){
				console.log(response);
			},
			complete:function(){
				l.hide();
			}
		});
	};

	$lrequest.events = function(){
		$('form.ajax-submit').unbind().on('submit', function(e){

			var validated = true;

			if(!$(this).parsley({
				errorsWrapper: '<p class="text-danger parsley-error-list"></p>',
				errorTemplate: '<p class="parsley-error"></p>'
			}).validate()){
				return false;
			}

			e.preventDefault();
			var formdata = new FormData($(this)[0]);

			Request.post($(this).attr('action'), formdata).then(function(response){
				console.log(response);
			});
		});

		$('.open-modal').unbind().on('click', function(e){
			e.preventDefault();
			m.open($(this).attr('data-url'));
		});
	}

	return $lrequest;

})(window, Url, $, Loader, Modal);



Request.events();