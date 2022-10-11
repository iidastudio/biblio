wp.blocks.registerBlockVariation('core/group', [
  {
    name: 'vertical-rl-group',
    title: '縦書きグループ',
    description: '内部のブロックを縦書きにする。',
    icon: 'wordpress',
    attributes: {
      className: 'vertical-rl',
    },
    scope: ['transform'],
  }
]);