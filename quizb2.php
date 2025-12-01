<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Beginner III</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff00ff;
            --secondary: #00ffff;
            --accent: #ffff00;
            --bg: #000000;
            --screen: #1a1a2e;
            --pixel: 2px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Press Start 2P', cursive;
            image-rendering: pixelated;
        }

        body {
            background: var(--bg);
            color: var(--primary);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            perspective: 1000px;
            overflow-y: auto;
            overflow-x: hidden;
            /* allow page to scroll vertically, but not horizontally */
            background: 
                radial-gradient(circle at center, #1a1a2e 0%, #000 100%),
                repeating-linear-gradient(
                    0deg,
                    rgba(255, 0, 255, 0.1) 0px,
                    rgba(255, 0, 255, 0.1) 1px,
                    transparent 1px,
                    transparent 2px
                );
        }

        .screen {
            position: relative;
            width: 95%;
            max-width: 1000px;
            min-height: 80vh;
            background: var(--screen);
            border: 4px solid var(--primary);
            padding: 3rem;
            transform-style: preserve-3d;
            transform: rotateX(5deg) rotateY(-5deg);
            box-shadow: 
                20px 20px 0 rgba(255, 0, 255, 0.2),
                40px 40px 0 rgba(0, 255, 255, 0.1);
            margin: 2rem auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .screen::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                linear-gradient(
                    to bottom,
                    rgba(255, 0, 255, 0.1) 0%,
                    transparent 50%,
                    rgba(0, 255, 255, 0.1) 100%
                );
            pointer-events: none;
        }

        h1 {
            text-align: center;
            margin: 2rem 0 3rem;
            color: var(--accent);
            text-shadow: 
                4px 4px 0 var(--primary),
                8px 8px 0 var(--secondary);
            font-size: 3.5rem;
            letter-spacing: 3px;
            transform: rotate(-1deg);
            animation: glitch 5s infinite;
            line-height: 1.3;
        }

        .btn {
            background: var(--primary);
            color: #000;
            border: none;
            padding: 1.5rem 3rem;
            font-family: 'Press Start 2P', cursive;
            font-size: 1.5rem;
            cursor: pointer;
            position: relative;
            margin: 1.5rem 0;
            text-transform: uppercase;
            min-width: 300px;
            letter-spacing: 2px;
            transition: all 0.3s;
            border: 4px solid var(--primary);
            box-shadow: 
                4px 4px 0 var(--secondary),
                8px 8px 0 var(--accent);
            z-index: 10; /* Ensure button is above other elements */
            pointer-events: auto !important; /* Force clickable */
        }
        
        /* Make sure the button container is properly positioned */
        .container {
            position: relative;
            z-index: 5;
        }

        .btn:hover {
            transform: translate(2px, 2px);
            box-shadow: 
                2px 2px 0 var(--secondary),
                4px 4px 0 var(--accent);
        }

        .btn:active {
            transform: translate(4px, 4px);
            box-shadow: none;
        }

        .primary-btn {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
        }

        .secondary-btn {
            background: transparent;
            color: var(--secondary);
            border-color: var(--secondary);
            position: relative;
            z-index: 10;
            pointer-events: auto !important;
        }
        
        /* Ensure the skip button container has proper stacking context */
        .game-container > div[style*="text-align: center"] {
            position: relative;
            z-index: 5;
            pointer-events: auto;
        }

        .timer-section {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: rgba(0, 0, 0, 0.8);
            padding: 1.2rem 2rem;
            border: 4px solid var(--accent);
            border-radius: 8px;
            transform: rotate(-1deg);
            z-index: 1000;
            box-shadow: 0 0 20px rgba(255, 255, 0, 0.7);
        }
        
        .timer-section:hover {
            transform: rotate(0deg) scale(1.05);
            transition: all 0.3s ease;
        }

        .timer {
            color: var(--accent);
            font-size: 1.8rem;
            font-weight: bold;
            text-shadow: 0 0 5px rgba(255, 255, 0, 0.7);
            letter-spacing: 1px;
        }
        
        /* Add some animation for the timer when it's running low */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .timer.low-time {
            animation: pulse 1s infinite;
            color: #ff4444;
        }

        .question-container {
            margin: 2rem 0;
            padding: 1.5rem;
            background: rgba(0, 0, 0, 0.5);
            border: 2px solid var(--secondary);
            position: relative;
        }

        .question-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
        }

        .question-text {
            margin-bottom: 1.5rem;
            line-height: 1.6;
            color: #fff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);

/* Add some animation for the timer when it's running low */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.timer.low-time {
    animation: pulse 1s infinite;
    color: #ff4444;
}
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .option-btn {
            background: rgba(0, 0, 0, 0.7);
            border: 3px solid var(--primary);
            color: white;
            padding: 1.5rem;
            font-family: 'Press Start 2P', cursive;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
            text-align: left;
            position: relative;
            overflow: hidden;
            z-index: 100;
            pointer-events: auto !important;
        }

        .option-btn:hover {
            background: rgba(255, 0, 255, 0.3);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 0, 255, 0.4);
        }
        
        .option-btn:active {
            transform: translateY(1px);
        }

        .option-btn.correct {
            background: rgba(0, 255, 0, 0.2);
            border-color: #0f0;
            color: #0f0;
        }

        .option-btn.incorrect {
            background: rgba(255, 0, 0, 0.2);
            border-color: #f00;
            color: #f00;
        }

        .options-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin: 3rem 0;
            position: relative;
            z-index: 100;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: var(--screen);
            padding: 2rem;
            border: 4px solid var(--accent);
            max-width: 80%;
            text-align: center;
            position: relative;
            transform-style: preserve-3d;
            animation: modalAppear 0.5s ease-out;
        }
        
        .modal-content #restartBtn {
            margin: 0 auto;
            display: block;
        }

        @keyframes modalAppear {
            from {
                opacity: 0;
                transform: translateY(-50px) rotateX(30deg);
            }
            to {
                opacity: 1;
                transform: translateY(0) rotateX(0);
            }
        }

        @keyframes glitch {
            0%, 100% {
                text-shadow: 
                    3px 3px 0 var(--primary),
                    6px 6px 0 var(--secondary);
            }
            25% {
                text-shadow: 
                    -3px 3px 0 var(--secondary),
                    -6px 6px 0 var(--accent);
            }
            50% {
                text-shadow: 
                    3px -3px 0 var(--accent),
                    6px -6px 0 var(--primary);
            }
            75% {
                text-shadow: 
                    -3px -3px 0 var(--primary),
                    -6px -6px 0 var(--secondary);
            }
        }

        .pixel-corner {
            position: absolute;
            width: 20px;
            height: 20px;
            border: 4px solid var(--accent);
            z-index: 1;
        }

        .pixel-corner.tl {
            top: -10px;
            left: -10px;
            border-right: none;
            border-bottom: none;
        }

        .pixel-corner.tr {
            top: -10px;
            right: -10px;
            border-left: none;
            border-bottom: none;
        }

        .pixel-corner.bl {
            bottom: -10px;
            left: -10px;
            border-right: none;
            border-top: none;
        }

        .pixel-corner.br {
            bottom: -10px;
            right: -10px;
            border-left: none;
            border-top: none;
        }

        /* Scanline effect */
        .scanlines {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                linear-gradient(
                    to bottom,
                    rgba(0, 0, 0, 0) 50%,
                    rgba(255, 255, 255, 0.03) 50%
                );
            background-size: 100% 5px;
            z-index: 9999;
            pointer-events: none !important;
        }

        /* CRT curve effect */
        .crt::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(
                    circle at center,
                    transparent 0%,
                    rgba(0, 0, 0, 0.2) 100%
                );
            pointer-events: none;
            z-index: 1001;
        }
    </style>
