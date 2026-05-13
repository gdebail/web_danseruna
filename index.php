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
      0% { box-shadow: 0 0 0 0 rgba(255,255,255,.0); }
      50% { box-shadow: 0 0 0 10px rgba(255,255,255,.18); }
      100% { box-shadow: 0 0 0 0 rgba(255,255,255,.0); }
    }
    .zone:not(.active) .hotspot { animation: hotspotPulse 2.2s ease-in-out infinite; }

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
      box-shadow: 0 0 0 20px rgba(255,255,255,.75);
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
      <button class="hotspot" style="left:56.6146%;top:39.9306%;width:35.4688%;height:14.0278%;" aria-label="CONTACTEURS 2"></button>
      <span class="tag">VIDEO - IOANIS</span>
    </section>

    <section class="zone" data-mode="link" data-href="pages/selection-photos-regis.html">
      <img class="overlay" src="FOND-SITE-DANSERUNA-Contacteurs-transparent.png" alt="">
      <button class="hotspot" style="left:5.8333%;top:26.9213%;width:45.9375%;height:13.4722%;" aria-label="CONTACTEURS 1"></button>
      <span class="tag">SELECTION PHOTOS REGIS</span>
    </section>

    <section class="zone" data-mode="link" data-href="pages/enregistrement-bal.html">
      <img class="overlay" src="FOND-SITE-DANSERUNA-MUSICIENS-transparent.png" alt="">
      <button class="hotspot" style="left:4.2188%;top:50.1157%;width:36.8750%;height:18.8657%;" aria-label="MUSICIENS"></button>
      <span class="tag">ENREGISTREMENT BAL</span>
    </section>

    <section class="zone" data-mode="link" data-href="pages/village-infos-pratiques.html">
      <img class="overlay" src="FOND-SITE-DANSERUNA-Village-transparent.png" alt="">
      <button class="hotspot" style="left:29.7917%;top:90.1620%;width:26.8229%;height:9.8380%;" aria-label="VILLAGE"></button>
      <span class="tag">VILLAGE / INFOS PRATIQUES</span>
    </section>

    <section class="zone" data-mode="modal" data-title="LA MEMBRANE" data-text="LA MEMBRANE">
      <img class="overlay" src="FOND-SITE-DANSERUNA-MAIN-transparent.png" alt="">
      <button class="hotspot" style="left:52.6562%;top:20.8796%;width:15.1562%;height:5.4398%;" aria-label="LA MAIN"></button>
      <span class="tag">LA MEMBRANE</span>
    </section>

    <section class="zone" data-mode="modal" data-title="LES ATELIERS - PEDAGOGIE" data-text="LES ATELIERS - PEDAGOGIE">
      <img class="overlay" src="FOND-SITE-DANSERUNA-Squelette-transparent.png" alt="">
      <button class="hotspot" style="left:71.2500%;top:65.9259%;width:15.4167%;height:14.9769%;" aria-label="SQUELETTE"></button>
      <span class="tag">LES ATELIERS - PEDAGOGIE</span>
    </section>

    <section class="zone" data-mode="modal" data-title="DANSERUNA" data-text="Texte explicatif du festival">
      <img class="overlay" src="FOND-SITE-DANSERUNA-Titre-transparent.png" alt="">
      <button class="hotspot" style="left:8.8542%;top:3.5185%;width:83.2292%;height:7.0833%;" aria-label="DANSERUNA"></button>
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


