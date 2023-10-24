import { isUserAgent } from 'biblio-helper';
import { typeA, typeB } from './setHeightAndColumnCount/index';

export const setHeightAndColumnCount = (target, forEdit) => {
  if ( isUserAgent('firefox')  ) {
    typeB(target, forEdit);
  } else {
    typeA(target, forEdit);
  }
}