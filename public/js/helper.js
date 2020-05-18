function search(parentSelector, filter) {
    let upperFilter = filter.toLowerCase();

    let wrapper = document.querySelector(parentSelector);
    let elements = wrapper.cloneNode(true).children;

    wrapper.textContent = "";

    for (let i = 0; i < elements.length; i++) {
        let elementContent = elements[i].innerText || elements[i].textContent;

        let elementContainsFilter =
            elementContent
                .toLowerCase()
                .indexOf(upperFilter) > -1;

        if (elementContainsFilter) {
            elements[i].style.display = "";
        } else {
            elements[i].style.display = "none";
        }
    }

    wrapper.append(...elements);
}

jQuery(document).ready(function() {
    let btn = $('.btnScrollToTop');
    $(window).scroll(function() {
        if ($(window).scrollTop() > 800) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });
});
