import { SelectControl } from '@wordpress/components';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor'

export default function Edit( { attributes, setAttributes }) {
  console.log('hoge');
  const withInspectorControls = createHigherOrderComponent( ( BlockEdit ) => {
    const { title, language } = attributes;
    const languageOptions = [
        { value: 'html', label: 'HTML' },
        { value: 'css', label: 'CSS' },
        { value: 'javascript', label: 'JavaScript' },
    ];

    return (
      <div { ...useBlockProps() }>
          <InspectorControls>
              <SelectControl
                  label={ title }
                  value={ language }
                  options={ languageOptions }
                  onChange={ ( value ) => setAttributes( { language: value } ) }
              />
          </InspectorControls>
      </div>
    );
  }, 'withInspectorControls' );

  addFilter(
      'editor.BlockEdit',
      'biblio-extension/code-block-syntax/inspector-controls',
      withInspectorControls
  );
}