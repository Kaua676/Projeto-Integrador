function validarLogin(event) {
    const documento = document.getElementById('documento').value;
    const senha = document.getElementById('password').value;
    const captchaInput = document.getElementById('captchaInput').value;
    const captchaCode = document.getElementById('captchaCode').innerText;

    // Atualizar o campo oculto com o CAPTCHA
    document.getElementById('captchaCodeHidden').value = captchaCode;

    // Validar CPF
    if (!validarCPF(documento)) {
        alert('CPF inválido');
        event.preventDefault();
        return false;
    }

    // Validar Senha
    if (!validarSenha(senha)) {
        alert('Senha inválida');
        event.preventDefault();
        return false;
    }

    // Validar CAPTCHA
    if (captchaInput !== captchaCode) {
        alert('CAPTCHA inválido');
        event.preventDefault();
        return false;
    }

    return true; // Se todos os campos estiverem válidos, permite o envio do formulário
}

