$().ready(function(){				
	$('.hover').hover(							
		function()
		{
			//$(this).css('background-color':'#F7F6F0');
			//$(this).css({'background-color' : '#F7F6F0'});

			//alert(val);
			//$('#quick-tool-'+val).removeClass("hide");
			$('#line1').css({'border-top' : '1px #fdae2f solid','border-bottom' : '1px #fdae2f solid'});
		},
		function()
		{			
			//$(this).css({'background-color' : '#F2F1EE'});
			
			//$('#quick-tool-'+val).addClass("hide");
			$('#line1').css({'border-bottom' : '1px #d6d6d6 solid','border-top' : '0' });
		}
	);
})