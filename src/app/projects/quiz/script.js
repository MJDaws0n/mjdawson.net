// Theme Toggle Logic
const themeToggle = document.getElementById('theme-toggle');
const html = document.documentElement;
const icon = themeToggle.querySelector('.theme-icon');

function updateIcon() {
    const isDark = html.getAttribute('data-theme') === 'dark';
    icon.textContent = isDark ? '🌙' : '☀️';
}
updateIcon();

themeToggle.addEventListener('click', () => {
    const current = html.getAttribute('data-theme');
    const next = current === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', next);
    localStorage.setItem('theme', next);
    updateIcon();
});

// Quiz Logic
let currentQuestionIndex = 0;
let score = 0;
let quizData = null;

const els = {
    loading: document.getElementById('loading-state'),
    interface: document.getElementById('quiz-interface'),
    result: document.getElementById('result-interface'),
    title: document.getElementById('quiz-title'),
    count: document.getElementById('question-count'),
    progress: document.getElementById('progress-bar'),
    questionText: document.getElementById('question-text'),
    optionsGrid: document.getElementById('options-grid'),
    nextBtn: document.getElementById('next-btn'),
    finalScore: document.getElementById('final-score'),
    resultMessage: document.getElementById('result-message'),
    resultSub: document.getElementById('result-sub')
};

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

async function loadQuiz() {
    try {
        const response = await fetch('/projects/quiz/quiz.json');
        quizData = await response.json();
        
        // Randomize Questions
        shuffleArray(quizData.questions);

        els.title.textContent = quizData.title;
        els.loading.style.display = 'none';
        els.interface.style.display = 'block';
        
        renderQuestion();
    } catch (error) {
        els.loading.innerHTML = '<p style="color: var(--accent)">Error loading quiz data.</p>';
        console.error(error);
    }
}

function renderQuestion() {
    const question = quizData.questions[currentQuestionIndex];
    const total = quizData.questions.length;

    // Update UI
    els.count.textContent = `Question ${currentQuestionIndex + 1}/${total}`;
    els.progress.style.width = `${((currentQuestionIndex) / total) * 100}%`;
    
    // Animate question change
    const container = document.getElementById('question-container');
    container.classList.remove('fade-in');
    void container.offsetWidth; // trigger reflow
    container.classList.add('fade-in');

    els.questionText.textContent = question.question;
    els.optionsGrid.innerHTML = '';
    els.nextBtn.style.display = 'none';

    // Prepare options with correctness tracking
    const options = question.options.map((opt, i) => ({
        text: opt,
        isCorrect: i === question.answer
    }));

    // Randomize Options
    shuffleArray(options);

    options.forEach((opt) => {
        const btn = document.createElement('button');
        btn.className = 'option-btn';
        btn.textContent = opt.text;
        btn.dataset.isCorrect = opt.isCorrect;
        btn.onclick = () => handleAnswer(btn);
        els.optionsGrid.appendChild(btn);
    });
}

function handleAnswer(btn) {
    const isCorrect = btn.dataset.isCorrect === 'true';
    const buttons = els.optionsGrid.querySelectorAll('.option-btn');
    
    // Disable all buttons
    buttons.forEach(b => b.disabled = true);

    if (isCorrect) {
        btn.classList.add('correct');
        score++;
        
        // 10% chance for 67 animation on correct answer
        if (Math.random() < 0.1) {
            trigger67();
        }
    } else {
        btn.classList.add('incorrect');
        // Highlight correct answer
        buttons.forEach(b => {
            if (b.dataset.isCorrect === 'true') {
                b.classList.add('correct');
            }
        });
    }

    // Show next button
    els.nextBtn.style.display = 'inline-flex';
    
    // Update progress bar to completed for this step
    const total = quizData.questions.length;
    els.progress.style.width = `${((currentQuestionIndex + 1) / total) * 100}%`;
}

function trigger67() {
    const el = document.createElement('div');
    el.className = 'floating-67';
    el.textContent = '67';
    
    // Random position near center
    const x = 50 + (Math.random() * 20 - 10);
    const y = 50 + (Math.random() * 20 - 10);
    
    el.style.left = `${x}%`;
    el.style.top = `${y}%`;
    
    document.body.appendChild(el);
    
    // Cleanup
    setTimeout(() => {
        el.remove();
    }, 2000);
}

els.nextBtn.addEventListener('click', () => {
    currentQuestionIndex++;
    if (currentQuestionIndex < quizData.questions.length) {
        renderQuestion();
    } else {
        showResults();
    }
});

function showResults() {
    els.interface.style.display = 'none';
    els.result.style.display = 'block';
    
    const total = quizData.questions.length;
    const percentage = Math.round((score / total) * 100);
    
    els.finalScore.textContent = `${percentage}%`;
    els.resultSub.textContent = `You scored ${score} out of ${total}`;

    if (percentage === 100) {
        els.resultMessage.textContent = "Perfect Score! 🎉";
    } else if (percentage >= 70) {
        els.resultMessage.textContent = "Great Job! 👏";
    } else if (percentage >= 50) {
        els.resultMessage.textContent = "Good Effort! 👍";
    } else {
        els.resultMessage.textContent = "Keep Learning! 📚";
    }
}

// Start
loadQuiz();
