import { registerBlockType } from '@wordpress/blocks';
import './style.scss';

import Edit from './edit';
import save from './save';

const enableBlocks = 'core/code';
Edit(enableBlocks);
// save(enableBlocks);