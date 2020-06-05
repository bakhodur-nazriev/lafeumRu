function search(parentSelector, filter, ignoreSelector = '') {
    let upperFilter = filter.toLowerCase();

    let wrapper = document.querySelector(parentSelector);
    
    let ignoredCount = 0;
    
    if(ignoreSelector){
        ignoredCount = wrapper.querySelectorAll(ignoreSelector).length;
    }

    let elements = wrapper.cloneNode(true).children;

    wrapper.textContent = "";

    let foundCount = 0;

    for (let i = 0; i < elements.length; i++) {
        if(ignoreSelector && elements[i].matches(ignoreSelector)){
            continue;
        }

        let elementContent = elements[i].innerText || elements[i].textContent;

        let elementContainsFilter =
            elementContent
                .toLowerCase()
                .indexOf(upperFilter) > -1;

        if (elementContainsFilter) {
            elements[i].style.display = "";
            foundCount++;
        } else {
            elements[i].style.display = "none";
        }
    }

    let ignoreExcludedLength = elements.length - ignoredCount;

    if(foundCount === ignoreExcludedLength){
        foundCount = null;
    }

    wrapper.append(...elements);

    return foundCount;
}

function attachSearch(inputSelector, elementsWrapperSelector, searchResultSelector, ignoreSelector = '') {

    $(inputSelector).keyup((e) => {
        let foundCount = search(elementsWrapperSelector, e.target.value, ignoreSelector);

        attachSummaryModals();

        let elementToShowResult = document.querySelector(searchResultSelector);

        if(!elementToShowResult) return;
        
        if(foundCount === null){
            elementToShowResult.textContent = '';
        
        } else if(foundCount > 0) {
            elementToShowResult.textContent = `Обнаружено ${foundCount} совпадений`;

        } else {
            elementToShowResult.textContent = `По вашему запросу ничего не обнаружено`;
        }
    });
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
