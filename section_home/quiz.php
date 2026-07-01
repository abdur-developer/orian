<link rel="stylesheet" href="css/quiz.css">

<div class="q-container">
    <!-- Loading State -->
    <div class="quiz-card" id="loading-section">
      <div class="loading-container">
        <div class="loading-spinner"></div>
      </div>
    </div>
    
    <!-- Quiz Section -->
    <div class="quiz-card" id="quiz-section" style="display: none;">
      <div class="progress-container">
        <div class="progress-bar" id="progress-bar"></div>
      </div>
      
      <div class="timer-container">
        <div class="timer">
          <span>⏱️</span>
          <span id="time">30</span> সেকেন্ড
        </div>
      </div>
      
      <div class="question" id="question">প্রশ্ন লোড হচ্ছে...</div>
      
      <div class="options" id="options">
        <!-- Options will be inserted here by JavaScript -->
      </div>
      
      <button class="submit-btn" id="submit-btn" disabled>সাবমিট</button>
    </div>
    
    <!-- Error Section -->
    <div class="quiz-card" id="error-section" style="display: none;">
      <div class="error-message">
        <span>⚠️</span>
        <h3>ডেটা লোড করতে সমস্যা হয়েছে</h3>
        <p>আমরা কুইজ ডেটা লোড করতে পারিনি। দয়া করে আবার চেষ্টা করুন।</p>
        <button class="retry-btn" id="retry-btn">আবার চেষ্টা করুন</button>
      </div>
    </div>
    
    <!-- Result Section -->
    <div class="result-container" id="result-section">
      <h2 class="result-title">আপনার ফলাফল</h2>
      <div class="score" id="score-display">আপনার স্কোর: <span>0</span>/0</div>
      
      <div class="feedback" id="feedback">
        <!-- Feedback will be inserted here by JavaScript -->
      </div>
      
      <button class="restart-btn" id="restart-btn">আবার খেলুন</button>
    </div>
    
    <!-- Leaderboard -->
    <div class="leaderboard" id="leaderboard">
      <h3>🏆 শীর্ষ খেলোয়াড় তালিকা</h3>
      <table class="leaderboard-table">
        <thead>
          <tr>
            <th>র‍্যাঙ্ক</th>
            <th>নাম</th>
            <th>স্কোর</th>
          </tr>
        </thead>
        <tbody id="leaderboard-list">
          <!-- Leaderboard rows will be inserted here -->
        </tbody>
      </table>
    </div>
</div>

<script src="js/quiz.js"></script>