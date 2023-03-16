import { render, useState, useEffect } from '@wordpress/element'
import {
  ToggleControl,
  TextControl,
  RangeControl
} from '@wordpress/components';
import api from '@wordpress/api';
import './admin.scss';

const Settings = () => {
  const [ showWritingFlag, setShowWritingFlag ] = useState( true );
  const [ showBookFlag, setShowBookFlag ] = useState( false );
  const [ text, setText ] = useState( 'ここにテキストが入ります' ); // テキスト
  const [ fontSize, setFontSize ] = useState( 16 );   

  useEffect( () => {
    api.loadPromise.then( () => {
      const model = new api.models.Settings();
      model.fetch().then( response => {
        setShowWritingFlag( Boolean( response.biblio_admin_show_writing_flg ) );
        setText( response.my_gutenberg_admin_plugin_text );
        setFontSize( response.my_gutenberg_admin_plugin_font_size );
      });
    });
  }, []);

  useEffect( () => {
    api.loadPromise.then( () => {
      const model = new api.models.Settings({
        'biblio_admin_show_writing_flg': showWritingFlag,
        'my_gutenberg_admin_plugin_text': text,
        'my_gutenberg_admin_plugin_font_size': fontSize
      });

      const save = model.save();

      save.success( ( response, status ) => {
        console.log( response );
        console.log( status );
      });
      save.error( ( response, status ) => {
        console.log( response );
        console.log( status );
      });
    });
  }, []);

  return (
    <>
      <h1>BIBLIO Settings</h1>
      <h2>カスタム投稿タイプの表示</h2>
      <ToggleControl
        label="執筆を有効にする"
        checked={ showWritingFlag }
        onChange={ () => setShowWritingFlag( ! showWritingFlag ) }
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
    </>
  );
};

render(
  <Settings />,
  document.getElementById('biblio-settings')
);