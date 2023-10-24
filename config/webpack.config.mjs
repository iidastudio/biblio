import path from 'path';
import { fileURLToPath } from 'url';
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

export default {
  resolve: {
    modules: [
      path.resolve(__dirname, '..'),
      'node_modules'
    ],
  },
  entry: {
    'common':'/src/js/common.js',
    'block-variations':'/src/js/block-variations.js',
  },
  output: {
    path: path.resolve(__dirname, '../dist/js/'),
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