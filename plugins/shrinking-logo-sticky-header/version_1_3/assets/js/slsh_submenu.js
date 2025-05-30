document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.wp-block-navigation-submenu .wp-block-navigation-item__content').forEach(item => {
    item.addEventListener('click', function(e) {
      const toggle = e.target.closest('.wp-block-navigation-submenu');
      if (toggle) {
        e.preventDefault();
        const submenu = toggle.querySelector('.wp-block-navigation__submenu-container');
        submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
      }
    });
  });
});