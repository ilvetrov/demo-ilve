try {
  const { showPopUp, checkPopUp, addCallbackToHideOfPopUp } = require("./partials/pop-up");
  const cookies = require("./partials/cookies");
  
  if (!cookies.get('demo_pop_up_shown')) {
    setTimeout(() => {
      if (checkPopUp('demo-hello')) {
        showPopUp('demo-hello');
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