wp.blocks.registerBlockVariation('core/image', [
  {
    name: 'photo-image',
    title: 'フォトフレームイメージ',
    description: 'ポラロイドカメラで印刷したようなフレーム付き画像',
    icon: 'wordpress',
    attributes: {
      className: 'c-image-photo'
    },
    innerBlocks: [
      [ 'core/paragraph',
          {
              className: 'title-box__title',
              placeholder: 'タイトルをここに入力...',
          }
      ],
      [ 'core/group',
          {
              className: 'title-box__body',
          },
          [
              [ 'core/paragraph', { placeholder: 'コンテンツをここに入力...' } ]
          ],
      ],
    ],
    scope: ['inserter', 'transform'],
  },
]);