function search(selector, filter) {
    let upperFilter = filter.toUpperCase();

    let elements  = document.querySelectorAll(selector);
    
    for (const element of elements) {
        let elementContent = element.innerText || element.textContent;

        let elementConatainsFilter = 
            elementContent
            .toUpperCase()
            .indexOf(upperFilter) > -1;

        if(elementConatainsFilter){
            element.style.display = "";
        } else {
            element.style.display = "none";
        }
    }
}

$('.like').on('click', function(event){
    console.log(event);
});