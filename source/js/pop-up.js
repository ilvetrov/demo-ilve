try {
  require('./partials/set-page-loaded-class');
  const { showPopUp, checkPopUp, addCallbackToHideOfPopUp } = require("./partials/pop-up");
  const cookies = require("./partials/cookies");
  
  if (!cookies.get('demo_pop_up_shown')) {
    if (window.innerWidth <= 1199) {
      window.addEventListener('load', function() {
        setTimeout(() => {
          if (checkPopUp('demo-hello')) {
            showPopUp('demo-hello');
          }
        }, 0);
      });
    }
    setTimeout(() => {
      if (checkPopUp('demo-hello')) {
        if (window.innerWidth >= 1200) showPopUp('demo-hello');
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