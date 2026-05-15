(function (window) {
  function createModalController(options) {
    const root = options.root;
    if (!root) throw new Error('Modal root is required');
    const onOpen = options.onOpen || function () {};
    const onClose = options.onClose || function () {};
    const closeSelector = options.closeSelector || null;

    function open() {
      root.classList.add('open');
      onOpen();
    }

    function close() {
      if (!root.classList.contains('open')) return;
      root.classList.remove('open');
      onClose();
    }

    function isOpen() {
      return root.classList.contains('open');
    }

    if (closeSelector) {
      const closeBtn = root.querySelector(closeSelector);
      if (closeBtn) closeBtn.addEventListener('click', close);
    }

    root.addEventListener('click', function (event) {
      if (event.target === root) close();
    });

    return { open, close, isOpen };
  }

  window.ModalManager = { createModalController };
})(window);
