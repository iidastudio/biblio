export const applyFontFeatureSettingsPalt = () => {
  const dataList = document.getElementsByTagName('p');
  for (let i = 0; i < dataList.length; i++) {
    const data = dataList[i];
    const regex = /(「|」|・|（|）)/g;
    const replaceHTML = data.innerHTML.replace(/(「|」|・|（|）)/g, `<span class="palt">$1</span>`);
    data.innerHTML = replaceHTML;
    console.log(data);
  }
}
applyFontFeatureSettingsPalt();