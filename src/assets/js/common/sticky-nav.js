import { throttle } from './throttle.js';


//throttleでsticyNavの実行回数を間引き実行
document.addEventListener('scroll', () => {
  throttle(stickyNav,300);
});

const sticky = document.getElementsByClassName('js-sticky');
const header = document.getElementsByClassName('l-header');
const headerHight = header[0].clientHeight;
let flg = null;

const stickyNav = () => {
  // サイト最上部からのスクロール量を取得
  const current = document.documentElement.scrollTop || document.body.scrollTop;

    // flgをつけることでDOMの書き換え回数を最小限にする
    if (headerHight < current && (flg === "off" || flg == null) ) {
      sticky[0].classList.add('js-sticky--active');
      flg = "on";
    }else if(headerHight >= current && (flg === "on" || flg == null) ) {
      sticky[0].classList.remove('js-sticky--active');
      flg = "off";
    }
}

export { stickyNav };