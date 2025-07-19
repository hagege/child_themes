document.addEventListener('DOMContentLoaded', function() {
	const header = document.querySelector('header.wp-block-template-part');
	if (!header) return;
	window.addEventListener('scroll', function() {
		if (window.scrollY > 50) {
			header.classList.add('shrink');
		} else {
			header.classList.remove('shrink');
		}
	});
});

(function() {
  var lastScrollTop = 0;
  var header = document.querySelector('header.wp-block-template-part'); // Selektor für Header

  window.addEventListener('scroll', function() {
    var st = window.pageYOffset || document.documentElement.scrollTop;

    if (st > lastScrollTop && st > 50) {
      // Runterscrollen: Header ausblenden
      header.classList.add('hide-header');
    } else if (st < lastScrollTop) {
      // Hochscrollen: Header einblenden
      header.classList.remove('hide-header');
	  header.classList.add('show-header');
    }

    lastScrollTop = st <= 0 ? 0 : st; // scrollTop kann negativ sein (iOS)
  });
})();


