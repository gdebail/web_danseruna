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

    .hotspot { position: absolute; z-index: 6; background: transparent; border: 0; padding: 0; cursor: pointer; border-radius: var(--rr, 42% 58% 49% 51% / 58% 44% 56% 42%); overflow: visible; }
    .hotspot:focus-visible { outline: 2px dashed #fff; outline-offset: 2px; }

    @keyframes hotspotPulse {
      0% { box-shadow: 0 0 0 0 rgba(255,255,255,0), 0 0 0 0 rgba(255,255,255,0), inset 0 0 0 0 rgba(255,255,255,0), inset 0 0 0 0 rgba(255,255,255,0); }
      55% { box-shadow: 0 0 24px 9px rgba(255,255,255,.28), 0 0 54px 16px rgba(255,255,255,.18), inset 0 0 24px 9px rgba(255,255,255,.28), inset 0 0 54px 16px rgba(255,255,255,.18); }
      100% { box-shadow: 0 0 8px 3px rgba(255,255,255,.10), 0 0 18px 6px rgba(255,255,255,.06), inset 0 0 8px 3px rgba(255,255,255,.10), inset 0 0 18px 6px rgba(255,255,255,.06); }
    }
    .zone { --pulse-delay: 0s; }
    .zone:nth-of-type(1) { --pulse-delay: -0.15s; }
    .zone:nth-of-type(2) { --pulse-delay: -0.65s; }
    .zone:nth-of-type(3) { --pulse-delay: -1.05s; }
    .zone:nth-of-type(4) { --pulse-delay: -1.55s; }
    .zone:nth-of-type(5) { --pulse-delay: -0.35s; }
    .zone:nth-of-type(6) { --pulse-delay: -1.35s; }
    .zone:nth-of-type(7) { --pulse-delay: -0.9s; }
    .zone:not(.active) .hotspot { animation: hotspotPulse 3.4s cubic-bezier(.22,.61,.36,1) infinite, hotspotMorph 5.8s ease-in-out infinite alternate; animation-delay: var(--pulse-delay), calc(var(--pulse-delay) * .5); }
    .zone:not(.active) .hotspot::before { content: ''; position: absolute; inset: 0; border-radius: inherit; background: radial-gradient(circle at 50% 50%, rgba(255,255,255,.20) 0%, rgba(255,255,255,.10) 45%, rgba(255,255,255,0) 85%); mix-blend-mode: screen; animation: hotspotInnerFog 3.4s cubic-bezier(.22,.61,.36,1) infinite; animation-delay: var(--pulse-delay); pointer-events: none; }
    @keyframes hotspotInnerFog { 0%,100% { opacity: .12; } 55% { opacity: .62; } }

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
      background: rgba(255,255,255,.72);
      border-radius: 51px;
      backdrop-filter: blur(8px) saturate(120%);
      -webkit-backdrop-filter: blur(8px) saturate(120%);
      box-shadow: 0 0 0 6px rgba(255,255,255,.24);
    }
    .zone.active .hotspot::before {
      content: '';
      position: absolute;
      inset: -16px;
      border-radius: 63px;
      background: rgba(255,255,255,.55);
      filter: blur(16px);
      opacity: .7;
      z-index: -1;
      pointer-events: none;
    }
    .zone.active .tag { opacity: 1; transform: translate(-50%, -110%); }

    @keyframes hotspotMorph {
      0% { border-radius: var(--rr-a, 42% 58% 49% 51% / 58% 44% 56% 42%); transform: translate(0,0) rotate(0deg); }
      50% { border-radius: var(--rr-b, 62% 38% 68% 32% / 34% 66% 30% 70%); transform: translate(1.2%, -.9%) rotate(-1.4deg); }
      100% { border-radius: var(--rr-c, 35% 65% 31% 69% / 72% 28% 69% 31%); transform: translate(-1.0%, .9%) rotate(1.5deg); }
    }

    @media (prefers-reduced-motion: reduce) {
      .zone:not(.active) .hotspot { animation: none; }
    }

    @media (max-width: 900px) {
      .zone:not(.active) .hotspot { animation-duration: 4.6s; }
      @keyframes hotspotPulse {
        0% { box-shadow: 0 0 0 0 rgba(255,255,255,0), 0 0 0 0 rgba(255,255,255,0), inset 0 0 0 0 rgba(255,255,255,0), inset 0 0 0 0 rgba(255,255,255,0); }
        55% { box-shadow: 0 0 16px 6px rgba(255,255,255,.20), 0 0 34px 10px rgba(255,255,255,.12), inset 0 0 16px 6px rgba(255,255,255,.20), inset 0 0 34px 10px rgba(255,255,255,.12); }
        100% { box-shadow: 0 0 8px 3px rgba(255,255,255,.10), 0 0 18px 6px rgba(255,255,255,.06), inset 0 0 8px 3px rgba(255,255,255,.10), inset 0 0 18px 6px rgba(255,255,255,.06); }
      }
      .zone.active .hotspot { box-shadow: 0 0 0 4px rgba(255,255,255,.20); }
      .zone.active .hotspot::before { inset: -10px; border-radius: 57px; filter: blur(11px); opacity: .55; }
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

    <section class="zone" data-mode="modal" data-title="VIDEO - IOANIS" data-text="VIDEO - IOANIS">
      <img class="overlay" src="FOND-SITE-DANSERUNA-contacteur2-transparent.png" alt="">
      <button class="hotspot" style="left:55.5729%;top:39.4676%;width:37.5521%;height:14.9537%; --rr: 46% 54% 39% 61% / 57% 43% 59% 41%; --rr-a: 46% 54% 39% 61% / 57% 43% 59% 41%; --rr-b: 68% 32% 63% 37% / 31% 69% 33% 67%; --rr-c: 34% 66% 28% 72% / 74% 26% 68% 32%;" aria-label="CONTACTEURS 2"></button>
      <span class="tag">VIDEO - IOANIS</span>
    </section>

    <section class="zone" data-mode="modal" data-title="SELECTION PHOTOS REGIS" data-text="SELECTION PHOTOS REGIS">
      <img class="overlay" src="FOND-SITE-DANSERUNA-Contacteurs-transparent.png" alt="">
      <button class="hotspot" style="left:4.7916%;top:26.4583%;width:48.0208%;height:14.3981%; --rr: 58% 42% 50% 50% / 40% 60% 45% 55%; --rr-a: 58% 42% 50% 50% / 40% 60% 45% 55%; --rr-b: 71% 29% 66% 34% / 30% 70% 36% 64%; --rr-c: 36% 64% 33% 67% / 73% 27% 64% 36%;" aria-label="CONTACTEURS 1"></button>
      <span class="tag">SELECTION PHOTOS REGIS</span>
    </section>

    <section class="zone" data-mode="modal" data-title="ENREGISTREMENT BAL" data-text="ENREGISTREMENT BAL">
      <img class="overlay" src="FOND-SITE-DANSERUNA-MUSICIENS-transparent.png" alt="">
      <button class="hotspot" style="left:3.1771%;top:49.6527%;width:38.9583%;height:19.7916%; --rr: 41% 59% 56% 44% / 60% 40% 52% 48%; --rr-a: 41% 59% 56% 44% / 60% 40% 52% 48%; --rr-b: 66% 34% 61% 39% / 35% 65% 31% 69%; --rr-c: 30% 70% 36% 64% / 72% 28% 63% 37%;" aria-label="MUSICIENS"></button>
      <span class="tag">ENREGISTREMENT BAL</span>
    </section>

    <section class="zone" data-mode="modal" data-title="VILLAGE / INFOS PRATIQUES" data-text="VILLAGE / INFOS PRATIQUES">
      <img class="overlay" src="FOND-SITE-DANSERUNA-Village-transparent.png" alt="">
      <button class="hotspot" style="left:28.7500%;top:89.6990%;width:28.9062%;height:10.3010%; --rr: 60% 40% 43% 57% / 54% 46% 61% 39%; --rr-a: 60% 40% 43% 57% / 54% 46% 61% 39%; --rr-b: 74% 26% 58% 42% / 33% 67% 35% 65%; --rr-c: 32% 68% 29% 71% / 76% 24% 61% 39%;" aria-label="VILLAGE"></button>
      <span class="tag">VILLAGE / INFOS PRATIQUES</span>
    </section>

    <section class="zone" data-mode="modal" data-title="LA MEMBRANE" data-text="LA MEMBRANE">
      <img class="overlay" src="FOND-SITE-DANSERUNA-MAIN-transparent.png" alt="">
      <button class="hotspot" style="left:51.6145%;top:20.4166%;width:17.2395%;height:6.3657%; --rr: 44% 56% 62% 38% / 47% 53% 40% 60%; --rr-a: 44% 56% 62% 38% / 47% 53% 40% 60%; --rr-b: 63% 37% 73% 27% / 29% 71% 34% 66%; --rr-c: 28% 72% 37% 63% / 74% 26% 30% 70%;" aria-label="LA MAIN"></button>
      <span class="tag">LA MEMBRANE</span>
    </section>

    <section class="zone" data-mode="modal" data-title="LES ATELIERS - PEDAGOGIE" data-text="LES ATELIERS - PEDAGOGIE">
      <img class="overlay" src="FOND-SITE-DANSERUNA-Squelette-transparent.png" alt="">
      <button class="hotspot" style="left:70.2083%;top:65.4629%;width:17.5000%;height:15.9028%; --rr: 52% 48% 41% 59% / 59% 41% 63% 37%; --rr-a: 52% 48% 41% 59% / 59% 41% 63% 37%; --rr-b: 69% 31% 57% 43% / 34% 66% 74% 26%; --rr-c: 33% 67% 27% 73% / 76% 24% 58% 42%;" aria-label="SQUELETTE"></button>
      <span class="tag">LES ATELIERS - PEDAGOGIE</span>
    </section>

    <section class="zone" data-mode="modal" data-title="DANSERUNA" data-text="Texte explicatif du festival">
      <img class="overlay" src="FOND-SITE-DANSERUNA-Titre-transparent.png" alt="">
      <button class="hotspot" style="left:7.8125%;top:3.0555%;width:85.3125%;height:8.0092%; --rr: 49% 51% 57% 43% / 42% 58% 49% 51%; --rr-a: 49% 51% 57% 43% / 42% 58% 49% 51%; --rr-b: 67% 33% 62% 38% / 31% 69% 43% 57%; --rr-c: 31% 69% 34% 66% / 75% 25% 64% 36%;" aria-label="DANSERUNA"></button>
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




