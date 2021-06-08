

const questionNumber = document.querySelector(".question-number");
const questionText = document.querySelector(".question-text");
const optionContainer = document.querySelector(".option-container");
const answersInducatorContainer = document.querySelector(".answer-indicator");
const homeBox = document.querySelector(".home-box");
const quizBox = document.querySelector(".quiz-box");
const resultBox = document.querySelector(".result-box");

let questionCounter = 0;
let currentQuestion;
let availableQuestions = [];
let availableOptions = [];
let correctAnswers = 0;
let attempt = 0;

//push the question into availableQuestions Array
function setAvailableQuestions(){
    const totalQuestion = index.length;
    for(let i=0; i<totalQuestion; i++){
        availableQuestions.push(index[i])
    }
}

// set question number and question and options
function getNewQuestion(){
    // set question number
    questionNumber.innerHTML = "Pertanyaan " + (questionCounter + 1) + " dari " + index.length;

    // set question text
    // get random question
    const questionIndex = availableQuestions[Math.floor(Math.random() * availableQuestions.length)]
    currentQuestion = questionIndex;
    questionText.innerHTML = currentQuestion.q;
    // get the position of 'questionIndex' form the availableQuestion Array
    const index1= availableQuestions.indexOf(questionIndex);
    // remove the 'questionIndex' form the availableQuestion Array, so that the question does not repeat
    availableQuestions.splice(index1,1)

    // set options
    // get the length of options
    const optionLen = currentQuestion.options.length
    // push options into availableOptions Array
    for(let i=0; i<optionLen; i++){
        availableOptions.push(i)
    }
    optionContainer.innerHTML = '';
    let animationDelay = 0.15;
    //create optionsin html
    for(let i=0; i<optionLen; i++){
        // random option
        const optonIndex = availableOptions[Math.floor(Math.random() * availableOptions.length)];
        // get the position of 'optonIndex' from the availableOptions Array
        const index2 = availableOptions.indexOf(optonIndex);
        // remove the 'optonIndex' from the availableOptions Array, so that the option does not repeat
        availableOptions.splice(index2,1);
        const option = document.createElement("div");
        option.innerHTML = currentQuestion.options[optonIndex];
        option.id = optonIndex;
        option.style.animationDelay =animationDelay + 's';
        animationDelay = animationDelay + 0.15;
        option.className = "option";
        optionContainer.appendChild(option)
        option.setAttribute("onclick","getResult(this)");
    }
     
    questionCounter++
}

// get the result of current attempt question
function getResult(element){
    const id = parseInt(element.id);
    // get the answer by comparing the id of clicked option
    if(id === currentQuestion.answer){
        // set the green color to the correct option
        element.classList.add("correct");
        // add the indicator to correct mark
        updateAnswerIndicaror("correct");
        correctAnswers++;
    }
    else{
        // set the red color to the incorrect option
        element.classList.add("wrong");
        // add the indicator to wrong mark
        updateAnswerIndicaror("wrong");
        
        // if the answer is incorrect the show the correct option by adding green color the correct option 
        const optionLen = optionContainer.children.length;
        for(let i=0; i<optionLen; i++){
            if(parseInt(optionContainer.children[i].id) === currentQuestion.answer){
                optionContainer.children[i].classList.add("correct");
            }
        }
    }
    attempt++; 
    unclickableOptions();
}

// make all the options unclickable once the user select a option (RESTRICT THE USER TO CHANGE THE OPTION AGAIN)
function unclickableOptions(){
    const optionLen = optionContainer.children.length;
    for(let i=0 ; i<optionLen; i++)
    optionContainer.children[i].classList.add("already-answered");
}

function answersInducator(){
    answersInducatorContainer.innerHTML = '';
    const totalQuestion = index.length;
    for(let i=0; i<totalQuestion; i++){
        const indicators = document.createElement("div");
        answersInducatorContainer.appendChild(indicators);
    }
}
function updateAnswerIndicaror(markType){
    answersInducatorContainer.children[questionCounter-1].classList.add(markType)
}


function next(){
    if(questionCounter === index.length){
        console.log("quiz over");
        quizOver();
    }
    else{
        getNewQuestion();
    }
}

function quizOver(){
    // hide quiz Box
    quizBox.classList.add("hide");
    // show result Box
    resultBox.classList.remove("hide"); 
    quizResult();
}
// get the quiz Result
function quizResult(){
    resultBox.querySelector(".total-question").innerHTML = index.length;
    resultBox.querySelector(".total-attempt").innerHTML = attempt;
    resultBox.querySelector(".total-correct").innerHTML = correctAnswers;
    resultBox.querySelector(".total-wrong").innerHTML = attempt - correctAnswers;
    const percentage = (correctAnswers/index.length)*100;
    resultBox.querySelector(".total-percentage").innerHTML = percentage.toFixed(2) + "%";
    resultBox.querySelector(".total-score").innerHTML = correctAnswers +" / " + index.length;
}

function resetQuiz(){
    questionCounter = 0;
    correctAnswers = 0;
    attempt = 0;
}

function tryAgainQuiz(){
    //hide the resultBox
    resultBox.classList.add("hide");
    // show the quizBox
    quizBox.classList.remove("hide");
    resetQuiz();
    starQuiz();
}

function GOToHome(){
    // hide resultBox
    resultBox.classList.add("hide");
    // show home box
    homeBox.classList.remove("hide");
    resetQuiz();
}

// #### STARTING POINT ####

function starQuiz(){

    // hide home box
    homeBox.classList.add("hide");
    // show quiz Box
    quizBox.classList.remove("hide");
    // first we will set all question in availableQuestions Array
    setAvailableQuestions();
    // second we will call getgetNewQuestion(); function
    getNewQuestion();
    // to create indicators of answers
    answersInducator();

}


window.onload = function (){
    resultBox.querySelector(".total-question").innerHTML = index.length;
}