const { __ } = wp.i18n;
// const targetStyles = [

// ]

const submenuToggleButtons = document.querySelectorAll('.wp-block-navigation__submenu-container .wp-block-navigation-submenu__toggle');
const mobileMenuToggleButtons = document.querySelectorAll('.wp-block-navigation__container > .open-on-hover-click > .wp-block-navigation-submenu__toggle, .wp-block-page-list > .open-on-hover-click > .wp-block-navigation-submenu__toggle');
const submenuHaschildItems = document.querySelectorAll('.wp-block-navigation__submenu-container .wp-block-navigation-item.has-child.open-on-hover-click');

let mobileMenuListenersAdded = false;

// ホバーによるaria-expandedの停止
document.addEventListener('DOMContentLoaded', function () {
  submenuHaschildItems.forEach(haschildItem => {
    haschildItem.addEventListener('mouseenter', (e) => {
      e.stopImmediatePropagation(); // ホバーイベントを無効化
    });

    haschildItem.addEventListener('mouseleave', (e) => {
      e.stopImmediatePropagation(); // ホバーイベントを無効化
    });
  });
  
});

// トグルボタンの状態を切り替える関数
const toggleButtonState = (button) => {
  const isOpened = button.classList.toggle("is-opened");
  const siblingMenu = button.nextElementSibling;
  if (siblingMenu) siblingMenu.classList.toggle("is-opened", isOpened);
  console.log("hoge");
  // accessibility attributeの更新
  button.setAttribute('aria-expanded', isOpened);
  button.setAttribute('aria-label', isOpened ? __('Close the lower level page', 'biblio') : __('Open the lower level page', 'biblio'));
};

// トグルボタンにイベントリスナーを追加する関数
const handleToggleButton = (toggleButtons) => {
  toggleButtons.forEach(toggleButton => {
    // イベントリスナーがすでに追加されているか確認
    if (toggleButton.dataset.listenerAdded) return;

    // 初期化
    toggleButton.setAttribute('aria-expanded', false);
    toggleButton.setAttribute('aria-label', __('Open the lower level page', 'biblio'));

    // イベントリスナーを追加
    toggleButton.addEventListener("click", (e) => {
      e.stopImmediatePropagation(); // ホバーイベントを無効化
      toggleButtonState(toggleButton);
    });
    
    // イベントリスナーが追加されたことをマーク
    toggleButton.dataset.listenerAdded = 'true';
  });
};

// 初回ロード時にサブメニューボタンのイベントリスナーを追加
handleToggleButton(submenuToggleButtons);


//-------------------------------------------------
// モバイル用のナビゲーションのトグル処理
//-------------------------------------------------
const openButtons = document.querySelectorAll('.wp-block-navigation__responsive-container-open');

openButtons.forEach((openButton) => {
  openButton.addEventListener('click', () => {
    // モバイルメニューのトグルボタンのイベントリスナーを一度だけ追加
    if (!mobileMenuListenersAdded) {
      handleToggleButton(mobileMenuToggleButtons);
      mobileMenuListenersAdded = true;
    }
  });
});
