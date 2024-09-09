// Função para abrir o modal, fechando o modal anterior se houver
function openModal(modalId) {
    // Fecha todos os modais abertos
    closeAllModals();

    // Abre o modal específico
    document.getElementById(modalId).style.display = "block";
}

// Função para fechar um modal específico
function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

// Função para fechar todos os modais
function closeAllModals() {
    const modals = document.getElementsByClassName("modal");
    for (let i = 0; i < modals.length; i++) {
        modals[i].style.display = "none";
    }
}

// Fecha o modal quando o usuário clica fora do conteúdo
window.onclick = function(event) {
    const modals = document.getElementsByClassName("modal");
    for (let i = 0; i < modals.length; i++) {
        if (event.target == modals[i]) {
            modals[i].style.display = "none";
        }
    }
}
