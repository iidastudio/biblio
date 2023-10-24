import debounce from 'lodash.debounce';

export const targetObserver = (target, callback, forEdit ) => {
  const debounceTime = 100;

  if ( forEdit ) {
    const mutationObserver = new MutationObserver(debounce((mutations, observer) => {
      mutations.forEach((mutation) => {
        callback(target, forEdit);
      });

    }, debounceTime));
    mutationObserver.observe(target, {
      childList: true,
      characterData: true,
      subtree: true
    });  
  }

  const resizeObserver = new ResizeObserver(debounce((entries, observer) => {
      entries.forEach((entry) => {
        callback(entry.target, forEdit);
      });
  }, debounceTime));
  resizeObserver.observe(target);
}