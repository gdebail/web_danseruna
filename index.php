<?php
$musicDir = __DIR__ . DIRECTORY_SEPARATOR . 'music';
$musicFiles = [];
if (is_dir($musicDir)) {
  $matches = glob($musicDir . DIRECTORY_SEPARATOR . '*.mp3') ?: [];
  foreach ($matches as $fullPath) {
    $name = basename($fullPath);
    $musicFiles[] = [
      'title' => pathinfo($name, PATHINFO_FILENAME),
      'src' => 'music/' . rawurlencode($name),
    ];
  }
}
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Danseruna</title>
  <link rel="icon" href="favicon.ico" sizes="any">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="stylesheet" href="assets/css/index.css">
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

    <section class="zone" data-mode="music" data-title="ENREGISTREMENT BAL" data-text="ENREGISTREMENT BAL">
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

    <section class="zone" data-mode="modal" data-title="ATELIERS - PEDAGOGIE" data-text="ATELIERS - PEDAGOGIE">
      <img class="overlay" src="FOND-SITE-DANSERUNA-Squelette-transparent.png" alt="">
      <button class="hotspot" style="left:70.2083%;top:65.4629%;width:17.5000%;height:15.9028%; --rr: 52% 48% 41% 59% / 59% 41% 63% 37%; --rr-a: 52% 48% 41% 59% / 59% 41% 63% 37%; --rr-b: 69% 31% 57% 43% / 34% 66% 74% 26%; --rr-c: 33% 67% 27% 73% / 76% 24% 58% 42%;" aria-label="SQUELETTE"></button>
      <span class="tag">ATELIERS - PEDAGOGIE</span>
    </section>

    <section class="zone" data-mode="archive" data-title="DANSERUNA" data-text="Texte explicatif du festival">
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
  <div class="archive-modal" id="archiveModal" role="dialog" aria-modal="true" aria-label="Archive Danseruna">
    <div class="archive-modal-card">
      <iframe class="archive-frame" id="archiveFrame" src="" title="Archive Danseruna"></iframe>
    </div>
  </div>
  <div class="music-modal" id="musicModal" role="dialog" aria-modal="true" aria-labelledby="music-title">
    <div class="music-card">
      <h2 id="music-title">Enregistrements Bal</h2>
      <div class="music-list" id="musicList"></div>
      <button class="close-btn close-icon-btn" id="closeMusicModal" type="button" aria-label="Fermer">
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
          <path d="M7 7l10 10M17 7l-10 10" fill="none" stroke="currentColor" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </button>
    </div>
  </div>
  <script>
    window.DANSERUNA_CONFIG = {
      musicTracks: <?php echo json_encode($musicFiles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
    };
  </script>
  <script src="assets/js/modal-manager.js" defer></script>
  <script src="assets/js/index-app.js" defer></script>
</body>
</html>
