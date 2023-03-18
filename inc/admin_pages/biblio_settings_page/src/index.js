import { render, useState, useEffect } from '@wordpress/element'
import {
  Panel,
  PanelBody,
  TabPanel,
  TextControl,
  ToggleControl,
  RangeControl,
  Button,
  Spinner
} from '@wordpress/components';
import api from '@wordpress/api';
import './admin.scss';

const Settings = () => {

  const defaultValues = {
    showWritingFlg: true,
    showBookFlg: true,
    showInfoFlg: true,
    text: 'ここにテキストが入ります',
    fontSize: 16,
  }

  const [ isLoading, setIsLoading ] = useState(true);
  const [ showWritingFlg, setShowWritingFlg ] = useState( defaultValues.showWritingFlg );
  const [ showBookFlg, setShowBookFlg ] = useState( defaultValues.showBookFlg );
  const [ showInfoFlg, setShowInfoFlg ] = useState( defaultValues.showInfoFlg );
  const [ text, setText ] = useState( defaultValues.text ); // テキスト
  const [ fontSize, setFontSize ] = useState( defaultValues.fontSize );

  useEffect( () => {
    api.loadPromise.then( () => {
      const model = new api.models.Settings();
      model.fetch().then( response => {
        setIsLoading(false);
        setShowWritingFlg( Boolean( response.biblio_admin_show_writing_flg ) );
        setShowBookFlg( Boolean( response.biblio_admin_show_book_flg ) );
        setShowInfoFlg( Boolean( response.biblio_admin_show_info_flg ) );
        setText( response.my_gutenberg_admin_plugin_text );
        setFontSize( response.my_gutenberg_admin_plugin_font_size );
      });
    });
  }, []);

  const onSaveClick = () => {
    api.loadPromise.then( () => {
      const model = new api.models.Settings({
        'biblio_admin_show_writing_flg': showWritingFlg,
        'biblio_admin_show_book_flg': showBookFlg,
        'biblio_admin_show_info_flg': showInfoFlg,
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
    setShowWritingFlg( defaultValues.showWritingFlg );
    setShowBookFlg( defaultValues.showBookFlg );
    setShowInfoFlg( defaultValues.showInfoFlg );
    setText( defaultValues.text );
    setFontSize( defaultValues.fontSize );
  };

  const onSelect = ( tabName ) => {
    console.log( 'Selecting tab', tabName );
  };

  return (
    <>
      <h1>BIBLIO Settings</h1>
      <WaitLoading isLoading={ isLoading }>
        <TabPanel
          className="settings-tab-panels"
          activeClass="is-active"
          onSelect={ onSelect }
          tabs={ [
            {
              name: 'settings-1',
              title: '設置1',
              className: 'tab-settings-1'
            },
            {
              name: 'license',
              title: 'ライセンス',
              className: 'tab-license'
            },
          ] }
        >
          { (tab) => {
            switch (tab.name) {
              case 'settings-1':
                return (
                  <>
                    <ShowCustomType
                      showWritingFlg = { showWritingFlg }
                      showBookFlg = { showBookFlg }
                      setShowWritingFlg = { setShowWritingFlg }
                      setShowBookFlg = { setShowBookFlg }
                    />
                    <SaveButton
                      onSaveClick = { onSaveClick }
                      onResetClick= { onResetClick }
                    />
                  </>  
                );
              case 'license':
                return (
                  <div className="other-options">
                    <p>ここにその他のオプションの説明を記述します。</p>
                  </div>
                );
              default:
                return null;
            }
          }}        
        </TabPanel>
        {/* <TextControl
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
        /> */}
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

const ShowCustomType = ( { showWritingFlg, showBookFlg, setShowWritingFlg, setShowBookFlg, showInfoFlg, setShowInfoFlg } ) => {
  return (
    <Panel header="カスタム投稿タイプの表示">
      <PanelBody>
        <ToggleControl
          label="執筆を有効にする"
          checked={ showWritingFlg }
          onChange={ () => setShowWritingFlg( ! showWritingFlg ) }
        />
        <ToggleControl
          label="書籍を有効にする"
          checked={ showBookFlg }
          onChange={ () => setShowBookFlg( ! showBookFlg ) }
        />
        <ToggleControl
          label="お知らせを有効にする"
          checked={ showInfoFlg }
          onChange={ () => setShowInfoFlg( ! showInfoFlg ) }
        />
      </PanelBody>
    </Panel>
  );
} 

const SaveButton = ( { onResetClick, onSaveClick } ) => {
  return (
    <Panel>
      <PanelBody>
        <Button
          variant='primary'
          children='保存'
          onClick={ onSaveClick }
        >
        </Button>
        <Button
          variant='primary'
          children='初期化'
          onClick={ onResetClick }
        >
        </Button>
      </PanelBody>
    </Panel>
  );
}

render(
  <Settings />,
  document.getElementById('biblio-settings')
);