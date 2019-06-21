$(function() {

  window.emojiPicker = new EmojiPicker({
    emojiable_selector: '[data-emojiable=true]',
    assetsPath: '/assets/img/',
    popupButtonClasses: 'fe fe-heart'
  });

  window.emojiPicker.discover();
});