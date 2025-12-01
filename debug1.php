<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Python Debugging Challenge</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #ff00ff;
            --secondary: #00ffff;
            --accent: #ffff00;
            --bg: #000000;
            --screen: #1a1a2e;
            --error: #ff4444;
            --success: #00ff88;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Press Start 2P', cursive;
        }

        body {
            background: var(--bg);
            color: var(--primary);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: 
                radial-gradient(circle at center, #1a1a2e 0%, #000 100%),
                repeating-linear-gradient(
                    0deg,
                    rgba(255, 0, 255, 0.1) 0px,
                    rgba(255, 0, 255, 0.1) 1px,
                    transparent 1px,
                    transparent 2px
                );
            padding: 25px;
        }

        .game-container {
            width: 100%;
            max-width: 1000px;
            background: var(--screen);
            border: 4px solid var(--primary);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 
                10px 10px 0 rgba(255, 0, 255, 0.2),
                20px 20px 0 rgba(0, 255, 255, 0.1);
            position: relative;
            line-height: 1.8;
            letter-spacing: 0.5px;
        }

        .game-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.5);
            border: 2px solid var(--secondary);
        }

        .health-bar {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .hearts-container {
            display: flex;
            gap: 5px;
        }

        .heart {
            color: var(--error);
            font-size: 1.5rem;
            transition: all 0.3s ease-in-out;
            position: relative;
            display: inline-block;
        }

        .heart::before {
            content: '❤️';
            position: absolute;
            opacity: 0.3;
        }

        .heart.lost {
            transform: scale(0.8) rotate(45deg);
            opacity: 0.3;
        }

        .heart.lost::before {
            content: '💔';
            opacity: 0;
            transition: opacity 0.3s ease-in-out 0.2s;
        }

        .heart.lost.animate::before {
            opacity: 1;
        }

        .timer {
            color: var(--accent);
            font-size: 1.2rem;
            text-shadow: 0 0 5px rgba(255, 255, 0, 0.7);
        }

        .timer.warning {
            color: var(--error);
            animation: pulse 1s infinite;
        }

        .level-indicator {
            font-size: 1.2rem;
            color: var(--secondary);
        }

        /* Retro terminal styles */
        .code-container {
            background: #0a0a1a;
            border: 2px solid var(--secondary);
            margin: 1.5rem 0;
            position: relative;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }
        
        /* CRT screen effect */
        .code-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%);
            background-size: 100% 4px;
            z-index: 2;
            pointer-events: none;
            border-radius: 6px;
        }
        
        /* Scanline effect */
        .code-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                to bottom,
                rgba(0, 255, 255, 0.03) 0%,
                transparent 5%,
                transparent 95%,
                rgba(0, 255, 255, 0.05) 100%
            );
            pointer-events: none;
            z-index: 3;
            animation: scanline 8s linear infinite;
        }
        
        @keyframes scanline {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(100%); }
        }

        .code-header {
            background: linear-gradient(to right, #001a1a, #003333);
            padding: 0.6rem 1.2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--secondary);
            position: relative;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        
        .code-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--secondary), transparent);
        }

        .code-editor {
            width: 100%;
            min-height: 200px;
            padding: 1.5rem;
            background: #0a0a1a;
            color: #33ff33; /* Classic green terminal text */
            border: none;
            resize: none;
            font-family: 'Courier New', monospace;
            font-size: 15px;
            line-height: 1.6;
            letter-spacing: 0.5px;
            tab-size: 4;
            margin: 0;
            text-shadow: 0 0 5px rgba(51, 255, 51, 0.5);
            position: relative;
            z-index: 1;
            border-radius: 0 0 6px 6px;
        }
        
        /* Terminal cursor */
        .code-editor:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
        }
        
        .code-editor::selection {
            background: rgba(0, 255, 255, 0.3);
            color: #fff;
        }

        .code-editor:focus {
            outline: none;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            gap: 1rem;
        }

        .btn {
            padding: 0.9rem 1.8rem;
            font-size: 1.05rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            letter-spacing: 0.8px;
            margin: 0.5rem 0;
        }

        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
        }

        .btn-secondary {
            background: transparent;
            color: var(--secondary);
            border-color: var(--secondary);
        }

        .result {
            margin: 1rem 0;
            padding: 0.8rem 1rem;
            border-left: 4px solid transparent;
            display: none;
            border-radius: 4px;
            line-height: 1.5;
            word-wrap: break-word;
            overflow-wrap: break-word;
            font-size: 0.75rem;
            max-width: 100%;
        }
        
        .result strong {
            display: block;
            margin-bottom: 0.3rem;
            font-size: 0.85rem;
        }

        .result.success {
            border-color: var(--success);
            background: rgba(0, 255, 136, 0.1);
            color: var(--success);
        }

        /* Error notification */
        .error-notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(-100px);
            background: rgba(255, 0, 0, 0.9);
            color: white;
            padding: 15px 30px;
            border-radius: 4px;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.9rem;
            z-index: 2000;
            box-shadow: 0 4px 15px rgba(255, 0, 0, 0.3);
            border: 2px solid #ff4444;
            opacity: 0;
            transition: all 0.3s ease-out;
            text-align: center;
            max-width: 90%;
            width: auto;
            white-space: nowrap;
        }
        
        .error-notification.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
        
        .error-notification::before {
            content: '⚠️';
            margin-right: 10px;
            font-size: 1.2em;
        }
        
        .result.error {
            border-color: var(--error);
            background: rgba(255, 68, 68, 0.1);
            color: var(--error);
        }

        .hint {
            margin: 1.2rem 0;
            padding: 1.2rem 1.5rem;
            background: rgba(255, 255, 0, 0.1);
            border-left: 4px solid var(--accent);
            color: var(--accent);
            display: none;
            border-radius: 4px;
            line-height: 1.8;
        }

        /* Confetti styles */
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background-color: #f00;
            opacity: 0;
            z-index: 1001;
            pointer-events: none;
            animation: confetti-fall 3s ease-in-out forwards;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(720deg);
                opacity: 0;
            }
        }

        .game-over, .level-complete {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.95);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            text-align: center;
            padding: 2rem;
            opacity: 0;
            transform: scale(0.9);
            transition: all 0.5s ease-out;
            pointer-events: none;
        }
        
        .level-complete-content {
            max-width: 500px;
            width: 90%;
            background: rgba(20, 20, 30, 0.95);
            padding: 2.5rem 2rem;
            border-radius: 8px;
            box-shadow: 0 0 40px rgba(0, 255, 136, 0.2);
            text-align: center;
            position: relative;
            margin: 0 auto;
        }
        
        .congrats-message {
            font-size: 1.1rem;
            color: var(--secondary);
            margin: 0.5rem 0 2rem 0;
            padding: 0 0.5rem;
            text-shadow: 0 0 8px var(--success);
            line-height: 1.5;
            opacity: 0.9;
        }
        
        .level-complete .button-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }
        
        .level-complete .btn {
            min-width: 150px;
            padding: 0.8rem 1.5rem;
            font-size: 1.1rem;
        }

        .game-over.show, .level-complete.show {
            opacity: 1;
            transform: scale(1);
            pointer-events: auto;
        }

        .game-over h2, .level-complete h2 {
            color: var(--error);
            font-size: 2.5rem;
            margin: 0 0 1.5rem 0;
            padding: 0;
            text-shadow: 0 0 10px var(--error);
            transform: translateY(30px);
            opacity: 0;
            animation: slideDown 0.5s ease-out 0.3s forwards;
            line-height: 1.2;
            letter-spacing: 1px;
        }

        .level-complete h2 {
            color: var(--success);
            text-shadow: 0 0 10px var(--success);
            animation: pulse 1.5s infinite alternate, slideDown 0.5s ease-out 0.3s forwards;
            margin-bottom: 2rem;
        }

        @keyframes slideDown {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); text-shadow: 0 0 10px var(--success); }
            100% { transform: scale(1.1); text-shadow: 0 0 20px var(--success); }
        }

        .final-score {
            font-size: 2rem;
            margin: 1.5rem 0;
            color: var(--secondary);
            transform: scale(0.8);
            opacity: 0;
            animation: popIn 0.5s ease-out 0.6s forwards;
            text-shadow: 0 0 10px var(--secondary);
        }

        @keyframes popIn {
            0% { transform: scale(0.8); opacity: 0; }
            70% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Next level button animation */
        .level-complete .btn {
            transform: translateY(30px);
            opacity: 0;
            animation: slideUp 0.5s ease-out 0.9s forwards;
        }

        @keyframes slideUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Start Screen Styles */
        .start-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #0a0a1a 0%, #000 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            font-family: 'Press Start 2P', cursive;
            text-align: center;
            padding: 2rem;
            color: var(--secondary);
        }

        .start-content {
            max-width: 800px;
            padding: 3rem;
            background: rgba(20, 20, 30, 0.9);
            border: 2px solid var(--primary);
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(255, 0, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .start-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(rgba(0, 255, 255, 0.1) 1px, transparent 1px),
                        linear-gradient(90deg, rgba(0, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.3;
            pointer-events: none;
        }

        .start-screen h1 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: var(--primary);
            text-shadow: 0 0 10px var(--primary);
            letter-spacing: 2px;
            line-height: 1.4;
        }

        .game-description {
            margin: 2rem 0;
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--secondary);
        }

        .game-features {
            margin: 2.5rem 0;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .game-features p {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin: 0.5rem 0;
        }

        .game-features i {
            color: var(--accent);
            font-size: 1.2rem;
        }

        .start-btn {
            font-size: 1.2rem;
            padding: 1rem 2.5rem;
            margin-top: 1rem;
            position: relative;
            overflow: hidden;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .start-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .start-btn:active {
            transform: translateY(-1px);
        }

        .start-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, var(--primary), var(--accent));
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .start-btn:hover::after {
            opacity: 0.2;
        }

        @media (max-width: 768px) {
            .game-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Start Screen -->
    <div id="startScreen" class="start-screen">
        <div class="start-content">
            <h1>PYTHON DEBUG CHALLENGE</h1>
            <div class="game-description">
                <p>Find and fix Python code errors before time runs out!</p>
                <div class="game-features">
                    <p><i class="fas fa-heart"></i> 3 Lives</p>
                    <p><i class="fas fa-clock"></i> 90s per challenge</p>
                    <p><i class="fas fa-code"></i> Fix syntax and logic errors</p>
                </div>
            </div>
            <button id="startBtn" class="btn btn-primary start-btn">
                <i class="fas fa-play"></i> START GAME
            </button>
        </div>
    </div>

    <div class="game-container" style="display: none;">
        <div class="game-header">
            <div class="health-bar">
                <span>Lives:</span>
                <div class="hearts-container" id="healthBar">
                    <div class="heart">❤️</div>
                    <div class="heart">❤️</div>
                    <div class="heart">❤️</div>
                </div>
            </div>
            <div class="level-indicator">Question: <span id="level">1</span>/<span id="totalLevels">5</span></div>
            <div class="timer" id="timer">01:30</div>
        </div>

        <h2 id="challengeTitle">Debug the Code</h2>
        <p id="challengeDescription">Find and fix the error in the code below:</p>

        <div class="code-container">
            <div class="code-header">
                <span>debug.py</span>
                <button id="showHintBtn" class="btn btn-secondary" style="font-size: 0.7rem; padding: 0.3rem 0.6rem;">
                    <i class="fas fa-lightbulb"></i> Hint
                </button>
            </div>
            <!-- Broken bug shown as read-only code -->
            <div style="background:#17172e; border-bottom:1px solid var(--secondary); padding:1rem 1.5rem; color:#ff5555; font-family:'Courier New',monospace; font-size:15px;">
                <label style="color:var(--accent); font-size:0.96em; margin-bottom:0.35em; display:block;">Broken Code:</label>
                <pre id="buggyCodeDisplay" style="margin:0;white-space:pre-wrap;word-break:break-all;background:none;border:none;padding:0;user-select:text;">
                </pre>
            </div>
            <!-- Student input area -->
            <div style="padding:1rem 1.5rem 0.7rem 1.5rem; background:#101024;">
                <label for="codeEditor" style="color:var(--success); font-size:0.93em; margin-bottom:0.4em; display:block;">Your Fix:</label>
                <textarea id="codeEditor" class="code-editor" spellcheck="false"></textarea>
            </div>
        </div>

        <div id="hint" class="hint"></div>

        <!-- Output boxes for each question's run result -->
        <div id="outputContainer"></div>

        <!-- Detailed feedback (kept for longer explanations, currently hidden by JS) -->
        <div id="result" class="result"></div>

        <div class="button-group">
            <button id="resetBtn" class="btn btn-secondary">
                <i class="fas fa-undo"></i> Reset Code
            </button>
            <button id="runBtn" class="btn btn-primary">
                <i class="fas fa-play"></i> Run Code
            </button>
            <button id="nextQuestionBtn" class="btn btn-secondary" style="display:none;" disabled>
                <i class="fas fa-arrow-right"></i> Next Question
            </button>
        </div>
    </div>

    <div id="gameOver" class="game-over">
        <h2>Game Over!</h2>
        <div class="final-score">Questions Answered: <span id="finalScore">0</span>/<span id="totalQuestions">0</span></div>
        <button id="restartBtn" class="btn btn-primary" style="margin-top: 2rem;">
            <i class="fas fa-redo"></i> Play Again
        </button>
    </div>

    <div id="levelComplete" class="level-complete">
        <div class="level-complete-content">
            <h2>Level Completed!</h2>
            <p class="congrats-message">You've successfully completed all questions!</p>
            <div class="final-score">Questions Answered: <span id="levelScore">0</span>/<span id="totalQuestions2">0</span></div>
            <div class="button-group">
                <button id="homeBtn" class="btn btn-secondary">
                    <i class="fas fa-home"></i> Home
                </button>
                <button id="nextLevelBtn" class="btn btn-primary">
                    Next Level <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Game state
        let questions = [];
        let currentIndex = 0;

        function loadQuestion() {
            const q = questions[currentIndex];

            if (!q) {
                console.log("No question found!");
                return;
            }

            // UI updates for DB-driven questions (kept for future use)
            document.getElementById("level").textContent = q.level || (currentIndex + 1);
            document.getElementById("buggyCodeDisplay").textContent = q.code_snippet || '';
            document.getElementById("codeEditor").value = q.code_snippet || '';

            // Use the existing hint element (id="hint") instead of a non‑existent "hintText"
            const hintEl = document.getElementById("hint");
            if (hintEl && q.hint) {
                hintEl.textContent = q.hint;
            }
        }

        function nextQuestion() {
            if (currentIndex < questions.length - 1) {
                currentIndex++;
                loadQuestion();
            } else {
                alert("🎉 You've completed all debugging levels!");
            }
        }

        // Load questions from your DB (optional – game still works with local challenges array)
        fetch("load_debugging_questions.php?language=Python&difficulty=Beginner")
            .then(response => response.json())
            .then(data => {
                questions = data;
                console.log("Questions loaded: ", questions);

                if (questions.length > 0) {
                    document.getElementById("totalLevels").textContent = questions.length;
                    loadQuestion();
                } else {
                    console.warn("⚠ No debugging questions found!");
                }
            })
            .catch(error => console.error("Fetch error:", error));

        // Debug challenges - Focused on missing quotes
        const challenges = [
            {
                title: "Missing Double Quotes",
                description: "Add the missing double quotes to fix the print statement.",
                code: `print(Hello, World!)`,
                hint: "Text in Python needs to be enclosed in quotes.",
                solution: `print("Hello, World!")`
            },
            {
                title: "Missing Single Quotes",
                description: "Add the missing single quotes around the name.",
                code: `name = John
print('Hello, ' + name)`,
                hint: "Variable names don't need quotes, but string literals do.",
                solution: `name = 'John'
print('Hello, ' + name)`
            }
        ];

        // DOM elements
        const codeEditor = document.getElementById('codeEditor');
        const runBtn = document.getElementById('runBtn');
        const resetBtn = document.getElementById('resetBtn');
        const showHintBtn = document.getElementById('showHintBtn');
        const hintElement = document.getElementById('hint');
        const resultElement = document.getElementById('result');
        const outputContainer = document.getElementById('outputContainer');
        const healthBar = document.getElementById('healthBar');
        const timerElement = document.getElementById('timer');
        const levelElement = document.getElementById('level');
        const totalLevelsElement = document.getElementById('totalLevels');
        const challengeTitle = document.getElementById('challengeTitle');
        const challengeDescription = document.getElementById('challengeDescription');
        const gameOverScreen = document.getElementById('gameOver');
        const levelCompleteScreen = document.getElementById('levelComplete');
        const finalScoreElement = document.getElementById('finalScore');
        const levelScoreElement = document.getElementById('levelScore');
        const totalQuestionsElement = document.getElementById('totalQuestions');
        const totalQuestionsElement2 = document.getElementById('totalQuestions2');
        const restartBtn = document.getElementById('restartBtn');
        const nextLevelBtn = document.getElementById('nextLevelBtn');
        const nextQuestionBtn = document.getElementById('nextQuestionBtn');
        let readyForNextQuestion = false;

        // Initialize game
        function initGame() {
            currentLevel = 0;
            health = 3;
            score = 0;
            readyForNextQuestion = false;
            nextQuestionBtn.style.display = 'none';
            nextQuestionBtn.disabled = true;
            updateHealthBar();
            loadLevel(currentLevel);
            startTimer();
            
            // Set total questions (we have 5 levels)
            const total = 5; // Fixed to show 5 questions
            totalQuestionsElement.textContent = total;
            totalQuestionsElement2.textContent = total;
            
            // Hide game over and level complete screens
            gameOverScreen.style.display = 'none';
            levelCompleteScreen.style.display = 'none';
        }

        // Load a level
        function loadLevel(levelIndex) {
            if (levelIndex >= challenges.length) {
                // Game completed
                endGame(true);
                return;
            }

            // Only start/restart the timer if this is a new level
            if (levelIndex !== currentLevel) {
                startTimer();
            }
            
            currentLevel = levelIndex;
            const challenge = challenges[levelIndex];
            challengeTitle.textContent = challenge.title;
            challengeDescription.textContent = challenge.description;
            // NEW: Update the display for the buggy code
            document.getElementById('buggyCodeDisplay').textContent = challenge.code;
            codeEditor.value = challenge.code;
            originalCode = challenge.code;
            hintElement.textContent = '';
            hintElement.style.display = 'none';
            resultElement.textContent = '';
            resultElement.className = 'result';
            resultElement.style.display = 'none';
            levelElement.textContent = levelIndex + 1;
            readyForNextQuestion = false;
            nextQuestionBtn.style.display = 'none';
            nextQuestionBtn.disabled = true;
        }

        // Update health display
        function updateHealthBar() {
            const hearts = healthBar.querySelectorAll('.heart');
            hearts.forEach((heart, index) => {
                if (index < health) {
                    heart.classList.remove('lost', 'animate');
                } else if (!heart.classList.contains('lost')) {
                    // Only add animation class if this is a new loss
                    heart.classList.add('lost');
                    // Trigger reflow to ensure animation plays
                    void heart.offsetWidth;
                    heart.classList.add('animate');
                    
                    // Remove the animation class after it completes
                    setTimeout(() => {
                        heart.classList.remove('animate');
                    }, 1000);
                }
            });
        }

        // Start the timer
        function startTimer() {
            clearInterval(timer);
            timeLeft = 90; // 1.5 minutes per level
            updateTimerDisplay();
            
            timer = setInterval(() => {
                timeLeft--;
                updateTimerDisplay();
                
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    // End game when time runs out
                    endGame(false);
                }
            }, 1000);
        }

        // Update timer display
        function updateTimerDisplay() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft <= 10) {
                timerElement.classList.add('warning');
            } else {
                timerElement.classList.remove('warning');
            }
        }

        // Lose health
        function loseHealth() {
            health--;
            updateHealthBar();
            
            if (health <= 0) {
                endGame(false);
            } else {
                // Reset the level without resetting the timer
                loadLevel(currentLevel);
                // Show feedback to the player
                showErrorNotification('Try again! Lives left: ' + health);
            }
        }

        // Create confetti effect
        function createConfetti() {
            const colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];
            const container = document.createElement('div');
            container.style.position = 'fixed';
            container.style.top = '0';
            container.style.left = '0';
            container.style.width = '100%';
            container.style.height = '100%';
            container.style.pointerEvents = 'none';
            container.style.zIndex = '1001';
            document.body.appendChild(container);

            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.width = Math.random() * 15 + 5 + 'px';
                confetti.style.height = Math.random() * 15 + 5 + 'px';
                confetti.style.animationDuration = Math.random() * 2 + 2 + 's';
                confetti.style.animationDelay = Math.random() * 2 + 's';
                container.appendChild(confetti);

                // Remove confetti after animation
                setTimeout(() => {
                    confetti.remove();
                    if (i === 99) {
                        container.remove();
                    }
                }, 5000);
            }
        }

        // Show level complete screen with animations
        function showLevelComplete(levelScore) {
            levelScoreElement.textContent = levelScore;
            levelCompleteScreen.style.display = 'flex';
            
            // Trigger reflow to ensure the transition works
            void levelCompleteScreen.offsetWidth;
            
            // Add show class to trigger animations
            levelCompleteScreen.classList.add('show');
            
            // Create confetti effect
            createConfetti();
            
            // Stop the timer
            clearInterval(timer);
        }

        // Show error notification
        function showErrorNotification(message = 'Incorrect Code') {
            const notification = document.createElement('div');
            notification.className = 'error-notification';
            notification.textContent = message;
            document.body.appendChild(notification);
            
            // Trigger reflow
            void notification.offsetWidth;
            
            // Add show class
            notification.classList.add('show');
            
            // Play error sound
            const errorSound = new Audio('data:audio/wav;base64,UklGRl9vT19XQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YU...');
            errorSound.volume = 0.3;
            errorSound.play().catch(e => console.log('Error sound failed to play:', e));
            
            // Remove notification after delay
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }
        
        // Analyze code and provide detailed feedback
        function analyzeCode(userCode, buggyCode, solution) {
            const userCodeTrimmed = userCode.trim();
            const buggyCodeTrimmed = buggyCode.trim();
            const solutionTrimmed = solution.trim();
            
            // Check if code is correct
            if (userCodeTrimmed === solutionTrimmed) {
                return {
                    isCorrect: true,
                    message: getCorrectExplanation(buggyCode, solution)
                };
            }
            
            // Analyze what went wrong
            const issues = [];
            
            // Check for Python-style syntax issues using simple heuristics
            (function detectSyntaxIssues() {
                const lines = userCode.split('\n');

                // 1) Unbalanced parentheses
                let parenBalance = 0;
                for (const ch of userCode) {
                    if (ch === '(') parenBalance++;
                    if (ch === ')') parenBalance--;
                }
                if (parenBalance !== 0) {
                    issues.push({
                        type: 'syntax_parentheses',
                        message: 'Syntax Error: Unbalanced parentheses',
                        detail: 'The number of opening and closing parentheses does not match. In Python, every "(" must have a matching ")". Check your print statements and any function calls to make sure all parentheses are properly paired and in the correct order.'
                    });
                }

                // 2) Unmatched quotes on a line
                lines.forEach((line, idx) => {
                    const singleQuotes = (line.match(/'/g) || []).length;
                    const doubleQuotes = (line.match(/"/g) || []).length;
                    if (singleQuotes % 2 !== 0 || doubleQuotes % 2 !== 0) {
                        issues.push({
                            type: 'syntax_quotes',
                            message: 'Syntax Error: Unmatched quotes in line ' + (idx + 1),
                            detail: 'One of your lines has an odd number of single or double quotes, which means a string is not properly closed. In Python, strings must start and end with the same quote character. Carefully check line ' + (idx + 1) + ' and ensure every opening quote has a matching closing quote.'
                        });
                    }
                });
            })();
            
            // Check for missing quotes around strings in print statements
            const printMatches = userCode.match(/print\s*\([^)]+\)/g);
            if (printMatches) {
                printMatches.forEach(match => {
                    const content = match.match(/print\s*\((.+)\)/);
                    if (content && content[1]) {
                        let arg = content[1].trim();
                        // Remove outer parentheses if present
                        while (arg.startsWith('(') && arg.endsWith(')')) {
                            arg = arg.slice(1, -1).trim();
                        }
                        // Check if it's a string literal without quotes
                        const isQuoted = arg.match(/^["'].*["']$/) || arg.match(/^["'].*["']\s*\+/);
                        const isVariable = arg.match(/^\w+$/) || arg.match(/^\w+\s*\+/);
                        const looksLikeString = arg.match(/^[A-Za-z][A-Za-z0-9\s,!]*$/);
                        
                        if (!isQuoted && !isVariable && looksLikeString) {
                            // Check if solution expects quotes here
                            const solutionPrint = solution.match(/print\s*\([^)]+\)/);
                            if (solutionPrint && (solutionPrint[0].includes('"') || solutionPrint[0].includes("'"))) {
                                issues.push({
                                    type: 'missing_quotes',
                                    message: 'Missing Quotes: String literals need to be enclosed in quotes',
                                    detail: `The text in your print statement should be enclosed in quotes. In Python, all string literals (text values) must be wrapped in either single quotes (') or double quotes ("). Without quotes, Python treats the text as a variable name, which will cause a NameError if that variable doesn't exist. For example, instead of print(${arg}), you should use print("${arg}") or print('${arg}'). Both single and double quotes work the same way in Python for strings, so choose whichever you prefer, but you must use quotes to tell Python that you're working with text data.`
                                });
                            }
                        }
                    }
                });
            }
            
            // Check for variable assignment issues
            const varAssignments = userCode.match(/\w+\s*=\s*[^=\n]+/g);
            if (varAssignments) {
                varAssignments.forEach(assignment => {
                    const match = assignment.match(/(\w+)\s*=\s*(.+)/);
                    if (match) {
                        const varName = match[1];
                        let value = match[2].trim();
                        // Remove trailing semicolons or other characters
                        value = value.replace(/[;,\s]+$/, '');
                        
                        // Check if assigning a string literal without quotes
                        const isQuoted = value.match(/^["'].*["']$/);
                        const isBooleanOrNone = value.match(/^(True|False|None)$/);
                        const isNumber = value.match(/^\d+$/);
                        const looksLikeString = value.match(/^[A-Za-z][A-Za-z0-9]*$/) && !isBooleanOrNone;
                        
                        if (!isQuoted && !isNumber && looksLikeString) {
                            // Check if solution has quotes around this value
                            const solutionAssignment = solution.match(new RegExp(`${varName}\\s*=\\s*["']`));
                            if (solutionAssignment) {
                                issues.push({
                                    type: 'missing_quotes_assignment',
                                    message: `Missing Quotes in Assignment: The value for "${varName}" needs quotes`,
                                    detail: `When assigning a string value to "${varName}", the value must be enclosed in quotes. In Python, string literals (text values) always require quotes to distinguish them from variable names. Without quotes, Python interprets "${value}" as a variable name and will look for a variable with that name. If no such variable exists, you'll get a NameError. To fix this, use quotes around the text: ${varName} = "${value}" or ${varName} = '${value}'. Both single and double quotes work identically in Python - the important thing is that you use quotes to tell Python that you want to store the literal text "${value}" in the variable, not the value of a variable named "${value}".`
                                });
                            }
                        }
                    }
                });
            }
            
            // Compare with original buggy code
            if (userCodeTrimmed === buggyCodeTrimmed) {
                issues.push({
                    type: 'no_changes',
                    message: 'No Changes Made: You need to fix the code',
                    detail: 'The code is still the same as the broken version shown above. You need to identify what is wrong with the original code and make the necessary corrections. Look at the "Broken Code" section and compare it with what you\'ve written. The broken code contains an error that prevents it from running correctly - your task is to find and fix that error. Make sure you\'ve actually modified the code to address the issue.'
                });
            }
            
            // Check for common mistakes
            const solutionHasDoubleQuotes = solution.includes('"');
            const solutionHasSingleQuotes = solution.includes("'");
            const userHasDoubleQuotes = userCode.includes('"');
            const userHasSingleQuotes = userCode.includes("'");
            
            if ((solutionHasDoubleQuotes && !userHasDoubleQuotes) || 
                (solutionHasSingleQuotes && !userHasSingleQuotes)) {
                if (issues.length === 0 || !issues.some(i => i.type.includes('quotes'))) {
                    issues.push({
                        type: 'quote_type',
                        message: 'Quote Issue: Check the type of quotes used',
                        detail: 'Make sure you are using the correct type of quotes (single or double) as required by the solution. While both single quotes (\') and double quotes (") work in Python for strings, the solution may require a specific type. Check the expected solution format and ensure your quotes match. Also verify that you haven\'t mixed quote types incorrectly or left any quotes unclosed.'
                    });
                }
            }
            
            // If no specific issues found, provide general feedback
            if (issues.length === 0) {
                issues.push({
                    type: 'general',
                    message: 'Incorrect Solution: The code does not match the expected solution',
                    detail: 'Your code may run without syntax errors, but it does not produce the correct output or fix the issue properly. Compare your code carefully with the broken code shown above and identify what specific changes need to be made. Look for differences in quotes, variable assignments, function calls, or logic. The solution should address the exact problem in the broken code. Make sure you understand what the broken code is trying to do and what error it contains, then apply the correct fix.'
                });
            }
            
            return {
                isCorrect: false,
                issues: issues
            };
        }
        
        // Get explanation for correct code
        function getCorrectExplanation(buggyCode, solution) {
            const explanations = [];
            
            // Compare buggy code with solution
            const buggyLines = buggyCode.split('\n');
            const solutionLines = solution.split('\n');
            
            // Check for added quotes
            if (!buggyCode.includes('"') && !buggyCode.includes("'") && 
                (solution.includes('"') || solution.includes("'"))) {
                explanations.push('✅ You correctly added quotes around the string literals. In Python, all text values (strings) must be enclosed in either single quotes (\') or double quotes ("). This is a fundamental rule in Python - any sequence of characters that you want Python to treat as literal text must be wrapped in quotes. Without quotes, Python interprets the text as variable names, function names, or other identifiers, which will cause errors if those identifiers don\'t exist. By adding quotes, you\'ve told Python that this is a string literal (actual text data) that should be used as-is, not as a reference to something else.');
            }
            
            // Check for specific fixes
            if (buggyCode.includes('print(Hello') && solution.includes('print("Hello')) {
                explanations.push('✅ You fixed the print statement by adding double quotes around "Hello, World!". Without quotes, Python treats Hello and World! as variable names, which causes a NameError because those variables don\'t exist. By adding quotes, you\'ve converted the text into a proper string literal. When Python executes print("Hello, World!"), it recognizes "Hello, World!" as a string and outputs it directly to the console. This is the correct way to display text in Python - always wrap your text in quotes when using print().');
            }
            
            if (buggyCode.includes('name = John') && solution.includes("name = 'John'")) {
                explanations.push('✅ You correctly added quotes around the string value "John" in the variable assignment. When assigning a string literal to a variable, the value must be enclosed in quotes. Without quotes, Python looks for a variable named John, which doesn\'t exist, causing a NameError. By adding quotes (either single or double), you\'ve told Python that "John" is a string literal - actual text data that should be stored in the name variable. This is how you assign text values to variables in Python: variable_name = "text value" or variable_name = \'text value\'. Both single and double quotes work the same way.');
            }
            
            // General explanation
            if (explanations.length === 0) {
                explanations.push('✅ Your code is correct! The syntax is valid and the code will execute properly. You successfully fixed the error in the original code. The changes you made address the specific issue that was preventing the code from running correctly. Your solution follows Python syntax rules and will produce the expected output when executed.');
            }
            
            // Add execution result
            try {
                const safeCode = `
                    (function() {
                        const __output = [];
                        const __print = (...args) => {
                            __output.push(args.join(' '));
                        };
                        const print = __print;
                        ${solution.replace(/print\(/g, '__print(')}
                        return __output.join('\\n');
                    })();
                `;
                const result = new Function(safeCode)();
                if (result) {
                    explanations.push(`\n📊 Output: "${result}"`);
                }
            } catch (e) {
                // Ignore execution errors for explanation
            }
            
            return explanations.join('\n\n');
        }

        // Run the code
        function runCode() {
            const code = codeEditor.value;
            // Hide the long feedback box; we only use the compact output box now
            resultElement.style.display = 'none';
            
            // Play click sound
            const clickSound = new Audio('data:audio/wav;base64,UklGRl9vT19XQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YU...');
            clickSound.volume = 0.2;
            clickSound.play().catch(e => console.log('Click sound failed to play:', e));
            
            try {
                const challenge = challenges[currentLevel];
                const analysis = analyzeCode(code, challenge.code, challenge.solution);
                
                // Ensure there is a dedicated output box for this question
                let outputBox = document.getElementById(`outputBox-q${currentLevel}`);
                let outputStatus;
                let outputDetails;

                if (!outputBox) {
                    outputBox = document.createElement('div');
                    outputBox.id = `outputBox-q${currentLevel}`;
                    outputBox.className = 'result';

                    // Small heading showing which question this box belongs to
                    const heading = document.createElement('div');
                    heading.textContent = `Question ${currentLevel + 1}`;
                    heading.style.fontSize = '0.8rem';
                    heading.style.marginBottom = '0.25rem';
                    heading.style.color = 'var(--accent)';

                    outputStatus = document.createElement('strong');
                    outputStatus.className = 'output-status';

                    outputDetails = document.createElement('pre');
                    outputDetails.className = 'output-details';
                    outputDetails.style.marginTop = '0.4rem';
                    outputDetails.style.whiteSpace = 'pre-wrap';

                    outputBox.appendChild(heading);
                    outputBox.appendChild(outputStatus);
                    outputBox.appendChild(outputDetails);

                    if (outputContainer) {
                        outputContainer.appendChild(outputBox);
                    }
                } else {
                    outputStatus = outputBox.querySelector('.output-status');
                    outputDetails = outputBox.querySelector('.output-details');
                }

                if (outputBox) {
                    outputBox.style.display = 'block';
                }
                
                if (analysis.isCorrect) {
                    // Compact output: correct (very short summary explanation)
                    if (outputBox && outputStatus && outputDetails) {
                        outputBox.className = 'result success';
                        outputStatus.textContent = '✅ Correct answer';
                        // Provide a concise summary instead of the long explanation
                        let summary = 'Your fix matches the expected solution and runs without errors.';
                        // Optional: tailor summary based on current challenge
                        if (currentLevel === 0) {
                            summary = 'You correctly added quotes so Python treats the text as a string.';
                        } else if (currentLevel === 1) {
                            summary = 'You correctly stored the name as a quoted string before printing.';
                        }
                        outputDetails.textContent = summary;
                    }

                    // Calculate score based on time left and health
                    const timeBonus = Math.floor(timeLeft / 5);
                    const levelScore = 100 + (health * 20) + timeBonus;
                    score += levelScore;
                    
                    // Check if this was the last question
                    if (currentLevel >= challenges.length - 1) {
                        // If last question, show victory screen
                        endGame(true);
                    } else {
                        // Enable manual progression to the next question
                        readyForNextQuestion = true;
                        nextQuestionBtn.disabled = false;
                        nextQuestionBtn.style.display = 'inline-block';
                    }
                } else {
                    // Incorrect solution - compact output only (short description + user code)
                    if (outputBox && outputStatus && outputDetails) {
                        outputBox.className = 'result error';
                        outputStatus.textContent = '❌ Incorrect answer';
                        const firstIssue = analysis.issues && analysis.issues.length > 0 ? analysis.issues[0] : null;
                        const shortMsg = firstIssue ? firstIssue.message : 'Your solution does not match the expected fix.';
                        // Show a short description and echo the user code
                        outputDetails.textContent = `${shortMsg}\n\nYour code:\n${code.trim()}`;
                    }
                
                // Try to execute to show syntax errors
                try {
                    const safeCode = `
                        (function() {
                            const __output = [];
                            const __print = (...args) => {
                                __output.push(args.join(' '));
                                console.log(...args);
                            };
                            const print = __print;
                            ${code.replace(/print\(/g, '__print(')}
                            return __output.join('\\n');
                        })();
                    `;
                    const result = new Function(safeCode)();
                    // If execution succeeds but code is wrong, add note
                    if (result !== undefined) {
                        resultElement.innerHTML += '<br><em>Note: Your code executed without syntax errors, but the solution is still incorrect. Review the issues above.</em>';
                    }
                } catch (error) {
                    // Add syntax error details
                    resultElement.innerHTML += `<br><strong>Execution Error:</strong> ${error.message}`;
                }
                
                // Show error notification
                showErrorNotification('Incorrect Code - Check feedback below');
                
                // Lose health after showing feedback (give user time to read)
                setTimeout(() => {
                    loseHealth();
                }, 4000); // Give 4 seconds to read the feedback before resetting
                }
            } catch (error) {
                // Handle any unexpected errors during analysis
                resultElement.innerHTML = '<strong>❌ ERROR</strong><br><br>An unexpected error occurred while analyzing your code: ' + error.message;
                resultElement.className = 'result error';
                showErrorNotification('Analysis Error');
                
                setTimeout(() => {
                    loseHealth();
                }, 4000);
            }
        }

        // Show hint
        function showHint() {
            hintElement.textContent = challenges[currentLevel].hint;
            hintElement.style.display = 'block';
        }

        // End the game
        function endGame(victory) {
            clearInterval(timer);
            
            if (victory) {
                // Game completed successfully
                levelCompleteScreen.style.display = 'flex';
                // Trigger reflow to ensure the transition works
                void levelCompleteScreen.offsetWidth;
                levelCompleteScreen.querySelector('h2').textContent = 'Level Completed!';
                nextLevelBtn.innerHTML = 'Next Level <i class="fas fa-arrow-right"></i>';
                // Add show class to trigger animations
                levelCompleteScreen.classList.add('show');
                // Create confetti effect
                createConfetti();
            } else {
                // Game over - show appropriate message
                const gameOverTitle = gameOverScreen.querySelector('h2');
                
                if (health <= 0) {
                    gameOverTitle.textContent = 'Game Over - Out of Lives!';
                    finalScoreElement.textContent = currentLevel; // Show questions answered (0-based index)
                } else if (timeLeft <= 0) {
                    gameOverTitle.textContent = 'Time\'s Up!';
                    // If time runs out on the first question without answering, show 0/5
                    if (currentLevel === 0 && codeEditor.value.trim() === challenges[0].code.trim()) {
                        finalScoreElement.textContent = '0';
                    } else {
                        finalScoreElement.textContent = currentLevel;
                    }
                } else {
                    gameOverTitle.textContent = 'Game Over!';
                    finalScoreElement.textContent = currentLevel; // Show questions answered (0-based index)
                }
                
                gameOverScreen.style.display = 'flex';
                gameOverScreen.classList.add('show');
            }
        }

        // Handle restart button click
        restartBtn.addEventListener('click', () => {
            gameOverScreen.classList.remove('show');
            setTimeout(() => {
                initGame();
            }, 300);
        });

        // Get the home button element
        const homeBtn = document.getElementById('homeBtn');

        // Handle home button click
        homeBtn.addEventListener('click', () => {
            // Redirect to home page or main menu
            window.location.href = 'index.html'; // Change this to your home page URL
        });

        // Handle next level button click on completion screen
        nextLevelBtn.addEventListener('click', () => {
            // Remove show class to trigger fade out
            levelCompleteScreen.classList.remove('show');
            
            // Wait for the fade out animation to complete
            setTimeout(() => {
                levelCompleteScreen.style.display = 'none';
                // Here you can add logic to load the next level
                // For now, we'll just restart the game
                initGame();
            }, 300);
        });

        // Event listeners
        runBtn.addEventListener('click', runCode);
        
        resetBtn.addEventListener('click', () => {
            codeEditor.value = originalCode;
            resultElement.style.display = 'none';
        });
        
        showHintBtn.addEventListener('click', showHint);
        
        nextQuestionBtn.addEventListener('click', () => {
            if (!readyForNextQuestion) {
                showErrorNotification('Complete the current challenge before proceeding.');
                return;
            }
            if (currentLevel < challenges.length - 1) {
                currentLevel++;
                loadLevel(currentLevel);
                levelElement.textContent = currentLevel + 1;
                readyForNextQuestion = false;
                nextQuestionBtn.style.display = 'none';
                nextQuestionBtn.disabled = true;
            } else {
                endGame(true);
            }
        });

        // Initialize the game when the start button is clicked
        document.getElementById('startBtn').addEventListener('click', () => {
            document.getElementById('startScreen').style.display = 'none';
            document.querySelector('.game-container').style.display = 'block';
            initGame();
            
            // Play start sound
            const startSound = new Audio('data:audio/wav;base64,UklGRl9vT19XQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YU...');
            startSound.volume = 0.3;
            startSound.play().catch(e => console.log('Start sound failed to play:', e));
        });
    </script>
</body>
</html>
