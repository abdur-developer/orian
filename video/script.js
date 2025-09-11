// Password protection
const passwordOverlay = document.getElementById('password-overlay');
const videoElement = document.getElementById('main-video');
const firstNumber = document.getElementById('firstNumber');
const secondNumber = document.getElementById('secondNumber');
const videoName = document.getElementById('video-name');

function generateRandomNumbers() {
    const fn = Math.floor(Math.random() * 10);
    const sn = Math.floor(Math.random() * 10);
    firstNumber.textContent = fn;
    secondNumber.textContent = sn;
}
generateRandomNumbers();

function verifyPassword() {
    const passwordInput = document.getElementById('video-password');
    const fn = parseInt(firstNumber.textContent);
    const sn = parseInt(secondNumber.textContent);
    const correctAnswer = fn + sn;
    // In a real implementation, this would verify with server
    if (parseInt(passwordInput.value) === correctAnswer) {
        passwordOverlay.style.display = 'none';
        initPlayer(videoName.value);
    } else {
        alert("ভুল উত্তর! আবার চেষ্টা করুন।");
    }
    generateRandomNumbers();
    passwordInput.value = '';
}
// Load video function starts here
let currentToken = null;
let currentExpires = 0;
const videoPlayer = document.getElementById('main-video');

async function initPlayer(videoName) {
    try {
        const { token, expires, url } = await getToken(videoName);
        currentToken = token;
        currentExpires = expires;

        videoPlayer.src = url;
        videoPlayer.load();

        // Set up refresh 5 minutes before expiration
        const refreshTime = (expires - 300) * 1000 - Date.now();
        if (refreshTime > 0) {
            setTimeout(refreshToken, refreshTime);
        }

    } catch (error) {
        console.error('Player initialization failed:', error);
        alert('Failed to load video: ' + error.message);
    }
}

async function getToken(videoName) {
    const response = await fetch(`generate_token.php?video=${encodeURIComponent(videoName)}`);
    if (!response.ok) {
        throw new Error('Failed to get token');
    }
    return await response.json();
}

async function refreshToken() {
    try {
        const videoName = new URL(videoPlayer.src).searchParams.get('video');
        const { token, expires, url } = await getToken(videoName);

        currentToken = token;
        currentExpires = expires;

        // Schedule next refresh
        const refreshTime = (expires - 300) * 1000 - Date.now();
        if (refreshTime > 0) {
            setTimeout(refreshToken, refreshTime);
        }

    } catch (error) {
        console.error('Token refresh failed:', error);
        // Retry after 1 minute
        setTimeout(refreshToken, 60000);
    }
}

// Handle token expiration
videoPlayer.addEventListener('error', () => {
    if (videoPlayer.error && videoPlayer.error.code === MediaError.MEDIA_ERR_NETWORK) {
        refreshToken().then(() => {
            videoPlayer.src = `secure_video.php?video=${encodeURIComponent(
                new URL(videoPlayer.src).searchParams.get('video')
            )}&token=${currentToken}&expires=${currentExpires}`;
            videoPlayer.load();
        });
    }
});
// Handle video end



// Module accordion functionality
const moduleHeaders = document.querySelectorAll('.module-header');
moduleHeaders.forEach(header => {
    header.addEventListener('click', () => {
        header.classList.toggle('collapsed');
        const content = header.nextElementSibling;
        if (content.style.display === 'none') {
            content.style.display = 'flex';
        } else {
            content.style.display = 'none';
        }
    });
});

// Video player functionality
function playVideo(element, moduleTitle) {
    const videoSrc = element.getAttribute('data-video');
    const description = element.getAttribute('data-title');

    videoName.value = videoSrc; 
    passwordOverlay.style.display = 'flex';

    // Update active state in playlist
    const playlistItems = document.querySelectorAll('.playlist-item');
    playlistItems.forEach(item => item.classList.remove('active'));
    element.classList.add('active');

    // Update video info
    document.getElementById('module-title').textContent = moduleTitle;
    document.getElementById('video-description').textContent = description;


    // Scroll the active item into view
    element.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

// Disable right-click context menu
document.addEventListener('contextmenu', function (e) {
    e.preventDefault();
});

// Disable keyboard shortcuts
document.addEventListener('keydown', function (e) {
    // Disable F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
    if (e.key === 'F12' ||
        (e.ctrlKey && e.shiftKey && e.key === 'I') ||
        (e.ctrlKey && e.shiftKey && e.key === 'J') ||
        (e.ctrlKey && e.key === 'U')) {
        e.preventDefault();
        alert('এই ফিচারটি ডিজেবল করা আছে সিকিউরিটি কারণে।');
    }
});