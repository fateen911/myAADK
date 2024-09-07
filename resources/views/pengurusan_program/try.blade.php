<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Try</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .question-container {
            text-align: center;
        }

        .likert-scale {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            gap: 15px;
        }

        .likert-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 10px;
        }

        input[type="radio"] {
            display: none;
        }

        label {
            font-size: 14px;
            color: #666;
        }

        .circle1 {
            width: 40px;
            height: 40px;
            border: 2px solid forestgreen;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
            cursor: pointer;
            transition: 0.5s;
        }

        .circle2 {
            width: 30px;
            height: 30px;
            border: 2px solid forestgreen;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
            cursor: pointer;
            transition: 0.5s;
        }

        .circle3 {
            width: 30px;
            height: 30px;
            border: 2px solid purple;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
            cursor: pointer;
            transition: 0.5s;
        }

        .circle4 {
            width: 40px;
            height: 40px;
            border: 2px solid purple;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
            cursor: pointer;
            transition: 0.5s;
        }

        .circle1:hover{
            border-color: forestgreen;
            background-color: forestgreen;
            transition: 0.5s;
        }

        .circle2:hover{
            border-color: forestgreen;
            background-color: forestgreen;
            transition: 0.5s;
        }

        .circle3:hover{
            border-color: purple;
            background-color: purple;
            transition: 0.5s;
        }

        .circle4:hover{
            border-color: purple;
            background-color: purple;
            transition: 0.5s;
        }

        input[type="radio"]:checked + .circle1 {
            border-color: forestgreen;
            background-color: forestgreen;
        }

        input[type="radio"]:checked + .circle2 {
            border-color: forestgreen;
            background-color: forestgreen;
        }

        input[type="radio"]:checked + .circle3 {
            border-color: purple;
            background-color: purple;
        }

        input[type="radio"]:checked + .circle4 {
            border-color: purple;
            background-color: purple;
        }

        .keputusan{
            height: 30px;
            align-items: center;
            margin: auto 10px;
            font-weight: bold;
            font-size: 18px;
        }

        .hr{
            margin-top: 40px;
            margin-bottom: 40px;
            width: 60%;
        }

        .mt-50{
            margin-top: 50px;
        }

        .mt-40{
            margin-top: 40px;
        }

        .color-purple{
            color: purple;
        }

        .color-green{
            color: forestgreen;
        }

        .question{
            font-weight: bold;
            font-size: 25px;
            color: #424242;
        }
    </style>
</head>
<body>
<div class="question-container mt-50">
    <p class="question">Adakah anda seorang yang teratur?</p>

    <div class="likert-scale mt-40">
        <span class="keputusan color-green">Sangat Setuju</span>
        <div class="likert-option">
            <input type="radio" id="option1" name="likert" value="1">
            <label for="option1" class="circle1"></label>
        </div>
        <div class="likert-option">
            <input type="radio" id="option2" name="likert" value="2">
            <label for="option2" class="circle2"></label>
        </div>
        <div class="likert-option">
            <input type="radio" id="option3" name="likert" value="3">
            <label for="option3" class="circle3"></label>
        </div>
        <div class="likert-option">
            <input type="radio" id="option4" name="likert" value="4">
            <label for="option4" class="circle4"></label>
        </div>
        <span class="keputusan color-purple">Sangat Tidak Setuju</span>
    </div>
</div>
<hr class="hr">
<div class="question-container">
    <p class="question">Adakah anda percaya kepada Tuhan?</p>

    <div class="likert-scale mt-40">
        <span class="keputusan color-green">Sangat Setuju</span>
        <div class="likert-option">
            <input type="radio" id="option1" name="likert" value="1">
            <label for="option1" class="circle1"></label>
        </div>
        <div class="likert-option">
            <input type="radio" id="option2" name="likert" value="2">
            <label for="option2" class="circle2"></label>
        </div>
        <div class="likert-option">
            <input type="radio" id="option3" name="likert" value="3">
            <label for="option3" class="circle3"></label>
        </div>
        <div class="likert-option">
            <input type="radio" id="option4" name="likert" value="4">
            <label for="option4" class="circle4"></label>
        </div>
        <span class="keputusan color-purple">Sangat Tidak Setuju</span>
    </div>
</div>
<hr class="hr">
</body>
</html>
