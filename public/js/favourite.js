function toggleFavourite(id, model, onSuccess = null, onFailure = null) {
    $.ajax({
        url: '/toggle-favourite',
        method: 'PUT',
        data: {
            "_token": window.Laravel.csrf_token,
            favouritable: model,
            id: id
        }
    }).then(onSuccess).catch(onFailure);
}

$(document).ready(() => {
    $('.favourite-quote-btn').click(e => {
        let button = e.target;
        let id = button.dataset.id;

        toggleFavourite(id, "App\\Quote", (isFavourite) => {
            button.classList.toggle('fa-star-active', isFavourite);
        });
    });

    $('.favourite-term-btn').click(e => {
        let button = e.target;
        let id = button.dataset.id;

        toggleFavourite(id, "App\\Term", (isFavourite) => {
            button.classList.toggle('fa-star-active', isFavourite);
        });
    });

    $('.favourite-video-btn').click(e => {
        let button = e.target;
        let id = button.dataset.id;

        toggleFavourite(id, "App\\Video", (isFavourite) => {
            button.classList.toggle('fa-star-active', isFavourite);
        });
    });
});
