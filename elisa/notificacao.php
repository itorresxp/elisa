<?php
/**
 * 💕 PÁGINA DE NOTIFICAÇÃO - SISTEMA ELISA
 * Administrador acessou o site!
 * Botão que foge 3 vezes
 */

session_start();

if (!isset($_SESSION['usuario_autenticado'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>💕 Notificação Especial - Elisa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a0033 0%, #330066 50%, #1a0033 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .container {
            max-width: 600px;
            width: 100%;
            padding: 2rem;
        }

        .notification {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            padding: 3rem 2rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3), 0 0 100px rgba(255, 192, 203, 0.2);
            text-align: center;
            animation: popIn 0.6s cubic-bezier(0.36, 0, 0.66, 1);
            border: 2px solid rgba(255, 20, 147, 0.3);
        }

        @keyframes popIn {
            0% {
                opacity: 0;
                transform: scale(0.3) rotateZ(-10deg);
            }
            50% {
                transform: scale(1.05) rotateZ(2deg);
            }
            100% {
                opacity: 1;
                transform: scale(1) rotateZ(0);
            }
        }

        .icon {
            font-size: 5rem;
            margin-bottom: 1rem;
            animation: bounce 1s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-30px); }
        }

        h1 {
            color: #1a0033;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #ff69b4 0%, #ff1493 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .message {
            color: #333;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
            font-weight: 500;
        }

        .message i {
            color: #ff1493;
            margin: 0 0.25rem;
        }

        .button-container {
            margin-top: 3rem;
            min-height: 60px;
            position: relative;
        }

        .magic-button {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #ff69b4 0%, #ff1493 100%);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(255, 20, 147, 0.4);
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .magic-button:hover {
            transform: translate(-50%, -50%) scale(1.05);
            box-shadow: 0 10px 30px rgba(255, 20, 147, 0.6);
        }

        .magic-button:active {
            transform: translate(-50%, -50%) scale(0.95);
        }

        /* Efeito de confete */
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            pointer-events: none;
            animation: confettiFall 3s ease-in forwards;
        }

        @keyframes confettiFall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .falling-hearts {
            position: fixed;
            font-size: 2rem;
            pointer-events: none;
            animation: fallHearts 3s ease-in forwards;
        }

        @keyframes fallHearts {
            to {
                transform: translateY(100vh) rotateZ(360deg);
                opacity: 0;
            }
        }

        .info-text {
            color: #999;
            font-size: 0.9rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #eee;
        }

        .timestamp {
            color: #ff1493;
            font-weight: 600;
        }

        @media (max-width: 480px) {
            .notification {
                padding: 2rem 1.5rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .message {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="notification">
            <div class="icon">✨</div>
            <h1>Bem-vindo!</h1>
            <div class="message">
                <i class="fas fa-check-circle"></i>
                <strong>Administrador acessou o site!</strong>
                <i class="fas fa-check-circle"></i>
            </div>
            <p style="color: #666; margin-bottom: 1rem;">
                Uma surpresa especial te aguarda abaixo...
            </p>

            <div class="button-container">
                <button class="magic-button" id="magicButton">
                    <i class="fas fa-gift" style="margin-right: 0.5rem;"></i>
                    Clique em mim!
                </button>
            </div>

            <div class="info-text">
                <p>Acesso em: <span class="timestamp"><?php echo date('d/m/Y às H:i:s'); ?></span></p>
            </div>
        </div>
    </div>

    <script>
        const button = document.getElementById('magicButton');
        let clickCount = 0;
        const maxFlees = 3;

        // Criar confete ao carregar
        function createConfetti() {
            for (let i = 0; i < 30; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.background = ['#ff69b4', '#ff1493', '#ff69b4', '#ffe6f0'][Math.floor(Math.random() * 4)];
                confetti.style.animationDelay = (Math.random() * 0.5) + 's';
                document.body.appendChild(confetti);

                setTimeout(() => confetti.remove(), 3000);
            }

            // Corações caindo
            for (let i = 0; i < 20; i++) {
                const heart = document.createElement('div');
                heart.className = 'falling-hearts';
                heart.innerHTML = '❤️';
                heart.style.left = Math.random() * 100 + 'vw';
                heart.style.animationDelay = (Math.random() * 0.5) + 's';
                document.body.appendChild(heart);

                setTimeout(() => heart.remove(), 3000);
            }
        }

        // Função para mover o botão
        function moveButton() {
            if (clickCount < maxFlees) {
                // Gerar posição aleatória
                const newX = Math.random() * (window.innerWidth - 200);
                const newY = Math.random() * (window.innerHeight - 100);

                button.style.position = 'fixed';
                button.style.left = newX + 'px';
                button.style.top = newY + 'px';
                button.style.transform = 'translate(0, 0)';

                clickCount++;

                // Adicionar um efeito visual
                button.style.animation = 'none';
                setTimeout(() => {
                    button.style.animation = 'shake 0.3s';
                }, 10);

                // Criar explosão de corações
                for (let i = 0; i < 10; i++) {
                    const heart = document.createElement('div');
                    heart.innerHTML = '💕';
                    heart.style.position = 'fixed';
                    heart.style.left = (newX + 50) + 'px';
                    heart.style.top = (newY + 25) + 'px';
                    heart.style.fontSize = '1.5rem';
                    heart.style.pointerEvents = 'none';
                    heart.style.animation = 'fallHearts 2s ease-in forwards';
                    heart.style.animationDelay = (i * 0.05) + 's';
                    heart.style.opacity = '1';
                    document.body.appendChild(heart);

                    setTimeout(() => heart.remove(), 2000);
                }
            } else {
                // Na quarta tentativa, o botão fica clicável
                button.onclick = handleButtonClick;
                button.style.cursor = 'pointer';
                button.style.animation = 'pulse 1s ease-in-out infinite';
            }
        }

        function handleButtonClick() {
            createConfetti();
            // Redirecionar após animação
            setTimeout(() => {
                window.location.href = 'carta.php';
            }, 800);
        }

        // Event listeners
        button.addEventListener('mouseover', moveButton);
        button.addEventListener('click', function(e) {
            if (clickCount < maxFlees) {
                e.preventDefault();
                return false;
            }
        });

        // Adicionar animação shake
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translate(0, 0) scale(1); }
                25% { transform: translate(-5px, -5px) scale(1.05); }
                50% { transform: translate(5px, 5px) scale(1); }
                75% { transform: translate(-5px, 5px) scale(1.05); }
            }
            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.1); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
