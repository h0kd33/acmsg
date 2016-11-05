window.quoteview = $('.quoteview');
var quotes = $('.quote');
function view(tid, floor) {
	var result = $.ajax({
	url: './getReply.php?tid='+tid+'&f='+floor,
	async: false
	});
	return result.responseText;
}
quoteview.mouseleave(function(){
	quoteview.stop().fadeOut(250);
});
quotes.mouseenter(function(ev){
	var e = ev||event;
	window.ctop = e.pageY;
	window.cleft = e.pageX;
	var
		re = />>(\d+)(?:>(\d+))?/,
		res = re.exec(this.innerText),
		tid = res[1],
		floor = typeof res[2]=='undefined'?0:res[2],
		newdiv = document.createElement('div');


	var cur_discus = $('.discussion[tid='+ tid +']');
	if (cur_discus.length>0) {
		var tmp_html = cur_discus.find('[floor=' + floor + ']').html();
	}
	if (typeof tmp_html == 'undefined') {
		var tmp_html = view(tid ,floor);
	}
	newdiv.setAttribute('class', 'reply');
	newdiv.setAttribute('style', 'margin:0');
	newdiv.innerHTML = tmp_html;
	quoteview.html('');
	quoteview.append(newdiv);
	quoteview.css('top', ctop).css('left', cleft).stop().fadeIn(250);
});
quotes.mouseleave(function(ev){
	var e = ev||event;
	top = e.pageY;
	left = e.pageX;
	if(top<window.ctop||left<window.cleft){
		quoteview.mouseleave();
	}
});