function toggleDropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function logout() {
  // Exibir caixa de diálogo de confirmação
  if (confirm("Tem certeza de que deseja sair?")) {
      // Lógica de logout aqui, por exemplo, redirecionar para a página de login ou realizar uma chamada de API para encerrar a sessão
      alert("Você foi desconectado.");
      // Para redirecionar para uma página de login:
      window.location.href = "login.html";
  } else {
      // Se o usuário clicar em "Não", apenas feche o menu suspenso
      toggleDropdown();
  }
}

// Adicionar estilo para mostrar o dropdown
document.addEventListener('DOMContentLoaded', (event) => {
  var dropdowns = document.getElementsByClassName("dropdown-content");
  window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
          for (var i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                  openDropdown.classList.remove('show');
              }
          }
      }
  }
});