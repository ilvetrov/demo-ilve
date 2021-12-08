const clickables = document.querySelectorAll('[data-click]');
for (let i = 0; i < clickables.length; i++) {
  const clickable = clickables[i];
  clickable.addEventListener('click', function() {
    if (!clickable.classList.contains('clicked')) {
      clickable.classList.add('clicked');
    }
  });
}

const clickSetters = document.querySelectorAll('[data-click-set]');
for (let i = 0; i < clickSetters.length; i++) {
  const clickSetter = clickSetters[i];
  const name = clickSetter.getAttribute('data-click-set');
  clickSetter.addEventListener('click', () => {
    const hasUnset = clickSetter.hasAttribute('data-click-unset');
    document.querySelectorAll(`[data-click-to="${name}"]`).forEach(el => {
      if (hasUnset) {
        el.classList.toggle('clicked');
      } else {
        if (!el.classList.contains('clicked')) {
          el.classList.add('clicked');
        }
      }
    });
  });
}

const clickUnsetters = document.querySelectorAll('[data-click-unset]');
for (let i = 0; i < clickUnsetters.length; i++) {
  const clickUnsetter = clickUnsetters[i];
  const name = clickUnsetter.getAttribute('data-click-unset');
  if (clickUnsetter.hasAttribute('data-click-set')) continue;
  clickUnsetter.addEventListener('click', () => {
    document.querySelectorAll(`[data-click-to="${name}"]`).forEach(el => {
      setTimeout(() => {
        el.classList.remove('clicked');
      }, 0);
    });
  });
}

function checkClicked(name) {
  return document.querySelector(`[data-click-to="${name}"]`).classList.contains('clicked');
}

window.checkClicked = checkClicked;