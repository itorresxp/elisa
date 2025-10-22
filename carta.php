<?php
/**
 * 💕 PÁGINA DA CARTA ROMÂNTICA - SISTEMA ELISA
 * Carta com design romântico e efeitos especiais
 * Texto personalizável
 */

session_start();

if (!isset($_SESSION['usuario_autenticado'])) {
    header('Location: index.php');
    exit;
}

// Texto da carta (pode ser personalizado)
$cartaTexto = "Meu amor,

Não tenho palavras para descrever o quanto você é importante na minha vida. Eu sei que às vezes não sou o melhor namorado/noivo, mas quero sempre melhorar por você e para você.

Quando penso em você, meu coração já fica quentinho, porque ele queima de amor por você. Você é uma pessoa brilhante em cada coisa que faz, você sempre faz o certo e isso me impressiona demais.

Em hipótese alguma você deixa de pensar nas pessoas ao seu redor, e acho isso muito bonito em você. Quero te dizer que você é um orgulho para mim. Suas vitórias são as minhas, e as minhas são as suas, sempre.

Desejo que você seja abençoada e que sempre seja guardada por Deus. Te desejo muitos anos de vida e que você consiga aprender muitas coisas nesse novo ano da sua vida.

Eu te amo além dessa vida. Obrigado por fazer tanto por mim, mesmo com dificuldades, e peço que me desculpe pelos meus erros.

