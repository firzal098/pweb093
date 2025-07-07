<?php
function formatTime($ms) {
    $ms = (int)$ms;
    $minutes = floor($ms / 60000);
    $seconds = floor(($ms % 60000) / 1000);
    $msec = floor(($ms % 1000) / 10); // 2-digit milliseconds

    return sprintf('%02d:%02d:%02d', $minutes, $seconds, $msec);
}

$lines = file('data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Timer Results</title>

  <!-- Fonts & Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=News+Cycle:wght@400;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: "Inter", monospace;
      background-color: #fdfdfd;
      color: #333;
      margin: 0;
      padding: 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    body, html {
    overflow: hidden;
    height: 100%;
    touch-action: none; /* prevents scrolling on mobile */
    }
    h2 {
      font-weight: 1000;
      margin-bottom: 20px;
    }

    ul {
      list-style: none;
      padding: 0;
      width: 200px;
    }

    li {
      font-weight: 600;
      font-size: 18px;
      padding: 8px;
      text-align: center;
      /* color: rgb(75, 171, 255); */
      border-bottom: 1px solid #ddd;
    }

    li:last-child {
      border-bottom: none;
    }

    .button {
      user-select: none;
      margin-top: 30px;
      cursor: pointer;
      transition: scale 0.3s ease;
      font-size: 32px;
      color: black;
    }

    .button:active {
      transform: scale(0.92);
      transition: scale 0.3s ease;
    }
  </style>
</head>
<body>

  <h2 class="black">⏱️ Saved Times</h2>

  <ul>
    <?php foreach ($lines as $ms): ?>
      <li><?= htmlspecialchars(formatTime($ms)) ?></li>
    <?php endforeach; ?>
  </ul>

  <i class="material-icons button" onclick="window.location.href='index.html'">arrow_back</i>

</body>
</html>
