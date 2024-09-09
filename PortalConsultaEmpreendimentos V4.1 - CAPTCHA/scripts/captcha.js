// Função para gerar uma string CAPTCHA aleatória
function generateCaptcha() {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let captcha = '';
    for (let i = 0; i < 6; i++) {
        captcha += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    document.getElementById('captchaCode').innerText = captcha;
}

// Função para validar o CAPTCHA
function validateCaptcha() {
    const userInput = document.getElementById('captchaInput').value;
    const captchaCode = document.getElementById('captchaCode').innerText;

    if (userInput === captchaCode) {
        document.getElementById('captchaMessage').innerText = 'CAPTCHA correto!';
        document.getElementById('captchaMessage').style.color = 'green';
    } else {
        document.getElementById('captchaMessage').innerText = 'CAPTCHA incorreto. Tente novamente!';
        document.getElementById('captchaMessage').style.color = 'red';
    }
}

// Gerar CAPTCHA inicial
generateCaptcha();
