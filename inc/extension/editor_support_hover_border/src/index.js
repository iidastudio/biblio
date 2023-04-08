import { registerPlugin } from '@wordpress/plugins';
import { PluginMoreMenuItem } from '@wordpress/edit-post';
import { withPluginContext } from '@wordpress/plugins';
import { PreferenceToggleMenuItem, store as preferencesStore } from '@wordpress/preferences';
import { useSelect } from '@wordpress/data';
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

const HoverBorder = () => {

  const isActive = useSelect(
		( select ) => !! select( preferencesStore ).get( "core/preferences", "biblio-hover-border-mode" ),
		[ "biblio-hover-border-mode" ]
	);

  const dataName = "[data-biblio-hover-border-data]";
  const existingStyle = document.querySelector(dataName);

  if (isActive && !existingStyle) {
    const styleElement = document.createElement('style');
    styleElement.dataset.biblioHoverBorderData = 'enable';
    styleElement.innerHTML = '.block-editor-block-list__block:hover { box-shadow: 0 0 0 1px var(--wp-admin-theme-color); }';
    document.head.appendChild(styleElement);
  } else if( !isActive && existingStyle ) {
    if (existingStyle) {
      existingStyle.remove();
    }
  }

  return (
    <HoverBorderPluginMoreMenuItem />
  );
};

registerPlugin( 'hover-border', { render: HoverBorder });