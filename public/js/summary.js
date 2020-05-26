let popperInstance = null;

let summaryModal = document.querySelector('#summaryModal');

let summaryLink = null;

let summaryCache = null;

function initSummaryCache() {
    resetSummaryCache();

    caches.open('summaries').then((cache) => {
        summaryCache = cache;
    });
}

function resetSummaryCache() {
    caches.delete('summaries');
}

function setSummaryContent(content) {
    summaryModal.children[0].innerHTML = content;
}

function renderSummary(summary, elementToAttach) {
    if(!summaryLink) return;

    setSummaryContent(summary);

    popperInstance = new Popper(elementToAttach, summaryModal, {
        placement: 'bottom-start',
        modifiers: {
            offset: {
                enabled: true,
                offset: '0, 10'
            }
        }
    });

    summaryModal.setAttribute('data-show', '');
}

function hideSummary() {
    if(popperInstance){
        popperInstance.destroy();
        popperInstance = null;
    }

    summaryLink = null;
    setSummaryContent('');
    summaryModal.removeAttribute('data-show');
}

function fetchAndCacheSummary(url) {
    return fetch(url)
        .then(res => {
            let resToCache = res.clone();

            summaryCache.put(url, resToCache);

            return res.json();
        });
}

function showTermSummary(link, anchor) {
    summaryCache
        .match(link)
        .then(r => {
            if(r){
               return r.json();
            } else {
                return fetchAndCacheSummary(link, anchor);
            }
        })
        .then(r => renderSummary(r.body, anchor));
}

function getSummaryLink(anchor) {

    let termsPostId = parseInt(anchor.pathname.replace('/', ''));

    return '/api/summary/' + termsPostId;
}

function onMouseOverAnchor(e) {
    const anchor = e.path.find((el) => el.tagName === "A");

    if(!anchor) return;

    let currentSummaryLink = getSummaryLink(anchor); 
    
    summaryLink = currentSummaryLink;

    // Show modal on delay of 200Ms
    setTimeout(() => {

        if(summaryLink === currentSummaryLink){
            showTermSummary(currentSummaryLink, anchor);
        }

    }, 200);
}

function attachSummaryModals() {
    $('.summary-links-wrapper').find("a").each((i, a) => {

        const ignoreAnchor = a.className.includes('ignore-summary');

        if(ignoreAnchor) return;

        // Match only anchors with href to post (/1234)
        if(a.pathname.match(/\/[0-9]\w+/g)){
            a.addEventListener('mouseover', onMouseOverAnchor);
            a.addEventListener('mouseout', hideSummary);
        }
    });
}

$(document).ready(() => {
    initSummaryCache();
    attachSummaryModals();
});