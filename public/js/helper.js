function search(parentSelector, filter) {
    let upperFilter = filter.toLowerCase();

    let wrapper = document.querySelector(parentSelector);
    let elements = wrapper.cloneNode(true).children;

    wrapper.textContent = "";

    for (let i = 0; i < elements.length; i++) {
        let elementContent = elements[i].innerText || elements[i].textContent;

        let elementConatainsFilter =
            elementContent
                .toLowerCase()
                .indexOf(upperFilter) > -1;

        if (elementConatainsFilter) {
            elements[i].style.display = "";
        } else {
            elements[i].style.display = "none";
        }
    }

    wrapper.append(...elements);
}
