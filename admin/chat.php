<?php
    function chotoKro($str, $len=50){
        return substr($str, 0, $len) . "...";
    }
    include_once "../include/dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Chat Application</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --danger-color: #f72585;
            --warning-color: #f8961e;
            --info-color: #4895ef;
        }
        
        body {
            background-color: #f0f2f5;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .chat-container {
            height: 100%;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        #sidebar {
            border-right: 1px solid rgba(0, 0, 0, 0.05);
            height: 100%;
            overflow-y: auto;
            background-color: #ffffff;
        }
        
        .chat-area {
            display: flex;
            flex-direction: column;
            height: 100%;
            background-color: #f5f7fb;
        }
        
        .chat-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
            z-index: 1;
        }
        
        .messages {
            flex: 1;
            overflow-y: auto;
            padding: 0 20px;
            background-image: url('../img/chat-bg.png');
            background-repeat: repeat;
            background-size: 250px;
        }
        
        .message-input {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
            background-color: #ffffff;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.03);
        }
        
        .user-list-item {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .user-list-item:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .user-list-item.active {
            background-color: rgba(67, 97, 238, 0.1);
            border-left: 3px solid var(--primary-color);
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
            border: 2px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .message {
            margin-bottom: 15px;
            max-width: 75%;
            transition: all 0.3s ease;
        }
        
        .received {
            align-self: flex-start;
        }
        
        .sent {
            align-self: flex-end;
        }
        
        .message-content {
            padding: 12px 16px;
            border-radius: 18px;
            position: relative;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            line-height: 1.4;
        }
        .message-content p{
            margin-bottom: 0;
        }
        
        .received .message-content {
            background-color: white;
            border-top-left-radius: 5px;
            color: var(--dark-color);
        }
        
        .sent .message-content {
            background-color: var(--primary-color);
            border-top-right-radius: 5px;
            color: white;
        }
        
        .message-time {
            font-size: 0.7rem;
            color: #6c757d;
            margin-top: 5px;
            display: flex;
            align-items: center;
        }
        
        .sent .message-time {
            color: rgba(255, 255, 255, 0.8);
            justify-content: flex-end;
        }
        
        .received .message-time {
            justify-content: flex-start;
        }
        
        .message-input .form-control {
            border-radius: 20px;
            padding: 10px 15px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: none;
        }
        
        .message-input .btn {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            background-color: var(--primary-color);
            border: none;
            transition: all 0.2s ease;
        }
        
        .message-input .btn:hover {
            background-color: var(--secondary-color);
            transform: scale(1.05);
        }
        
        .unread {
            font-weight: 700 !important;
            color: black;
        }
        .unread .unread-count {
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 10px;
            height: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            font-weight: bold;
            padding: 0;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .chat-container {
                height: 100vh;
                margin-top: 0;
                border-radius: 0;
            }
            
            #sidebar {
                position: absolute;
                width: 100%;
                height: 100%;
                z-index: 10;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            #sidebar.active {
                transform: translateX(0);
            }
            
            .chat-area {
                width: 100%;
            }
            
            .back-to-contacts {
                display: block !important;
                margin-right: 10px;
                cursor: pointer;
            }
        }
        
        .back-to-contacts {
            display: none;
        }
        
        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }
        
        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 3px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.2);
        }
        .logo {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 24px;
            display: flex;
            align-items: center;
        }

        .logo-icon {
            margin-right: 10px;
            color: var(--accent-color);
        }
        #user-list{
             user-select: none;      /* Standard */
            -webkit-user-select: none; /* Safari */
            -moz-user-select: none;    /* Firefox */
            -ms-user-select: none;
        }
    </style>
</head>
<body>
    <span id="user_id_from_local_db" class="d-none"></span>
    <div class="container-fluid chat-container p-0">
        <div class="row g-0 h-100">
            <!-- Sidebar -->
            <div class="col-md-4 col-lg-3" id="sidebar">
                <div style="display: flex; align-items: center;" class="m-2 p-1">
                    <div class="logo">
                        <i class="fas fa-city logo-icon"></i> Chatting
                    </div>
                </div>
                <!-- User List -->
                <div id="user-list"></div>
            </div>
            
            <!-- Chat Area -->
            <div class="col-md-8 col-lg-9 chat-area">
                <!-- Chat Header -->
                <div class="chat-header">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-arrow-left back-to-contacts me-2"></i>
                        <div class="position-relative">
                            <img id="current-img" class="user-avatar">
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0" id="current-user"></h5>
                        </div>
                    </div>
                </div>
                
                <!-- Messages -->
                <div class="messages">
                    <style>
                        #chatBody {
                            overflow-y: auto;
                            height: 100%;
                            min-height: 200px;
                            max-height: 1000px;                            
                            display: flex;
                            flex-direction: column;
                            margin-top: 10px;
                        }
                    </style>
                    <div class="d-flex flex-column" id="chatBody"></div>
                </div>
                
                <!-- Message Input -->
                <div class="message-input">
                    <form class="d-flex align-items-center" onsubmit="sendMessage(event)">
                        <input type="text" id="userInput" class="form-control flex-grow-1" placeholder="Type a message..." autocomplete="off" disabled>
                        <button class="btn btn-primary" type="submit" disabled>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                    const checkSendMessage = setInterval(() => {
                        if (typeof sendMessage === 'function') {
                            document.getElementById('userInput').disabled = false;
                            document.querySelector('.message-input button').disabled = false;
                            clearInterval(checkSendMessage);
                        }
                    }, 50);
                    });
                </script>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../js/admin-chat.js"></script>
    <script>
        // Simple mobile responsiveness
        document.addEventListener('DOMContentLoaded', function() {
            const backButton = document.querySelector('.back-to-contacts');
            const sidebar = document.getElementById('sidebar');
            
            if (backButton && sidebar) {
                backButton.addEventListener('click', function() {
                    sidebar.classList.add('active');
                });
                
                // Simulate clicking on a contact
                const userListItems = document.querySelectorAll('.user-list-item');
                userListItems.forEach(item => {
                    item.addEventListener('click', function() {
                        
                    });
                });
            }
        });
    </script>
</body>
</html>