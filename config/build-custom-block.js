// const { exec } = require('child_process');
import { exec } from 'child_process';

const customBlocks = [
  'inc/extension/code_block_syntax_highlight',
  'inc/extension/editor_support_hover_border'
  // 追加のカスタムブロックのパスを必要に応じて追加
];

customBlocks.forEach(customBlock => {
  exec(`cd ${customBlock} && wp-scripts build`, (error, stdout, stderr) => {
    if (error) {
      console.error(`Error: ${error.message}`);
      return;
    }
    if (stderr) {
      console.error(`stderr: ${stderr}`);
      return;
    }
    console.log(stdout);
  });
});