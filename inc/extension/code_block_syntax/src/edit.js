import { SelectControl, Panel, PanelBody } from '@wordpress/components';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor'
import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from "@wordpress/hooks";
import classNames from 'classnames';


export default function Edit( enableBlocks ) {

  const withInspectorControls = createHigherOrderComponent( ( BlockEdit ) => {
    return ( props ) => {
      if ( props.name !== enableBlocks ) {
        return <BlockEdit { ...props } />;
      }
      console.log(props);

      const { attributes, setAttributes } = props;

      const languageOptions = [
          { value: '', label: 'Select a language'},
          { value: 'html', label: 'HTML' },
          { value: 'css', label: 'CSS' },
          { value: 'javascript', label: 'JavaScript' },
      ];

      const setLangageClassName = ( value ) => {
        
        deleteLanguageClassName();

        const newClassNames = classNames(attributes.className,`language-${value}`);
        console.log(newClassNames);
        
        setAttributes({
          ...attributes,
          language: value,
          className: newClassNames,
        });
      }

      const deleteLanguageClassName = () => {
        const classNames = attributes.className.split(' ');
        const filteredClassNames = classNames.filter(className => !className.startsWith('language-')); // 'language-'で始まるクラス名をフィルターする
        attributes.className = filteredClassNames.join(' ');
      }

      console.log(attributes.className);

      return (
        <>
          <BlockEdit { ...props } />
          <InspectorControls>
            <Panel>
              <PanelBody title='Syntax Highlight'>
                <SelectControl
                  label={ "Language" }
                  value={ languageOptions.value }
                  options={ languageOptions }
                  onChange={ setLangageClassName }
                />
              </PanelBody>
            </Panel>
          </InspectorControls>
        </>
      );

    }
  }, 'withInspectorControls' );

  addFilter(
    'editor.BlockEdit',
    'biblio-extension/code-block-syntax/inspector-controls',
    withInspectorControls
  );

}