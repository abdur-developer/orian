// Firebase Import
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
import { getDatabase, ref, onValue, set } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-database.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-analytics.js";

// Firebase Config & Init
const firebaseConfig = {
    apiKey: "AIzaSyCm-lGYEk_5riAWRLIXTQC1VUgwVDIe2K4",
    authDomain: "nayok-420.firebaseapp.com",
    databaseURL: "https://nayok-420-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "nayok-420",
    storageBucket: "nayok-420.appspot.com",
    messagingSenderId: "886043728751",
    appId: "1:886043728751:web:ff3088fefd30e5bddc669a",
    measurementId: "G-E23KJNZVDW"
};

const app = initializeApp(firebaseConfig);
const db = getDatabase(app);
getAnalytics(app);

// Globals
let lastMessageId = 0;
const userIdElem = document.getElementById("user_id_from_local_db");
const userId = userIdElem && !isNaN(parseInt(userIdElem.innerText, 10)) ? parseInt(userIdElem.innerText, 10) : null;

// Load messages (initial or new only)
function loadMessages(initial = false) {
    fetch("js/get_chat.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            user_id: userId,
            last_id: initial ? 0 : lastMessageId
        })
    })
    .then(res => res.json())
    .then(messages => {
        messages.forEach(msg => {
            appendMessage(msg);
            lastMessageId = msg.id;
        });
        scrollToBottom();
    });
}

// Append single message
function appendMessage(msg) {
    const chatBody = document.getElementById("chatBody");
    const div = document.createElement("div");
    div.className = `message ${msg.sender == 1 ? "user" : "admin"}`;
    // Format timestamp: show date if >1 day ago, else show time
    let timeStr;
    const date = msg.timestamp ? new Date(msg.timestamp) : new Date();
    const now = new Date();
    const isSameDay = date.toDateString() === now.toDateString();
    if (isSameDay) {
        let h = date.getHours(), m = date.getMinutes();
        const ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12 || 12;
        timeStr = `${h}:${m.toString().padStart(2, '0')} ${ampm}`;
    } else {
        timeStr = `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
    }
    div.innerHTML = `
        ${msg.message}
        <span class="message-time">${timeStr}</span>
    `;
    chatBody.appendChild(div);
}

// Scroll chat to bottom
function scrollToBottom() {
    const chatBody = document.getElementById("chatBody");
    chatBody.scrollTop = chatBody.scrollHeight;
}

// Send message
function sendMessage(event) {
    event.preventDefault();
    const input = document.getElementById("userInput");
    const message = input.value.trim();
    if (!message) return;

    appendLocalMessage(message);
    input.value = "";
    scrollToBottom();
    fetch("js/add_chat.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            user_id: userId,
            messages: message,
            type: 1 //user
        })
    })
    .then(res => res.json())
    .then((res) => {
        if (res.success) {
            const adminStatusRef = ref(db, `/message_status/admin/user_${userId}`);
            set(adminStatusRef, "unread");
        }
    });
}
window.sendMessage = sendMessage;

// Show user message immediately
function appendLocalMessage(msg) {
    const chatBody = document.getElementById("chatBody");
    const div = document.createElement("div");
    div.className = "message user";
    div.innerHTML = `${msg} <span class="message-time">${getCurrentTime()}</span>`;
    chatBody.appendChild(div);
}

function getCurrentTime() {
    const now = new Date();
    let h = now.getHours(), m = now.getMinutes();
    const ampm = h >= 12 ? 'PM' : 'AM';
    h = h % 12 || 12;
    return `${h}:${m.toString().padStart(2, '0')} ${ampm}`;
}

// Notification with permission
async function showNotification() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: "New message received"
    });
    const audio = new Audio('js/noti.wav');
    audio.play().catch(() => {
        console.log("Autoplay might be blocked; ignore error");
    });
}

// Firebase message watcher
const statusRef = ref(db, `message_status/user_${userId}/admin`);
onValue(statusRef, (snap) => {
    const status = snap.val();
    if (status === "unread") {
        showNotification();
        loadMessages(); // Only load new
        set(statusRef, "read");
    }
});

// Init
document.addEventListener("DOMContentLoaded", () => {
    loadMessages(true);
    document.getElementById("userInput").focus();
});
