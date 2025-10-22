<?php
/**
 * 💕 PÁGINA FINAL - SISTEMA ELISA
 * "você será sempre a minha garotinha ❤️"
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
    <title>💕 Fim da Jornada - Elisa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Georgia', serif;
            background: linear-gradient(135deg, #1a0033 0%, #330066 50%, #1a0033 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Fundo animado com brilhos */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 50%, rgba(255, 192, 203, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 80% 80%, rgba(255, 20, 147, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 50% 0%, rgba(255, 105, 180, 0.05) 0%, transparent 50%);
            animation: gradientShift 8s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes gradientShift {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            50% {
                transform: translate(20px, 20px) scale(1.05);
            }
        }

        .container {
            position: relative;
            z-index: 10;
            text-align: center;
            width: 100%;
            max-width: 900px;
            padding: 2rem;
        }

        .main-text {
            font-size: 3.5rem;
            font-weight: bold;
            color: white;
            text-shadow: 
                0 0 20px rgba(255, 20, 147, 0.8),
                0 0 40px rgba(255, 20, 147, 0.5),
                0 0 60px rgba(255, 105, 180, 0.3);
            letter-spacing: 2px;
            word-spacing: 0.2em;
            line-height: 1.4;
            animation: textGlow 2s ease-in-out infinite, textFloat 4s ease-in-out infinite;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 700;
        }

        @keyframes textGlow {
            0%, 100% {
                text-shadow: 
                    0 0 20px rgba(255, 20, 147, 0.8),
                    0 0 40px rgba(255, 20, 147, 0.5),
                    0 0 60px rgba(255, 105, 180, 0.3);
            }
            50% {
                text-shadow: 
                    0 0 30px rgba(255, 20, 147, 1),
                    0 0 60px rgba(255, 20, 147, 0.8),
                    0 0 90px rgba(255, 105, 180, 0.5);
            }
        }

        @keyframes textFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .heart-icon {
            display: inline-block;
            font-size: 1em;
            margin-left: 0.2em;
            animation: heartBeat 1.2s ease-in-out infinite;
        }

        @keyframes heartBeat {
            0% { transform: scale(1) rotate(0deg); }
            25% { transform: scale(1.3) rotate(-10deg); }
            50% { transform: scale(1) rotate(0deg); }
            75% { transform: scale(1.3) rotate(10deg); }
            100% { transform: scale(1) rotate(0deg); }
        }

        /* Efeitos de partículas ao redor do texto */
        .particle-ring {
            position: absolute;
            width: 600px;
            height: 600px;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 10px;
            height: 10px;
            left: 50%;
            top: 50%;
            pointer-events: none;
        }

        .particle::before {
            content: '❤️';
            position: absolute;
            font-size: 1.5rem;
            animation: orbitParticle 8s linear infinite;
        }

        @keyframes orbitParticle {
            0% {
                transform: rotate(0deg) translateX(300px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: rotate(360deg) translateX(300px) rotate(-360deg);
                opacity: 0.3;
            }
        }

        .particle:nth-child(1)::before { animation-delay: 0s; }
        .particle:nth-child(2)::before { animation-delay: 1s; }
        .particle:nth-child(3)::before { animation-delay: 2s; }
        .particle:nth-child(4)::before { animation-delay: 3s; }
        .particle:nth-child(5)::before { animation-delay: 4s; }
        .particle:nth-child(6)::before { animation-delay: 5s; }
        .particle:nth-child(7)::before { animation-delay: 6s; }
        .particle:nth-child(8)::before { animation-delay: 7s; }

        /* Flocos de neve/brilhos caindo */
        .snowflake {
            position: fixed;
            top: -10px;
            z-index: 1;
            user-select: none;
            cursor: default;
            animation: snowfall linear infinite;
            pointer-events: none;
        }

        @keyframes snowfall {
            to {
                transform: translateY(100vh) rotate(360deg);
            }
        }

        /* Fuegos artificiales */
        .firework {
            position: fixed;
            pointer-events: none;
            animation: explode 2s ease-out forwards;
        }

        @keyframes explode {
            0% {
                transform: translate(0, 0) scale(1);
                opacity: 1;
            }
            100% {
                transform: translate(var(--tx), var(--ty)) scale(0);
                opacity: 0;
            }
        }

        /* Ondas de luz */
        .wave {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        .wave-circle {
            position: absolute;
            width: 100px;
            height: 100px;
            border: 2px solid rgba(255, 192, 203, 0.5);
            border-radius: 50%;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            animation: waveExpand 2s ease-out infinite;
        }

        @keyframes waveExpand {
            from {
                width: 0;
                height: 0;
                opacity: 1;
            }
            to {
                width: 500px;
                height: 500px;
                opacity: 0;
            }
        }

        .wave-circle:nth-child(1) { animation-delay: 0s; }
        .wave-circle:nth-child(2) { animation-delay: 0.5s; }
        .wave-circle:nth-child(3) { animation-delay: 1s; }

        /* Luzes de fundo */
        .glow-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.3;
        }

        .glow-1 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, #ff69b4 0%, transparent 70%);
            top: -100px;
            left: -100px;
            animation: glowMove1 10s ease-in-out infinite;
        }

        .glow-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #ff1493 0%, transparent 70%);
            bottom: -150px;
            right: -150px;
            animation: glowMove2 15s ease-in-out infinite;
        }

        @keyframes glowMove1 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, 30px); }
        }

        @keyframes glowMove2 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-30px, -30px); }
        }

        /* Botão de saída (discreto) */
        .exit-btn {
            position: fixed;
            bottom: 2rem;
            left: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .exit-btn:hover {
            background: rgba(255, 20, 147, 0.2);
            border-color: rgba(255, 20, 147, 0.8);
            transform: scale(1.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-text {
                font-size: 2rem;
                letter-spacing: 1px;
            }

            .particle-ring {
                width: 300px;
                height: 300px;
            }

            .particle::before {
                font-size: 1rem;
                animation: orbitParticle 8s linear infinite;
            }

            @keyframes orbitParticle {
                0% {
                    transform: rotate(0deg) translateX(150px) rotate(0deg);
                    opacity: 1;
                }
                100% {
                    transform: rotate(360deg) translateX(150px) rotate(-360deg);
                    opacity: 0.3;
                }
            }
        }

        @media (max-width: 480px) {
            .main-text {
                font-size: 1.5rem;
                letter-spacing: 0.5px;
            }

            .exit-btn {
                width: 40px;
                height: 40px;
                bottom: 1rem;
                left: 1rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Glows de fundo -->
    <div class="glow-circle glow-1"></div>
    <div class="glow-circle glow-2"></div>

    <!-- Ondas de luz -->
    <div class="wave">
        <div class="wave-circle"></div>
        <div class="wave-circle"></div>
        <div class="wave-circle"></div>
    </div>

    <!-- Partículas em órbita -->
    <div class="particle-ring" id="particleRing"></div>

    <!-- Conteúdo principal -->
    <div class="container">
        <h1 class="main-text">
            você será sempre a minha<br>
            <span style="background: linear-gradient(135deg, #ff69b4 0%, #ff1493 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                garotinha
            </span>
            <span class="heart-icon">❤️</span>
        </h1>
    </div>

    <!-- Botão de saída -->
    <button class="exit-btn" onclick="sair()" title="Voltar">
        <i class="fas fa-home"></i>
    </button>

    <script>
        // Criar partículas em órbita
        function criarParticulasOrbita() {
            const ring = document.getElementById('particleRing');
            for (let i = 0; i < 8; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.setProperty('--delay', i * 0.5 + 's');
                ring.appendChild(particle);
            }
        }

        // Criar flocos de neve/brilhos caindo
        function criarSnowflake() {
            const snowflake = document.createElement('div');
            snowflake.className = 'snowflake';
            snowflake.innerHTML = ['❄️', '✨', '💫', '⭐'][Math.floor(Math.random() * 4)];
            snowflake.style.left = Math.random() * window.innerWidth + 'px';
            snowflake.style.fontSize = (Math.random() * 20 + 15) + 'px';
            snowflake.style.animationDuration = (Math.random() * 15 + 10) + 's';
            snowflake.style.opacity = Math.random() * 0.5 + 0.2;
            document.body.appendChild(snowflake);

            setTimeout(() => snowflake.remove(), 30000);
        }

        // Criar fogos de artifício
        function criarFogos(x, y) {
            for (let i = 0; i < 30; i++) {
                const firework = document.createElement('div');
                firework.className = 'firework';
                firework.innerHTML = ['❤️', '💕', '💖', '💗', '✨'][Math.floor(Math.random() * 5)];
                firework.style.left = x + 'px';
                firework.style.top = y + 'px';
                firework.style.fontSize = (Math.random() * 20 + 10) + 'px';

                // Calcular trajetória aleatória
                const angle = (Math.PI * 2 * i) / 30;
                const velocity = Math.random() * 200 + 100;
                const tx = Math.cos(angle) * velocity;
                const ty = Math.sin(angle) * velocity - 100;

                firework.style.setProperty('--tx', tx + 'px');
                firework.style.setProperty('--ty', ty + 'px');

                document.body.appendChild(firework);
                setTimeout(() => firework.remove(), 2000);
            }
        }

        // Efeito de clique para fogos de artifício
        document.addEventListener('click', function(e) {
            criarFogos(e.clientX, e.clientY);
        });

        // Criar fogos ao mover o mouse
        let lastFireworkTime = 0;
        document.addEventListener('mousemove', function(e) {
            const now = Date.now();
            if (now - lastFireworkTime > 300) {
                if (Math.random() > 0.8) {
                    criarFogos(e.clientX, e.clientY);
                    lastFireworkTime = now;
                }
            }
        });

        // Função para sair
        function sair() {
            window.location.href = 'index.php';
        }

        // Inicializar
        window.addEventListener('load', () => {
            criarParticulasOrbita();

            // Criar flocos continuamente
            setInterval(criarSnowflake, 500);

            // Criar alguns fogos iniciais
            setTimeout(() => {
                for (let i = 0; i < 5; i++) {
                    setTimeout(() => {
                        criarFogos(
                            window.innerWidth / 2 + (Math.random() - 0.5) * 200,
                            window.innerHeight / 2 + (Math.random() - 0.5) * 200
                        );
                    }, i * 300);
                }
            }, 500);
        });

        // Animação de pulsação no mobile
        const mainText = document.querySelector('.main-text');
        if (window.innerWidth < 768) {
            mainText.style.animation = 'textGlow 1.5s ease-in-out infinite, textFloat 2s ease-in-out infinite';
        }
    </script>
</body>
</html>
