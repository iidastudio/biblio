// import { __ } from '@wordpress/i18n';
import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';

export default function save({ attributes }) {
	const { tagName: Tag, height, orientation } = attributes;

	const blockProps = useBlockProps.save(
		{
			'data-biblio-init-height': height
		}
	);
	const innerBlocksProps = useInnerBlocksProps.save();

	const textOrientationClassName = orientation ? `biblio-text-orientation-${orientation}` : "";

	const {className} = blockProps;
	const wpContainerClassMatch = className.match(/(?:^|\s)wp-container-\S+/);
	const wpContainerClass = wpContainerClassMatch ? wpContainerClassMatch[0] : '';
	const isLayoutFlowClass = className.includes('is-layout-flow') ? 'is-layout-flow' : '';
	const combinedClassName = `wp-block-biblio-vertical-group__inner ${textOrientationClassName} ${isLayoutFlowClass} ${wpContainerClass}`;

	const excludedClasses = [isLayoutFlowClass, wpContainerClass];
	const filteredClassName = className
		.split(' ')
		.filter((cls) => !excludedClasses.includes(cls))
		.join(' ');

	return (
		<Tag { ...blockProps } className={filteredClassName }>
			<div {...innerBlocksProps} className={combinedClassName} />
		</Tag>
	);
}