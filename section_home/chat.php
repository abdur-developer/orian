<style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --user-color: #0c0092;
      --max-color: #f72585;
      --light-bg: #f8f9fa;
      --dark-text: #212529;
      --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      --border-radius: 12px;
    }
    .header{
        display: none;
    }
    
    #chat-section {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 85vh;
    }
    
    #chat-section .chat-container {
      width: 100%;
      max-width: 450px;
      height: 100%;
      max-height: 800px;
      background-color: white;
      display: flex;
      flex-direction: column;
      border-radius: var(--border-radius);
      box-shadow: var(--shadow);
      overflow: hidden;
      transition: all 0.3s ease;
    }
    
    #chat-section .chat-header {
      padding: 18px;
      background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
      color: #f8f9fa;
      font-size: 20px;
      font-weight: 600;
      text-align: center;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      position: relative;
    }
    
    #chat-section .chat-header::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 0;
      height: 0;
      border-left: 10px solid transparent;
      border-right: 10px solid transparent;
      border-top: 10px solid var(--secondary-color);
    }
    
    #chat-section .status-dot {
      width: 10px;
      height: 10px;
      background-color: #4ade80;
      border-radius: 50%;
      margin-right: 10px;
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0% { transform: scale(0.95); }
      50% { transform: scale(1.1); }
      100% { transform: scale(0.95); }
    }
    
    #chat-section .chat-body {
      flex: 1;
      padding: 20px;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      background-color: var(--light-bg);
      background-image: radial-gradient(circle at 1px 1px, #e0e0e0 1px, transparent 0);
      background-size: 20px 20px;
    }
    
    #chat-section .message {
      margin: 10px 0;
      padding: 6px 16px;
      border-radius: var(--border-radius);
      max-width: 80%;
      position: relative;
      line-height: 1.4;
      font-size: 15px;
      box-shadow: var(--shadow);
      transition: transform 0.2s ease, opacity 0.2s ease;
    }
    
    #chat-section .message:hover {
      transform: translateY(-2px);
    }
    
    #chat-section .user {
      align-self: flex-end;
      background-color: var(--user-color);
      color: white;
      border-bottom-right-radius: 4px;
      animation: slideInRight 0.3s ease;
    }
    
    #chat-section .admin {
      align-self: flex-start;
      background-color: white;
      color: var(--dark-text);
      border-bottom-left-radius: 4px;
      animation: slideInLeft 0.3s ease;
    }
    
    #chat-section .message-time {
      display: block;
      font-size: 11px;
      opacity: 0.7;
      margin-top: 5px;
      text-align: right;
    }

    #chat-section .chat-input {
      display: flex;
      padding: 15px;
      border-top: 1px solid #e0e0e0;
      background-color: white;
    }

    #chat-section .chat-input input {
      flex: 1;
      padding: 12px 18px;
      border: 2px solid #e0e0e0;
      border-radius: 30px;
      outline: none;
      font-size: 15px;
      transition: all 0.3s ease;
    }

    #chat-section .chat-input input:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
    }

    #chat-section .chat-input button {
      margin-left: 12px;
      padding: 12px 20px;
      border: none;
      background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
      color: white;
      border-radius: 30px;
      cursor: pointer;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    #chat-section .chat-input button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    #chat-section .chat-input button:active {
      transform: translateY(0);
    }

    #chat-section .typing-indicator {
      display: flex;
      padding: 10px;
      align-self: flex-start;
    }

    #chat-section .typing-dot {
      width: 8px;
      height: 8px;
      background-color: #aaa;
      border-radius: 50%;
      margin: 0 2px;
      animation: typingAnimation 1.4s infinite ease-in-out;
    }

    #chat-section .typing-dot:nth-child(1) { animation-delay: 0s; }
    #chat-section .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    #chat-section .typing-dot:nth-child(3) { animation-delay: 0.4s; }

    @keyframes typingAnimation {
      0%, 60%, 100% { transform: translateY(0); }
      30% { transform: translateY(-5px); }
    }
    
    @keyframes slideInLeft {
      from { transform: translateX(-20px); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideInRight {
      from { transform: translateX(20px); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
    
    /* Scrollbar styling */
    #chat-section .chat-body::-webkit-scrollbar {
      width: 6px;
    }

    #chat-section .chat-body::-webkit-scrollbar-track {
      background: transparent;
    }

    #chat-section .chat-body::-webkit-scrollbar-thumb {
      background-color: rgba(0, 0, 0, 0.2);
      border-radius: 3px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 480px) {
      #chat-section .chat-container {
        height: 100%;
        max-height: none;
        border-radius: 0;
      }

      #chat-section .message {
        max-width: 85%;
      }
    }
</style>
<section id="chat-section">
    <script type="module" src="js/chat.js"></script>
    <div class="chat-container">
        <div class="chat-header">
            <span class="status-dot"></span>
            Chat with Consultant
        </div>
        <div class="chat-body" id="chatBody">
            <div class="message admin">
                Hi there! 👋 I'm Alamin, your Mentor. How can I help you today?
                <span class="message-time">Just now</span>
            </div>
        </div>
        <form class="chat-input" onsubmit="sendMessage(event)">
            <input type="text" id="userInput" placeholder="Type a message..." autocomplete="off" disabled>
            <button type="submit" disabled>
                <i class="fas fa-paper-plane"></i>
                <span style="margin-left: 8px;">Send</span>
            </button>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
              const checkSendMessage = setInterval(() => {
                if (typeof sendMessage === 'function') {
                    document.getElementById('userInput').disabled = false;
                    document.querySelector('.chat-input button').disabled = false;
                    clearInterval(checkSendMessage);
                }
              }, 50);
            });
        </script>
    </div>
