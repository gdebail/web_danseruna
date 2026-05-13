<?php
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Danseruna</title>
  <style>
    :root { --bg:#050505; --label:#ffe94d; --label-text:#111; }
    * { box-sizing: border-box; }
    body { margin: 0; background: var(--bg); color: #fff; font-family: Arial, sans-serif; display: flex; justify-content: center; }
    .scene { position: relative; width: min(100vw, 1920px); aspect-ratio: 1920 / 4320; overflow: hidden; background: #000; }

    .base,
    .overlay { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; display: block; }
    .base { z-index: 0; }
    .overlay { z-index: 7; opacity: 0; transition: opacity .2s ease; pointer-events: none; }

    .hotspot { position: absolute; z-index: 6; background: transparent; border: 0; padding: 0; cursor: pointer; border-radius: 22px; }
    .hotspot:focus-visible { outline: 2px dashed #fff; outline-offset: 2px; }

    @keyframes hotspotPulse {
      0% { box-shadow: 0 0 0 0 rgba(255,255,255,0), 0 0 0 0 rgba(255,255,255,0), inset 0 0 0 0 rgba(255,255,255,0), inset 0 0 0 0 rgba(255,255,255,0); }
      55% { box-shadow: 0 0 36px 12px rgba(255,255,255,.26), 0 0 80px 28px rgba(255,255,255,.18), inset 0 0 22px 8px rgba(255,255,255,.20), inset 0 0 46px 18px rgba(255,255,255,.14); }
      100% { box-shadow: 0 0 0 0 rgba(255,255,255,0), 0 0 0 0 rgba(255,255,255,0), inset 0 0 0 0 rgba(255,255,255,0), inset 0 0 0 0 rgba(255,255,255,0); }
    }
    .zone { --pulse-delay: 0s; }
    .zone:nth-of-type(1) { --pulse-delay: -0.15s; }
    .zone:nth-of-type(2) { --pulse-delay: -0.65s; }
    .zone:nth-of-type(3) { --pulse-delay: -1.05s; }
    .zone:nth-of-type(4) { --pulse-delay: -1.55s; }
    .zone:nth-of-type(5) { --pulse-delay: -0.35s; }
    .zone:nth-of-type(6) { --pulse-delay: -1.35s; }
    .zone:nth-of-type(7) { --pulse-delay: -0.9s; }
    .zone:not(.active) .hotspot { animation: hotspotPulse 3.4s cubic-bezier(.22,.61,.36,1) infinite; animation-delay: var(--pulse-delay); }

    .tag {
      position: absolute;
      z-index: 9;
      padding: .35rem .65rem;
      background: var(--label);
      color: var(--label-text);
      border-radius: 999px;
      font-size: clamp(12px, 1.2vw, 22px);
      font-weight: 700;
      letter-spacing: .04em;
      opacity: 0;
      transform: translate(-50%, -95%);
      transition: opacity .2s ease, transform .2s ease;
      pointer-events: none;
      white-space: nowrap;
      box-shadow: 0 8px 24px rgba(0,0,0,.35);
    }

    .zone.active .overlay { opacity: 1; }
    .zone.active .hotspot {
      animation: none;
      background: rgba(255,255,255,.75);
      border-radius: 34px;
      backdrop-filter: blur(8px) saturate(120%);`r`n      -webkit-backdrop-filter: blur(8px) saturate(120%);`r`n      box-shadow: 0 0 0 20px rgba(255,255,255,.55);
    }
    .zone.active .tag { opacity: 1; transform: translate(-50%, -110%); }

    @media (prefers-reduced-motion: reduce) {
      .zone:not(.active) .hotspot { animation: none; }
    }

    .modal { position: fixed; inset: 0; background: rgba(0,0,0,.65); display: none; align-items: center; justify-content: center; z-index: 100; padding: 20px; }
    .modal.open { display: flex; }
    .modal-card { width: min(560px, 100%); background: #111; border: 1px solid #444; border-radius: 14px; padding: 20px; }
    .modal-card h2 { margin-top: 0; }
    .close-btn { margin-top: 12px; border: 0; border-radius: 8px; background: #ffe94d; color: #000; padding: 10px 14px; font-weight: 700; cursor: pointer; }
  </style>
</head>
<body>
  <main class="scene" id="scene">
    <img class="base" src="FOND-SITE-DANSERUNA-1.jpg" alt="Danseruna">

    <section class="zone" data-mode="link" data-href="pages/video-ioanis.html">
      <img class="overlay" src="FOND-SITE-DANSERUNA-contacteur2-transparent.png" alt="">
      <button class="hotspot" style="left:55.5729%;top:39.4676%;width:37.5521%;height:14.9537%;" aria-label="CONTACTEURS 2"></button>
      <span class="tag">VIDEO - IOANIS</span>
    </section>

    <section class="zone" data-mode="link" data-href="pages/selection-photos-regis.html">
      <img class="overlay" src="FOND-SITE-DANSERUNA-Contacteurs-transparent.png" alt="">
      <button class="hotspot" style="left:4.7916%;top:26.4583%;width:48.0208%;height:14.3981%;" aria-label="CONTACTEURS 1"></button>
      <span class="tag">SELECTION PHOTOS REGIS</span>
    </section>

    <section class="zone" data-mode="link" data-href="pages/enregistrement-bal.html">
      <img class="overlay" src="FOND-SITE-DANSERUNA-MUSICIENS-transparent.png" alt="">
      <button class="hotspot" style="left:3.1771%;top:49.6527%;width:38.9583%;height:19.7916%;" aria-label="MUSICIENS"></button>
      <span class="tag">ENREGISTREMENT BAL</span>
    </section>

    <section class="zone" data-mode="link" data-href="pages/village-infos-pratiques.html">
      <img class="overlay" src="FOND-SITE-DANSERUNA-Village-transparent.png" alt="">
      <button class="hotspot" style="left:28.7500%;top:89.6990%;width:28.9062%;height:10.3010%;" aria-label="VILLAGE"></button>
      <span class="tag">VILLAGE / INFOS PRATIQUES</span>
    </section>

    <section class="zone" data-mode="modal" data-title="LA MEMBRANE" data-text="LA MEMBRANE">
      <img class="overlay" src="FOND-SITE-DANSERUNA-MAIN-transparent.png" alt="">
      <button class="hotspot" style="left:51.6145%;top:20.4166%;width:17.2395%;height:6.3657%;" aria-label="LA MAIN"></button>
      <span class="tag">LA MEMBRANE</span>
    </section>

    <section class="zone" data-mode="modal" data-title="LES ATELIERS - PEDAGOGIE" data-text="LES ATELIERS - PEDAGOGIE">
      <img class="overlay" src="FOND-SITE-DANSERUNA-Squelette-transparent.png" alt="">
      <button class="hotspot" style="left:70.2083%;top:65.4629%;width:17.5000%;height:15.9028%;" aria-label="SQUELETTE"></button>
      <span class="tag">LES ATELIERS - PEDAGOGIE</span>
    </section>

    <section class="zone" data-mode="modal" data-title="DANSERUNA" data-text="Texte explicatif du festival">
      <img class="overlay" src="FOND-SITE-DANSERUNA-Titre-transparent.png" alt="">
      <button class="hotspot" style="left:7.8125%;top:3.0555%;width:85.3125%;height:8.0092%;" aria-label="DANSERUNA"></button>
      <span class="tag">DANSERUNA</span>
    </section>
  </main>

  <div class="modal" id="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div class="modal-card">
      <h2 id="modal-title"></h2>
      <p id="modal-text"></p>
      <button class="close-btn" id="closeModal" type="button">Fermer</button>
    </div>
  </div>

  <script>
    const zones = document.querySelectorAll('.zone');
    const modal = document.getElementById('modal');
    const modalTitle = document.getElementById('modal-title');
    const modalText = document.getElementById('modal-text');
    const closeModal = document.getElementById('closeModal');
    const scene = document.getElementById('scene');
    let lockedZone = null;

    function placeTag(zone) {
      const hotspot = zone.querySelector('.hotspot');
      const tag = zone.querySelector('.tag');
      if (!hotspot || !tag) return;
      const cx = hotspot.offsetLeft + hotspot.offsetWidth / 2;
      const ty = hotspot.offsetTop;
      tag.style.left = `${cx}px`;
      tag.style.top = `${ty}px`;
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

    zones.forEach((zone) => {
      const hotspot = zone.querySelector('.hotspot');
      hotspot.addEventListener('mouseenter', () => activate(zone));
      hotspot.addEventListener('mouseleave', () => deactivate(zone));
      hotspot.addEventListener('focus', () => activate(zone));
      hotspot.addEventListener('blur', () => deactivate(zone));

      hotspot.addEventListener('click', () => {
        lockZone(zone);
        const mode = zone.dataset.mode;
        if (mode === 'link') {
          window.location.href = zone.dataset.href;
          return;
        }
        if (mode === 'modal') {
          modalTitle.textContent = zone.dataset.title || 'Info';
          modalText.textContent = zone.dataset.text || '';
          modal.classList.add('open');
        }
      });
    });

    window.addEventListener('resize', () => {
      document.querySelectorAll('.zone.active').forEach(placeTag);
    });

    closeModal.addEventListener('click', () => { modal.classList.remove('open'); unlockZone(); });
    modal.addEventListener('click', (e) => { if (e.target === modal) { modal.classList.remove('open'); unlockZone(); } });
    window.addEventListener('keydown', (e) => { if (e.key === 'Escape') { modal.classList.remove('open'); unlockZone(); } });
    scene.addEventListener('click', (e) => {
      if (!e.target.closest('.hotspot') && !modal.classList.contains('open')) unlockZone();
    });
  </script>
</body>
</html>



