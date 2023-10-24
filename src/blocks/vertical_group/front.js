import { targetObserver } from './lib/targetObserver';
import { setHeightAndColumnCount } from "./lib/setHeightAndColumnCount";
import debounce from 'lodash.debounce';

window.onload = () => {
  const targets = document.querySelectorAll('.wp-block-biblio-vertical-group');
  const forEdit = false;
  
  targets.forEach((target) => {
    window.addEventListener('resize', debounce(() => {
      setHeightAndColumnCount(target, forEdit);  
    }, 100));
    targetObserver(target, setHeightAndColumnCount, forEdit);
  });
};