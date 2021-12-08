try {
  require('./partials/set-page-loaded-class');
  require('./partials/click');
  const { showPopUp, checkPopUp, addCallbackToHideOfPopUp, hidePopUp } = require("./partials/pop-up");
  const cookies = require("./partials/cookies");
  
  if (cookies.get('demo_pop_up_shown')) {
    hidePopUp('demo-hello');
  } else {
    setTimeout(() => {
      if (checkPopUp('demo-hello')) {
        addCallbackToHideOfPopUp('demo-hello', function() {
          cookies.set('demo_pop_up_shown', true, 1);
        });
      }
    }, 0);
  }

  window.showDemoErrorPopUp = () => showPopUp('demo-error');
} catch (error) {
  console.error(error);
}