</head>
<body class="crt">
    <div class="scanlines" style="pointer-events: none;"></div>
    
    <div id="startScreen" class="screen">
        <div class="pixel-corner tl"></div>
        <div class="pixel-corner tr"></div>
        <div class="pixel-corner bl"></div>
        <div class="pixel-corner br"></div>
        
        <div class="container">
            <h1>PYTHON BEGINNER II</h1>
            <p class="description" style="text-align: center; margin: 2rem 0; line-height: 1.6; color: var(--secondary);">
                TEST YOUR KNOWLEDGE IN THIS<br>
                <span style="color: var(--accent); font-size: 1.5rem;">PYTHON BEGINNER II</span><br>
                PRESS START TO BEGIN!
            </p>
            
            <!-- Instructions Section -->
            <div style="background: rgba(0, 0, 0, 0.6); border: 3px solid var(--secondary); padding: 2rem; margin: 2rem 0; max-width: 800px; margin-left: auto; margin-right: auto; max-height: 340px; overflow-y: auto; scrollbar-color: var(--secondary) #222; scrollbar-width: thin;">
                <h2 style="text-align: center; color: var(--accent); margin-bottom: 1.5rem; font-size: 1.5rem; text-shadow: 2px 2px 0 var(--primary);">
                    GAME MECHANICS
                </h2>
                
                <div style="text-align: left; color: var(--secondary); line-height: 1.8; font-size: 0.8rem;">
                    <div style="margin-bottom: 1.2rem; padding: 0.8rem; background: rgba(255, 0, 255, 0.1); border-left: 4px solid var(--primary);">
                        <h3 style="color: var(--accent); margin-bottom: 0.5rem; font-size: 0.9rem;">⏱️ TIME LIMIT</h3>
                        <p style="margin-left: 0.5rem;">• Each question has a <span style="color: var(--accent);">15-second time limit</span></p>
                        <p style="margin-left: 0.5rem;">• The timer resets for each new question</p>
                        <p style="margin-left: 0.5rem; font-weight: bold; color: #ff4444;">• If time runs out on any question, the game ends immediately</p>
                    </div>
                    
                    <div style="margin-bottom: 1.2rem; padding: 0.8rem; background: rgba(255, 0, 0, 0.1); border-left: 4px solid #ff4444;">
                        <h3 style="color: var(--accent); margin-bottom: 0.5rem; font-size: 0.9rem;">❌ WRONG ANSWER PENALTY</h3>
                        <p style="margin-left: 0.5rem;">• Each wrong answer <span style="color: #ff4444;">deducts 5 seconds</span> from the timer</p>
                        <p style="margin-left: 0.5rem;">• The timer will not go below 1 second</p>
                        <p style="margin-left: 0.5rem;">• You can continue trying until you get the correct answer</p>
                    </div>
                    
                    <div style="margin-bottom: 1.2rem; padding: 0.8rem; background: rgba(0, 255, 255, 0.1); border-left: 4px solid var(--secondary);">
                        <h3 style="color: var(--accent); margin-bottom: 0.5rem; font-size: 0.9rem;">⏭️ SKIP QUESTION</h3>
                        <p style="margin-left: 0.5rem;">• You can skip questions using the "Skip Question" button</p>
                        <p style="margin-left: 0.5rem; font-weight: bold; color: var(--accent);">• You can only skip each question <span style="color: #ff4444;">once</span></p>
                        <p style="margin-left: 0.5rem;">• Skipped questions can be answered later if time permits</p>
                        <p style="margin-left: 0.5rem;">• Skipped questions don't affect passing the level</p>
                    </div>
                    
                    <div style="margin-bottom: 1.2rem; padding: 0.8rem; background: rgba(255, 255, 0, 0.1); border-left: 4px solid var(--accent);">
                        <h3 style="color: var(--accent); margin-bottom: 0.5rem; font-size: 0.9rem;">🎯 WINNING CONDITION</h3>
                        <p style="margin-left: 0.5rem;">• Answer all questions <b>before time runs out</b></p>
                        <p style="margin-left: 0.5rem;">• Do <span style='color:#ff4444;font-weight:bold;'>not</span> get 3 wrong answers on any question</p>
                        <p style="margin-left: 0.5rem;">• If you complete every question in time, you WIN and complete the level!</p>
                    </div>
                </div>
            </div>
            
            <div style="text-align: center;">
                <button id="startBtn" class="btn primary-btn">START GAME</button>
            </div>
        </div>
    </div>

    <div id="gameArea" class="screen" style="display: none;">
        <div class="pixel-corner tl"></div>
        <div class="pixel-corner tr"></div>
        <div class="pixel-corner bl"></div>
        <div class="pixel-corner br"></div>
        
        <div class="game-container" style="position: relative; z-index: 5;">
            <div class="timer-section">
                <div class="timer">TIME: <span id="timer">15</span>s</div>
                <div style="color: var(--secondary); font-size: 0.7rem; margin-top: 0.5rem; text-align: center;">
                    Per Question
                </div>
            </div>
            
            <div class="question-container">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <div id="questionNumber" style="color: var(--accent); font-family: 'Press Start 2P', cursive; font-size: 0.8rem;">
                        Question 1 of 10
                    </div>
                </div>
                <h3 id="question" class="question-text">LOADING QUESTION...</h3>
                <div id="optionsContainer" class="options-grid"></div>
            </div>

            <div style="text-align: center; margin-top: 2rem; position: relative; z-index: 10;">
                <button id="nextBtn" class="btn secondary-btn">Next Question →</button>
            </div>
        </div>
    </div>

    <div id="gameOver" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="pixel-corner tl"></div>
            <div class="pixel-corner tr"></div>
            <div class="pixel-corner bl"></div>
            <div class="pixel-corner br"></div>
            
            <div class="modal-header">
                <h2 class="modal-title" style="color: var(--accent); margin-bottom: 1.5rem;">GAME OVER</h2>
                <p id="finalScore" style="color: var(--secondary); margin-bottom: 2rem; font-size: 1.2rem; display:none;"></p>
            </div>
            <button id="restartBtn" class="btn primary-btn">PLAY AGAIN</button>
        </div>
    </div>

    <script>
        // Game state
        let timeLeft = 15; // Time limit per question (in seconds)
        let questionTimeLimit = 15; // Time limit for each question
        let timer;
        let currentQuestionIndex = 0;
        let questions = [];
        let gameActive = false; // Track if game is in progress
        let skippedQuestions = []; // Track skipped questions (for navigation)
        let skippedQuestionSet = new Set(); // Track which questions have been skipped (to prevent multiple skips)
        let answeredQuestions = new Set(); // Track answered question indices
        let wrongAnswerCount = 0; // Track wrong answer attempts for current question

        // Helper: check if an option index is correct for a question
        function isCorrectIndex(question, index) {
            if (Array.isArray(question.correct)) {
                return question.correct.includes(index);
            }
            return index === question.correct;
        }
        
        // DOM Elements
        const startScreen = document.getElementById('startScreen');
        const gameArea = document.getElementById('gameArea');
        const gameOverScreen = document.getElementById('gameOver');
        const startBtn = document.getElementById('startBtn');
        const skipBtn = document.getElementById('skipBtn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const restartBtn = document.getElementById('restartBtn');
        const questionElement = document.getElementById('question');
        const questionNumberElement = document.getElementById('questionNumber');
        const optionsContainer = document.getElementById('optionsContainer');
        const timerElement = document.getElementById('timer');
        const finalScoreElement = document.getElementById('finalScore');

        // Fetch questions from database
        async function fetchQuestions() {
            try {
                console.log('Fetching questions from database...');
                // Fetch questions for Beginner II (level 2, difficulty beginner)
                const response = await fetch('fetch_all_questions.php?level=2&difficulty=beginner');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const text = await response.text();
                console.log('Raw response:', text.substring(0, 200)); // Log first 200 chars
                
                let data;
                try {
                    data = JSON.parse(text);
                } catch (parseError) {
                    console.error('JSON parse error:', parseError);
                    console.error('Response text:', text);
                    throw new Error('Invalid JSON response from server');
                }
                
                // Check if response contains an error
                if (data.error) {
                    console.error('Database error:', data.error);
                    throw new Error(data.error);
                }
                
                console.log('Questions fetched:', Array.isArray(data) ? data.length : 0, 'questions');
                
                if (!Array.isArray(data) || data.length === 0) {
                    console.error('No questions returned from database');
                    console.log('Response data:', data);
                    return [];
                }
                
                // Transform database format to game format
                return data.map(q => {
                    const options = [q.choice_a, q.choice_b, q.choice_c, q.choice_d];
                    const rawCorrect = q.correct_answer != null ? q.correct_answer.toString() : '';

                    // Support multiple correct answers (comma/pipe/semicolon separated, by value or by letter A-D)
                    const parts = rawCorrect
                        .split(/[,|;]/)
                        .map(p => p.trim())
                        .filter(p => p.length > 0);

                    const correctIndices = [];

                    parts.forEach(part => {
                        let idx = options.findIndex(opt =>
                            opt != null &&
                            opt.toString().trim().toLowerCase() === part.toLowerCase()
                        );
                        if (idx === -1) {
                            // Try by letter A-D
                            idx = ['A', 'B', 'C', 'D'].indexOf(part.toUpperCase());
                        }
                        if (idx !== -1 && !correctIndices.includes(idx)) {
                            correctIndices.push(idx);
                        }
                    });

                    // Fallback: if nothing matched, keep existing single-answer behaviour
                    if (correctIndices.length === 0) {
                        const singleIdx = options.findIndex(opt =>
                            opt != null &&
                            opt.toString().trim().toLowerCase() === rawCorrect.toLowerCase()
                        );
                        const fallback =
                            singleIdx !== -1
                                ? singleIdx
                                : ['A', 'B', 'C', 'D'].indexOf(rawCorrect.trim().toUpperCase());

                        return {
                            question: q.question,
                            options: options,
                            // store as array for consistency
                            correct: fallback !== -1 ? [fallback] : [0]
                        };
                    }

                    return {
                        question: q.question,
                        options: options,
                        correct: correctIndices
                    };
                });
            } catch (error) {
                console.error('Error fetching questions:', error);
                // Fallback to empty array
                return [];
            }
        }

        // Initialize the game
        async function initGame() {
            // Fetch questions from database
            const allQuestions = await fetchQuestions();
            
            if (allQuestions.length === 0) {
                console.error('No questions fetched from database');
                alert('No questions available in the database.\n\nPlease make sure:\n1. Questions have been inserted into the database\n2. Run insert_questions.php to add questions\n3. Check database connection');
                return false;
            }
            
            // Shuffle and get up to 10 questions
            questions = shuffleArray(allQuestions).slice(0, Math.min(10, allQuestions.length));
            currentQuestionIndex = 0;
            skippedQuestions = [];
            skippedQuestionSet = new Set(); // Reset skipped questions set
            answeredQuestions = new Set();
            wrongAnswerCount = 0; // Reset wrong answer count
            
            // Reset navigation buttons
            updateNavigationButtons();
            return true;
        }

        // Start the game
        async function startGame() {
            const initialized = await initGame();
            
            if (!initialized || questions.length === 0) {
                return; // Don't start if no questions loaded
            }
            
            gameActive = true;
            startScreen.style.display = 'none';
            gameArea.style.display = 'block';
            loadQuestion(); // This will start the timer for the first question
        }

        // Load a question
        function loadQuestion() {
            if (!gameActive) return; // Don't load new questions if game is over
            
            // Check if all questions are answered
            if (answeredQuestions.size === questions.length && skippedQuestions.length === 0) {
                endGame('completed'); // Level completed successfully
                return;
            }
            
            // If we've gone through all questions but some were skipped
            if (currentQuestionIndex >= questions.length) {
                // Go to first skipped question
                if (skippedQuestions.length > 0) {
                    currentQuestionIndex = skippedQuestions[0];
                    skippedQuestions.shift(); // Remove from skipped questions
                } else {
                    currentQuestionIndex = 0; // Start from beginning if no skipped questions
                }
            }

            updateNavigationButtons();

            const question = questions[currentQuestionIndex];
            questionElement.textContent = question.question;
            
            // Reset timer for this question
            timeLeft = questionTimeLimit;
            clearInterval(timer);
            startTimer();
            
            // Reset wrong answer count for new question
            wrongAnswerCount = 0;
            
            // Clear previous options
            optionsContainer.innerHTML = '';
            
            // Add new options
            question.options.forEach((option, index) => {
                const button = document.createElement('button');
                button.className = 'option-btn';
                button.textContent = option;
                button.style.pointerEvents = 'auto';
                
                // Disable if already answered
                if (answeredQuestions.has(currentQuestionIndex)) {
                    button.disabled = true;
                    if (isCorrectIndex(question, index)) {
                        button.classList.add('correct');
                    } else {
                        button.classList.add('incorrect');
                    }
                }
                
                // Use mousedown instead of click for better mobile support
                button.addEventListener('mousedown', (e) => {
                    e.stopPropagation();
                    selectAnswer(index);
                });
                
                // Also add touch support
                button.addEventListener('touchstart', (e) => {
                    e.stopPropagation();
                    selectAnswer(index);
                }, { passive: true });
                
                optionsContainer.appendChild(button);
            });
        }

        // Handle answer selection
        function selectAnswer(selectedIndex) {
            const question = questions[currentQuestionIndex];
            const options = optionsContainer.children;
            
            // Check if already selected a correct answer
            const anyCorrectMarked = Array.from(options).some((btn, idx) =>
                isCorrectIndex(question, idx) && btn.classList.contains('correct')
            );
            if (anyCorrectMarked) {
                return; // Do nothing if a correct answer was already selected
            }
            
            // Stop the timer for this question
            clearInterval(timer);
            
            // Disable the selected button
            const selectedOption = options[selectedIndex];
            selectedOption.disabled = true;
            
            // Check answer
            if (isCorrectIndex(question, selectedIndex)) {
                // Correct answer
                selectedOption.classList.add('correct');
                playSound('correct');
                
                // Mark as answered
                answeredQuestions.add(currentQuestionIndex);
                
                // Remove from skipped questions if it was there
                const skipIndex = skippedQuestions.indexOf(currentQuestionIndex);
                if (skipIndex !== -1) {
                    skippedQuestions.splice(skipIndex, 1);
                }
                // Remove from skipped set since it's now answered
                skippedQuestionSet.delete(currentQuestionIndex);
                
                // Move to next question after a delay
                setTimeout(() => {
                    // Find next unanswered question
                    let nextIndex = (currentQuestionIndex + 1) % questions.length;
                    const startIndex = nextIndex;
                    
                    // Find next question that hasn't been answered
                    while (answeredQuestions.has(nextIndex) && nextIndex !== currentQuestionIndex) {
                        nextIndex = (nextIndex + 1) % questions.length;
                        
                        // If we've come full circle, check if there are skipped questions
                        if (nextIndex === startIndex) {
                            if (skippedQuestions.length > 0) {
                                nextIndex = skippedQuestions[0];
                                skippedQuestions.shift();
                            }
                            break;
                        }
                    }
                    
                    currentQuestionIndex = nextIndex;
                    loadQuestion();
                }, 1000);
            } else {
                // Wrong answer
                selectedOption.classList.add('incorrect');
                playSound('incorrect');
                
                // Increment wrong answer count
                wrongAnswerCount++;
                
                // Check if user has failed 3 times on this question
                if (wrongAnswerCount >= 3) {
                    // Game over - too many wrong answers on this question
                    clearInterval(timer);
                    setTimeout(() => {
                        endGame('threeWrongAnswers');
                    }, 1000);
                    return;
                }
                
                // Deduct time for wrong answer (minimum 1 second remaining)
                if (timeLeft > 5) {
                    timeLeft -= 5; // Deduct 5 seconds for wrong answer
                    updateTimer();
                    
                    // Visual feedback for time deduction
                    const timerEl = document.getElementById('timer');
                    timerEl.style.transform = 'scale(1.2)';
                    timerEl.style.color = '#ff4444';
                    setTimeout(() => {
                        timerEl.style.transform = '';
                        if (timeLeft > 5) {
                            timerEl.style.color = '';
                        }
                    }, 300);
                } else {
                    timeLeft = 1; // Ensure at least 1 second remains
                    updateTimer();
                }
                
                // Restart timer after wrong answer
                startTimer();
                
                // If only one option remains, it must be a correct one
                const remainingOptions = Array.from(options).filter(opt => !opt.disabled);
                if (remainingOptions.length === 1) {
                    // Auto-select the first correct index
                    const firstCorrectIndex = Array.isArray(question.correct)
                        ? question.correct[0]
                        : question.correct;
                    setTimeout(() => {
                        selectAnswer(firstCorrectIndex);
                    }, 500);
                }
            }
        }

        // Handle moving to next question (with skip functionality)
        function goToNextQuestion() {
            if (!gameActive) return;
            
            // Stop the timer for current question
            clearInterval(timer);
            
            // If current question isn't answered, treat as skip
            if (!answeredQuestions.has(currentQuestionIndex)) {
                // Check if this question has already been skipped once
                if (skippedQuestionSet.has(currentQuestionIndex)) {
                    // Already skipped once - don't allow skipping again
                    alert('You can only skip each question once. Please answer this question.');
                    // Restart the timer
                    startTimer();
                    return;
                }
                
                // Mark as skipped (first time)
                skippedQuestionSet.add(currentQuestionIndex);
                if (!skippedQuestions.includes(currentQuestionIndex)) {
                    skippedQuestions.push(currentQuestionIndex);
                }
            }
            
            // Find next unanswered question
            let nextIndex = (currentQuestionIndex + 1) % questions.length;
            const startIndex = nextIndex;
            
            // Find next question that hasn't been answered
            while (answeredQuestions.has(nextIndex) && nextIndex !== currentQuestionIndex) {
                nextIndex = (nextIndex + 1) % questions.length;
                
                // If we've come full circle, check if there are skipped questions
                if (nextIndex === startIndex) {
                    if (skippedQuestions.length > 0) {
                        nextIndex = skippedQuestions[0];
                        skippedQuestions.shift();
                    }
                    break;
                }
            }
            
            currentQuestionIndex = nextIndex;
            loadQuestion();
        }

        // Update navigation buttons state
        function updateNavigationButtons() {
            if (!gameActive) return;
            
            // Update question number display
            questionNumberElement.textContent = `Question ${currentQuestionIndex + 1} of ${questions.length}`;
            
            // Update next button text and state
            const isAnswered = answeredQuestions.has(currentQuestionIndex);
            const isAlreadySkipped = skippedQuestionSet.has(currentQuestionIndex);
            
            if (isAnswered) {
                nextBtn.textContent = 'Next Question →';
                nextBtn.disabled = false;
                nextBtn.style.opacity = '1';
            } else if (isAlreadySkipped) {
                // Question was already skipped once - disable skip button
                nextBtn.textContent = 'Answer Required';
                nextBtn.disabled = true;
                nextBtn.style.opacity = '0.5';
                nextBtn.style.cursor = 'not-allowed';
            } else {
                nextBtn.textContent = 'Skip Question →';
                nextBtn.disabled = false;
                nextBtn.style.opacity = '1';
                nextBtn.style.cursor = 'pointer';
            }
            
            // If all questions are answered, show finish button
            if (answeredQuestions.size === questions.length) {
                nextBtn.textContent = 'Finish Game';
                nextBtn.disabled = false;
                nextBtn.style.opacity = '1';
                nextBtn.style.cursor = 'pointer';
            }
        }
        
        // Navigate to a specific question
        function navigateToQuestion(index) {
            if (index >= 0 && index < questions.length) {
                currentQuestionIndex = index;
                loadQuestion();
            }
        }

        // Timer functions
        function startTimer() {
            clearInterval(timer);
            updateTimer(); // Initial update
            
            timer = setInterval(() => {
                if (!gameActive) {
                    clearInterval(timer);
                    return;
                }
                
                timeLeft--;
                updateTimer();
                
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    timeUp();
                }
            }, 1000);
        }

        function resetTimer() {
            // No longer needed as we're using a single timer
        }

        function updateTimer() {
            timerElement.textContent = timeLeft;
            
            // Add visual feedback when time is running out
            if (timeLeft <= 5) {
                timerElement.classList.add('low-time');
                timerElement.style.color = '#ff4444';
                timerElement.style.textShadow = '0 0 10px #ff0000';
            } else {
                timerElement.classList.remove('low-time');
                timerElement.style.color = 'var(--accent)';
                timerElement.style.textShadow = '0 0 5px rgba(255, 255, 0, 0.7)';
            }
        }

        function timeUp() {
            if (!gameActive) return;
            
            // Time's up for this question - game ends immediately
            endGame('timeout');
        }

        // Add confetti: tiny, lightweight canvas particles
        function launchConfetti() {
            if (document.getElementById('confetti-canvas')) return; // Already exists
            const confettiCanvas = document.createElement('canvas');
            confettiCanvas.id = 'confetti-canvas';
            confettiCanvas.style.position = 'fixed';
            confettiCanvas.style.left = '0';
            confettiCanvas.style.top = '0';
            confettiCanvas.style.width = '100vw';
            confettiCanvas.style.height = '100vh';
            confettiCanvas.style.pointerEvents = 'none';
            confettiCanvas.style.zIndex = '5000';
            document.body.appendChild(confettiCanvas);
            // -- Simple confetti animation --
            const ctx = confettiCanvas.getContext('2d');
            confettiCanvas.width = window.innerWidth;
            confettiCanvas.height = window.innerHeight;
            const pieces = Array.from({length: 150}).map(() => ({
                x: Math.random() * confettiCanvas.width,
                y: Math.random() * -confettiCanvas.height,
                w: 10 + Math.random()*8,
                h: 8 + Math.random()*6,
                color: `hsl(${Math.floor(Math.random()*360)}, 100%, 60%)`,
                speed: 2 + Math.random()*3,
                rotate: Math.random()*3.14,
                tilt: Math.random()*Math.PI
            }));
            let frame = 0;
            function drawConfetti() {
                ctx.clearRect(0,0,confettiCanvas.width,confettiCanvas.height);
                for (let p of pieces) {
                    ctx.save();
                    ctx.translate(p.x, p.y);
                    ctx.rotate(p.rotate + Math.sin(frame/10 + p.tilt));
                    ctx.fillStyle = p.color;
                    ctx.fillRect(0,0,p.w,p.h);
                    ctx.restore();
                    p.y += p.speed;
                    p.x += Math.sin(frame/15 + p.tilt)*2;
                    if (p.y > confettiCanvas.height) p.y = -10 - Math.random()*20;
                }
                frame++;
                if (frame < 300) {
                    requestAnimationFrame(drawConfetti);
                } else {
                    confettiCanvas.remove();
                }
            }
            drawConfetti();
        }
        // End game
        function endGame(reason) {
            gameActive = false;
            clearInterval(timer);
            gameArea.style.display = 'none';
            gameOverScreen.style.display = 'flex';
            const modalTitle = gameOverScreen.querySelector('.modal-title');
            finalScoreElement.style.display = 'block';
            finalScoreElement.innerHTML = '';
            let oldNextBtn = gameOverScreen.querySelector('.btn.secondary-btn');
            if (oldNextBtn) oldNextBtn.remove();
            let oldHomeBtn = gameOverScreen.querySelector('.btn.home-btn');
            if (oldHomeBtn) oldHomeBtn.remove();
            // Remove confetti if present
            const existingConfetti = document.getElementById('confetti-canvas');
            if (existingConfetti) existingConfetti.remove();
            // Stylish celebratory modal if completed
            if (reason === 'completed') {
                modalTitle.textContent = '🎉 CONGRATULATIONS! 🎉';
                // Modern card style
                gameOverScreen.querySelector('.modal-content').style.background = 'rgba(255,255,255,0.93)';
                gameOverScreen.querySelector('.modal-content').style.boxShadow = '0 6px 36px 8px rgba(0,0,0,0.2)';
                modalTitle.style.color = '#34b233';
                modalTitle.style.fontSize = '2.7rem';
                modalTitle.style.textAlign = 'center';
                finalScoreElement.innerHTML = '<span style="display:inline-block;font-size:1.6rem;color:#226aad;margin-bottom:18px;">✨ You passed the level!</span>';
                finalScoreElement.style.color = '#226aad';
                finalScoreElement.style.fontSize = '1.3rem';
                finalScoreElement.style.background = 'none';
                restartBtn.style.display = 'none';
                // Add Next Level button
                const nextLevelBtn = document.createElement('button');
                nextLevelBtn.className = 'btn secondary-btn';
                nextLevelBtn.textContent = 'NEXT LEVEL';
                nextLevelBtn.style.margin = '1rem auto';
                nextLevelBtn.style.fontSize = '1.3rem';
                nextLevelBtn.style.display = 'block';
                nextLevelBtn.style.background = '#226aad';
                nextLevelBtn.style.color = '#fff';
                nextLevelBtn.onclick = () => { window.location.href = 'quizb3.php'; };
                // Add Home button
                const homeBtn = document.createElement('button');
                homeBtn.className = 'btn home-btn';
                homeBtn.textContent = 'HOME';
                homeBtn.style.margin = '1rem auto';
                homeBtn.style.fontSize = '1.3rem';
                homeBtn.style.display = 'block';
                homeBtn.style.background = '#fff';
                homeBtn.style.color = '#226aad';
                homeBtn.onclick = () => { window.location.href = 'indexhome.php'; };
                finalScoreElement.after(nextLevelBtn);
                nextLevelBtn.after(homeBtn);
                launchConfetti();
            } else {
                // Undo celebratory style if failure
                gameOverScreen.querySelector('.modal-content').style.background = '';
                gameOverScreen.querySelector('.modal-content').style.boxShadow = '';
                modalTitle.style.color = 'var(--accent)';
                modalTitle.style.fontSize = '';
                modalTitle.style.textAlign = '';
                if (reason === 'threeWrongAnswers') {
                    modalTitle.textContent = 'GAME OVER';
                    finalScoreElement.innerHTML = '3 WRONG ANSWERS ON ONE QUESTION';
                    finalScoreElement.style.color = '#ff4444';
                    restartBtn.style.display = 'block';
                } else if (reason === 'timeout') {
                    modalTitle.textContent = 'GAME OVER';
                    finalScoreElement.innerHTML = 'OUT OF TIME!';
                    finalScoreElement.style.color = '#ff4444';
                    restartBtn.style.display = 'block';
                } else {
                    modalTitle.textContent = 'GAME OVER';
                    finalScoreElement.innerHTML = 'Game ended.';
                    finalScoreElement.style.color = 'var(--accent)';
                    restartBtn.style.display = 'block';
                }
            }
        }

        // Restart game
        async function restartGame() {
            gameOverScreen.style.display = 'none';
            timeLeft = questionTimeLimit; // Reset timer to per-question limit
            currentQuestionIndex = 0;
            skippedQuestions = [];
            skippedQuestionSet = new Set(); // Reset skipped questions set
            answeredQuestions = new Set();
            wrongAnswerCount = 0; // Reset wrong answer count
            await startGame();
        }

        // Utility functions
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        function playSound(type) {
            // In a real app, you would play sound effects here
            console.log(`Playing ${type} sound`);
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            // Debug: Log button status
            console.log('DOM loaded, startBtn exists:', !!startBtn);
            
            // Initialize event listeners after DOM is loaded with better error handling
            if (startBtn) {
                startBtn.addEventListener('click', (e) => {
                    console.log('Start button clicked');
                    startGame();
                    e.stopPropagation();
                });
                startBtn.style.pointerEvents = 'auto';
            } else {
                console.error('Start button not found!');
            }
            
            if (skipBtn) {
                skipBtn.addEventListener('click', (e) => {
                    console.log('Skip button clicked');
                    goToNextQuestion(); // Changed from skipQuestion() to goToNextQuestion()
                    e.stopPropagation();
                });
                skipBtn.style.pointerEvents = 'auto';
                skipBtn.style.position = 'relative';
                skipBtn.style.zIndex = '100';
            } else {
                console.error('Skip button not found!');
            }
            
            if (restartBtn) {
                restartBtn.addEventListener('click', (e) => {
                    console.log('Restart button clicked');
                    restartGame();
                    e.stopPropagation();
                });
            }
            
            // Make sure the button is visible and clickable
            if (startBtn) {
                startBtn.style.pointerEvents = 'auto';
                startBtn.disabled = false;
            }
            
            // Add some retro sound effects (placeholder)
            const sounds = {
                correct: new Audio('data:audio/wav;base64,UklGRl9vT19XQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YU...'),
                incorrect: new Audio('data:audio/wav;base64,UklGRl9vT19XQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YU...')
            };

            window.playSound = (type) => {
                if (sounds[type]) {
                    sounds[type].currentTime = 0;
                    sounds[type].play().catch(e => console.log('Audio play failed:', e));
                }
            };
            
            // Next button event listener
            nextBtn.addEventListener('click', () => {
                // Don't proceed if button is disabled (question already skipped)
                if (nextBtn.disabled) {
                    return;
                }
                
                if (answeredQuestions.size === questions.length) {
                    endGame('completed'); // All questions answered - level completed
                } else {
                    goToNextQuestion();
                }
            });
        });
    </script>
</body>
</html>