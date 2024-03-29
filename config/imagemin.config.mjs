// import imagemin from "imagemin";
import * as imageminKeepFolder from 'imagemin-keep-folder';
const imagemin = imageminKeepFolder.default;
import imageminMozjpeg from 'imagemin-mozjpeg';
import imageminPngquant from 'imagemin-pngquant';
import imageminGifsicle from 'imagemin-gifsicle';
import imageminSvgo from 'imagemin-svgo';

imagemin(['./src/img/**/*.{jpg,png,gif,svg}'], {
  plugins: [
    imageminMozjpeg({ quality: 80 }),
    imageminPngquant({ quality: [0.65, 0.8] }),
    imageminSvgo()
  ],
  replaceOutputDir: output => {
    return output.replace(/src/, /dist/)
  }
}).then(() => {
  console.log('Images optimized');
});