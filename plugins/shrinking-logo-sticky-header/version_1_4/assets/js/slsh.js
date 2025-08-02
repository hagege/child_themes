document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header.wp-block-template-part');
    if (!header) return;
    
    let lastScrollY = window.scrollY;
    let lastScrollTop = 0;
    let ticking = false;
    let isMenuOpen = false;
    
    // Prüfen ob Hide-Header Option aktiviert ist
    const hideHeaderEnabled = document.body.classList.contains('slsh-hide-header-enabled');
    
    // Funktion zum Prüfen ob Focus innerhalb des Headers ist
    function isFocusWithinHeader() {
        return header.contains(document.activeElement);
    }
    
    // Funktion zum Prüfen ob Off-Canvas Menü offen ist
    function isOffCanvasOpen() {
        const navContainer = document.querySelector('.wp-block-navigation__responsive-container');
        const toggleButton = document.querySelector('.wp-block-navigation__responsive-container-open');
        
        return (navContainer && navContainer.classList.contains('is-menu-open')) || 
               (toggleButton && toggleButton.getAttribute('aria-expanded') === 'true') ||
               isMenuOpen;
    }
    
    // Hauptfunktion für Header-Updates
    function updateHeader() {
        const currentScrollY = window.scrollY;
        
        // Shrinking Logic - immer aktiv
        if (Math.abs(currentScrollY - lastScrollY) > 5) {
            if (currentScrollY > 100) {
                header.classList.add('shrink');
            } else {
                header.classList.remove('shrink');
            }
            lastScrollY = currentScrollY;
        }
        
        // Hide/Show Logic - nur wenn aktiviert und Off-Canvas nicht offen
        if (hideHeaderEnabled && !isOffCanvasOpen()) {
            if (currentScrollY > lastScrollTop && currentScrollY > 50 && !isFocusWithinHeader()) {
                header.classList.add('hide-header');
                header.classList.remove('show-header');
            } else if (currentScrollY < lastScrollTop || currentScrollY <= 50) {
                header.classList.remove('hide-header');
                header.classList.add('show-header');
            }
            
            lastScrollTop = currentScrollY <= 0 ? 0 : currentScrollY;
        }
        
        ticking = false;
    }
    
    // Scroll Event Listener
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(updateHeader);
            ticking = true;
        }
    }, { passive: true });
    
    // Erweiterte Off-Canvas Detection und Header-Management
    if (hideHeaderEnabled) {
        // Focus Event - Header sichtbar machen
        header.addEventListener('focusin', function() {
            header.classList.remove('hide-header');
            header.classList.add('show-header');
        });
        
        // Mobile Menu Button Click Detection
        document.addEventListener('click', function(e) {
            const menuButton = e.target.closest('.wp-block-navigation__responsive-container-open, .wp-block-navigation__responsive-container-close');
            
            if (menuButton) {
                // Kurze Verzögerung um DOM-Updates abzuwarten
                setTimeout(() => {
                    const navContainer = document.querySelector('.wp-block-navigation__responsive-container');
                    if (navContainer && navContainer.classList.contains('is-menu-open')) {
                        isMenuOpen = true;
                        header.classList.remove('hide-header');
                        header.classList.add('show-header');
                    } else {
                        isMenuOpen = false;
                    }
                }, 50);
            }
        });
        
        // Escape Key Detection (schließt oft Off-Canvas Menüs)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                setTimeout(() => {
                    isMenuOpen = false;
                }, 100);
            }
        });
        
        // Mutation Observer für Navigation Container
        const navContainer = document.querySelector('.wp-block-navigation__responsive-container');
        if (navContainer) {
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes') {
                        const isOpen = navContainer.classList.contains('is-menu-open') || 
                                     navContainer.classList.contains('has-modal-open');
                        
                        if (isOpen) {
                            isMenuOpen = true;
                            header.classList.remove('hide-header');
                            header.classList.add('show-header');
                        } else {
                            // Kleine Verzögerung vor dem Zurücksetzen
                            setTimeout(() => {
                                isMenuOpen = false;
                            }, 300);
                        }
                    }
                });
            });
            
            observer.observe(navContainer, {
                attributes: true,
                attributeFilter: ['class', 'aria-hidden', 'style']
            });
        }
        
        // Zusätzlicher Observer für den Toggle Button
        const toggleButton = document.querySelector('.wp-block-navigation__responsive-container-open');
        if (toggleButton) {
            const buttonObserver = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'aria-expanded') {
                        const isExpanded = toggleButton.getAttribute('aria-expanded') === 'true';
                        if (isExpanded) {
                            isMenuOpen = true;
                            header.classList.remove('hide-header');
                            header.classList.add('show-header');
                        }
                    }
                });
            });
            
            buttonObserver.observe(toggleButton, {
                attributes: true,
                attributeFilter: ['aria-expanded']
            });
        }
        
        // Overlay Click Detection (schließt Off-Canvas)
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('wp-block-navigation__responsive-dialog-overlay')) {
                setTimeout(() => {
                    isMenuOpen = false;
                }, 100);
            }
        });
    }
});