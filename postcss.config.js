import autoprefixer from 'autoprefixer';
import * as postcssPxtorem  from 'postcss-pxtorem';
const pxtorem = postcssPxtorem.default;

export default {
  plugins: [
    autoprefixer(),
    pxtorem({
      rootValue: 16,
      propList: ['font-size', '--font-size*', '--spacing*', '--block-gap*'],
      selectorBlackList: []
    }),
  ]
}