import { registerBlockType } from '@wordpress/blocks';
import './style.scss';

import icon from './icon';
import metadata from './block.json';
import Edit from './edit';
import save from './save';

registerBlockType( metadata.name, {
	icon: {
		src: icon,
	},
	edit: Edit,
	save,
} );