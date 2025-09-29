document.addEventListener("DOMContentLoaded", () => {
    const profileButton = document.querySelector('.profile');
    const profileMenu = document.querySelector('.profile-menu');

    profileButton.addEventListener('click', (e) => {
        e.stopPropagation();
        profileMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        const isClickInsideMenu = profileMenu.contains(e.target);
        const isClickOnButton = profileButton.contains(e.target);

        if (!isClickInsideMenu && !isClickOnButton) {
            profileMenu.classList.add('hidden');
        }
    });
});