document.querySelector("#searchInput").oninput = function() {
    let val = this.value.trim();
    let elasticItems = document.querySelectorAll(".elastic li");
    if (val != "") {
        elasticItems.forEach(function(elem) {
            if (elem.innerText.search(val) == -1) {
                elem.classList.add("hide");
            } else {
                elem.classList.remove("hide");
            }
        });
    } else {
        elasticItems.forEach(function(elem) {
            elem.classList.remove("hide");
        });
    }
};

//Get the button:
let mybutton = document.getElementById("arrowTop");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
