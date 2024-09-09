// Variáveis para manipulação do zoom
let currentFontSize = 100; // Porcentagem de zoom da fonte
const bodyElement = document.body;

// Função para alterar o tamanho da fonte
function adjustFontSize(zoomChange) {
    currentFontSize += zoomChange;
    bodyElement.style.fontSize = currentFontSize + "%";
}

// Resetar tamanho da fonte
function resetFontSize() {
    currentFontSize = 100;
    bodyElement.style.fontSize = "100%";
}

// Função para alterar contraste
function changeContrast(mode) {
    bodyElement.classList.remove("high-contrast", "black-white", "inverted-contrast");

    switch (mode) {
        case 'high':
            bodyElement.classList.add("high-contrast");
            break;
        case 'bw':
            bodyElement.classList.add("black-white");
            break;
        case 'invert':
            bodyElement.classList.add("inverted-contrast");
            break;
        case 'normal':
        default:
            bodyElement.style.filter = "none";
            break;
    }
}

// Controle de zoom
document.getElementById("zoomInBtn").addEventListener("click", function() {
    adjustFontSize(10); // Aumenta a fonte em 10%
});

document.getElementById("zoomOutBtn").addEventListener("click", function() {
    adjustFontSize(-10); // Diminui a fonte em 10%
});

document.getElementById("resetZoomBtn").addEventListener("click", resetFontSize);

// Controle de contraste
document.getElementById("normalContrastBtn").addEventListener("click", function() {
    changeContrast('normal');
});

document.getElementById("highContrastBtn").addEventListener("click", function() {
    changeContrast('high');
});

document.getElementById("blackWhiteBtn").addEventListener("click", function() {
    changeContrast('bw');
});

document.getElementById("invertContrastBtn").addEventListener("click", function() {
    changeContrast('invert');
});

// Toggle do menu de acessibilidade
function toggleAccessibilityMenu() {
    const menu = document.getElementById("accessibilityMenu");
    menu.style.display = (menu.style.display === "none" || menu.style.display === "") ? "block" : "none";
}

// Toggle do dropdown
function toggleDropdown() {
    const dropdown = document.getElementById("myDropdown");
    dropdown.classList.toggle("show");
}
