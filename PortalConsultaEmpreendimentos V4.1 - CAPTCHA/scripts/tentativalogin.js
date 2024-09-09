document.addEventListener('DOMContentLoaded', function() {
    const tempoRestante = localStorage.getItem('tempoRestante');
    if (tempoRestante) {
        localStorage.removeItem('tempoRestante');
        let tempo = parseInt(tempoRestante);

        const modal = document.getElementById('countdownModal');
        const modalCountdown = document.getElementById('modalCountdown');

        // Exibe o modal
        modal.style.display = 'flex';

        function atualizarContagemRegressiva() {
            if (tempo > 0) {
                modalCountdown.textContent = `Tentativa de LOGIN excedida! Aguarde ${tempo} segundos para tentar novamente.`;
                tempo--;
                setTimeout(atualizarContagemRegressiva, 1000);
            } else {
                modalCountdown.textContent = 'Você pode tentar fazer login novamente agora.';
                setTimeout(() => {
                    modal.style.display = 'none'; // Oculta o modal quando o tempo acaba
                }, 1000); // Dá 1 segundo de tempo antes de fechar o modal
            }
        }

        atualizarContagemRegressiva();
    }
});

