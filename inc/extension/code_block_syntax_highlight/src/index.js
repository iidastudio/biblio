import { SelectControl, Panel, PanelBody, ToggleControl } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor'
import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from "@wordpress/hooks";
import classNames from 'classnames';

const enableBlock = 'core/code';

const withInspectorControls = createHigherOrderComponent( ( BlockEdit ) => {
  return ( props ) => {
    
    if ( props.name !== enableBlock ) {
      return <BlockEdit { ...props } />;
    }

    const { attributes, setAttributes } = props;

    const languageOptions = [
        { value: '', label: 'Select a language'},
        { value: 'html', label: 'HTML' },
        { value: 'css', label: 'CSS' },
        { value: 'scss', label: 'Sass (SCSS)' },
        { value: 'php', label: 'PHP' },
        { value: 'javascript', label: 'JavaScript' },
        { value: 'typescript', label: 'TypeScript' },
        { value: 'jsx', label: 'React JSX' },
        { value: 'tsx', label: 'React TSX' },
        { value: 'python', label: 'Python' },
        { value: 'git', label: 'Git' },
        { value: 'shell', label: 'Shell' },
    ];

    const setLangageClassName = ( value ) => {

      let newClassNames = attributes.className;
      if (value !== '') {
        newClassNames = classNames(attributes.className,`language-${value}`);
      }
      setAttributes({
        ...attributes,
        language: value,
      });
    }

    const setLineNumberClassName = ( value ) => {

      setAttributes({
        ...attributes,
        linenumber: !attributes.linenumber
      });
    }

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
              <ToggleControl
                checked={ attributes.linenumber }
                label="Show Line Number"
                onChange={ setLineNumberClassName }
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


const registerBlockType = (settings, name) => { 
  if ( name !== enableBlock ) {
    return settings;
  }
console.log(settings)
  settings = {
    ...settings, attributes: {
      ...settings.attributes,
      language: {
        type: 'string',
        default: ''
      },
      linenumber: {
        type: 'boolean',
        default: false
      }
    }
  };

  return settings;
}
addFilter(
  'blocks.registerBlockType',
  'code-block-syntax-highlight/set-classname/register-block-type',
  registerBlockType
);


// styleをブロックにセットする
const setClassName = createHigherOrderComponent( ( BlockListBlock ) => {
  return ( props ) => {
    const { attributes, block } = props;

    if ( block.name !== enableBlock ) {
      return <BlockListBlock { ...props } />;
    }

    const languageClass = attributes.language !== "" ? `language-${attributes.language}` : "";
    const linenumberClass = attributes.linenumber === true ? "line-numbers" : "";

    return <BlockListBlock { ...props } className={ `${languageClass} ${linenumberClass}`} />;
  }
}, 'setClassName');
addFilter( 'editor.BlockListBlock', 'biblio-extension/code-block-syntax-highlight/set-classname' , setClassName );



// フロント側のカスタマイズ
function saveSetClassName ( extraProps, blockType, attributes ) {
  if ( blockType.name !== enableBlock ) {
    return extraProps;
  }

  const languageClass = attributes.language !== "" ? `language-${attributes.language}` : "";
  const linenumberClass = attributes.linenumber === true ? "line-numbers" : "";

  console.log(attributes)
  const newExtraProps = {
    // ...extraProps,
    className: `${extraProps.className} ${languageClass} ${linenumberClass}`,
  }

  return newExtraProps;
}
addFilter(
  'blocks.getSaveContent.extraProps',
  'biblio-extension/code-block-syntax-highlight/save-set-classname',
  saveSetClassName
);