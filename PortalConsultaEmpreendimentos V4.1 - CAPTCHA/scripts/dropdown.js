/* Função para alternar a exibição do dropdown */
function toggleDropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function logout() {
  // Coloque aqui o código para fazer logout, como redirecionar para a página de login
  window.location.href = "Login.html";
  alert("Você foi desconectado!");
}

function loadUserName() {
  var userButton = document.getElementById("userButton");
  if (userButton) {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '../php/nome_usuario.php', true); // Caminho ajustado
      xhr.onload = function() {
          if (xhr.status === 200) {
              var response = xhr.responseText.trim(); // Remove espaços em branco adicionais
              if (response) {
                  userButton.innerText = response;
              } else {
                  userButton.innerText = 'Usuário';
              }
          } else {
              console.error('Erro ao carregar nome do usuário: Status ' + xhr.status);
          }
      };
      xhr.onerror = function() {
          console.error('Erro ao realizar a requisição.');
      };
      xhr.send();
  } else {
      console.error('Elemento com ID "userButton" não encontrado.');
  }
}

window.onload = function() {
  loadUserName();
};