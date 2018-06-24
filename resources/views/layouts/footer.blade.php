<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<script type="text/javascript">

	jQuery('.rpm-api-search-slug').on('input', function () {
		
		var input = jQuery(this);
		var valueHolder = jQuery( '#' + input.attr('rpm-api-input') );
		var list = jQuery( '#' + input.attr('rpm-api-list') );
		var resultId = input.attr('rpm-api-result-id');
		var resultHuman = input.attr('rpm-api-result-human');

		list.children().unbind();
		list.html('');
		
		jQuery.ajax({
			type: "GET",
			url: jQuery(this).attr('rpm-api'),
			data: {
				'string': jQuery(this).val()
			},
			success: function(data) {
				list.css('display', 'block');
				data.forEach(function (e) {
					var aux = jQuery('<li>' + e[resultHuman] + '</li>');
					list.append(aux);
					aux.bind('click', function() {
						input.val(e[resultHuman]);
						valueHolder.val(e[resultId]);
						list.css('display', 'none');
					});
				});
			},
			dataType: 'json'
		});
	});

	var removeCloudElement = function() {
		var me = jQuery(this);
		me.parent().append(jQuery('<input type="hidden" name="' + me.attr('rpm-delete') +'" value="'+ me.attr('rpm-input') +'" >'));
		me.remove();
		jQuery( '#' + me.attr('rpm-input') ).remove();
	};

	jQuery('.rpm-api-search-slug-cloud').on('input', function () {
		
		var input = jQuery(this);
		var list = jQuery( '#' + input.attr('rpm-api-list') );
		var resultId = input.attr('rpm-api-result-id');
		var resultHuman = input.attr('rpm-api-result-human');
		var cloud = jQuery( '#' + input.attr('rpm-api-cloud') );

		list.children().unbind();
		list.html('');
		
		jQuery.ajax({
			type: "GET",
			url: jQuery(this).attr('rpm-api'),
			data: {
				'string': jQuery(this).val()
			},
			success: function(data) {
				list.css('display', 'block');
				data.forEach(function (e) {
					var aux = jQuery('<li>'+e[resultHuman]+'</li>');
					list.append(aux);
					aux.bind('click', function() {
						list.css('display', 'none');
						input.val('');
						var cloudItem = jQuery('<button class="btn btn-primary rpm-badge" type="button" rpm-input="' + e[resultId] + '" rpm-delete="' + input.attr('rpm-api-input') + '_delete[]"><span>' + e[resultHuman] + '</span></button>');
						var cloudInput = jQuery('<input type="hidden" name="' + input.attr('rpm-api-input') +'[]" id="' + e[resultId] + '" value="' + e[resultId] + '">');
						cloud.append(cloudItem);
						cloud.append(cloudInput);
						cloudItem.bind('click', removeCloudElement);
					});
				});
			},
			dataType: 'json'
		});
	});

	jQuery('.rpm-api-cloud').children('.rpm-badge').bind('click', removeCloudElement);

	var removeListElement = function() {
		var item = jQuery(this).parents('.rpm-dynamic-list-item');
		item.css('display', 'none');
		item.children('.delete').val(1);
	};
	
	var addListElement = function() {
		var item = jQuery(this).parents('.rpm-dynamic-list-item');
		var itemContainer = item.parent();
		var clon = item.clone(true);

		clon.find('input[type=text]').val('');
		clon.find('input[type=radio]').prop('checked', false);
		clon.find('input[type=checkbox]').prop('checked', false);
		clon.find('textarea').val('');
		clon.find('.delete').val(-1);
		clon.find('.id').val(-1);

		itemContainer.append(clon);

		jQuery(this).unbind();
		jQuery(this).val('-');
		jQuery(this).bind('click', removeListElement)
	};

	jQuery('.plus').bind('click', addListElement);
	jQuery('.minus').bind('click', removeListElement);

</script>
<script type="text/javascript">
	var googleUser = {};
	  var startApp = function() {
	    gapi.load('auth2', function(){
	      // Retrieve the singleton for the GoogleAuth library and set up the client.
	      auth2 = gapi.auth2.init({
	        client_id: '{{ env('G_CLIENT_ID') }}',
	        cookiepolicy: 'single_host_origin',
	        // Request scopes in addition to 'profile' and 'email'
	        //scope: 'additional_scope'
	      });
	      attachSignin(document.getElementById('g-custom-btn'));
	    });
	  };

	  function attachSignin(element) {
	    console.log(element.id);
	    auth2.attachClickHandler(element, {},
	        function(googleUser) {
	          document.getElementById('token').value = googleUser.getAuthResponse().id_token;
	          document.getElementById('login').submit();
	        }, function(error) {
	          alert(JSON.stringify(error, undefined, 2));
	        });
	  }
	  startApp();
</script>