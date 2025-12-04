function switchTab(tabName, clickedBtn, index) {
    const tabs = document.querySelectorAll('#boot1 .tab-container .tab');
    const indicator = document.querySelector('#boot1 .tab-indicator');
  
    tabs.forEach(tab => tab.classList.remove('active'));
    clickedBtn.classList.add('active');
  
    // Update the transform position
    indicator.style.transform = `translateX(${index * 100}%)`;
  
    const forms = document.querySelectorAll('.form-content');
    forms.forEach(form => form.classList.remove('active'));
  
    const activeForm = document.getElementById(`${tabName}-form`);
    if (activeForm) {
      activeForm.classList.add('active');
    }
  }
  


    // Handle boot2
    if (clickedBtn.closest('#boot2')) {
        const tabs = document.querySelectorAll('#boot2 .tab-container2 .tabb');
        const indicator = document.querySelector('#boot2 .tab-indicatorr');
        
        tabs.forEach(tab => tab.classList.remove('active'));
        clickedBtn.classList.add('active');
        
        indicator.style.transform = `translateX(${index * 100}%)`;
    }

    // Handle boot3
    if (clickedBtn.closest('#boot3')) {
        const tabs = document.querySelectorAll('#boot3 .tab-container1 .tabby');
        const indicator = document.querySelector('#boot3 .tab-indicator1');
        
        tabs.forEach(tab => tab.classList.remove('active'));
        clickedBtn.classList.add('active');
        
        // Adjust the width based on the number of tabs and move the indicator
        const tabWidth = clickedBtn.offsetWidth;
        const tabOffset = clickedBtn.offsetLeft;
        indicator.style.width = `${tabWidth}px`;
        indicator.style.transform = `translateX(${tabOffset}px)`;
    }




