//===========================================================
// イベント処理の間引き
//===========================================================
let lastFunc;
let lastTime;
export const throttle = (fn, delay) => {
  if(!lastTime){
    fn(); //引数で読み込んだapperFncを実行
    lastTime = performance.now();
  } else {
    clearTimeout(lastFunc);
    lastFunc = setTimeout(() => {
      fn();
      lastTime = performance.now();
    }, delay - (performance.now() - lastTime));
  }
}