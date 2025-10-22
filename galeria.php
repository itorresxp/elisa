<?php
/**
 * 💕 GALERIA DE FOTOS - SISTEMA ELISA
 * Quadro com 7 fotos - Grid responsivo
 */

session_start();

if (!isset($_SESSION['usuario_autenticado'])) {
    header('Location: index.php');
    exit;
}

// FOTOS DA GALERIA - 7 fotos
$fotos = [
    ['src' => 'img/foto1.jfif', 'alt' => 'Momento 1'],
    ['src' => 'img/foto2.jfif', 'alt' => 'Momento 2'],
    ['src' => 'img/foto3.jfif', 'alt' => 'Momento 3'],
    ['src' => 'img/foto4.jfif', 'alt' => 'Momento 4'],
    ['src' => 'img/foto5.jfif', 'alt' => 'Momento 5'],
    ['src' => 'img/foto6.jfif', 'alt' => 'Momento 6'],
    ['src' => 'img/foto7.jfif', 'alt' => 'Momento 7']
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🖼️ Galeria de Momentos - Elisa</title>
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
            padding: 2rem;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
            animation: headerFadeIn 0.8s ease-out;
        }

        @keyframes headerFadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header h1 {
            color: white;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 20px rgba(255, 20, 147, 0.5);
        }

        .header p {
            color: #ffb6c1;
            font-size: 1.1rem;
            font-style: italic;
        }

        .frame {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4), 0 0 100px rgba(255, 20, 147, 0.2);
            margin-bottom: 2rem;
            border: 3px solid #ffe6f0;
            animation: frameAppear 0.8s ease-out 0.2s both;
        }

        @keyframes frameAppear {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .photo-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: photoSlideIn 0.6s ease-out both;
        }

        .photo-item:nth-child(1) { animation-delay: 0.1s; }
        .photo-item:nth-child(2) { animation-delay: 0.2s; }
        .photo-item:nth-child(3) { animation-delay: 0.3s; }
        .photo-item:nth-child(4) { animation-delay: 0.4s; }
        .photo-item:nth-child(5) { animation-delay: 0.5s; }
        .photo-item:nth-child(6) { animation-delay: 0.6s; }
        .photo-item:nth-child(7) { animation-delay: 0.7s; }
        .photo-item:nth-child(8) { animation-delay: 0.8s; }

        @keyframes photoSlideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .photo-item:hover {
            transform: scale(1.05) rotateZ(2deg);
            box-shadow: 0 15px 40px rgba(255, 20, 147, 0.3);
        }

        .photo-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .photo-item:hover img {
            transform: scale(1.1);
            filter: brightness(1.1);
        }

        .photo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 20, 147, 0.3) 0%, rgba(255, 105, 180, 0.3) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .photo-item:hover .photo-overlay {
            opacity: 1;
        }

        .photo-overlay-content {
            text-align: center;
            color: white;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .photo-overlay-content i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            animation: iconBounce 0.5s ease-in-out infinite;
        }

        @keyframes iconBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .photo-number {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 20, 147, 0.9);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            z-index: 2;
        }

        .button-container {
            text-align: center;
            margin-top: 2rem;
        }

        .btn {
            padding: 1.2rem 2.5rem;
            background: linear-gradient(135deg, #ff69b4 0%, #ff1493 100%);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(255, 20, 147, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 12px 35px rgba(255, 20, 147, 0.6);
        }

        .btn:active {
            transform: translateY(-2px);
        }

        /* Modal para visualizar foto em grande */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            position: relative;
            max-width: 90%;
            max-height: 90vh;
            animation: zoomIn 0.3s ease;
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-content img {
            width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .modal-close {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .modal-close:hover {
            transform: scale(1.2) rotate(90deg);
        }

        .floating-particles {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            font-size: 2rem;
            opacity: 0.3;
            animation: particleFloat 10s linear infinite;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.3;
            }
            90% {
                opacity: 0.3;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .frame {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="floating-particles" id="particles"></div>

    <div class="container">
        <div class="header">
            <h1>🖼️ Galeria de Momentos Especiais</h1>
            <p>Cada foto é uma memória preciosa ao seu lado</p>
        </div>

        <div class="frame">
            <div class="gallery-grid">
                <?php foreach ($fotos as $index => $foto): ?>
                    <div class="photo-item" onclick="abrirFoto(<?php echo $index; ?>)">
                        <img src="<?php echo $foto['src']; ?>" alt="<?php echo $foto['alt']; ?>" onerror="this.src='https://via.placeholder.com/400x400/ff69b4/ffffff?text=Foto+<?php echo ($index + 1); ?>'">
                        <div class="photo-overlay">
                            <div class="photo-overlay-content">
                                <i class="fas fa-search-plus"></i>
                                <p>Clique para ampliar</p>
                            </div>
                        </div>
                        <div class="photo-number"><?php echo $index + 1; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="button-container">
            <button class="btn" onclick="proximaPagina()">
                <i class="fas fa-heart"></i>
                Achei lindo! Quero continuar
            </button>
        </div>
    </div>

    <!-- Modal para ampliar foto -->
    <div class="modal" id="photoModal">
        <div class="modal-content">
            <span class="modal-close" onclick="fecharModal()">✕</span>
            <img id="modalImage" src="" alt="">
        </div>
    </div>

    <script>
        const fotos = <?php echo json_encode($fotos); ?>;

        // Criar partículas flutuantes
        function criarParticulas() {
            const container = document.getElementById('particles');
            const particulas = ['❤️', '💕', '✨', '💖', '💗'];

            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.innerHTML = particulas[Math.floor(Math.random() * particulas.length)];
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                particle.style.animationDelay = Math.random() * 2 + 's';
                container.appendChild(particle);
            }
        }

        function abrirFoto(index) {
            const modal = document.getElementById('photoModal');
            const img = document.getElementById('modalImage');
            const fotos = <?php echo json_encode($fotos); ?>;
            
            img.src = fotos[index].src;
            img.onerror = function() {
                this.src = 'https://via.placeholder.com/800x800/ff69b4/ffffff?text=Foto+' + (index + 1);
            };
            modal.classList.add('active');
        }

        function fecharModal() {
            const modal = document.getElementById('photoModal');
            modal.classList.remove('active');
        }

        function proximaPagina() {
            // Criar explosão de corações
            for (let i = 0; i < 100; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.innerHTML = ['❤️', '💕', '✨', '💖'][Math.floor(Math.random() * 4)];
                particle.style.left = Math.random() * 100 + 'vw';
                particle.style.top = Math.random() * 100 + 'vh';
                particle.style.fontSize = (Math.random() * 30 + 20) + 'px';
                particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
                document.body.appendChild(particle);

                setTimeout(() => particle.remove(), 4000);
            }

            setTimeout(() => {
                window.location.href = 'final.php';
            }, 1000);
        }

        // Fechar modal ao clicar fora
        document.getElementById('photoModal').addEventListener('click', function(e) {
            if (e.target === this) {
                fecharModal();
            }
        });

        // Criar partículas ao carregar
        window.addEventListener('load', criarParticulas);

        // Adicionar efeito ao texto "Achei lindo"
        const btn = document.querySelector('.btn');
        btn.addEventListener('mouseover', function() {
            for (let i = 0; i < 10; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.innerHTML = '💕';
                particle.style.left = this.offsetLeft + Math.random() * this.offsetWidth + 'px';
                particle.style.top = this.offsetTop + Math.random() * this.offsetHeight + 'px';
                particle.style.animationDuration = (Math.random() * 2 + 1) + 's';
                document.body.appendChild(particle);

                setTimeout(() => particle.remove(), 3000);
            }
        });
    </script>
</body>
</html>
