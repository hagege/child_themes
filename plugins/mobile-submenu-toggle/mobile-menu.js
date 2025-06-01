document.addEventListener('click', (e) => {
  // Nur im geöffneten mobilen Menü reagieren
  const mobileMenu = document.querySelector('.wp-block-navigation__responsive-container.is-menu-open');
  if (!mobileMenu) return;

  // Prüfe, ob auf den Toggle-Button geklickt wurde
  const toggle = e.target.closest('.wp-block-navigation-submenu__toggle');
  // Prüfe, ob auf einen Menü-Link mit Submenü geklickt wurde
  const menuLink = e.target.closest('.wp-block-navigation-item__content');
  const parentSubmenu = menuLink && menuLink.parentElement.classList.contains('wp-block-navigation-submenu')
    ? menuLink.parentElement
    : null;

  // Fall 1: Klick auf Toggle
  if (toggle && mobileMenu.contains(toggle)) {
    e.preventDefault();
    e.stopImmediatePropagation();

    const submenu = toggle.closest('.wp-block-navigation-submenu');
    if (!submenu) return;

    submenu.classList.toggle('is-open');
    // Andere Untermenüs schließen
    mobileMenu.querySelectorAll('.wp-block-navigation-submenu').forEach(other => {
      if (other !== submenu) other.classList.remove('is-open');
    });
    return;
  }

  // Fall 2: Klick auf Link mit Submenü (nur im mobilen Menü)
  if (parentSubmenu && mobileMenu.contains(menuLink)) {
    e.preventDefault();
    e.stopImmediatePropagation();

    parentSubmenu.classList.toggle('is-open');
    // Andere Untermenüs schließen
    mobileMenu.querySelectorAll('.wp-block-navigation-submenu').forEach(other => {
      if (other !== parentSubmenu) other.classList.remove('is-open');
    });
    return;
  }
});

// Untermenüs initial zuklappen, sobald das mobile Menü geöffnet wird
const observer = new MutationObserver(() => {
  const mobileMenu = document.querySelector('.wp-block-navigation__responsive-container.is-menu-open');
  if (!mobileMenu) return;
  mobileMenu.querySelectorAll('.wp-block-navigation-submenu').forEach(submenu => {
    submenu.classList.remove('is-open');
  });
});
observer.observe(document.body, { childList: true, subtree: true });


