import { registerPlugin, withPluginContext } from '@wordpress/plugins';
import { PluginMoreMenuItem } from '@wordpress/edit-post';
import { PreferenceToggleMenuItem, store as preferencesStore } from '@wordpress/preferences';
import { useSelect } from '@wordpress/data';
import { useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

const HoverBorderToggleMenuItem = () => {
  return (
    <PreferenceToggleMenuItem
      label="Hover border mode"
      info="ブロック編集の視覚サポート"
      scope="core/preferences"
      name="biblio-hover-border-mode"
    />
  );
};



const HoverBorderPluginMoreMenuItem = withPluginContext( ( context ) => ( {
  as: HoverBorderToggleMenuItem,
} ) )( PluginMoreMenuItem );


const createHoverBorderStyle = () => {
  const styleElement = document.createElement('style');
  styleElement.dataset.biblioHoverBorder = 'enable';
  const addStyle = `
.block-editor-block-list__layout .block-editor-block-list__block:hover::after {
border-radius: 1px;
bottom: 1px;
box-shadow: 0 0 0 var(--wp-admin-border-width-focus) var(--wp-admin-theme-color);
content: "";
left: 1px;
outline: 2px solid transparent;
pointer-events: none;
position: absolute;
right: 1px;
top: 1px;
z-index: 1;
}
  `;

  styleElement.insertAdjacentHTML('beforeend', addStyle);
  return styleElement;
}

const getIframeBody = () => {
  const iframe = document.querySelector('iframe[name="editor-canvas"]');
  const iframeDoc = iframe?.contentWindow.document;
  const iframeBody = iframeDoc?.querySelector('head');
  return iframeBody;
};

const HoverBorder = () => {

  // この機能がオンかオフか
  const isActive = useSelect(
		( select ) => !! select( preferencesStore ).get( "core/preferences", "biblio-hover-border-mode" ),
		[ "biblio-hover-border-mode" ]
	);

  const dataName = "[data-biblio-hover-border]";

  // Gutenbergプラグインが有効化されているか判定（Editor_Support_Hover_Boderからwp_localize_scriptを使用して取得）
  const hasIframe = !! document.querySelector("iframe[name='editor-canvas']");
  console.log(hasIframe);

  // Gutenberg有効時（iframe使用のため分岐）
  if (hasIframe) {

    const iframeBody = getIframeBody();
    const existingStyle = iframeBody?.querySelector(dataName);

    if (isActive && !existingStyle ) {
      const hoverBorderStyle = createHoverBorderStyle();
      iframeBody?.appendChild(hoverBorderStyle);
    } else if ( !isActive && existingStyle ) {
      existingStyle.remove();
    }

  // Gutenberg無効時
  } else {

    const existingStyle = document.querySelector(dataName);
    if ( isActive  && !existingStyle ) {
      const hoverBorderStyle = createHoverBorderStyle();
      document.head.appendChild(hoverBorderStyle);
    } else if ( !isActive && existingStyle ) {
      existingStyle.remove();
    }

  }

  return (
    <HoverBorderPluginMoreMenuItem />
  );
};

registerPlugin( 'hover-border', { render: HoverBorder });