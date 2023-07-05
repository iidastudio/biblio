import { isFloatClass, removeTempSpacingElement } from './common';

export const typeB = (target) => {

  const innerParent = target.children[0];
  // get inspector control max height
  const heightValue = target.dataset.biblioInitHeight;

  // init style
  innerParent.style.columnCount = null;
  innerParent.style.height = null;

  // 一度エディタで設定した高さをセットする
  innerParent.style.height = heightValue;
  const controlHeight = innerParent.clientHeight;

  const innerParentOffsetWidth = innerParent.offsetWidth;
  const innerParentRectTop = parseFloat(innerParent.getBoundingClientRect().top);

  // 最後の要素を取得
  let lastChild;
  const reverseChildren = Array.from(innerParent.children).reverse();
  for (let i = 0; i < reverseChildren.length; i++) {
    const child = reverseChildren[i];
    if (!child.classList.contains('block-list-appender')) {
      lastChild = child;
      break;
    }
  }
  const lastChildRectBottom = parseFloat(lastChild.getBoundingClientRect().bottom);

  const totalHeight = lastChildRectBottom - innerParentRectTop;
  const columnGap = parseInt(getComputedStyle(innerParent).getPropertyValue('column-gap'));
  const columnCount = Math.round((totalHeight + columnGap) / (controlHeight + columnGap));

  const children = Array.from(innerParent.children);
  for (let i = 0; i < children.length; i++) {
    const child = children[i];

    removeTempSpacingElement(innerParent, child);

    // floatしてる要素の処理
    if (isFloatClass(child)) {

      child.style.marginBlockStart = null;
      child.style.paddingBlockStart = null;

      const innerParentRectRight = innerParent.getBoundingClientRect().right;
      const childRectRight = child.getBoundingClientRect().right;
      const distanceRight = parseInt( innerParentRectRight - childRectRight );

      const childMarginBlockStart = parseInt(getComputedStyle(child)?.getPropertyValue('margin-block-start'));

      if ( distanceRight === childMarginBlockStart || distanceRight === 0 ) {
        child.style.marginBlockStart = 0;

        //　右マージンを0にしたときに段がずれてしまわないように要素を追加して仮想マージンを作る
        if ( child.previousElementSibling.id !== 'biblio-temp-spacing-element' ) {

          const createdTempSpacingElement = document.createElement('div');
          createdTempSpacingElement.id = 'biblio-temp-spacing-element';
          createdTempSpacingElement.className = 'wp-block-biblio-vertical-group__temp-spacing-element';
          createdTempSpacingElement.style.display = 'block';
          innerParent.insertBefore(createdTempSpacingElement, child);

        }
      }

      // 画像が親要素の外にはみ出した時に親要素の高さを追加する
      target.style.height = null;
      const parentMarginTop = parseInt(getComputedStyle(target)?.getPropertyValue('margin-bottom'));
      const parentPaddingTop = parseInt(getComputedStyle(target)?.getPropertyValue('padding-bottom'));
      const parentBorderTop = parseInt(getComputedStyle(target)?.getPropertyValue('border-bottom'));
      const parentMarginBottom = parseInt(getComputedStyle(target)?.getPropertyValue('margin-bottom'));
      const parentPaddingBottom = parseInt(getComputedStyle(target)?.getPropertyValue('padding-bottom'));
      const parentBorderBottom = parseInt(getComputedStyle(target)?.getPropertyValue('border-bottom'));
      const imageRectBottom = child.getBoundingClientRect().bottom
      const innerParentRectBottom = innerParent.getBoundingClientRect().top + totalHeight - parentMarginTop - parentPaddingTop - parentBorderTop - parentMarginBottom - parentPaddingBottom - parentBorderBottom;
      const overhangHight = imageRectBottom - innerParentRectBottom;
      if ( innerParentRectBottom < imageRectBottom ) {
        target.style.height = totalHeight + overhangHight + 'px';
      }

      // ブラウザ幅が狭くなり親要素が画像より狭くなろうとした時に親要素の幅に画像サイズを合わせる
      child.style.width = null;
      const childOffsetWidth = child.offsetWidth;
      if ( innerParentOffsetWidth <= childOffsetWidth ) {
        child.style.width = innerParentOffsetWidth + 'px';
        child.style.marginBlockStart = 0;
        child.style.paddingBlockStart = 0;
      }
    }
  }

  innerParent.style.columnCount = columnCount;
  innerParent.style.height = totalHeight + 'px';
}