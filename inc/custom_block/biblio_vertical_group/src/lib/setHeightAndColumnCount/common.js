import { isUserAgent } from 'biblio-helper';

/**
 * Extracts the unit from a value string.
 *
 * @param {string} value - The value string.
 * @returns {string|null} - The extracted unit, or null if not found.
 */
export const extractUnit = (value) => {
  const unitMatch = value?.match(/[a-z%]+$/i);
  if (unitMatch) {
    return unitMatch[0];
  }
  return null;
};


/**
 * Checks if the child element has the necessary classes for alignment.
 *
 * @param {HTMLElement} child - The child element.
 * @returns {boolean} - True if the child has the necessary classes, false otherwise.
 */
export const isFloatClass = (child) => {
  return child?.classList &&
  (child?.classList.contains('wp-block-image') || child?.classList.contains('wp-block-video')) &&
  (child?.classList.contains('alignleft') || child?.classList.contains('alignright'));
}

/**
 * Calculates the offset position of the first column for a child element within its parent container.
 * This function takes into account multiple columns if present.
 *
 * @param {HTMLElement} innerParent - The parent container element.
 * @param {HTMLElement} child - The child element for which to calculate the offset position.
 * @returns {number} - The offset position (right edge) of the first column for the child element.
 */
export const calcChildFirstColumnOffsetRight = (innerParent, child) => {

  let childFirstColumnOffsetRight = 0;
  const targetChild = child.id === 'biblio-temp-spacing-element' ? child.nextElementSibling.nextElementSibling : child;
  const innerParentOffsetWidth = innerParent.offsetWidth;
  const innerParentOffsetLeft = innerParent.offsetLeft;
  const innerParentOffsetRight = innerParentOffsetLeft + innerParentOffsetWidth;
  
  const childOffsetWidth = targetChild.offsetWidth;
  const childOffsetLeft = targetChild.offsetLeft;
  const childOffsetRight = childOffsetLeft + childOffsetWidth;

  if ( innerParentOffsetRight !== childOffsetRight ) {
  
    if ( innerParentOffsetRight >= childOffsetRight ) {
      // console.log('1段落しかない')
      return childFirstColumnOffsetRight = childOffsetRight;
    } else {
      const childLastColumnWidth = innerParentOffsetRight - childOffsetLeft;
      // 最後のカラムを要素の全体の幅から除外した幅
      const childLastColumnExclusionWidth = childOffsetWidth - childLastColumnWidth;
      const childColumnCount = childLastColumnExclusionWidth / innerParentOffsetWidth;

      if ( childColumnCount < 1 ) {
        // ('２段落以上ある。上下段のみ中途半端')
        return childFirstColumnOffsetRight = childLastColumnExclusionWidth + innerParentOffsetLeft - innerParentOffsetWidth;
      } else if ( Number.isInteger(childColumnCount) ) {
        // console.log('２段落以上ある。右端ぴったり');
        return childFirstColumnOffsetRight = childLastColumnExclusionWidth + innerParentOffsetLeft;
      } else {
        // console.log('２段落以上ある。');
        return childFirstColumnOffsetRight = (childLastColumnExclusionWidth + innerParentOffsetLeft) - innerParentOffsetWidth * Math.floor(childColumnCount);
      }
    }

  } else {
    // console.log('1段落しかない。右端ぴったり')
    return childFirstColumnOffsetRight = childOffsetRight;
  }
}


/**
 * Checks if the child element is placed attached to the right edge of the parent container.
 * This function takes into account multiple columns if present.
 *
 * @param {HTMLElement} innerParent - The parent container element.
 * @param {HTMLElement} child - The child element to be checked for alignment.
 * @param {boolean} forEdit - Flag indicating if the check is performed in an editor environment.
 * @returns {boolean} - True if the child is aligned just to the right, false otherwise.
 */
