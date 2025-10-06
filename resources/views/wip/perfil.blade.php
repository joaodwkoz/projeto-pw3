<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="{{ url('css/perfil.css') }}" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <h1>Popcorn</h1>
        <ul>
            <li>Home</li>
            <li>Explorer</li>
            <li>Favorites</li>
            <li>Perfil</li>
            <li>Configurações</li>
        </ul>
    </div>
    
    <div class="main-content">
        <div class="profile-header">
            <div class="profile-pic">JP</div>
            <div class="profile-info">
                <h2>João Pedro</h2>
            </div>
        </div>
        
        <div class="section">
            <h3>Minha lista</h3>

            <div class="movie-list">
                <div class="movie-card">
                    <div class="movie-poster">Poster 1</div>
                </div>
                <div class="movie-card">
                    <div class="movie-poster">Poster 2</div>
                </div>
                <div class="movie-card">
                    <div class="movie-poster">Poster 3</div>
                </div>
                <div class="movie-card">
                    <div class="movie-poster">Poster 4</div>
                </div>
            </div>
        </div>
        
        
        <div class="section">
            <h3>Já assistidos</h3>
            <div class="movie-list">
                <div class="movie-card">
                    <div class="movie-poster">Poster A</div>
                </div>
                <div class="movie-card">
                    <div class="movie-poster">Poster B</div>
                </div>
                <div class="movie-card">
                    <div class="movie-poster">Poster C</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 