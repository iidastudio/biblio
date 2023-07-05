import { exec } from 'child_process';

const customBlocks = [
  'inc/extension/code_block_syntax_highlight',
  'inc/extension/editor_support_hover_border',
  'inc/custom_block/biblio_vertical_group'
];

customBlocks.forEach(customBlock => {
  exec(`cd ${customBlock} && npm run build`, (error, stdout, stderr) => {
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