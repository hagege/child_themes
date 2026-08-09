document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header.wp-block-template-part');
    if (!header) return; // Early return = Performance
    
    let ticking = false; // prevent throttling
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(function() {
                if (window.scrollY > 0.1) {
                    header.classList.add('shrink');
                } else {
                    header.classList.remove('shrink');
                }
                ticking = false;  // Reset for next scroll
            });
            ticking = true;  // Block further events
        }
    }, { passive: true });  // Performance optimisation
});