window.onload = function () {
    const params = new URLSearchParams(window.location.search);
    const popup = document.getElementById("popup");

    if (params.get("error") === "email") {
        popup.textContent = "Email does not exist!";
        popup.style.display = "block";
    } else if (params.get("error") === "password") {
        popup.textContent = "Incorrect password!";
        popup.style.display = "block";
    } else if (params.get("success") === "true") {
        popup.textContent = "Registration successful! You can now login.";
        popup.style.backgroundColor = "#4CAF50";
        popup.style.display = "block";
    } else if (params.get("error") === "exists") {
        popup.textContent = "Email or username already exists!";
        popup.style.display = "block";
    } else if (params.get("error") === "admin") {
        popup.textContent = "Invalid admin credentials!";
        popup.style.display = "block";
    }

    const targetTab = params.get("tab");
    if (targetTab === "register") {
        switchTab("register");
    } else if (targetTab === "admin") {
        switchTab("admin");
    }

    if (popup.style.display === "block") {
        setTimeout(() => {
            popup.style.display = "none";
        }, 3000);
    }

    // Quiz Mode Variables
    let quizMode = false;
    let timeLeft = 15; // Start with 15 seconds
    let score = 0;
    let streak = 0;
    let skipCount = 0;
    let currentQuestionIndex = 0;
    const MAX_SKIP_LIMIT = 3;

    // Question Bank
    const questions = [
        {
            type: 'multiple',
            question: 'What is the correct syntax to output "Hello World" in JavaScript?',
            options: ['console.log("Hello World");', 'print("Hello World");', 'echo "Hello World";', 'document.write("Hello World");'],
            correct: 0
        },
        {
            type: 'truefalse',
            question: 'JavaScript is a case-sensitive language.',
            correct: true
        },
        {
            type: 'fillin',
            question: 'The keyword used to declare a variable in JavaScript is __________.',
            correct: 'var'
        }
        // Add more questions here
    ];

    // DOM Elements
    const quizContainer = document.createElement('div');
    const timeDisplay = document.createElement('div');
    const scoreDisplay = document.createElement('div');
    const streakDisplay = document.createElement('div');
    const skipButton = document.createElement('button');
    const questionDisplay = document.createElement('div');
    const optionsContainer = document.createElement('div');
    const answerInput = document.createElement('input');
    const submitButton = document.createElement('button');

    // Initialize Quiz Mode
    function startQuizMode() {
        quizMode = true;
        initializeQuizUI();
        startTimer();
        showNextQuestion();
    }

    // Initialize Quiz UI
    function initializeQuizUI() {
        quizContainer.className = 'quiz-container';
        
        timeDisplay.textContent = `Time: ${timeLeft}s`;
        scoreDisplay.textContent = `Score: ${score}`;
        streakDisplay.textContent = `Streak: ${streak}`;
        
        skipButton.textContent = 'Skip Question';
        skipButton.onclick = handleSkip;
        
        submitButton.textContent = 'Submit Answer';
        submitButton.onclick = handleAnswer;
        
        quizContainer.appendChild(timeDisplay);
        quizContainer.appendChild(scoreDisplay);
        quizContainer.appendChild(streakDisplay);
        quizContainer.appendChild(skipButton);
        quizContainer.appendChild(questionDisplay);
        quizContainer.appendChild(optionsContainer);
        quizContainer.appendChild(answerInput);
        quizContainer.appendChild(submitButton);
        
        document.body.appendChild(quizContainer);
    }

    // Timer Function
    function startTimer() {
        const timer = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(timer);
                endQuiz();
                return;
            }
            timeLeft--;
            timeDisplay.textContent = `Time: ${timeLeft}s`;
        }, 1000);
    }

    // Show Next Question
    function showNextQuestion() {
        const question = questions[currentQuestionIndex % questions.length];
        questionDisplay.textContent = question.question;
        
        // Clear previous options/input
        optionsContainer.innerHTML = '';
        answerInput.value = '';
        
        // Show appropriate question type
        if (question.type === 'multiple') {
            question.options.forEach((option, index) => {
                const btn = document.createElement('button');
                btn.textContent = option;
                btn.onclick = () => handleAnswer(index);
                optionsContainer.appendChild(btn);
            });
        } else if (question.type === 'truefalse') {
            const trueBtn = document.createElement('button');
            trueBtn.textContent = 'True';
            trueBtn.onclick = () => handleAnswer(true);
            optionsContainer.appendChild(trueBtn);
            
            const falseBtn = document.createElement('button');
            falseBtn.textContent = 'False';
            falseBtn.onclick = () => handleAnswer(false);
            optionsContainer.appendChild(falseBtn);
        } else if (question.type === 'fillin') {
            answerInput.style.display = 'block';
        }
    }

    // Handle Answer
    function handleAnswer(answer) {
        const currentQuestion = questions[currentQuestionIndex % questions.length];
        const isCorrect = (currentQuestion.type === 'fillin' 
            ? answer.toLowerCase() === currentQuestion.correct.toLowerCase()
            : answer === currentQuestion.correct);
        
        if (isCorrect) {
            score += 10;
            if (timeLeft > 10) score += 5; // Bonus for quick answers
            timeLeft += 10;
            streak++;
        } else {
            score -= 5;
            timeLeft -= 2;
            streak = 0;
        }
        
        updateDisplays();
        showNextQuestion();
        currentQuestionIndex++;
    }

    // Handle Skip
    function handleSkip() {
        if (skipCount >= MAX_SKIP_LIMIT) {
            score -= 5; // Penalty for too many skips
        } else {
            skipCount++;
            timeLeft -= 1;
        }
        showNextQuestion();
    }

    // Update Displays
    function updateDisplays() {
        timeDisplay.textContent = `Time: ${timeLeft}s`;
        scoreDisplay.textContent = `Score: ${score}`;
        streakDisplay.textContent = `Streak: ${streak}`;
    }

    // End Quiz
    function endQuiz() {
        quizMode = false;
        quizContainer.remove();
        alert(`Quiz ended! Final Score: ${score}`);
    }

    // Start quiz mode when user clicks on a specific button
    const startQuizBtn = document.getElementById('start-quiz-btn');
    if (startQuizBtn) {
        startQuizBtn.onclick = startQuizMode;
    }
}

  // Enable tooltips
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Sample chart - replace with actual data
  var ctx = document.getElementById('performanceChart');
  if (ctx) {
      new Chart(ctx, {
          type: 'line',
          data: {
              labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
              datasets: [{
                  label: 'Average Score',
                  data: [65, 59, 80, 81, 56, 72],
                  borderColor: '#4e73df',
                  backgroundColor: 'rgba(78, 115, 223, 0.05)',
                  tension: 0.3,
                  fill: true
              }]
          },
          options: {
              maintainAspectRatio: false,
              plugins: {
                  legend: {
                      display: false
                  }
              },
              scales: {
                  y: {
                      beginAtZero: true,
                      max: 100,
                      ticks: {
                          callback: function(value) {
                              return value + '%';
                          }
                      }
                  }
              }
          }
      });
  } 

const button = document.querySelector('.button-main');
const anim = button.querySelector('.btn-anim');
const symbols = ["#", ".", "^{", "-!", "#$_", "№:0", "#{+.", "@}-?", "?{4@%", "=.,^!", "?2@%", "\\;1}]", "?{%:%", "|{f[4", "{4%0%", "'1_0<", "{0%", "]>'", "4", "2"];

button.addEventListener('mouseenter', () => {
  let i = 0;
  anim.style.opacity = 1;
  anim.textContent = symbols[i];
  const interval = setInterval(() => {
    i++;
    if (i >= symbols.length) {
      clearInterval(interval);
      anim.textContent = '';
    } else {
      anim.textContent = symbols[i];
    }
  }, 60); // change symbol every 60ms
});