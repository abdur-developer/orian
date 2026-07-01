// Firebase Import
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
import { getDatabase, ref, onValue, set } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-database.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-analytics.js";


// Firebase Config & Init
const firebaseConfig = {
    apiKey: "AIzaSyBjLHvGtPp0yF20Wyc3IOm3-q3ZWh_Yl1w",
    authDomain: "protisheba-cc0e4.firebaseapp.com",
    databaseURL: "https://nayok-420-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "protisheba-cc0e4",
    storageBucket: "protisheba-cc0e4.firebasestorage.app",
    messagingSenderId: "638647831105",
    appId: "1:638647831105:web:d48df9437d08379f5e54c0",
    measurementId: "G-96G6R16HED"
};

const app = initializeApp(firebaseConfig);
const db = getDatabase(app);
getAnalytics(app);

// Globals
let lastMessageId = 0;
let userId = null;

// Load messages (initial or new only)
function loadMessages(usId, initial = false) {
    userId = usId;
    fetch("../js/get_chat.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            user_id: usId,
            last_id: initial ? 0 : lastMessageId
        })
    })
    .then(res => res.json())
    .then(messages => {
        if(initial){
            const chatBody = document.getElementById("chatBody");
            fetch(`../js/getName.php?id=${usId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                        document.getElementById("current-user").innerHTML = `${data.name} ${data.pro}`;
                        const currentImg = document.getElementById("current-img");
                        currentImg.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(data.name)}&background=random`;
                    } else {
                        console.log(data.message);
                    }
                })
                .catch(error => {
                    document.getElementById('result').textContent = `Fetch error: ${error}`;
                });
            chatBody.innerHTML = null;
        }
        messages.forEach(msg => {
            appendMessage(msg);
            lastMessageId = msg.id;
        });
        const userStatusRef = ref(db, `/message_status/admin/user_${usId}`);
        set(userStatusRef, "read");
        scrollToBottom();
    });
}

// Append single message
function appendMessage(msg) {
    const chatBody = document.getElementById("chatBody");
    const div = document.createElement("div");
    div.className = `message ${msg.sender == 1 ? "received" : "sent"}`;
    div.innerHTML = `
        <div class="message-content">
            <p>${msg.message}</p>
            <div class="message-time">
                <span>${timeAgo(msg.timestamp)}</span>
            </div>
        </div>
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
    if(userId == null) alert("null");
    // if(userId == null) return;
    event.preventDefault();
    const input = document.getElementById("userInput");
    const message = input.value.trim();
    if (!message) return;

    appendLocalMessage(message);
    input.value = "";
    scrollToBottom();
    fetch("../js/add_chat.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            user_id: userId,
            messages: message,
            type: 0 //admin
        })
    })
    .then(res => res.json())
    .then((res) => {
        if (res.success) {
            const userStatusRef = ref(db, `/message_status/user_${userId}/admin`);
            set(userStatusRef, "unread");
        }
    });
}
window.sendMessage = sendMessage;

// Show user message immediately
function appendLocalMessage(msg) {
    const chatBody = document.getElementById("chatBody");
    const div = document.createElement("div");
    div.className = `message sent`;
    div.innerHTML = `
        <div class="message-content">
            <p>${msg}</p>
            <div class="message-time">
                <span>${getCurrentTime()}}</span>
            </div>
        </div>
    `;
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
    const audio = new Audio('../js/noti.wav');
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
        loadMessages(userId); // Only load new
        set(statusRef, "read");
    }
});
function isUnread(status) {
    if (status === "unread"){
        return "unread";
    }else{
        return "";
    }
}
function timeAgo(datetimeStr) {
    const givenTime = new Date(datetimeStr.replace(" ", "T"));
    const now = new Date();
    const diffInSeconds = Math.floor((now - givenTime) / 1000);

    const units = [
        { name: "year", seconds: 365 * 24 * 60 * 60 },
        { name: "month", seconds: 30 * 24 * 60 * 60 },
        { name: "day", seconds: 24 * 60 * 60 },
        { name: "hour", seconds: 60 * 60 },
        { name: "min", seconds: 60 },
        { name: "sec", seconds: 1 },
    ];

    for (let unit of units) {
        const interval = Math.floor(diffInSeconds / unit.seconds);
        if (interval >= 1) {
            return `${interval} ${unit.name}${interval > 1 ? "s" : ""} ago`;
        }
    }

    return "just now";
}
async function getUserIds(){
    try {
        const response = await fetch("../js/get_user_ids.php");
        const data = await response.json();
        return data; // যেমন: ["u3", "u5", "u2"]
    } catch (error) {
        console.error("Error fetching user IDs:", error);
        return [];
    }
}
async function loadUserList() {
    const adminStatusRef = ref(db, `/message_status/admin`);
    onValue(adminStatusRef, async (snapshot) => {
        const users = snapshot.val();
        if (!users) return;

        const userListElem = document.getElementById("user-list");
        if (!userListElem) return;
        userListElem.innerHTML = "";

        // const userIds = Object.keys(users).filter(key => key.startsWith("user_")).map(key => key.replace("user_", ""));
        const userIds = await getUserIds();

        for (const id of userIds) {
            try {
                const res = await fetch("../js/get_user_data.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ user_id: id })
                });

                const data = await res.json();
                if (data.error) continue; // Skip if no message found

                const name = data.name || "Unknown";
                const message = data.message || "";
                const time = data.timestamp || "";

                const div = document.createElement("div");
                div.addEventListener('click', function() {
                    loadMessages(id, true);
                    if (window.innerWidth <= 768) {
                        document.getElementById('sidebar').classList.remove('active');
                        console.log("xx");
                    }
                });
                div.className = "user-list-item";
                div.innerHTML = `
                    <div class="d-flex align-items-center ${isUnread(users["user_" + id])}">
                        <div class="position-relative">
                            <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=random" alt="User" class="user-avatar">
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">${name}</h6>
                                <small class="text-muted">${timeAgo(time)}</small>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0 text-muted small text-truncate" style="max-width: 150px;">${message}</p>
                                <span class="unread-count"></span>
                            </div>
                        </div>
                    </div>
                `;
                userListElem.appendChild(div);
            } catch (e) {
                console.error("User load failed:", e);
            }
        }
        loadMessages(userIds[0], true);
    });
}

// Init
document.addEventListener("DOMContentLoaded", () => {
    loadUserList();
});
