const { __ } = wp.i18n;
// console.log(__('pokapoka', 'biblio'));

const submenuToggleButtons = document.querySelectorAll('.wp-block-navigation__submenu-container .wp-block-navigation-submenu__toggle');

for (let i = 0; i < submenuToggleButtons.length; i++) {
  const toggleButton = submenuToggleButtons[i];

  // init span change to button
  toggleButton.setAttribute('aria-pressed', false);
  toggleButton.setAttribute('aria-label', __('Open the lower level page', 'biblio'));

  // toggle(class add is-opened)
  toggleButton.addEventListener("click", (e) => {
    e.preventDefault();
    toggleButton.classList.toggle("is-opened");

    const targetSubmenuContainer = toggleButton.nextElementSibling;
    targetSubmenuContainer.classList.toggle("is-opened");

    // accessibility change attribute
    let toggleState = toggleButton.getAttribute('aria-pressed');
    if (toggleState === 'false') {
      toggleButton.setAttribute('aria-pressed', true);
      toggleButton.setAttribute('aria-label', __('Close the lower level page', 'biblio'));
    } else if(toggleState === 'true') {
      toggleButton.setAttribute('aria-pressed', false);
      toggleButton.setAttribute('aria-label', __('Open the lower level page', 'biblio'));
    }
  })
}

const menuToggleButtons = document.querySelectorAll('.open-on-hover-click .wp-block-navigation-submenu__toggle');

for (let i = 0; i < menuToggleButtons.length; i++) {
  const menuToggle = menuToggleButtons[i];
  
  menuToggle.removeAttribute("aria-expanded");
}