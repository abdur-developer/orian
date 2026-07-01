// Quiz state variables
let quizData = [];
let currentQuestion = 0;
let score = 0;
let timer;
let timeLeft = 30;
let selectedAnswer = null;
let userAnswers = [];
let leaderboardData = [
    { name: "আপনি", score: 0 }
];

const names = [
    "আব্দুল্লাহ", "সুমাইয়া", "রাফি", "তানিয়া", "নাঈম", "ফারিহা", "সাকিব", "মাহি", "ইমন", "জারা",
    "আদনান", "শাহরিন", "রিয়াদ", "নুসরাত", "আরাফাত", "তাসনিম", "রাইhan", "ফাইজা", "সাদমান", "ইশা",
    "আহসান", "মেহজাবিন", "রাশেদ", "তাবাসসুম", "নাইম", "ফাহিমা", "সাব্বির", "মালিহা", "ইব্রাহিম", "জেসমিন",
    "আকিব", "শাহানা", "রিয়াজ", "নুজহাত", "আজাদ", "তানজিলা", "রাফসান", "ফারজানা", "সামির", "ইশরাত",
    "আনাস", "মেহেদি", "রিশাদ", "তানভীর", "নাজিব", "ফারহানা", "সিজান", "মাসুমা", "ইকবাল", "জান্নাত",
    "আরমান", "শামীম", "রনি", "নাজিয়া", "আফনান", "তামান্না", "রাকিব", "ফারিহা", "সাহিল", "ইশতিয়াq",
    "আতিক", "মৌসুমী", "রাফিউল", "তাসলিমা", "নাদিম", "ফারিয়া", "সাদিক", "মুনিয়া", "ইমরান", "জাহিদা",
    "আজহার", "শাহনাজ", "রুবেল", "নিশাত", "আবির", "তাসনিয়া", "রাহাত", "ফারদিন", "সাইফ", "ইবতেশাম",
    "আদিল", "মিম", "রবিন", "নিশি", "আজিম", "তানিশা", "রাশাদ", "ফারহাত", "সামি", "ইমাদ",
    "আরিফ", "শাহানা", "রুমেল", "নাজনীন", "আবরার", "তাহসিন", "রাহিম", "ফারজানা", "সাকিল", "ইফতি"
];

for (let i = 0; i < 14; i++) {
    const randomNameIndex = Math.floor(Math.random() * names.length);
    const randomScore = Math.floor(Math.random() * 11);
    leaderboardData.push({
        name: names[randomNameIndex],
        score: randomScore
    });
}

// DOM elements
const loadingSection = document.getElementById('loading-section');
const quizSection = document.getElementById('quiz-section');
const errorSection = document.getElementById('error-section');
const resultSection = document.getElementById('result-section');
const leaderboard = document.getElementById('leaderboard');
const questionElement = document.getElementById('question');
const optionsElement = document.getElementById('options');
const submitBtn = document.getElementById('submit-btn');
const timeElement = document.getElementById('time');
const progressBar = document.getElementById('progress-bar');
const scoreDisplay = document.getElementById('score-display');
const feedbackElement = document.getElementById('feedback');
const leaderboardList = document.getElementById('leaderboard-list');
const restartBtn = document.getElementById('restart-btn');
const retryBtn = document.getElementById('retry-btn');

// Initialize quiz
function initQuiz() {
    currentQuestion = 0;
    score = 0;
    userAnswers = [];
    loadQuestion();
}

// Fetch quiz data
function fetchQuizData() {
    loadingSection.style.display = 'block';
    quizSection.style.display = 'none';
    errorSection.style.display = 'none';
    resultSection.style.display = 'none';
    leaderboard.style.display = 'none';
    
    fetch('js/get_quiz.php')
    .then(response => response.json())
    .then(data => {
        quizData = data;
        loadingSection.style.display = 'none';
        quizSection.style.display = 'block';
        initQuiz();
    })
    .catch(error => {
        showError();
        console.error('Error fetching quiz data:', error);
    });
}

// Show error state
function showError() {
    loadingSection.style.display = 'none';
    errorSection.style.display = 'block';
}

// Load question
function loadQuestion() {
    resetState();
    const q = quizData[currentQuestion];
    
    // Update progress bar
    progressBar.style.width = `${((currentQuestion) / quizData.length) * 100}%`;
    
    // Set question text
    questionElement.textContent = `${currentQuestion + 1}. ${q.question}`;
    
    // Create options
    q.options.forEach((option, index) => {
        const optionElement = document.createElement('div');
        optionElement.classList.add('option');
        optionElement.textContent = option;
        optionElement.dataset.index = index;
        optionElement.addEventListener('click', selectOption);
        optionsElement.appendChild(optionElement);
    });
    
    // Reset timer
    resetTimer();
}

// Reset quiz state for new question
function resetState() {
    selectedAnswer = null;
    optionsElement.innerHTML = '';
    submitBtn.disabled = true;
}

// Select an option
function selectOption(e) {
    // Remove selected class from all options
    document.querySelectorAll('.option').forEach(option => {
        option.classList.remove('selected');
    });
    
    // Add selected class to clicked option
    e.target.classList.add('selected');
    selectedAnswer = parseInt(e.target.dataset.index);
    submitBtn.disabled = false;
}

