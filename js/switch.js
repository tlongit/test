onload = function() {
	var e, i = 0;
	while (e = document.getElementsByTagName ('B') [i++]) {
		if (e.className == 'switch') {
		e.onclick = function () {
			this.className = this.className == 'switch' ? 'switch off' : 'switch';
			this.nextSibling.className = this.className == 'switch' ? 'hide' : 'show';
			}
		}
	}
}