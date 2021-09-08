function checkMobile() {
  return window.innerWidth < 1024 || checkMobileAgent();
}

function checkMobileAgent() {
  return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

function checkMobileView() {
  return document.body.classList.contains('mobile-view');
}

module.exports = {
  checkMobile,
  checkMobileAgent,
  checkMobileView
}