export const isJustToRight = (innerParent, child, forEdit ) => {

  const targetChild = child.id === 'biblio-temp-spacing-element' ? child.nextElementSibling.nextElementSibling : child;
  const parentpaddingleft = parseInt(getComputedStyle(innerParent.parentNode)?.getPropertyValue('padding-left'));
  const innerParentOffsetWidth = innerParent.offsetWidth;
  // editorとfrontでinnerParent.offsetLeftの値が違うため調整
  const innerParentOffsetLeft = forEdit ? innerParent.offsetLeft - parentpaddingleft : innerParent.offsetLeft;
  const innerParentOffsetRight = innerParentOffsetLeft + innerParentOffsetWidth;
  
  const childOffsetWidth = targetChild.offsetWidth;
  const childOffsetLeft = targetChild.offsetLeft;
  const childOffsetRight = childOffsetLeft + childOffsetWidth; // これはカラムが２段以上の場合要素の右端の位置（innerParentRectRightと同じ）になる

  // カラムが１段しかない
  if ( innerParentOffsetRight !== childOffsetRight ) {
  
    if ( innerParentOffsetRight >= childOffsetRight ) {
      return false;
    } else {
      const childLastColumnWidth = innerParentOffsetRight - childOffsetLeft;
      // 最後のカラムを要素の全体の幅から除外した幅
      const childLastColumnExclusionWidth = childOffsetWidth - childLastColumnWidth;
      const childColumnCount = childLastColumnExclusionWidth / innerParentOffsetWidth;

      if ( childColumnCount < 1 ) {
        return false;
      } else if ( Number.isInteger(childColumnCount) ) {
        return true;
      } else {
        return false;
      }
    }

  } else {
    return true;
  }

}


/**
 * Adjust the layout of the image block so that it is attached to the right edge of the parent container.
 * 
 * @param {HTMLElement} innerParent - The parent container element.
 * @param {HTMLElement} child - The image block element to be aligned to the right.
 */
export const imageJustToRight = (innerParent, child) => {

  child.style.marginBlockStart = null;
  child.style.paddingBlockStart = null;

  const innerParentRectRight = innerParent.getBoundingClientRect().right;
  const childRectRight = child.getBoundingClientRect().right;

  const distanceRight = parseInt( innerParentRectRight - childRectRight );

  const childMarginBlockStart = parseInt(getComputedStyle(child)?.getPropertyValue('margin-block-start'));

  // 画像ブロックのmarginBlockStartの代わりの要素を追加する
  // distanceRight === 0 重要 これがないとなぜかその後に処理する画面幅が縮んだ時の挙動がおかしくなる
  if ( distanceRight === childMarginBlockStart || distanceRight === 0) {

    child.style.marginBlockStart = 0;

    //　右マージンを0にしたときに段がずれてしまわないように要素を追加して仮想マージンを作る
    if ( child.previousElementSibling && child.previousElementSibling.id !== 'biblio-temp-spacing-element' ) {

      const createdTempSpacingElement = document.createElement('div');
      createdTempSpacingElement.id = 'biblio-temp-spacing-element';
      createdTempSpacingElement.className = 'wp-block-biblio-vertical-group__temp-spacing-element';
      createdTempSpacingElement.style.display = 'block';
      innerParent.insertBefore(createdTempSpacingElement, child);

    }
  }
}

/**
 * Removes the temporary spacing element, if it exists, added by the `imageJustToRight` function.
 *
 * @param {HTMLElement} innerParent - The parent container element.
 * @param {HTMLElement} child - The element to be checked for the temporary spacing element.
 */
export const removeTempSpacingElement = (innerParent, child) => {

  if ( child.id === 'biblio-temp-spacing-element' ) {
    const innerParentRectRight = innerParent.getBoundingClientRect().right;
    const childRectRight = child.nextElementSibling.getBoundingClientRect().right;
    const distanceRight = parseInt( innerParentRectRight - childRectRight );
    if ( isFloatClass(child.nextElementSibling) && distanceRight !== 0 ) {
      innerParent.removeChild(child);
    }
  }
}