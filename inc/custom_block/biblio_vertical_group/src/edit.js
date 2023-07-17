import { __ } from '@wordpress/i18n';
import { useRefEffect } from '@wordpress/compose';
import { useSelect } from '@wordpress/data';
import {
	InspectorControls,
	HeightControl, 
	InnerBlocks,
	useBlockProps,
	useInnerBlocksProps,
	store as blockEditorStore,
} from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { GroupEditControls } from './components/GroupEditControls';
import { targetObserver } from './lib/targetObserver';
import { setHeightAndColumnCount } from './lib/setHeightAndColumnCount';
import debounce from 'lodash.debounce';
import './editor.scss';

export default function Edit( { attributes, setAttributes, clientId } ) {
	
	const {
		allowedBlocks,
		templateLock,
		tagName: TagName = 'div' } = attributes;

	const hasInnerBlocks = useSelect(
		( select ) => {
			const block = select( blockEditorStore ).getBlock( clientId );
			return !! ( block && block.innerBlocks.length );
		},[ clientId ]
	);

	const ref = useRefEffect( ( target ) => {
		const forEdit = true;
		targetObserver( target, setHeightAndColumnCount, forEdit );
		window.addEventListener('resize', debounce(() => {
			setHeightAndColumnCount(target, forEdit);  
		}, 100));
	}, [attributes?.height] );

	const onHeightChange = ( value ) => {
		setAttributes( { ...attributes, height: value } );
	};

	const orientationOptions = [
		{ value: '', label: 'Select Orientation'},
		{ value: 'mixed', label: 'mixed' },
		{ value: 'upright', label: 'upright' },
		{ value: 'sideways', label: 'sideways' },
	];

	let customPropatyOrientation = 'biblio-text-orientation-mixed'

	const setTextOrientation = ( value ) => {
		setAttributes({ ...attributes, orientation: value });
	}

	const setTextOrientationClassName = () => {
		const textOrientationClassName = attributes.orientation ? `biblio-text-orientation-${attributes.orientation}` : "";
		return textOrientationClassName;
	}

	const blockProps = useBlockProps({
		ref,
		'data-biblio-init-height': attributes?.height
	});

	const innerBlocksProps = useInnerBlocksProps(
		{
			className: `wp-block-biblio-vertical-group__inner ${setTextOrientationClassName()}`,
		},
		{
			templateLock,
			allowedBlocks,
			renderAppender: hasInnerBlocks
				? InnerBlocks.DefaultBlockAppender
				: InnerBlocks.ButtonBlockAppender,
		}
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title="Vertical Text Settings">
					<HeightControl
							label="Max Height"
							value={ attributes.height }
							onChange={ onHeightChange }
					/>
					<SelectControl
						label={ "Text Orientation" }
						value={ attributes.orientation }
						options={ orientationOptions }
						onChange={ setTextOrientation }
					/>
				</PanelBody>
			</InspectorControls>
			<GroupEditControls
				tagName={ TagName }
				onSelectTagName={ ( value ) =>
					setAttributes( { tagName: value } )
				}
			/>
			<TagName {...blockProps}>
				<div {...innerBlocksProps} />
			</TagName>
		</>
	);
}
