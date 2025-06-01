document.addEventListener('DOMContentLoaded', () => {
  const mobileMenu = document.querySelector('.wp-block-navigation__responsive-container.is-menu-open');
  if (!mobileMenu) return;

  // Alle Untermenüs initial schließen
  mobileMenu.querySelectorAll('.wp-block-navigation-submenu').forEach(submenu => {
    submenu.classList.remove('is-open');
  });

  // Toggle-Logik
  mobileMenu.addEventListener('click', (e) => {
    const toggle = e.target.closest('.wp-block-navigation-submenu__toggle');
    if (!toggle) return;

    e.preventDefault();
    e.stopImmediatePropagation();
    
    const submenu = toggle.closest('.wp-block-navigation-submenu');
    submenu.classList.toggle('is-open');
    
    // Andere Untermenüs schließen
    mobileMenu.querySelectorAll('.wp-block-navigation-submenu').forEach(other => {
      if (other !== submenu) other.classList.remove('is-open');
    });
  });
});


