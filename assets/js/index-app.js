(function () {
  const config = window.DANSERUNA_CONFIG || { musicTracks: [] };
  const zones = document.querySelectorAll('.zone');
  const scene = document.getElementById('scene');

  const defaultModal = document.getElementById('modal');
  const modalTitle = document.getElementById('modal-title');
  const modalText = document.getElementById('modal-text');

  const archiveModal = document.getElementById('archiveModal');
  const archiveFrame = document.getElementById('archiveFrame');
  const archiveBaseUrl = 'pages/archive-danseruna.html?direct=1&edition=8';

  const musicModal = document.getElementById('musicModal');
  const musicList = document.getElementById('musicList');
  let musicListBuilt = false;

  const defaultController = window.ModalManager.createModalController({
    root: defaultModal,
    closeSelector: '#closeModal',
    onClose: unlockZone,
  });

  const archiveController = window.ModalManager.createModalController({
    root: archiveModal,
    onClose: unlockZone,
  });

  const musicController = window.ModalManager.createModalController({
    root: musicModal,
    closeSelector: '#closeMusicModal',
    onClose: function () {
      unlockZone();
    },
  });

  let lockedZone = null;
  let layoutRaf = null;

  function placeTag(zone) {
    const hotspot = zone.querySelector('.hotspot');
    const tag = zone.querySelector('.tag');
    if (!hotspot || !tag) return;
    const cx = hotspot.offsetLeft + hotspot.offsetWidth / 2;
    const ty = hotspot.offsetTop;
    tag.style.left = cx + 'px';
    tag.style.top = ty + 'px';
  }

  function activate(zone) {
    placeTag(zone);
    zone.classList.add('active');
  }

  function deactivate(zone) {
    if (lockedZone === zone) return;
    zone.classList.remove('active');
  }

  function lockZone(zone) {
    if (lockedZone && lockedZone !== zone) lockedZone.classList.remove('active');
    lockedZone = zone;
    activate(zone);
  }

  function unlockZone() {
    if (!lockedZone) return;
    lockedZone.classList.remove('active');
    lockedZone = null;
  }

  function openInfoModal(zone) {
    modalTitle.textContent = zone.dataset.title || 'Info';
    modalText.textContent = zone.dataset.text || '';
    defaultController.open();
  }

  function buildMusicListOnce() {
    if (musicListBuilt) return;
    musicListBuilt = true;
    musicList.innerHTML = '';

    if (!config.musicTracks.length) {
      musicList.innerHTML = '<p>Aucun MP3 trouvé dans /music.</p>';
      return;
    }

    const audios = [];

    config.musicTracks.forEach(function (track) {
      const item = document.createElement('div');
      item.className = 'music-track';

      const title = document.createElement('span');
      title.className = 'music-track-title';
      title.textContent = track.title;

      const audio = document.createElement('audio');
      audio.controls = true;
      audio.preload = 'none';
      audio.src = track.src;

      audio.addEventListener('play', function () {
        audios.forEach(function (otherAudio) {
          if (otherAudio !== audio && !otherAudio.paused) otherAudio.pause();
        });
      });

      audios.push(audio);
      item.appendChild(title);
      item.appendChild(audio);
      musicList.appendChild(item);
    });
  }

  function openMusicModal() {
    buildMusicListOnce();
    musicController.open();
  }

  function openArchiveModal() {
    archiveFrame.setAttribute('src', archiveBaseUrl + '&t=' + Date.now());
    archiveController.open();
  }

  function refreshSceneLayout() {
    scene.getBoundingClientRect();
    document.querySelectorAll('.zone.active').forEach(placeTag);
  }

  function scheduleLayoutRefresh() {
    if (layoutRaf) cancelAnimationFrame(layoutRaf);
    layoutRaf = requestAnimationFrame(function () {
      refreshSceneLayout();
      setTimeout(refreshSceneLayout, 120);
      setTimeout(refreshSceneLayout, 320);
    });
  }

  function forceViewportScaleOne() {
    const viewportMeta = document.querySelector('meta[name="viewport"]');
    if (!viewportMeta) return;
    viewportMeta.setAttribute('content', 'width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no');
  }

  function hardReloadWithBust() {
    const url = new URL(window.location.href);
    url.searchParams.set('v', String(Date.now()));
    window.location.replace(url.toString());
  }

  zones.forEach(function (zone) {
    const hotspot = zone.querySelector('.hotspot');
    if (!hotspot) return;

    hotspot.addEventListener('mouseenter', function () { activate(zone); });
    hotspot.addEventListener('mouseleave', function () { deactivate(zone); });
    hotspot.addEventListener('focus', function () { activate(zone); });
    hotspot.addEventListener('blur', function () { deactivate(zone); });

    hotspot.addEventListener('click', function () {
      lockZone(zone);
      const mode = zone.dataset.mode;

      if (mode === 'link') {
        window.location.href = zone.dataset.href;
        return;
      }
      if (mode === 'music') {
        openMusicModal();
        return;
      }
      if (mode === 'archive') {
        openArchiveModal();
        return;
      }
      openInfoModal(zone);
    });
  });

  window.addEventListener('resize', function () {
    document.querySelectorAll('.zone.active').forEach(placeTag);
  });

  window.addEventListener('orientationchange', scheduleLayoutRefresh);
  window.addEventListener('orientationchange', function () {
    document.body.classList.add('is-rotating');
    forceViewportScaleOne();
    setTimeout(hardReloadWithBust, 180);
  });

  window.addEventListener('pageshow', scheduleLayoutRefresh);

  if (window.visualViewport) {
    window.visualViewport.addEventListener('resize', scheduleLayoutRefresh);
  }

  window.addEventListener('message', function (event) {
    if (event && event.data && event.data.type === 'danseruna-archive-close') {
      archiveController.close();
    }
  });

  window.addEventListener('keydown', function (event) {
    if (event.key !== 'Escape') return;
    defaultController.close();
    musicController.close();
    archiveController.close();
  });

  scene.addEventListener('click', function (event) {
    if (event.target.closest('.hotspot')) return;
    if (defaultController.isOpen() || musicController.isOpen() || archiveController.isOpen()) return;
    unlockZone();
  });

  scheduleLayoutRefresh();
})();
