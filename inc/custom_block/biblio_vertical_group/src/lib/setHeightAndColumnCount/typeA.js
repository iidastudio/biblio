import { extractUnit, isFloatClass, isJustToRight, imageJustToRight, removeTempSpacingElement } from './common';
import { isUserAgent } from 'biblio-helper';

export const typeA = ( target, forEdit ) => {

  const innerParent = target.children[0];

  // get inspector control max height
  const heightValue = target.dataset.biblioInitHeight;
  const controlHeight = parseInt(heightValue);
  const heightUnit = extractUnit(heightValue);

  // get block size
  const parentPaddingRight = parseInt(getComputedStyle(target).getPropertyValue('padding-right'));
  const parentPaddingInline = parseInt(getComputedStyle(target).getPropertyValue('padding-left')) + parentPaddingRight;
  const parentPaddingBlock = parseInt(getComputedStyle(target).getPropertyValue('padding-top')) + parseInt(getComputedStyle(target).getPropertyValue('padding-bottom'));
  const innerParentOffsetWidth = innerParent.offsetWidth;
  const innerParentRectLeft = innerParent.getBoundingClientRect().left;
  
  // init
  let childrenWidth = 0;
  let childrenMargin = 0;
  let childrenCrack = 0;
  let columnCount = 1;
  let lastChild;
  let prevImageRectBottom = 0;
  target.style.height = null;

  const children = Array.from(innerParent.children);
  const childrenReverse = children.reverse();

  // get last child
  for (let i = 0; i < childrenReverse.length; i++) {
    lastChild = childrenReverse[0];
  }

  // caluclate children width and margin
  for (let i = 0; i < children.length; i++) {
    const child = children[i];

    // child margin init
    child.style.marginBlockStart = null;
    child.style.marginBlockEnd = null;

    removeTempSpacingElement(innerParent, child);

    // 画像ブロック/動画ブロック/埋め込みブロックの右寄せ左寄せを除外する条件
    if (
      !child.classList.contains('block-list-appender') &&
      child.id !== 'biblio-temp-spacing-element' &&
      !isFloatClass(child)
    ) {
      // calc add children Width
      childrenWidth += child.offsetWidth;

      // calc add children margin
      const innerParentOffsetLeft = innerParent.offsetLeft;

      const childMarginBlockStart = parseInt(getComputedStyle(child)?.getPropertyValue('margin-block-start'));
      const childMarginBlockEnd = parseInt(getComputedStyle(child)?.getPropertyValue('margin-block-end'));
      
      // 前後の要素のmarginの相殺を考慮してmarginを加算
      // 前の要素があり、
      if (child.previousElementSibling && !isJustToRight(innerParent, child, forEdit) ) {
        const prevBlockMarginEnd = parseInt(getComputedStyle(child.previousElementSibling)?.getPropertyValue('margin-block-end'));
        if ( prevBlockMarginEnd < childMarginBlockStart ) {
          childrenMargin += childMarginBlockStart;
        }
      }

      if ( child.nextElementSibling && !isJustToRight(innerParent, child.nextElementSibling, forEdit) ) {
        const nextBlockMarginStart = parseInt(getComputedStyle(child.nextElementSibling)?.getPropertyValue('margin-block-start'));
        // 端にきたはみ出したmargin-blockをそのまま加算してしまうと計算がずれてしまうので、はみ出してない分だけを加算
        if ( nextBlockMarginStart <= childMarginBlockEnd ) {
          childrenMargin += childMarginBlockEnd;
        }
      }

      // 要素の左にできた余ったスペース幅を取得する
      if ( child.nextElementSibling !== null && !child.nextElementSibling.classList.contains('block-list-appender') ) {
        // const childOffsetLeft = child.offsetLeft;
        // const distanceLeft = childOffsetLeft - innerParentOffsetLeft;
        const childRectLeft = child.getBoundingClientRect().left;
        const distanceLeft = childRectLeft - innerParentRectLeft;
        const isNextJustToRight = isJustToRight(innerParent, child.nextElementSibling, forEdit);
        if ( isNextJustToRight ) {
          childrenCrack += distanceLeft;
        }
      }

    // 画像のあるカラムが下がった時の右マージンの調整
    } else if (
      isFloatClass(child)
    ) {

      // 画像ブロックが右端にきた際に右マージンを0にする
      imageJustToRight(innerParent, child);

      const innerParentRectBottom = innerParent.getBoundingClientRect().bottom;
      const imageRectBottom = child.getBoundingClientRect().bottom;
      const overhangHight = imageRectBottom - innerParentRectBottom;
      const parentHeight = target.getBoundingClientRect().height;
      if ( innerParentRectBottom < imageRectBottom && prevImageRectBottom < imageRectBottom) {
        target.style.height = parseInt(parentHeight + overhangHight) + 'px';
        prevImageRectBottom = imageRectBottom;
      }

      // ブラウザ幅が狭くなり親要素が画像より狭くなろうとした時に親要素の幅に画像サイズを合わせる
      child.style.width = null;
      const childOffsetWidth = child.offsetWidth;
      if ( innerParentOffsetWidth <= childOffsetWidth ) {
        child.style.width = '100%';
        child.style.marginBlockStart = 0;
        child.style.paddingBlockStart = 0;
      }
    }
    
  }

  console.log('width',childrenWidth, 'margin',childrenMargin, 'crack',childrenCrack)
  const totalchildrenWidth = childrenWidth + childrenMargin + childrenCrack;

  // calculate columnCount
  columnCount = Math.ceil( totalchildrenWidth / innerParentOffsetWidth );

  // calculate add column-gap
  const totalColumnGap = columnCount > 1 ? parseInt(getComputedStyle(innerParent).getPropertyValue('column-gap')) * (columnCount - 1) : 0;

  // calculate height and add styles
  let cssCalcHeight = totalchildrenWidth !== 0 ? `calc(${controlHeight * columnCount + heightUnit} + ${ totalColumnGap }px)` : null;

  innerParent.style.height = cssCalcHeight;
  innerParent.style.columnCount = columnCount;
}