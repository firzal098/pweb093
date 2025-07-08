<?php
function formatTime($ms) {
    $ms = (int)$ms;
    $minutes = floor($ms / 60000);
    $seconds = floor(($ms % 60000) / 1000);
    $msec = floor(($ms % 1000) / 10);
    return sprintf('%02d:%02d:%02d', $minutes, $seconds, $msec);
}

$lines = file('data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Timer Log</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
    color: black; /* changed from blue */
    background-color: rgba(75, 171, 255, 0.15); /* soft blue background */
    border-radius: 6px;
    margin-bottom: 8px;
    transition: background-color 0.3s ease;
  }

  li:hover {
    background-color: rgba(75, 171, 255, 0.25);
  }


    li:last-child {
      border-bottom: none;
    }

    .button {
      user-select: none;
      margin-top: 30px;
      margin-inline: 10px;
      cursor: pointer;
      transition: scale 0.3s ease;
      font-size: 32px;
      color: black;
    }

    .button:active {
      transform: scale(0.92);
    }

    .danger {
      color: crimson;
    }

    .buttonRow {
      display: flex;
      justify-content: center;
      gap: 20px;
    }
  </style>
</head>
<body>

  <h2 class="black">⏱️ Timer Logs</h2>

  <ul>
    <?php foreach ($lines as $ms): ?>
      <li><?= htmlspecialchars(formatTime($ms)) ?></li>
    <?php endforeach; ?>
  </ul>

  <div class="buttonRow">
    <i class="material-icons button" onclick="window.location.href='index.html'">arrow_back</i>
    <i class="material-icons button danger" onclick="clearLogs()">delete_forever</i>
  </div>

  <form id="clearForm" method="POST" action="clear.php" style="display:none;"></form>

  <script>
    function clearLogs() {
      if (confirm("Apa anda yakin untuk menghapus semua log?")) {
        document.getElementById("clearForm").submit();
      }
    }
  </script>

</body>
</html>
