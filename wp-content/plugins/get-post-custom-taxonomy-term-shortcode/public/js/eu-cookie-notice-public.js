(function( $ ) {
	$(window).load(function () {
		
		var getmegposition = $('.cw_message_notify_position').val();
		var getmeganimation = $('.cw_message_notify_animation').val();
		
		settimeintfadein = setInterval(function(){ $(".cw_message_box_fade").fadeIn( 1000 ); clearInterval(settimeintfadein); },100);
		settimeintslide = setInterval(function(){ $(".cw_message_box_slide").slideDown("slow"); clearInterval(settimeintslide); },100);
		
		var onscrollenable = $(".cw_hide_onscroll_enable").val();
		onscrollAmount ='';
		if( onscrollenable == '1' ) {
			
			var onscrollAmount = $(".cw_hide_onscroll_amount").val();
			var scrollaction = 0;
			$(window).scroll(function() {
			  
			  var scrollamount = $(window).scrollTop();
			  
			    if ( scrollaction == 0 && scrollamount >= onscrollAmount ) {
			    	
			    	scrollaction = 1;
			    	
			     	$.ajax({
						type: 'POST',
						url: ajax_params.ajax_url,
						async : false,
						data: {
							action : 'cw_cookie_noticebar_action',
							hideaction :'cookie_accepted'
						},
						success: function( response ) {
							
							if( getmegposition == 'fancybox') {
								$('.ca_open_dialogbox').dialog("close"); 
							} else {
								
								if( getmeganimation =='fade' ) {
									jQuery(".cw_message_box_fade").fadeOut( 1000 );
								} 
								
								if( getmeganimation =='slide' ) {
									jQuery(".cw_message_box_slide").slideUp("slow");
								}
								
								if( getmeganimation =='none' ) {
									jQuery(".cw_message_box_none").hide("slow");
								}
							}
								
						}
					});
					
			    }
			});
			
		}
		
		$('body').on('click','#cw_message_ok',function() {
			$.ajax({
				type: 'POST',
				url: ajax_params.ajax_url,
				async : false,
				data: {
					action : 'cw_cookie_noticebar_action',
					hideaction :'cookie_accepted'
				},
				success: function( response ) {
					
					if( getmegposition == 'fancybox') {
						$('.ca_open_dialogbox').dialog("close"); 
					} else {
						
						if( getmeganimation =='fade' ) {
							jQuery(".cw_message_box_fade").fadeOut( 1000 );
						} 
						
						if( getmeganimation =='slide' ) {
							jQuery(".cw_message_box_slide").slideUp("slow");
						}
						
						if( getmeganimation =='none' ) {
							jQuery(".cw_message_box_none").hide("slow");
						}
						
					}
					
				}
			});
		});
		
		$('body').on('click','#cw_message_refuse',function() {
			$.ajax({
				type: 'POST',
				url: ajax_params.ajax_url,
				async : false,
				data: {
					action : 'cw_cookie_noticebar_action',
					hideaction :'cookie_not_accepted'
				},
				success: function( response ) {
					
					if( getmegposition == 'fancybox') {
						$('.ca_open_dialogbox').dialog("close"); 
					} else {
						
						if( getmeganimation =='fade' ) {
							jQuery(".cw_message_box_fade").fadeOut( 1000 );
						} 
						
						if( getmeganimation =='slide' ) {
							jQuery(".cw_message_box_slide").slideUp("slow");
						}
						
						if( getmeganimation =='none' ) {
							jQuery(".cw_message_box_none").hide("slow");
						}
					}
				}
			});
		});
		
		$( ".ca_open_dialogbox" ).dialog({modal: true, title: 'EU Cookie Notice', zIndex: 10000, autoOpen: true,width: '600',height:'200', resizable: true,});
		
		$('form').each(function () {
	       var cmdcode = $(this).find('input[name="cmd"]').val();
	       var bncode = $(this).find('input[name="bn"]').val();
	
	       if (cmdcode && bncode) {
	           $('input[name="bn"]').val("Multidots_SP");
	       } else if ((cmdcode) && (!bncode)) {
	           $(this).find('input[name="cmd"]').after("<input type='hidden' name='bn' value='Multidots_SP' />");
	       }
	   });
		
	}); 
})( jQuery );
	