$.fn.leftScrollbar = function(){
	var items = $(this);
	$(function(){
		items.each(function(){
			var e = $(this);
			var content = e.html();
			var ie = !jQuery.support.boxModel;
			var w = e[ie?'innerWidth':'width'](), h = e[ie?'innerHeight':'height']();
			//calculate paddings
			var pad = {};
			$(['top', 'right', 'bottom', 'left']).each(function(i, side){
				pad[side] = parseInt(e.css('padding-' + side).replace('px',''));
			});
			//detect scrollbar width
			var xfill = $('<div>').css({margin:0, padding:0, height:'1px'});
			e.append(xfill);
			var contentWidth = xfill.width();
			var scrollerWidth = e.innerWidth() - contentWidth - pad.left - pad.right;
			e.html('').css({overflow:'hidden'});
			e.css('padding', '0');
			
			var poserHeight = h - pad.top - pad.bottom;
			var poser = $('<div>')
				.html('<div style="visibility:hidden">'+content+'</div>')
				.css({
					marginLeft: -w+scrollerWidth-(ie?0:pad.left*2),
					overflow: 'auto'
				})
				.height(poserHeight+(ie?pad.top+pad.bottom:0))
				.width(w);
			
			var pane = $('<div>')
				.html(content)
				.css({
					width: w-scrollerWidth-(ie?0:pad.right+pad.left),
					height: h-(ie?0:pad.bottom+pad.top),
					overflow: 'hidden',
					marginTop: -poserHeight-pad.top*2,
					marginLeft: scrollerWidth
				});
				
			$(['top', 'right', 'bottom', 'left']).each(function(i, side){
				 poser.css('padding-'+side, pad[side]);
				 pane.css('padding-'+side, pad[side]);
			});
			e.append(poser).append(pane);
			
			var hRatio = (pane.innerHeight()+pad.bottom) / poser.innerHeight();
			window.setInterval(function(){
				pane.scrollTop(poser.scrollTop()*hRatio);
			}, 15);
		});
	});
	return items;
};
