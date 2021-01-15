const quizDuration = +document.querySelector('.quiz-duration').innerHTML;
const submitQuizBtn = document.querySelector('.submit-quiz-btn');

let deadline = new Date(new Date().getTime() + quizDuration * 60000)

let x = setInterval(function () {

    let current_time = new Date().getTime();

    let distance = deadline - current_time;

    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.querySelector('.timer').innerHTML = hours + "h " + minutes + "m "
        + seconds + "s ";

    if (distance < 0) {
        clearInterval(x);
        submitQuizBtn.form.submit();
    }
}, 1000);



