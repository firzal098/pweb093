addEventListener('DOMContentLoaded', () => {
    const playButton = document.getElementById('play');
    const label = document.getElementById('timer');
    const circle = document.getElementById('circle');
    const notice = document.getElementById("notice");
    const DELTA = 50;

    let lastTime = performance.now();

    let isPlaying = false;
    let sec = 0;
    let timerPromise = null;

    function convertSeconds(t) {
        const minutes = Math.floor(t / 60000);
        const seconds = Math.floor((t % 60000) / 1000);
        const milliseconds = Math.floor((t % 1000) / 10); // 2-digit ms

        return `${String(minutes).padStart(2, '0')}:` +
            `${String(seconds).padStart(2, '0')}:` +
            `${String(milliseconds).padStart(2, '0')}`;
    }

    function updateTimer() {
        label.innerHTML = convertSeconds(sec)
    }

    function setContentColor(color) {
        Array.from(document.getElementsByClassName('black')).forEach(element => {
            element.style.color = color;
        });
    }

    function updateState() {
        if (isPlaying) {
            lastTime=performance.now();
            document.getElementById("notice").style.opacity = 0;
            playButton.innerHTML = "pause_circle";  
            circle.style.transform = 'translate(-50%, -50%) scale(100)';
            setContentColor("#ffffff");      
            if (!timerPromise) {
                timerPromise = new Promise(nextTimer).then(() => {
                    timerPromise = null; // reset when done
                });
            }
        } else {
            circle.style.transform = 'translate(-50%, -50%) scale(0)';
             setContentColor("#000000");      
            playButton.innerHTML = "play_circle";
        }
    }

    function nextTimer(resolve) {
    if (isPlaying) {
        const now = performance.now();
        const diff = now - lastTime;
        lastTime = now;

        sec += diff;
        updateTimer();

        setTimeout(nextTimer, DELTA, resolve);
    } else {
        resolve();
    }
    }

    function saveTimer(ms) {
        fetch('save.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'time=' + encodeURIComponent(ms)
        })
        .then(res => res.text())
        .then(data => {
            console.log('server said:', data);
        });
    }
    document.getElementById('menu').onclick = function () {
        window.location.href = 'list.php';
    };
    document.getElementById('stop').onclick = function() {
        isPlaying = false;
        updateState();
        const savedSec = sec;
        sec = 0;
        updateTimer();

        if (savedSec != 0) {
            notice.style.opacity = 100;
            notice.innerHTML = "Waktu "+convertSeconds(savedSec)+ " telah disimpan";
            saveTimer(savedSec);
        }
    }

    playButton.onclick = function() {
        isPlaying = !isPlaying;
        updateState();
    }

}) 