Quero te amar para sempre.";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>💌 Uma Carta Especial - Elisa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', serif;
            background: linear-gradient(135deg, #1a0033 0%, #330066 50%, #1a0033 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            padding: 2rem;
        }

        .container {
            max-width: 700px;
            width: 100%;
        }

        .letter-container {
            perspective: 1000px;
            animation: letterAppear 1s ease-out;
        }

        @keyframes letterAppear {
            from {
                opacity: 0;
                transform: rotateX(20deg) translateZ(-100px);
            }
            to {
                opacity: 1;
                transform: rotateX(0) translateZ(0);
            }
        }

        .letter {
            background: linear-gradient(135deg, #fffaf0 0%, #fff5ee 100%);
            padding: 3rem 2.5rem;
            border-radius: 5px;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.5),
                inset 0 0 0 1px rgba(255, 192, 203, 0.5),
                0 0 100px rgba(255, 192, 203, 0.1);
            position: relative;
            overflow: hidden;
            border: 2px solid #ffe6f0;
        }

        /* Efeito de papel envelhecido */
        .letter::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(255, 182, 193, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 192, 203, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Brilho decorativo */
        .letter::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shine 3s infinite;
            pointer-events: none;
        }

        @keyframes shine {
            0% { left: -100%; }
            50% { left: 100%; }
            100% { left: 100%; }
        }

        .letter-content {
            position: relative;
            z-index: 1;
            animation: fadeIn 1.5s ease-out 0.3s both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .letter-header {
            text-align: center;
            margin-bottom: 2rem;
            border-bottom: 2px solid #ffb6c1;
            padding-bottom: 1.5rem;
        }

        .hearts-decoration {
            font-size: 1.5rem;
            letter-spacing: 0.5rem;
            margin-bottom: 0.5rem;
            animation: heartBeat 1.5s ease-in-out infinite;
        }

        @keyframes heartBeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        h1 {
            color: #c71585;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(199, 21, 133, 0.1);
        }

        .letter-text {
            color: #333;
            font-size: 1.05rem;
            line-height: 1.8;
            text-align: justify;
            white-space: pre-wrap;
            word-wrap: break-word;
            margin-bottom: 2rem;
            font-style: italic;
            color: #2c2c2c;
        }

        .letter-text p {
            margin-bottom: 1rem;
        }

        .signature {
            text-align: right;
            font-family: 'Brush Script MT', cursive;
            font-size: 1.5rem;
            color: #c71585;
            margin-top: 2rem;
        }

        /* Decorações ao redor da carta */
        .floating-hearts {
            position: absolute;
            font-size: 2rem;
            opacity: 0.3;
            animation: floatHearts 6s ease-in-out infinite;
        }

        .heart-1 { top: 20px; left: 20px; animation-delay: 0s; }
        .heart-2 { top: 30px; right: 30px; animation-delay: 1s; }
        .heart-3 { bottom: 40px; left: 40px; animation-delay: 2s; }
        .heart-4 { bottom: 50px; right: 50px; animation-delay: 3s; }

        @keyframes floatHearts {
            0%, 100% { transform: translateY(0) rotateZ(0deg); }
            50% { transform: translateY(-20px) rotateZ(5deg); }
        }

        .button-container {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            justify-content: center;
        }

        .btn {
            padding: 1rem 2rem;
            border: 2px solid #ff1493;
            background: linear-gradient(135deg, #ff69b4 0%, #ff1493 100%);
            color: white;
            border-radius: 15px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(255, 20, 147, 0.3);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 20, 147, 0.5);
        }

        .btn:active {
            transform: translateY(-1px);
        }

        .btn-finished {
            background: linear-gradient(135deg, #ff69b4 0%, #ff1493 100%);
        }

        .btn-continue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }

        /* Modal para customizar texto */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            animation: fadeInModal 0.3s ease;
        }

        @keyframes fadeInModal {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            max-width: 600px;
            width: 90%;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-content h2 {
            color: #c71585;
            margin-bottom: 1rem;
        }

        .modal-content textarea {
            width: 100%;
            min-height: 200px;
            padding: 1rem;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-family: Georgia, serif;
            font-size: 0.95rem;
            resize: vertical;
        }

        .modal-content textarea:focus {
            outline: none;
            border-color: #ff1493;
            box-shadow: 0 0 0 3px rgba(255, 20, 147, 0.1);
        }

        .modal-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .modal-buttons button {
            flex: 1;
            padding: 0.75rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
        }

        .modal-buttons .btn-save {
            background: #ff1493;
            color: white;
        }

        .modal-buttons .btn-cancel {
            background: #eee;
            color: #333;
        }

        .particle {
            position: fixed;
            pointer-events: none;
            animation: particleFloat 4s ease-in forwards;
        }

        @keyframes particleFloat {
            to {
                transform: translateY(-100px) translateX(100px);
                opacity: 0;
            }
        }

        @media (max-width: 600px) {
            .letter {
                padding: 2rem 1.5rem;
            }

            h1 {
                font-size: 1.4rem;
            }

            .letter-text {
                font-size: 0.95rem;
                line-height: 1.6;
            }

            .floating-hearts {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="letter-container">
            <div class="letter">
                <!-- Decorações flutuantes -->
                <div class="floating-hearts heart-1">❤️</div>
                <div class="floating-hearts heart-2">💕</div>
                <div class="floating-hearts heart-3">💖</div>
                <div class="floating-hearts heart-4">💗</div>

                <div class="letter-content">
                    <div class="letter-header">
                        <div class="hearts-decoration">✨ 💌 ✨</div>
                        <h1>Uma Carta Especial</h1>
                        <p style="color: #c71585; font-style: italic;">Para você, Elisa</p>
                    </div>

                    <div class="letter-text">
                        <?php echo htmlspecialchars($cartaTexto); ?>
                    </div>

                    <div class="signature">
                        Com amor, Ianzinho ❤️
                    </div>
                </div>
            </div>
        </div>

        <div class="button-container">
            <button class="btn btn-finished" onclick="finalizarLeitura()">
                <i class="fas fa-heart" style="margin-right: 0.5rem;"></i>
                Acabei de ler!
            </button>
        </div>
    </div>

    <script>
        function createFloatingParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.innerHTML = ['❤️', '💕', '✨', '💖'][Math.floor(Math.random() * 4)];
            particle.style.left = Math.random() * 100 + 'vw';
            particle.style.top = Math.random() * 100 + 'vh';
            particle.style.fontSize = (Math.random() * 20 + 20) + 'px';
            particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
            document.body.appendChild(particle);

            setTimeout(() => particle.remove(), 4000);
        }

        function finalizarLeitura() {
            // Criar explosão de corações
            for (let i = 0; i < 50; i++) {
                setTimeout(createFloatingParticle, i * 50);
            }

            // Redirecionar após animação
            setTimeout(() => {
                window.location.href = 'galeria.php';
            }, 1500);
        }

        // Criar algumas partículas ao carregar
        window.addEventListener('load', () => {
            for (let i = 0; i < 5; i++) {
                setTimeout(createFloatingParticle, i * 300);
            }
        });

        // Adicionar efeito de digitação ao carregar
        const letterText = document.querySelector('.letter-text');
        const originalText = letterText.innerHTML;
        letterText.innerHTML = '';

        let index = 0;
        function typeText() {
            if (index < originalText.length) {
                letterText.innerHTML += originalText.charAt(index);
                index++;
                setTimeout(typeText, 20);
            }
        }

        window.addEventListener('load', () => {
            setTimeout(typeText, 500);
        });
    </script>
</body>
</html>
