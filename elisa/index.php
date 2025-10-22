<?php
/**
 * 💕 SISTEMA ELISA - LOGIN COM CHAVE
 * Chave de acesso: elisa
 */

session_start();

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chave = trim($_POST['chave'] ?? '');
    
    // Validar chave
    if ($chave === 'elisa') {
        $_SESSION['usuario_autenticado'] = true;
        $_SESSION['hora_login'] = date('Y-m-d H:i:s');
        header('Location: notificacao.php');
        exit;
    } else {
        $erro = 'Chave de acesso inválida!';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>💕 Elisa - Sistema Especial</title>
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
            position: relative;
        }

        /* Fundo animado com corações */
        body::before {
            content: '❤️ ❤️ ❤️ ❤️ ❤️ ❤️ ❤️ ❤️ ❤️ ❤️ ❤️ ❤️ ❤️ ❤️ ❤️';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            font-size: 3rem;
            opacity: 0.05;
            pointer-events: none;
            overflow: hidden;
            white-space: pre-wrap;
            z-index: 0;
        }

        /* Partículas flutuantes */
        .particles {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 192, 203, 0.5);
            border-radius: 50%;
            animation: float 20s infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100vh) translateX(50px); opacity: 0; }
        }

        .container {
            z-index: 1;
            perspective: 1000px;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3), 0 0 100px rgba(255, 192, 203, 0.2);
            width: 100%;
            max-width: 420px;
            animation: slideInUp 0.8s ease-out;
            border: 1px solid rgba(255, 192, 203, 0.3);
            backdrop-filter: blur(10px);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
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

        .subtitle {
            color: #999;
            font-size: 0.9rem;
            font-style: italic;
        }

        .form-group {
            margin-bottom: 1.5rem;
            animation: slideInLeft 0.8s ease-out 0.1s both;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-group:nth-child(2) {
            animation-delay: 0.2s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.3s;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #1a0033;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .input-wrapper {
            position: relative;
            overflow: hidden;
        }

        .input-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 192, 203, 0.2), transparent);
            transition: left 0.5s;
            z-index: 1;
            pointer-events: none;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #ff1493;
            box-shadow: 0 0 0 3px rgba(255, 20, 147, 0.1);
            transform: translateY(-2px);
        }

        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            color: #ccc;
        }

        .icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #ff1493;
            z-index: 3;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border-left: 4px solid #c33;
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #ff69b4 0%, #ff1493 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(255, 20, 147, 0.3);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 20, 147, 0.4);
        }

        .btn:active {
            transform: translateY(-1px);
        }

        .info-text {
            text-align: center;
            color: #999;
            font-size: 0.85rem;
            margin-top: 1.5rem;
        }

        .info-text strong {
            color: #1a0033;
        }

        /* Flocos de neve rosa animados */
        .snowflake {
            position: fixed;
            top: -10px;
            z-index: 0;
            user-select: none;
            cursor: default;
            animation: snowfall linear infinite;
            opacity: 0.5;
        }

        @keyframes snowfall {
            to {
                transform: translateY(100vh) translateX(200px);
            }
        }

        /* Efeito de brilho no input ao focar */
        .glow-effect {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(255, 192, 203, 0.2) 0%, transparent 70%);
            border-radius: 10px;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s;
        }

        input[type="text"]:focus ~ .glow-effect,
        input[type="password"]:focus ~ .glow-effect {
            opacity: 1;
        }

        @media (max-width: 480px) {
            .login-box {
                padding: 2rem 1.5rem;
                max-width: 90%;
            }

            h1 {
                font-size: 1.5rem;
            }

            .logo {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <!-- Partículas flutuantes -->
    <div class="particles" id="particles"></div>

    <div class="container">
        <div class="login-box">
            <div class="header">
                <div class="logo">💕</div>
                <h1>Bem-vinda, Elisa</h1>
                <p class="subtitle">Um lugar especial só para você</p>
            </div>

            <?php if ($erro): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($erro); ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="chave">
                        <i class="fas fa-lock" style="margin-right: 0.5rem; color: #ff1493;"></i>
                        Chave de Acesso
                    </label>
                    <div class="input-wrapper">
                        <input type="password" id="chave" name="chave" placeholder="Digite sua chave especial" required>
                        <span class="icon"><i class="fas fa-check-circle" style="display:none;"></i></span>
                    </div>
                </div>

                <button type="submit" class="btn">
                    <i class="fas fa-heart" style="margin-right: 0.5rem;"></i>
                    Entrar no Meu Mundo
                </button>
            </form>

            <div class="info-text">
                <p><strong>💡 Dica:</strong> Digite os dados especiais para acessar</p>
            </div>
        </div>
    </div>

    <script>
        // Criar partículas flutuantes
        const particlesContainer = document.getElementById('particles');
        for (let i = 0; i < 20; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 20 + 's';
            particle.style.animationDuration = (15 + Math.random() * 10) + 's';
            particlesContainer.appendChild(particle);
        }

        // Criar flocos de neve rosa
        function createSnowflake() {
            const snowflake = document.createElement('div');
            snowflake.className = 'snowflake';
            snowflake.innerHTML = '❄️';
            snowflake.style.left = Math.random() * window.innerWidth + 'px';
            snowflake.style.fontSize = (Math.random() * 10 + 10) + 'px';
            snowflake.style.animationDuration = (Math.random() * 10 + 10) + 's';
            document.body.appendChild(snowflake);

            setTimeout(() => {
                snowflake.remove();
            }, 20000);
        }

        setInterval(createSnowflake, 300);

        // Validação em tempo real
        const usuarioInput = document.getElementById('usuario');
        const chaveInput = document.getElementById('chave');

        [usuarioInput, chaveInput].forEach(input => {
            input.addEventListener('input', function() {
                const icon = this.parentElement.querySelector('.icon i');
                if (this.value) {
                    icon.style.display = 'inline';
                    icon.style.animation = 'pulse 0.5s';
                } else {
                    icon.style.display = 'none';
                }
            });
        });

        // Efeito de digitação
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const btn = this.querySelector('.btn');
            btn.style.transform = 'scale(0.98)';
            setTimeout(() => {
                btn.style.transform = 'scale(1)';
            }, 100);
        });
    </script>
</body>
</html>
