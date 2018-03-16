var o = {
	init: function(){
		this.diagram();
	},
	random: function(l, u){
		return Math.floor((Math.random()*(u-l+1))+l);
	},
	diagram: function(){
		var r = Raphael('diagram', 320, 320),
			rad = 73,
			defaultText = "Overall",
			value1="52.15" 
			speed = 250;
		
		r.circle(160, 160, 85).attr({ stroke: 'none', fill: '#f1f1f1' });
		// r.path().attr({ id: 'none'});
		
		var title = r.text(160, 160,defaultText + '\n' + value1 + '%').attr({
			font: '20px Arial',
			fill: '#4d4d4d',
		}).toFront();
		
		r.customAttributes.arc = function(value, color, rad){
			var v = 3.6*value,
				alpha = v == 360 ? 359.99 : v,
				random = o.random(90, 90),
				a = (random-alpha) * Math.PI/180,
				b = random * Math.PI/180,
				sx = 160 + rad * Math.cos(b),
				sy = 160 - rad * Math.sin(b),
				x = 160 + rad * Math.cos(a),
				y = 160 - rad * Math.sin(a),
				path = [['M', sx, sy], ['A', rad, rad, 0, +(alpha > 180), 1, x, y]];
			return { path: path, stroke: color }
		}
		
		$('.get').find('.arc').each(function(i){
			var t = $(this), 
				color = t.find('.color').val(),
				value = t.find('.percent').val(),
				text = t.find('.text').text();
				// ids = t.attr('id','')
			rad += 30;	
			var z = r.path().attr({ arc: [value, color, rad], 'stroke-width': 26 });
			
			z.mouseover(function(){
                this.animate({ 'stroke-width': 50, opacity: .6 }, 1000, 'elastic');
                if(Raphael.type != 'VML') //solves IE problem
				this.toFront();
				title.stop().animate({ opacity: 0 }, speed, '>', function(){
					this.attr({ text: text + '\n' + value + '%' }).animate({ opacity: 1 }, speed, '<');
				});
            }).mouseout(function(){
				this.stop().animate({ 'stroke-width': 26, opacity: 1 }, speed*4, 'elastic');
				title.stop().animate({ opacity: 0 }, speed, '>', function(){
					title.attr({ text: defaultText + '\n' + value1 + '%' }).animate({ opacity: 1 }, speed, '<');
				});	
            });
		});
		
	}
}
$(function(){ o.init(); });
