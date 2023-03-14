import { render, useState } from '@wordpress/element'
import {
  ToggleControl,
  TextControl,
  RangeControl
} from '@wordpress/components';
import api from '@wordpress/api';
import './admin.scss';

console.log('hogehoge');

const Settings = () => {
  const [ showWritingFlag, setShowWritingFlag ] = useState( true );
  const [ showBookFlag, setShowBookFlag ] = useState( true );

  api.loadPromise.then( () => {
    // Modelの生成
    const model = new api.models.Settings();

    // 設定値の取得
    model.fetch().then( response => {
        console.log( response );
    });
  });

  return (
    <>
      <h1>BIBLIO Settings</h1>
      <h2>カスタム投稿タイプの表示</h2>
      <ToggleControl
        label="執筆を有効にする"
        checked={ showWritingFlag }
        onChange={ () => setShowWritingFlag( ! showWritingFlag ) }
      />
      <TextControl label="テキスト" />
      <RangeControl label="文字サイズ" min="10" max="30"/>
    </>
  );
};

render(
  <Settings />,
  document.getElementById('biblio-settings')
);