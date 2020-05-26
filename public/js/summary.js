let popperInstance = null;

let summaryModal = document.querySelector('#summaryModal');

let summaryLink = null;

let summaryCache = null;

const summaryLinks = [
    {
        name: 'terms',
        regex: new RegExp(`${window.location.origin}/[0-9]\\w+`, 'g'),
    },
    {
        name: 'wikipedia',
        regex: new RegExp('wikipedia.org/wiki/', 'g')
    }
];

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

    if(!summary) return;

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
        .then(r => renderSummary(r.extract_html, anchor));
}

function getTermSummaryLink(anchor) {
    if(anchor.host !== window.location.host) return;

    let termsPostId = parseInt(anchor.pathname.replace('/', ''));

    return '/api/summary/' + termsPostId;
}

function getWikipediaSummaryLink(anchor) {
    let link = anchor.href;

    link = link.replace('/wiki/', '/api/rest_v1/page/summary/');

    return link;
}

function getSummaryLink(anchor) {
    let summaryLinkType = summaryLinks.find(h => anchor.href.match(h.regex));

    switch(summaryLinkType.name){
        case 'terms':
            return getTermSummaryLink(anchor);
        case 'wikipedia':
            return getWikipediaSummaryLink(anchor);
    }
}

function onMouseOverAnchor(e) {
    const anchor = e.path.find((el) => el.tagName === "A");

    if(!anchor) return;

    let currentSummaryLink = getSummaryLink(anchor);
    
    if(!currentSummaryLink) return;

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

        for (const supportedLink of summaryLinks) {
            if(a.href.match(supportedLink.regex)){
                a.addEventListener('mouseover', onMouseOverAnchor);
                a.addEventListener('mouseout', hideSummary);

                break;
            }
        }
        
    });
}

$(document).ready(() => {
    initSummaryCache();
    attachSummaryModals();
});