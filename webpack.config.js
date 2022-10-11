
import path from 'path';
import { fileURLToPath } from 'url';
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

export default {
  entry: {
    'common':'./src/assets/js/common.js',
    'block-variations':'./src/assets/js/block-variations.js',
    // 'blocks':'./src/assets/js/blocks.js',
    // 'preload':'./src/assets/js/preload.js',
  },
  output: {
    path: __dirname + '/' + process.env.npm_package_config_dist + '/js/',
    filename: '[name]-bundle.js',
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: "babel-loader"
      }
    ]
  }  
};