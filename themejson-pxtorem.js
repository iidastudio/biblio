import path from 'path';
import { fileURLToPath } from 'url';
import { readFileSync, writeFileSync } from 'fs';
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const data = readFileSync(__dirname + '/' + '/theme.json', 'utf8');
const applyProps = [
  'fontSize',
  'blockGap'
];

const replacer = (key, value) => {
  if( applyProps.includes(key) && String(value).match(/^.*(px)$/)) {
    console.log(key + '/' + value);
    const defaultSize = 16; // browser default font-size
    let numValue = parseFloat(value);
    let remValue = numValue / defaultSize + 'rem';
    value = remValue;
  }
  return value;
}

const jsonObject = JSON.parse(data, replacer);
const jsonData = JSON.stringify(jsonObject, null, "\t");

writeFileSync(__dirname + '/' + '/theme.json', jsonData);