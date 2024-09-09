document.querySelector('form').addEventListener('submit', function(event) {
  const senhaInput = document.getElementById('password');
  const senha = senhaInput.value;
  
  if (!validarSenha(senha)) {  
    alert('Senha inválida. A senha deve ter pelo menos 8 caracteres, uma letra maiúscula, um número e um caractere especial.');
    event.preventDefault(); // Impede o envio do formulário
  }
});

function validarSenha(senha) {
  // Verifique se a senha tem pelo menos 8 caracteres
  if (senha.length < 8) {
    return false;
  }

  // Verifique se a senha contém pelo menos uma letra maiúscula
  if (!/[A-Z]/.test(senha)) {
    return false;
  }

  // Verifique se a senha contém pelo menos um número
  if (!/\d/.test(senha)) {
    return false;
  }

  // Verifique se a senha contém pelo menos um caractere especial
  if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(senha)) {
    return false;
  }

  // Se todos os critérios forem atendidos, a senha é válida
  return true;
}