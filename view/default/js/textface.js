function addtext(){
	var
		face = $('#textface').val(),
		content = $('#content'),
		text = content.val();
	content.val(text + face);
}