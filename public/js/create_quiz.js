const generateCodeBtn = document.querySelector('.generate-access-code');
const accessCodeInput = document.querySelector('.random-access-code');

generateCodeBtn.onclick = function () {
    accessCodeInput.value = `${generateRandomNum()}-${generateRandomNum()}`;
}

function generateRandomNum() {
    return Math.floor(1000 + Math.random() * 9000);
}
