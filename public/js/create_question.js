const addAnsBtn = document.querySelector('.add-answer');
const removeAnsBtn = document.querySelector('.remove-answer');

const questionTypeContainer = document.querySelector('.choose-question-type');
const singleChoiceRadio = document.querySelector('.single-choice');
const multipleChoiceRadio = document.querySelector('.multiple-choice');

const ansContainer = document.querySelector('.answer-set');
const setCorrectAnsContainer = document.querySelector('.set-correct-ans');

let ansCounter;

questionTypeContainer.onchange = function () {

    const ansContainerLength = ansContainer.children.length;
    setCorrectAnsContainer.innerHTML = '';

    if (singleChoiceRadio.checked) {
        for (let i = 1; i <= ansContainerLength; i++) {
            setCorrectAnsContainer.innerHTML += `
                       <div class="form-check mr-3">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="right_answer"
                                    id="answerRadios${i}" value="${i}" checked="">
                                Answer ${i}
                            </label>
                        </div>
            `;
        }
    } else if (multipleChoiceRadio.checked) {
        for (let i = 1; i <= ansContainerLength; i++) {
            setCorrectAnsContainer.innerHTML += `
                       <div class="form-check mr-3">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="right_answers[]"
                                value="${i}">
                                 Answer ${i}
                            </label>
                        </div>
            `;
        }
    }
}

addAnsBtn.onclick = function () {

    ansCounter = ansContainer.lastElementChild
        .lastElementChild.getAttribute('id').split('_')[1];

    ansCounter++;

    const answerHtmlString = `
          <div class="form-group">
              <label for="answer_${ansCounter}">Answer ${ansCounter}</label>
              <input id="answer_${ansCounter}" type="text" class="form-control"
                   placeholder="Enter answer ${ansCounter}" name="answers[]">
          </div>
    `;

    const answerNode = new DOMParser().parseFromString(answerHtmlString, 'text/html')
        .body.firstChild;

    ansContainer.appendChild(answerNode);

    let chooseRight;

    if (singleChoiceRadio.checked) {
        chooseRight = `
           <div class="form-check mr-3">
                 <label class="form-check-label">
                     <input type="radio" class="form-check-input" name="right_answer"
                       id="answerRadios${ansCounter}" value="${ansCounter}" checked="">
                        Answer ${ansCounter}
                </label>
            </div>
        `;
    } else if (multipleChoiceRadio.checked) {
        chooseRight = `
           <div class="form-check mr-3">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="right_answers[]"
                    value="${ansCounter}">
                     Answer ${ansCounter}
                </label>
            </div>
        `;
    }

    setCorrectAnsContainer.innerHTML += chooseRight;
}

removeAnsBtn.onclick = function () {
    if (ansContainer.children.length > 2) {
        ansContainer.removeChild(ansContainer.lastElementChild);
        setCorrectAnsContainer.removeChild(setCorrectAnsContainer.lastElementChild);
    } else {
        alert('You should have at least 2 answers!');
    }
}
