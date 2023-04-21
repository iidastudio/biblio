wp.blocks.registerBlockVariation('core/group', [
  {
    name: 'vertical-rl-group',
    title: '縦書き',
    description: '内部のブロックを縦書きにする。',
    icon: 'wordpress',
    attributes: {
      namespace: 'vertical-rl-group',
      layout: { type: 'grid' },
    },
    isActive: ( block, variation ) =>
      block.layout?.type === 'grid' &&
      variation.namespace === 'vertical-rl-group',
    scope: ['transform', 'inserter', 'block']
  }
]);