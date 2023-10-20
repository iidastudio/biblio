const { __ } = wp.i18n;

const submenuToggleButtons = document.querySelectorAll('.wp-block-navigation__submenu-container .wp-block-navigation-submenu__toggle');
const mobileMenuToggleButtons = document.querySelectorAll('.wp-block-navigation__container > .open-on-hover-click > .wp-block-navigation-submenu__toggle, .wp-block-page-list > .open-on-hover-click > .wp-block-navigation-submenu__toggle');

const handleToggleButton = (toggleButtons) => {

  for (let i = 0; i < toggleButtons.length; i++) {
    const toggleButton = toggleButtons[i];

    // init span change to button
    toggleButton.setAttribute('aria-pressed', false);
    toggleButton.setAttribute('aria-label', __('Open the lower level page', 'biblio'));
  
    // toggle(class add is-opened)
    toggleButton.addEventListener("click", (e) => {
      e.preventDefault();

      toggleButton.classList.toggle("is-opened");
      toggleButton.nextElementSibling.classList.toggle("is-opened");
  
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
}

handleToggleButton(submenuToggleButtons);

const openButtons = document.querySelectorAll('.wp-block-navigation__responsive-container-open');

openButtons.forEach(function(openButton) {
  openButton.addEventListener('click', function() {
    handleToggleButton(mobileMenuToggleButtons)
  });
});