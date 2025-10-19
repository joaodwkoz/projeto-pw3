document.addEventListener("DOMContentLoaded", () => {
    const app = document.getElementById('app');

    const moviesGrid = document.querySelector('.movies-scroll-list.recommended');
    const genreButtons = document.querySelectorAll('.genres .genre');

    const apiUrl = app.dataset.apiUrl;
    const storageUrl = app.dataset.storageUrl;
    const filmesShowUrlBase = document.querySelector('main').dataset.filmeShowUrlBase;

    const loadMovies = async (id) => {
        const url = `${apiUrl}/${id}`;
        const response = await fetch(url);
        const movies = await response.json();

        moviesGrid.innerHTML = '';

        movies.forEach(movie => {
            moviesGrid.appendChild(createMovieCard(movie));
        });
    };

    genreButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;

            genreButtons.forEach(btn => btn.classList.remove('active'));

            button.classList.add('active');

            loadMovies(id);
        });
    });

    const firstButton = genreButtons[0];
    
    firstButton.classList.add('active');

    loadMovies(firstButton.dataset.id);

    function createMovieCard(filme) {
        const movie = document.createElement('a');
        movie.className = 'movie';
        movie.href = `${filmesShowUrlBase}${filme.id}`;

        movie.innerHTML = `
            <div class="movie-poster">
                <img src="${storageUrl}/${filme.capa}" alt="${filme.nome}">
            </div>
            <div class="movie-rating-badge">
                <span class="movie-rating-num">${Math.round(filme.avaliacoes_avg_nota) || 0}</span>
                <div class="movie-rating-stars">
                    <img src="/imgs/side-reviews.png" alt="">
                </div>
            </div>
        `;

        return movie;
    }
});
