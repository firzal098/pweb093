<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ms = $_POST['time'] ?? null;

    if (is_numeric($ms)) {
        // Append to data.txt (adds a new line each time)
        file_put_contents('data.txt', $ms . PHP_EOL, FILE_APPEND);
        echo "Saved: $ms ms";
    } else {
        echo "Invalid input.";
    }
} else {
    echo "POST only.";
}
?>