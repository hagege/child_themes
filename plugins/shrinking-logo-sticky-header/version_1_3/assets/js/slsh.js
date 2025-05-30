document.addEventListener('DOMContentLoaded', function() {
	const header = document.querySelector('header.wp-block-template-part');
	if (!header) return;
	window.addEventListener('scroll', function() {
		if (window.scrollY > 100) {
			header.classList.add('shrink');
		} else {
			header.classList.remove('shrink');
		}
	});
});
