document.addEventListener("DOMContentLoaded", () => {
    const app = document.getElementById('app');

    const moviesGrid = document.querySelector('.movies');
    const genreButtons = document.querySelectorAll('.genres .genre');

    const apiUrl = app.dataset.apiUrl;
    const storageUrl = app.dataset.storageUrl;

    const loadMovies = async (id) => {
        const url = `${apiUrl}/${id}`;
        const response = await fetch(url);
        const movies = await response.json();

        moviesGrid.innerHTML = '';

        movies.forEach(movie => {
            const movieElement = document.createElement('div');

            movieElement.classList.add('movie');
            
            const imageUrl = `${storageUrl}/${movie.capa}`;
            
            movieElement.innerHTML = `<img src="${imageUrl}" alt="">`;

            moviesGrid.appendChild(movieElement);
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
});
