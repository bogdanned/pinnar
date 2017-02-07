(function( $ ) {
	$(window).load(function () {
			
		$( "#eucnotice_dialog" ).dialog({
			modal: true, title: 'Subscribe Now', zIndex: 10000, autoOpen: true,
			width: '500', resizable: false,
			position: {my: "center", at:"center", of: window },
			dialogClass: 'dialogButtons',
			buttons: {
				Yes: function () {
					// $(obj).removeAttr('onclick');
					// $(obj).parents('.Parent').remove();
					var email_id = $('#txt_user_sub_eucnotice').val();
					var data = { 'action': 'add_plugin_user_eucnotice','email_id': email_id };
					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					$.post(ajaxurl, data, function(response) {
						$('#eucnotice_dialog').html('<h2>You have been successfully subscribed');
						$(".ui-dialog-buttonpane").remove();
					});
				},
				No: function () {
					var email_id = $('#txt_user_sub_eucnotice').val();
					var data = {'action': 'hide_subscribe_eucnotice',	'email_id': email_id };
					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					$.post(ajaxurl, data, function(response) { });
					$(this).dialog("close");
				}
			},
			close: function (event, ui) { $(this).remove(); }
		});
		
		$("div.dialogButtons .ui-dialog-buttonset button").removeClass('ui-state-default'); 
		$("div.dialogButtons .ui-dialog-buttonset button").addClass("button-primary woocommerce-save-button");
		$("div.dialogButtons .ui-dialog-buttonpane .ui-button").css("width","80px");
		
		$('.cw_txt_color_effect').wpColorPicker();
		$('.cw_box_color_effect').wpColorPicker();
		
		$('body').on('click','.cw_msg_position',function(){
			if($(this).is(":checked")) {
				if( $(this).attr('value') == 'fancybox' ) {
					$('.cw_sub_contain table.form-table .cw_cookie_animation_enable').hide( "slow" );
				} else {
					$('.cw_sub_contain table.form-table .cw_cookie_animation_enable').show( "slow" );
				}
			}
		});
		
		$('body').on('click','#cw_more_info_links',function(){
			if($(this).is(":checked")) {
		    	$(this).attr('value','1');
		    	$('table.form-table .cw_more_info').slideToggle( 'fast' );
		   	} else {
		   		$(this).attr('value','0');
		   		$('table.form-table .cw_more_info').slideToggle( 'fast' );
		   	}
		});
		$('body').on('click','.cw_page_custom_link',function(){
			if($(this).is(":checked")) {
				if( $(this).attr('value') == 'pages' ) {
					$('table.form-table .cw_custom_link_option').css('display','none');
					$('table.form-table .cw_page_link_option').slideDown( "slow" );
				} else {
					$('table.form-table .cw_custom_link_option').slideDown( "slow" );
					$('table.form-table .cw_page_link_option').css('display','none');
				}
			}
		});
		$('body').on('click','#cw_refuse_chk_btn',function(){
			if($(this).is(":checked")) {
		    	$(this).attr('value','1');
		    	$('table.form-table .cw_refuse_contain').slideToggle( 'fast' );
		   	} else {
		   		$(this).attr('value','0');
		   		$('table.form-table .cw_refuse_contain').slideToggle( 'fast' );
		   	}
		});
		$('body').on('click','#cw_refuse_on_scroll_btn',function(){
			if($(this).is(":checked")) {
		    	$(this).attr('value','1');
		    	$('table.form-table .cw_onscroll_contain').slideToggle( 'fast' );
		   	} else {
		   		$(this).attr('value','0');
		   		$('table.form-table .cw_onscroll_contain').slideToggle( 'fast' );
		   	}
		});
		$('body').on('click','#cw_deactivation_option',function(){
			if($(this).is(":checked")) {
		    	$(this).attr('value','1');
		   	} else {
		   		$(this).attr('value','0');
		   	}
		});
		$('body').on('click','.cw_msg_btn_style',function(){
			if($(this).is(":checked")) {
				if( $(this).attr('value') == 'none' ) {
					$('.cw_custom_button_style').show();
				} else {
					$('.cw_custom_button_style').hide();
				}
			}
		});
		
		$('body').on('click','#cw_reset_settings',function(){
			ajaxindicatorstart('Please wait..!!');
			jQuery.ajax({
			url: ajax_params.ajax_url,
				type: 'post',
				data: {
					action: 'cw_reset_settings',
					reset: 'test'
				},
				success: function( html ) {
					location.reload(true);
				}
			});
		});
		
		$('#tabscokkie').tabs();
		
	});
	
	function ajaxindicatorstart(text) {
			
		if($('body').find('#resultLoading').attr('id') != 'resultLoading'){
			$('body').append('<div id="resultLoading" style="display:none"><div><img src="'+ajax_params.ajax_icon+'"><div><span id="ajax-quote">'+text+'</div></div><div class="bg"></div></div>');
	
	
		} else {
	
			$('#ajax-quote').text(text);
		}
	
	
		$('#resultLoading').css({
			'width':'100%',
			'height':'100%',
			'position':'fixed',
			'z-index':'10000000',
			'top':'0',
			'left':'0',
			'right':'0',
			'bottom':'0',
			'margin':'auto'
		});
	
		$('#resultLoading .bg').css({
			'background':'#000000',
			'opacity':'0.7',
			'width':'100%',
			'height':'100%',
			'position':'absolute',
			'top':'0'
		});
	
		$('#resultLoading>div:first').css({
			'width': '250px',
			'height':'75px',
			'text-align': 'center',
			'position': 'fixed',
			'top':'0',
			'left':'0',
			'right':'0',
			'bottom':'0',
			'margin':'auto',
			'font-size':'16px',
			'z-index':'10',
			'color':'#ffffff'
	
		});
	
	    $('#resultLoading .bg').height('100%');
	       $('#resultLoading').fadeIn(300);
	    $('body').css('cursor', 'wait');
	}
	
	function ajaxindicatorstop() {
	
	    $('#resultLoading .bg').height('100%');
	    $('#resultLoading').fadeOut(300);
	    $('body').css('cursor', 'default');
	}
})( jQuery );