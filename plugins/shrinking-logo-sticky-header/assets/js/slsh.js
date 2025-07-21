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
  var ticking = false;
  var header = document.querySelector('header.wp-block-template-part');
  if (!header) return;

  function isFocusWithinHeader() {
    return header.contains(document.activeElement);
  }

  function updateHeaderVisibility() {
    var st = window.pageYOffset || document.documentElement.scrollTop;

    if (st > lastScrollTop && st > 50 && !isFocusWithinHeader()) {
      header.classList.add('hide-header');
      header.classList.remove('show-header');
	  // Do not set aria-hidden because the header is still in the DOM and is only hidden via transform.
	  // header.setAttribute('aria-hidden', 'true');
    } else if (st < lastScrollTop) {
      header.classList.remove('hide-header');
      header.classList.add('show-header');
	  // header.setAttribute('aria-hidden', 'false');
    }

    lastScrollTop = st <= 0 ? 0 : st;
    ticking = false;
  }

  window.addEventListener('scroll', function() {
    if (!ticking) {
      window.requestAnimationFrame(updateHeaderVisibility);
      ticking = true;
    }
  });

  // Optional: Also check when changing focus so that the header remains visible when focusing.
  header.addEventListener('focusin', function() {
    header.classList.remove('hide-header');
    header.classList.add('show-header');
  });
})();





