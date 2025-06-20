<style>
  #chatbox {
    position: fixed;
    bottom: 80px;
    right: 30px;
    width: 320px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    display: none;
    z-index: 999;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  #chatbox .header {
    background: linear-gradient(135deg, #28a745, #218838);
    color: white;
    padding: 12px;
    border-radius: 10px 10px 0 0;
    font-weight: bold;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  #chatbox .header .close-btn {
    background: none;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
  }

  #chatbox .body {
    padding: 15px;
    font-size: 14px;
    height: 300px;
    overflow-y: auto;
    background: #f9f9f9;
  }

  #chatbox .footer {
    padding: 12px;
    border-top: 1px solid #e1e1e1;
    background: white;
  }

  .message-box {
    padding: 10px;
    margin-bottom: 12px;
    border-radius: 8px;
    max-width: 80%;
    word-wrap: break-word;
  }

  .bot-message {
    background: #e9f5ee;
    border-radius: 0 8px 8px 8px;
    margin-right: auto;
  }

  .user-message {
    background: #d4edda;
    border-radius: 8px 0 8px 8px;
    margin-left: auto;
    text-align: right;
  }

  .suggestions {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
  }

  .suggestion-btn {
    background: #f1f8ff;
    border: 1px solid #d1e3ff;
    border-radius: 15px;
    padding: 5px 12px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.2s;
  }

  .suggestion-btn:hover {
    background: #e1ecf7;
    transform: translateY(-2px);
  }

  .input-group {
    display: flex;
  }

  #userInput {
    flex: 1;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 20px 0 0 20px;
    outline: none;
  }

  .send-btn {
    border-radius: 0 20px 20px 0;
    background: #28a745;
    color: white;
    border: none;
    padding: 0 15px;
    cursor: pointer;
  }

  .toggle-btn {
    position: fixed;
    bottom: 20px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: #28a745;
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 24px;
    z-index: 1000;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .toggle-btn:hover {
    background: #218838;
    transform: scale(1.05);
  }

  .typing-indicator {
    display: flex;
    padding: 8px;
  }

  .typing-dot {
    width: 6px;
    height: 6px;
    background-color: #666;
    border-radius: 50%;
    margin: 0 2px;
    animation: typingAnimation 1.4s infinite ease-in-out;
  }

  .typing-dot:nth-child(1) {
    animation-delay: 0s;
  }

  .typing-dot:nth-child(2) {
    animation-delay: 0.2s;
  }

  .typing-dot:nth-child(3) {
    animation-delay: 0.4s;
  }

  @keyframes typingAnimation {
    0%, 60%, 100% { transform: translateY(0); }
    30% { transform: translateY(-5px); }
  }

  .timestamp {
    font-size: 10px;
    color: #666;
    margin-top: 4px;
  }
</style>

<!-- Toggle Button -->
<button class="toggle-btn" onclick="toggleChat()">💬</button>

<!-- Chat Box -->
<div id="chatbox">
  <div class="header">
    <span>AI Chat</span>
    <button class="close-btn" onclick="toggleChat()">×</button>
  </div>
  <div class="body" id="chatBody">
    <div class="message-box bot-message">
      <strong>AI:</strong> আসসালামু আলাইকুম! আমি AI সহকারী। কিভাবে আপনাকে সাহায্য করতে পারি? 🙏
      <div class="timestamp">আজ <?php echo date('h:i A'); ?></div>
      <div class="suggestions" id="initialSuggestions"></div>
    </div>
    <div class="message-box bot-message">
      আপনি চাইলে আমাদের ফেসবুক পেজেও যোগাযোগ করতে পারেন 👉 
      <a href="#" target="_blank" style="color: #218838; text-decoration: underline;">Facebook Page</a>
      <div class="timestamp"><?php echo date('h:i A'); ?></div>
    </div>
  </div>
  <div class="footer d-none">
    <div class="input-group">
      <input type="text" class="form-control" id="userInput" placeholder="আপনার মেসেজ লিখুন..." onkeypress="handleKeyPress(event)">
      <button class="send-btn" onclick="sendMessage()">➤</button>
    </div>
  </div>
</div>

<script>
  // Toggle chat visibility
  function toggleChat() {
    var chat = document.getElementById("chatbox");
    chat.style.display = (chat.style.display === "none" || chat.style.display === "") ? "block" : "none";
    
    // Load suggestions when chat is opened for the first time
    if (chat.style.display === "block" && document.getElementById("initialSuggestions").children.length === 0) {
      loadInitialSuggestions();
    }
  }

  // Load initial suggestions
  async function loadInitialSuggestions() {
    const initialSuggestions = document.getElementById("initialSuggestions");
    const suggestions = await fetchSuggestions();
    
    if (suggestions.length > 0) {
      suggestions.forEach(suggestion => {
        const button = document.createElement("button");
        button.className = "suggestion-btn";
        button.textContent = suggestion.message_text;
        button.onclick = () => {
          sendSuggestion(button, suggestion.id);
        };
        initialSuggestions.appendChild(button);
      });
    }
  }

  // Fetch suggestions from API
  let isInitialShowed = false;
  async function fetchSuggestions(parentId = null) {
    if (isInitialShowed && parentId == null) return []; // Prevent fetching initial suggestions again
    try {
      if (parentId == null) isInitialShowed = true;
      const response = await fetch(`section/api_suggestion.php?parent_id=${parentId || ''}`);
      const data = await response.json();
      return data.success ? data.suggestions : [];
    } catch (error) {
      console.error('Error fetching suggestions:', error);
      return [];
    }
  }

  // Send message to API
  async function sendMessageToAPI(message, suggestionId = null) {
    try {
      const response = await fetch('section/api_response.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ 
          message: message,
          message_id: suggestionId 
        })
      });
      return await response.json();
    } catch (error) {
      console.error('Error sending message:', error);
      return {
        success: false,
        response: "Sorry, I encountered an error. Please try again."
      };
    }
  }

  // Send user message
  async function sendMessage() {
    const userInput = document.getElementById("userInput");
    const message = userInput.value.trim();
    
    if (message) {
      addMessage(message, 'user');
      userInput.value = '';
      showTyping();
      
      const apiResponse = await sendMessageToAPI(message);
      hideTyping();
      
      if (apiResponse.success) {
        addMessage(apiResponse.response, 'bot');
        const suggestions = await fetchSuggestions(apiResponse.next_suggestions_parent_id || null);
        if (suggestions.length > 0) {
          showSuggestions(suggestions);
        }
      } else {
        addMessage(apiResponse.response, 'bot');
      }
    }
  }

  // Send suggestion
  async function sendSuggestion(button, suggestionId) {
    const message = button.textContent;
    addMessage(message, 'user');
    showTyping();
    
    const apiResponse = await sendMessageToAPI(message, suggestionId);
    hideTyping();
    
    if (apiResponse.success) {
      addMessage(apiResponse.response, 'bot');
      const suggestions = await fetchSuggestions(apiResponse.next_suggestions_parent_id || null);
      if (suggestions.length > 0) {
        showSuggestions(suggestions);
      }
    } else {
      addMessage(apiResponse.response, 'bot');
    }
  }

  // Handle Enter key press
  function handleKeyPress(event) {
    if (event.key === 'Enter') {
      sendMessage();
    }
  }

  // Add message to chat
  function addMessage(message, sender) {
    const chatBody = document.getElementById("chatBody");
    const messageBox = document.createElement("div");
    messageBox.className = `message-box ${sender}-message`;
    
    const now = new Date();
    // Get time in Dhaka and format as h:i A
    const options = { hour: '2-digit', minute: '2-digit', hour12: true, timeZone: 'Asia/Dhaka' };
    const timeString = now.toLocaleTimeString('en-US', options);
    
    messageBox.innerHTML = `
      ${sender === 'bot' ? '<strong>AI:</strong> ' : ''}${message}
      <div class="timestamp">${timeString}</div>
    `;
    
    chatBody.appendChild(messageBox);
    chatBody.scrollTop = chatBody.scrollHeight;
  }

  // Show typing indicator
  function showTyping() {
    const chatBody = document.getElementById("chatBody");
    const typingIndicator = document.createElement("div");
    typingIndicator.className = "message-box bot-message";
    typingIndicator.id = "typingIndicator";
    typingIndicator.innerHTML = `
      <div class="typing-indicator">
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
      </div>
    `;
    
    chatBody.appendChild(typingIndicator);
    chatBody.scrollTop = chatBody.scrollHeight;
  }

  // Hide typing indicator
  function hideTyping() {
    const typingIndicator = document.getElementById("typingIndicator");
    if (typingIndicator) {
      typingIndicator.remove();
    }
  }

  // Show suggestion buttons
  function showSuggestions(suggestions) {
    const chatBody = document.getElementById("chatBody");
    const suggestionsDiv = document.createElement("div");
    suggestionsDiv.className = "suggestions";
    
    suggestions.forEach(suggestion => {
      const button = document.createElement("button");
      button.className = "suggestion-btn";
      button.textContent = suggestion.message_text;
      button.onclick = () => {
        sendSuggestion(button, suggestion.id);
      };
      suggestionsDiv.appendChild(button);
    });
    
    chatBody.appendChild(suggestionsDiv);
    chatBody.scrollTop = chatBody.scrollHeight;
  }

  // Initialize chat when page loads
  document.addEventListener('DOMContentLoaded', function() {
    // Load initial suggestions when chat is first opened
    document.getElementById("chatbox").addEventListener('click', loadInitialSuggestions, { once: true });
  });
</script>