document.getElementById('submit').addEventListener('click', function (event) {
  const documentoInput = document.getElementById('documento');
  const documento = documentoInput.value;

  // Validação do CPF
  if (!validarCPF(documento)) {
    alert('CPF inválido');
    // Impede o envio do formulário se o CPF for inválido
    event.preventDefault();
  }
});

// Função para validar CPF
function validarCPF(cpf) {
  cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos
  if (cpf.length !== 11 || /^(.)\1+$/.test(cpf)) {
    return false; // CPF deve ter 11 dígitos e não pode ser composto por dígitos iguais
  }

  // Calcula o primeiro dígito verificador
  let soma = 0;
  for (let i = 0; i < 9; i++) {
    soma += parseInt(cpf.charAt(i)) * (10 - i);
  }
  let digito1 = 11 - (soma % 11);
  if (digito1 > 9) {
    digito1 = 0;
  }

  // Calcula o segundo dígito verificador
  soma = 0;
  for (let i = 0; i < 10; i++) {
    soma += parseInt(cpf.charAt(i)) * (11 - i);
  }
  let digito2 = 11 - (soma % 11);
  if (digito2 > 9) {
    digito2 = 0;
  }

  // Verifica se os dígitos calculados são iguais aos dígitos informados
  return parseInt(cpf.charAt(9)) === digito1 && parseInt(cpf.charAt(10)) === digito2;
}
