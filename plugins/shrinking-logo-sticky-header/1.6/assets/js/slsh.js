document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header.wp-block-template-part');
    if (!header) return; // Early return = Performance

    const cfg = window.slshConfig || {};
    const hideEnabled = !!cfg.hide;
    const threshold = cfg.sensitivity || 10;
    const delay = cfg.delay || 0;

    let ticking = false; // prevent throttling
    let lastY = window.scrollY;
    let timer = null;

    function menuIsOpen() {
        return document.documentElement.classList.contains('has-modal-open') ||
            document.body.classList.contains('has-modal-open') ||
            !!header.querySelector('.wp-block-navigation__responsive-container.is-menu-open');
    }

    function hideHeader() {
        // Do not hide while the menu is open or focus is inside the header (accessibility)
        if (header.matches(':focus-within') ||
            header.querySelector('.wp-block-navigation__responsive-container.is-menu-open')) {
            return;
        }
        header.classList.add('slsh-hidden');
    }

    // Remove stale focus from the menu close button after the navigation modal closes.
    let menuWasOpen = menuIsOpen();
    const menuObserver = new MutationObserver(function() {
        const menuOpen = menuIsOpen();
        if (menuWasOpen && !menuOpen && header.contains(document.activeElement)) {
            document.activeElement.blur();
        }
        menuWasOpen = menuOpen;
    });
    menuObserver.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class'],
        subtree: true
    });

    function update() {
        const y = window.scrollY;

        // Shrink logic (unchanged)
        if (y > 0.1) {
            header.classList.add('shrink');
        } else {
            header.classList.remove('shrink');
        }

        // Hide on scroll down, show on scroll up
        if (hideEnabled) {
            const diff = y - lastY;
            if (Math.abs(diff) >= threshold) {
                if (diff > 0 && y > header.offsetHeight) {
                    if (!timer && !header.classList.contains('slsh-hidden')) {
                        timer = setTimeout(function() {
                            hideHeader();
                            timer = null;
                        }, delay);
                    }
                } else if (diff < 0) {
                    clearTimeout(timer);
                    timer = null;
                    header.classList.remove('slsh-hidden');
                }
                lastY = y;
            }
            if (y <= 0) {
                clearTimeout(timer);
                timer = null;
                header.classList.remove('slsh-hidden');
            }
        }

        ticking = false;  // Reset for next scroll
    }

    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(update);
            ticking = true;  // Block further events
        }
    }, { passive: true });  // Performance optimisation
});