</section>
<?php
    function isFree() {
        global $conn, $user_id;
        $sql = "SELECT c.price FROM confirm_orders o 
                JOIN consultant c ON o.product_id = c.id 
                WHERE o.type = 'consultant' AND o.validity >= NOW() AND o.user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['price'] != 0) {
                return false;
            }
        }
        return true;
    }
    if(isFree()){ 
        
        $sql = "SELECT * FROM consultant WHERE id = 2";
        $result2 = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        ?>
        <style>
            :root {
              --primary: #4361ee;
              --primary-light: #4cc9f0;
              --secondary: #f72585;
              --dark: #212529;
              --light: #f8f9fa;
              --success: #4ade80;
              --border-radius: 12px;
              --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
              --transition: all 0.3s ease;
            }
            
            #dialog-section {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                z-index: 1000;
                display: flex;
                justify-content: center;
                align-items: center;
                background:rgb(241, 241, 241);
                padding: 0;
            }
            
            .pricing-card {
              width: 100%;
              max-width: 380px;
              background: white;
              border-radius: var(--border-radius);
              box-shadow: var(--shadow);
              overflow: hidden;
              transition: var(--transition);
              transform: translateY(0);
              animation: fadeInUp 0.5s ease;
            }
            
            .pricing-card:hover {
              transform: translateY(-5px);
              box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            }
            
            .plan-name {
              padding: 20px;
              background: linear-gradient(135deg, var(--primary), var(--primary-light));
              color: white;
              font-size: 22px;
              font-weight: 600;
              text-align: center;
            }
            
            .plan-description {
              padding: 15px 20px;
              text-align: center;
              color: var(--dark);
              font-size: 14px;
              border-bottom: 1px solid #eee;
            }
            
            .plan-price {
              padding: 20px;
              text-align: center;
              background-color: #f9f9f9;
              position: relative;
              overflow: hidden;
            }
            
            .price-amount {
              font-size: 36px;
              font-weight: 700;
              color: var(--primary);
            }
            
            .price-duration {
              font-size: 16px;
              color: #666;
            }
            
            .price-savings {
              position: absolute;
              top: 10px;
              right: -30px;
              background-color: var(--secondary);
              color: white;
              padding: 3px 30px;
              font-size: 12px;
              font-weight: 600;
              transform: rotate(45deg);
              box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
            
            .plan-features {
              padding: 20px;
            }
            
            .feature-item {
              display: flex;
              align-items: center;
              margin-bottom: 15px;
              transition: var(--transition);
            }
            
            .feature-item:hover {
              transform: translateX(5px);
            }
            
            .feature-check {
              color: var(--success);
              font-size: 18px;
              margin-right: 10px;
            }
            
            .feature-name {
              font-size: 15px;
              color: var(--dark);
            }
            
            .plan-button {
              display: block;
              width: calc(100% - 40px);
              margin: 0 auto 25px;
              padding: 12px;
              border: 2px solid var(--primary);
              background-color: white;
              color: var(--primary);
              font-size: 16px;
              font-weight: 600;
              border-radius: 30px;
              cursor: pointer;
              transition: var(--transition);
            }
            
            .plan-button:hover {
              background-color: var(--primary);
              color: white;
              transform: translateY(-2px);
              box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
            }
            
            .plan-button:active {
              transform: translateY(0);
            }
            
            .ribbon-corner {
              position: absolute;
              top: 0;
              right: 0;
              width: 0;
              height: 0;
              border-style: solid;
              border-width: 0 50px 50px 0;
              border-color: transparent var(--secondary) transparent transparent;
            }
            
            @keyframes fadeInUp {
              from {
                opacity: 0;
                transform: translateY(20px);
              }
              to {
                opacity: 1;
                transform: translateY(0);
              }
            }
            
            /* Responsive adjustments */
            @media (max-width: 480px) {
              .pricing-card {
                max-width: 100%;
              }
              
              .price-amount {
                font-size: 32px;
              }
            }
            .dg-close {
              position: absolute;
              top: 20px;
              right: 30px;
              cursor: pointer;
              color: var(--dark);
              font-size: 24px;
              transition: color 0.3s ease;
            }
        </style>
        <section id ="dialog-section">
            <span class="dg-close" onclick="document.getElementById('dialog-section').style.display='none';">
                <i class="fas fa-times"></i>
            </span>
            <div class="pricing-card">
                <h3 class="plan-name"><?= $result2['title']; ?></h3>
                <p class="plan-description">ব্যক্তিগত ব্যবহারের জন্য উপযুক্ত একটি প্ল্যান</p>
            
                <div class="plan-price">
                  <span class="price-amount">৳<?=$result2['price']?></span>
                  <span class="price-duration">/ ৩ মাস</span>
                  <span class="price-savings">সেভ ২৫%</span>
                </div>
                
                <div class="plan-features">
                  <div class="feature-item">
                    <i class="fas fa-check-circle feature-check"></i>
                    <div class="feature-name">চ্যাট</div>
                  </div>
                  <div class="feature-item">
                    <i class="fas fa-check-circle feature-check"></i>
                    <div class="feature-name">ভিডিও কনফারেন্স</div>
                  </div>
                  <div class="feature-item">
                    <i class="fas fa-check-circle feature-check"></i>
                    <div class="feature-name">বিশেষ নোটস</div>
                  </div>
                  <div class="feature-item">
                    <i class="fas fa-check-circle feature-check"></i>
                    <div class="feature-name">মেডিক্যাল টিপস</div>
                  </div>
                </div>
            
                <button class="plan-button" onclick="location.href = 'cart/add.php?thanks=<?=encryptSt(2)?>&nani=<?=encryptSt(90)?>&type=consultant'">
                  সাবস্ক্রাইব করুন
                </button>
            </div>
        </section>
    <?php }
?>
