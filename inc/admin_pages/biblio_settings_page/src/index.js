import { render, useState, useEffect } from '@wordpress/element'
import {
  Panel,
  PanelBody,
  TabPanel,
  ToggleControl,
  TextControl,
  RangeControl,
  Button,
  Spinner
} from '@wordpress/components';
import api from '@wordpress/api';
import './admin.scss';

const Settings = () => {

  const defaultValues = {
    showWritingFlag: true,
    showBookFlag: true,
    text: 'ここにテキストが入ります',
    fontSize: 16,
  }

  const [ isLoading, setIsLoading ] = useState(true);
  const [ showWritingFlag, setShowWritingFlag ] = useState( defaultValues.showWritingFlag );
  const [ showBookFlag, setShowBookFlag ] = useState( defaultValues.showBookFlag );
  const [ text, setText ] = useState( defaultValues.text ); // テキスト
  const [ fontSize, setFontSize ] = useState( defaultValues.fontSize );

  useEffect( () => {
    api.loadPromise.then( () => {
      const model = new api.models.Settings();
      model.fetch().then( response => {
        setIsLoading(false);
        setShowWritingFlag( Boolean( response.biblio_admin_show_writing_flg ) );
        setShowBookFlag( Boolean( response.biblio_admin_show_book_flg ) );
        setText( response.my_gutenberg_admin_plugin_text );
        setFontSize( response.my_gutenberg_admin_plugin_font_size );
      });
    });
  }, []);

  const onClick = () => {
    api.loadPromise.then( () => {
      const model = new api.models.Settings({
        'biblio_admin_show_writing_flg': showWritingFlag,
        'biblio_admin_show_book_flg': showBookFlag,
        'my_gutenberg_admin_plugin_text': text,
        'my_gutenberg_admin_plugin_font_size': fontSize
      });

      const save = model.save();

      save.success( ( response, status ) => {
        console.log( response );
        console.log( status );
        location.reload();
      });
      save.error( ( response, status ) => {
        console.log( response );
        console.log( status );
      });
    });
  };

  const onResetClick = () => {
    setShowWritingFlag( defaultValues.showWritingFlag );
    setShowBookFlag( defaultValues.showBookFlag );
    setText( defaultValues.text );
    setFontSize( defaultValues.fontSize );
  };

  return (
    <>
      <h1>BIBLIO Settings</h1>
      <WaitLoading isLoading={ isLoading }>
        <ShowCustomType
          showWritingFlag = { showWritingFlag }
          showBookFlag = { showBookFlag }
          setShowWritingFlag = { setShowWritingFlag }
          setShowBookFlag = { setShowBookFlag }
        />
        <TextControl
          label="テキスト"
          value={ text }
          onChange={ ( value ) => setText( value ) }
        />
        <RangeControl
          label="文字サイズ"
          min="10"
          max="30"
          value={ fontSize }
          onChange={ ( value ) => setFontSize( value ) }
        />
        <Button
          variant='primary'
          children='初期化'
          onClick={ onResetClick }
        >
        </Button>
        <Button
          variant='primary'
          children='保存'
          onClick={ onClick }
        >
        </Button>
      </WaitLoading>
    </>
  );
};

const WaitLoading = ( { isLoading, children } ) => {
  if(isLoading) {
    return <> <Spinner /> </>
  }else {
    return children
  }
}

const ShowCustomType = ( { showWritingFlag, showBookFlag, setShowWritingFlag, setShowBookFlag } ) => {
  return (
    <>
      <h2>カスタム投稿タイプの表示</h2>
      <ToggleControl
        label="執筆を有効にする"
        checked={ showWritingFlag }
        onChange={ () => setShowWritingFlag( ! showWritingFlag ) }
      />
      <ToggleControl
        label="書籍を有効にする"
        checked={ showBookFlag }
        onChange={ () => setShowBookFlag( ! showBookFlag ) }
      />
    </>
  );
} 

render(
  <Settings />,
  document.getElementById('biblio-settings')
);