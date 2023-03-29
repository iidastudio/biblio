import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

export default function save() {
  console.log('hoge front');
	return (
		<p { ...useBlockProps.save() }>
			{ __(
				'Core Gallery Extend – hello from the saved content!',
				'core-gallery-extend'
			) }
		</p>
	);
}
