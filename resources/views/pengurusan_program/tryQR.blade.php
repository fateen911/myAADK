<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Personality Test</title>
    <style>
        /* Basic Reset and Styling */
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        /* Form Container */
        #personalityTest {
            position: relative;
            width: 100%;
            height: 100%;
        }

        /* Question Container Styling */
        .question-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            max-width: 600px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        /* Active Question Styling */
        .question-container.active {
            display: block;
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }

        /* Hidden Question Styling for Smooth Transition */
        .question-container.hidden {
            opacity: 0;
            transform: translate(-50%, -60%) scale(0.95);
        }

        /* Question Heading */
        h2 {
            margin-bottom: 20px;
        }

        /* Radio Button Labels */
        label {
            display: block;
            margin: 10px 0;
            cursor: pointer;
            position: relative;
            padding-left: 35px;
            font-size: 1.1em;
        }

        /* Hide Default Radio Buttons */
        input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Custom Radio Button */
        label::before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 20px;
            width: 20px;
            border-radius: 50%;
            border: 2px solid #4285F4;
            background-color: white;
            transition: background-color 0.3s, border-color 0.3s;
        }

        /* Checked State */
        input[type="radio"]:checked + label::before {
            background-color: #4285F4;
        }

        /* Hover Effect */
        label:hover::before {
            border-color: #306acb;
        }

        /* Submit Button Styling */
        .submit-container {
            text-align: center;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            background-color: #4285F4;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #306acb;
        }
    </style>
</head>
<body>

<form id="personalityTest">
    <!-- Question 1 -->
    <div id="question1" class="question-container active">
        <h2>Question 1: What's your favorite color?</h2>
        <input type="radio" id="q1-blue" name="q1" value="blue">
        <label for="q1-blue">Blue</label>

        <input type="radio" id="q1-red" name="q1" value="red">
        <label for="q1-red">Red</label>

        <input type="radio" id="q1-green" name="q1" value="green">
        <label for="q1-green">Green</label>

        <input type="radio" id="q1-yellow" name="q1" value="yellow">
        <label for="q1-yellow">Yellow</label>
    </div>

    <!-- Question 2 -->
    <div id="question2" class="question-container">
        <h2>Question 2: What's your favorite animal?</h2>
        <input type="radio" id="q2-dog" name="q2" value="dog">
        <label for="q2-dog">Dog</label>

        <input type="radio" id="q2-cat" name="q2" value="cat">
        <label for="q2-cat">Cat</label>

        <input type="radio" id="q2-bird" name="q2" value="bird">
        <label for="q2-bird">Bird</label>

        <input type="radio" id="q2-fish" name="q2" value="fish">
        <label for="q2-fish">Fish</label>
    </div>

    <!-- Question 3 -->
    <div id="question3" class="question-container">
        <h2>Question 3: What's your favorite season?</h2>
        <input type="radio" id="q3-spring" name="q3" value="spring">
        <label for="q3-spring">Spring</label>

        <input type="radio" id="q3-summer" name="q3" value="summer">
        <label for="q3-summer">Summer</label>

        <input type="radio" id="q3-autumn" name="q3" value="autumn">
        <label for="q3-autumn">Autumn</label>

        <input type="radio" id="q3-winter" name="q3" value="winter">
        <label for="q3-winter">Winter</label>
    </div>

    <!-- Final Thank You Message -->
    <div id="question4" class="question-container">
        <h2>Thank you for completing the quiz!</h2>
        <p>Your responses have been recorded.</p>
        <div class="submit-container">
            <button type="submit">Submit</button>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('personalityTest');
        const questions = Array.from(form.querySelectorAll('.question-container'));
        let currentQuestionIndex = 0;

        // Function to show the next question
        function showNextQuestion(currentIndex) {
            const currentQuestion = questions[currentIndex];
            const nextQuestion = questions[currentIndex + 1];

            if (nextQuestion) {
                // Hide current question with animation
                currentQuestion.classList.remove('active');
                currentQuestion.classList.add('hidden');

                // Show next question with animation
                nextQuestion.classList.add('active');
                nextQuestion.classList.remove('hidden');
            }
        }

        // Attach event listeners to all radio buttons
        questions.forEach((question, index) => {
            const radioButtons = question.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', () => {
                    showNextQuestion(index);
                });
            });
        });
    });
</script>

</body>
</html>
`