// Timer functions
function resetTimer() {
    clearInterval(timer);
    timeLeft = 30;
    timeElement.textContent = timeLeft;
    startTimer();
}

function startTimer() {
    timer = setInterval(() => {
        timeLeft--;
        timeElement.textContent = timeLeft;
        
        // Change color when time is running out
        if (timeLeft <= 10) {
            document.querySelector('.timer').style.background = 'linear-gradient(135deg, #ff6b6b, #ff5252)';
        }
        
        if (timeLeft <= 0) {
            clearInterval(timer);
            submitAnswer();
        }
    }, 1000);
}

// Submit answer
function submitAnswer() {
    clearInterval(timer);
    
    const q = quizData[currentQuestion];
    const options = document.querySelectorAll('.option');
    
    // Disable all options
    options.forEach(option => {
        option.classList.add('disabled');
    });
    
    // Mark correct and wrong answers
    options.forEach((option, index) => {
        if (index === q.answer) {
            option.classList.add('correct');
        } else if (index === selectedAnswer && selectedAnswer !== q.answer) {
            option.classList.add('wrong');
        }
    });
    
    // Store user answer
    userAnswers.push({
        question: q.question,
        userAnswer: selectedAnswer !== null ? q.options[selectedAnswer] : 'সময় শেষ',
        correctAnswer: q.options[q.answer],
        isCorrect: selectedAnswer === q.answer,
        explanation: q.explanation
    });
    
    // Update score if correct
    if (selectedAnswer === q.answer) {
        score++;
    }
    
    // Move to next question or show results
    setTimeout(() => {
        currentQuestion++;
        if (currentQuestion < quizData.length) {
            loadQuestion();
            // Reset timer color
            document.querySelector('.timer').style.background = 'linear-gradient(135deg, var(--primary-color), #3a5bef)';
        } else {
            showResults();
        }
    }, 1500);
}

// Show results
function showResults() {
    quizSection.style.display = 'none';
    resultSection.style.display = 'block';
    leaderboard.style.display = 'block';
    
    // Update score display
    scoreDisplay.innerHTML = `আপনার স্কোর: <span>${score}</span>/${quizData.length}`;
    
    // Calculate stats
    const correctCount = score;
    const wrongCount = quizData.length - score;
    const percentage = Math.round((score / quizData.length) * 100);
    
    // Generate feedback
    feedbackElement.innerHTML = 
    `<h3 class="feedback-title">আপনার উত্তর বিশ্লেষণ</h3>
    
    <div class="feedback-stats">
        <div class="stat-box">
            <div class="stat-value correct">${correctCount}</div>
            <div class="stat-label">সঠিক উত্তর</div>
        </div>
        <div class="stat-box">
            <div class="stat-value wrong">${wrongCount}</div>
            <div class="stat-label">ভুল উত্তর</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">${percentage}%</div>
            <div class="stat-label">সাফল্যের হার</div>
        </div>
    </div>`;
    
    userAnswers.forEach((answer, index) => {
        feedbackElement.innerHTML += 
        `<div class="feedback-item">
            <div class="feedback-question">প্রশ্ন ${index + 1}: ${answer.question}</div>
            
            <div class="feedback-answer">
                <div class="answer-label">আপনার উত্তর:</div>
                <div class="user-answer ${answer.isCorrect ? 'correct' : ''}">${answer.userAnswer}</div>
            </div>
            
            ${!answer.isCorrect ? 
                `<div class="feedback-answer">
                    <div class="answer-label">সঠিক উত্তর:</div>
                    <div class="correct-answer">${answer.correctAnswer}</div>
                </div>`
                : ''}
            ${(answer.explanation != null) ? 
                `<div class="feedback-explanation">
                    ${answer.explanation}
                </div>` : ''}

        </div>`;
    });
    
    // Update leaderboard with user score
    leaderboardData[0].score = score;
    leaderboardData.sort((a, b) => b.score - a.score);
    // Remove scorers with score greater than total questions
    leaderboardData = leaderboardData.filter(player => player.score <= quizData.length);
    // Display leaderboard
    leaderboardList.innerHTML = '';
    leaderboardData.forEach((player, index) => {
        const tr = document.createElement('tr');
        if (player.name === 'আপনি') tr.classList.add('you');
        tr.innerHTML = 
            `<td class="rank">${index + 1}</td>
            <td>${player.name}</td>
            <td>${player.score}/${quizData.length}</td>`;
        leaderboardList.appendChild(tr);
    });
}

// Restart quiz
function restartQuiz() {
    quizSection.style.display = 'block';
    resultSection.style.display = 'none';
    leaderboard.style.display = 'none';
    initQuiz();
}

// Event listeners
submitBtn.addEventListener('click', submitAnswer);
restartBtn.addEventListener('click', restartQuiz);
retryBtn.addEventListener('click', fetchQuizData);

// Start the quiz when page loads
document.addEventListener('DOMContentLoaded', fetchQuizData);