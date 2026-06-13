<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <title>AI Rating Scanner</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Syne:wght@700;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <!-- TensorFlow.js – vaste stabiele versie -->
  <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@3.21.0/dist/tf.min.js"></script>
  <!-- javascript link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <!-- Teachable Machine – na TF.js laden -->
  <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8.5/dist/teachablemachine-image.min.js"></script>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

</head>

<body>

  <header>
    <a href="https://www.provil.be/nl" target="_blank">
      <img src="provil.png" alt="Provil">
    </a>
    <h1>AI <span>Rating</span> Scanner</h1>
    <p class="subtitle"><a href="https://provil-ict.be/" target="_blank">6ICW</a> · Rating · <a href="http://vreysenjarid.provil-ict.be/Gip.html" target="_blank">Jarid Vreysen</a></p>
  </header>

  <div class="error-banner" id="error-banner"></div>

  <div class="scanner-layout">
    <!-- Camera -->
    <div class="cam-box">
      <div class="cam-frame">
        <video id="webcam" autoplay playsinline></video>
        <div class="cam-overlay" id="cam-overlay">
          <div class="corner tl"></div>
          <div class="corner tr"></div>
          <div class="corner bl"></div>
          <div class="corner br"></div>
        </div>
      </div>
      <div style="text-align:center">
        <span class="status-pill">
          <span class="dot" id="status-dot"></span>
          <span id="status-text">Laden...</span>
        </span>
      </div>
    </div>

    <!-- Info panel -->
    <div class="info-panel">

      <div class="instructions-card">
        <div class="instructions-title">Hoe te gebruiken</div>
        <div class="instructions-step">
          <span>1: Neem een blad voor hoeveel sterren je deze richting geeft.</span>
        </div>
        <div class="instructions-step">
          <span>2: Houd het blad duidelijk voor de camera.</span>
        </div>
        <div class="instructions-step">
          <span>3: Haal het blad weg zodra de rating is opgeslagen.</span>
        </div>
      </div>

      <div class="prediction-card">
        <div class="card-label">Huidig gedetecteerd</div>
        <div class="detected-rating" id="detected-label">—</div>
        <div class="stars-display" id="stars-display"></div>
        <div class="confidence-bar-wrap">
          <div class="confidence-bar" id="conf-bar"></div>
        </div>
        <div class="confidence-text" id="conf-text">Zekerheid: —</div>
      </div>

      <div class="save-flash" id="save-flash">
        ✓ Opgeslagen: <strong id="flash-label"></strong>
      </div>

      <div class="log-box">
        <div class="log-title">Opgeslagen ratings</div>
        <ul id="log-list">
          <li class="empty-log" id="log-empty">Nog niets opgeslagen...</li>
        </ul>
      </div>

    </div>
  </div>

  <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
  <?php
  // Count ratings per star label from the file
  $counts = [
    "1 Ster"    => 0,
    "2 Sterren" => 0,
    "3 Sterren" => 0,
    "4 Sterren" => 0,
  ];

  $myfile = fopen("ratings.txt", "r") or die("Error: Unable to open file!");
  fseek($myfile, 0);

  while (!feof($myfile)) {
    $line = fgets($myfile);
    if (trim($line) === "") continue;

    $data  = explode('|', $line);
    if (count($data) < 2) continue;

    // Extract the star label: everything after the pipe, trimmed
    $stars = trim($data[1]);

    // Normalize: "1 Ster", "2 Sterren", "3 Sterren", "4 Sterren"
    if (isset($counts[$stars])) {
      $counts[$stars]++;
    }
  }

  fclose($myfile);

  // Build a JS-safe JSON array ordered by label
  $chartData = [
    $counts["1 Ster"],
    $counts["2 Sterren"],
    $counts["3 Sterren"],
    $counts["4 Sterren"],
  ];
  $chartDataJson = json_encode($chartData);
  ?>
  <script>
    let model;
    let lastSaved = "";
    let lastSaveTime = 0;
    const SAVE_COOLDOWN_MS = 2000;

    const modelURL = "https://storage.googleapis.com/tm-model/uzCAcNp8x/model.json"; // URL voor het /model.json
    const metadataURL = "https://storage.googleapis.com/tm-model/uzCAcNp8x/metadata.json"; // URL voor /metadata.json

    const NO_PAPER_LABELS = ["niks"];

    const statusDot = document.getElementById("status-dot");
    const statusText = document.getElementById("status-text");
    const camOverlay = document.getElementById("cam-overlay");

    // Functie die hetgeen dat de AI ziet (links) omzet naar het aantal sterren (rechts (sterren van fontawesome))
    function starsFor(label) {
      const map = {
        "1 Ster": '<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>',
        "2 Sterren": '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>',
        "3 Sterren": '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>',
        "4 Sterren": '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>',
      };
      return map[label] || "";
    }
    //De error te tonen om makkelijker te debuggen, niet nodig in het echte programma tijdens het runnen
    function showError(msg) {
      const el = document.getElementById("error-banner");
      el.textContent = "⚠ " + msg;
      el.classList.add("visible");
    }
    //Functie om het AI model te laden, functie wordt uitgevoerd als de pagina word geladen
    async function init() {
      setStatus("Model laden...", false);
      try {
        model = await tmImage.load(modelURL, metadataURL);
        setStatus("Model geladen!", false);
      } catch (err) {
        showError("Model laden mislukt: " + err.message);
        setStatus("Fout bij laden", false);
        return;
      }

      try {
        const stream = await navigator.mediaDevices.getUserMedia({
          video: {
            width: 280,
            height: 280,
            facingMode: "environment"
          }
        });
        const video = document.getElementById("webcam");
        video.srcObject = stream;
        await new Promise(resolve => video.onloadedmetadata = resolve);
        setStatus("Scannen actief", true);
      } catch (err) {
        showError("Webcam fout: " + (err.message || err.name));
        setStatus("Webcam fout", false);
        return;
      }

      predictLoop();
    }
    //Statusbalk onder de camera (laat weten of je kunt scannen of niet).
    function setStatus(text, active) {
      statusText.textContent = text;
      statusDot.className = "dot" + (active ? " active" : "");
    }
    //Functie om de frames (224x224 pixels) te lezen
    async function predictLoop() {
      const video = document.getElementById("webcam");

      // Canvas om frames van de video te lezen
      const canvas = document.createElement("canvas");
      canvas.width = 224;
      canvas.height = 224;
      const ctx = canvas.getContext("2d");

      async function frame() {
        if (video.readyState >= 2) {
          ctx.drawImage(video, 0, 0, 224, 224);
          await predict(canvas);
        }
        window.requestAnimationFrame(frame);
      }
      window.requestAnimationFrame(frame);
    }
    // Het canvasframe wordt doorgestuurd naar het AI-model, die zoekt dan wat er te zien is (1,2,3 of 4 ster(ren) of niks)
    async function predict(canvas) {
      try {
        const prediction = await model.predict(canvas);

        const best = prediction.reduce((max, p) => p.probability > max.probability ? p : max);
        const pct = (best.probability * 100).toFixed(1);
        const threshold = 0.75;

        document.getElementById("detected-label").textContent = best.className;
        document.getElementById("stars-display").innerHTML = starsFor(best.className);
        document.getElementById("conf-bar").style.width = pct + "%";
        document.getElementById("conf-text").textContent = `Zekerheid: ${pct}%`;

        const isNoPaper = NO_PAPER_LABELS.some(l => best.className.toLowerCase().includes(l));

        if (isNoPaper) {
          camOverlay.className = "cam-overlay";
          lastSaved = "";
          return;
        }

        if (best.probability >= threshold) {
          camOverlay.className = "cam-overlay detecting";
          const now = Date.now();
          if (best.className !== lastSaved || now - lastSaveTime > SAVE_COOLDOWN_MS * 5) {
            if (now - lastSaveTime >= SAVE_COOLDOWN_MS) {
              lastSaved = best.className;
              lastSaveTime = now;
              saveRating(best.className);
              flashSaved(best.className);
              addToLog(best.className);
              updateYValues(best.className);
            }
          }
        } else {
          camOverlay.className = "cam-overlay";
        }

      } catch (err) {
        console.error("Predict fout:", err);
      }
    }
    // Toont een groene kleur (voor 2 seconden) als je rating is verzonden en de AI heeft het antwoord.
    function flashSaved(label) {
      const el = document.getElementById("save-flash");
      document.getElementById("flash-label").innerHTML = label + " " + starsFor(label);
      el.classList.add("visible");
      camOverlay.className = "cam-overlay saved";
      setTimeout(() => {
        el.classList.remove("visible");
        camOverlay.className = "cam-overlay";
      }, 2000);
    }
    // Een lijst met alle opgeslagen waardes (totdat je refresht). Toont onder de drempelwaarde.
    function addToLog(label) {
      const list = document.getElementById("log-list");
      const empty = document.getElementById("log-empty");
      if (empty) empty.remove();

      const li = document.createElement("li");
      const now = new Date();
      const time = now.getHours().toString().padStart(2, "0") + ":" +
        now.getMinutes().toString().padStart(2, "0") + ":" +
        now.getSeconds().toString().padStart(2, "0");
      li.innerHTML = `<span>${label} ${starsFor(label)}</span><span class="time">${time}</span>`;
      list.prepend(li);
    }
    // De waarde word doorgegeven aan save.php. De data is als json vestuurd.
    async function saveRating(rating) {
      try {
        const res = await fetch("save.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            rating: rating
          })
        });
        if (!res.ok) console.warn("Save mislukt:", res.status);
        console.log(yValues);

      } catch (err) {
        console.error("Netwerk fout bij opslaan:", err);
      }

    }





var xValues = ["1 Ster", "2 Sterren", "3 Sterren", "4 Sterren"];
var yValues = <?= $chartDataJson ?>;
var barColors = ["#ee261c", "#007f26", "#2a99d6", "#fcec49"];

// Lokale update (direct na scan, zonder wachten op server)
function updateYValues(label) {
    const index = xValues.indexOf(label);
    if (index !== -1) {
        yValues[index]++;
    }
}

const myChart = new Chart("myChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: barColors,
            data: yValues
        }]
    },
    options: {
        legend: { display: false },
        title: { display: true, text: "Rating sterren" }
    }
});

// Elke 10 seconden de grafiek verversen met server-data
async function refreshChart() {
    try {
        const res = await fetch("get_ratings.php");
        const fresh = await res.json();
        myChart.data.datasets[0].data = fresh;
        yValues = fresh; // lokale kopie syncen
        myChart.update();
    } catch (err) {
        console.warn("Grafiek verversen mislukt:", err);
    }
}

setInterval(refreshChart, 10000); // 10 000 ms = 10 seconden
    window.onload = init;
  </script>
</body>

</html>