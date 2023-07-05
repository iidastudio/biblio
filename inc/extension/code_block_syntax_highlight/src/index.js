import { SelectControl, Panel, PanelBody } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor'
import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from "@wordpress/hooks";
import classNames from 'classnames';

const enableBlocks = 'core/code';

const withInspectorControls = createHigherOrderComponent( ( BlockEdit ) => {
  return ( props ) => {
    
    if ( props.name !== enableBlocks ) {
      return <BlockEdit { ...props } />;
    }

    const { attributes, setAttributes } = props;

    const languageOptions = [
        { value: '', label: 'Select a language'},
        { value: 'html', label: 'HTML' },
        { value: 'css', label: 'CSS' },
        { value: 'javascript', label: 'JavaScript' },
    ];

    const setLangageClassName = ( value ) => {

      deleteLanguageClassName();
      
      let newClassNames = attributes.className;

      if (value !== '') {
        newClassNames = classNames(attributes.className,`language-${value}`);
      }
      
      setAttributes({
        ...attributes,
        language: value,
        className: newClassNames,
      });
    }

    const deleteLanguageClassName = () => {
      const classNames = attributes?.className?.split(' ');
      const filteredClassNames = classNames?.filter(className => !className.startsWith('language-')); // 'language-'で始まるクラス名をフィルターする
      attributes.className = filteredClassNames?.join(' ');
    }
    console.log('hogehoge');

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