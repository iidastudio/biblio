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

      // ランゲージ名をたしたのと同じようにクラスもアトリビュート内のオブジェクトっぽいのでおなじようにセットアトリビュートでついかするひつようがありそう

      const setLangageClassName = ( value ) => {
        const newClassNames = classNames(attributes.className,`language-${attributes.language}`);
        console.log(newClassNames);
        setAttributes({
          ...attributes,
          language: value,
          className: newClassNames
        });
      }

      const deleteLanguageClassName = () => {

      }

      console.log(attributes);

      return (
        <>
          <BlockEdit { ...props } />
          <InspectorControls>
            <Panel>
              <PanelBody title='Syntax Highlight'>
                <SelectControl
                    label={ "Language" }
                    value={ attributes.language }
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