document.addEventListener('click', (e) => {
  // Initially close all submenus
  const mobileMenu = document.querySelector('.wp-block-navigation__responsive-container.is-menu-open');
  if (!mobileMenu) return;

  // Check whether the toggle button has been clicked
  const toggle = e.target.closest('.wp-block-navigation-submenu__toggle');
  // Check whether a menu link with a submenu has been clicked
  const menuLink = e.target.closest('.wp-block-navigation-item__content');
  const parentSubmenu = menuLink && menuLink.parentElement.classList.contains('wp-block-navigation-submenu')
    ? menuLink.parentElement
    : null;

  // Case 1: Click on Toggle
  if (toggle && mobileMenu.contains(toggle)) {
    e.preventDefault();
    e.stopImmediatePropagation();

    const submenu = toggle.closest('.wp-block-navigation-submenu');
    if (!submenu) return;

    submenu.classList.toggle('is-open');
    // Close other submenus
    mobileMenu.querySelectorAll('.wp-block-navigation-submenu').forEach(other => {
      if (other !== submenu) other.classList.remove('is-open');
    });
    return;
  }

  // Case 2: Click on link with submenu (only in mobile menu)
  if (parentSubmenu && mobileMenu.contains(menuLink)) {
    e.preventDefault();
    e.stopImmediatePropagation();

    parentSubmenu.classList.toggle('is-open');
    // Close other submenus
    mobileMenu.querySelectorAll('.wp-block-navigation-submenu').forEach(other => {
      if (other !== parentSubmenu) other.classList.remove('is-open');
    });
    return;
  }
});

// Close submenus initially as soon as the mobile menu is opened
const observer = new MutationObserver(() => {
  const mobileMenu = document.querySelector('.wp-block-navigation__responsive-container.is-menu-open');
  if (!mobileMenu) return;
  mobileMenu.querySelectorAll('.wp-block-navigation-submenu').forEach(submenu => {
    submenu.classList.remove('is-open');
  });
});
observer.observe(document.body, { childList: true, subtree: true });