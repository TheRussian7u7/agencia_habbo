<?php
require_once('../private/plantillas/header.php');
require_once('../private/procesos/db.php');

// Asegurarse de que la sesión no esté activa antes de iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Asegurarse de que el usuario esté autenticado
if (!isset($_SESSION['usuario_registro'])) {
    // Si no hay sesión activa, redirigir al usuario al login
    header('Location: ../public/login.php');
    exit();
}

// Obtener el nombre de usuario de la sesión
$username = $_SESSION['usuario_registro'];

?>

<body class="bg-theme bg-theme1">
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">

            <!-- Reproductor de Música -->
           <div class="neon-card container p-4">
    <h3 class="text-center">Buscador de Música</h3>
    <hr>
    <div class="form-group">
        <input type="text" id="searchQuery" class="form-control mb-2" placeholder="Buscar música...">
        <button id="searchButton" class="neon-button btn w-100">Buscar</button>
    </div>
    <div id="player" class="mt-3" style="display: none;">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe id="ytplayer" class="embed-responsive-item" src="" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <ul id="results" class="list-group mt-3"></ul>
</div>

            <!-- Chat en Vivo -->
            <div class="card mt-5">
                <div class="card-body">
                    <h3>Chat en Vivo</h3>
                    <hr>
                    <div id="chatBox" class="border p-3 mb-3" style="height: 400px; overflow-y: scroll;">
                        <!-- Aquí se mostrarán los mensajes del chat -->
                    </div>
                    <form id="chatForm">
                        <input type="hidden" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="chatMessage" name="chatMessage" placeholder="Escribe tu mensaje..." required>
                        </div>
                        <div class="form-group">
                            <label for="bgColor">Elige el color de fondo de tu mensaje:</label>
                            <input type="color" class="form-control" id="bgColor" name="bgColor" value="<?php echo htmlspecialchars($_SESSION['bg_color']); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>

            <!-- Aquí va el resto de tu contenido -->
            <!-- ... -->

            <?php require_once('../private/plantillas/footer.php'); ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuración del chat
            const chatForm = document.getElementById('chatForm');
            const chatBox = document.getElementById('chatBox');

            function loadChatMessages() {
                fetch('../private/load_chat.php')
                    .then(response => response.text())
                    .then(data => {
                        chatBox.innerHTML = data;
                        chatBox.scrollTop = chatBox.scrollHeight; // Scroll automático al final
                    });
            }

            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(chatForm);
                fetch('../private/process_chat.php', {
                    method: 'POST',
                    body: formData
                }).then(() => {
                    chatForm.reset();
                    document.getElementById('bgColor').value = "<?php echo htmlspecialchars($_SESSION['bg_color']); ?>";
                    loadChatMessages();
                });
            });

            document.getElementById('bgColor').addEventListener('change', function() {
                fetch('../private/update_bg_color.php', {
                    method: 'POST',
                    body: new URLSearchParams('bgColor=' + this.value)
                });
            });

            setInterval(loadChatMessages, 5000);
            loadChatMessages();

            // Configuración del reproductor de música
            const API_KEY = 'AIzaSyAHQnmcsuIwmnIiOpxvzbglAPO5-GevB7k';  // Reemplaza con tu clave de API de YouTube

            document.getElementById('searchButton').addEventListener('click', function() {
                const query = document.getElementById('searchQuery').value;
                searchYouTube(query);
            });

            function searchYouTube(query) {
                fetch(`https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=5&q=${query}&key=${API_KEY}`)
                    .then(response => response.json())
                    .then(data => {
                        const results = document.getElementById('results');
                        results.innerHTML = '';
                        data.items.forEach(item => {
                            const li = document.createElement('li');
                            li.classList.add('list-group-item');
                            li.textContent = item.snippet.title;
                            li.setAttribute('data-video-id', item.id.videoId);
                            li.addEventListener('click', function() {
                                playVideo(item.id.videoId);
                            });
                            results.appendChild(li);
                        });
                    });
            }

            function playVideo(videoId) {
                const player = document.getElementById('player');
                const ytplayer = document.getElementById('ytplayer');
                ytplayer.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&enablejsapi=1`;
                player.style.display = 'block';
            }
        });
    </script>
</body>