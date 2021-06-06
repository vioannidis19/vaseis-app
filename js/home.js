let treeView = document.querySelector('.tree-view-container');
let selector = document.querySelector('.selector');
selector.addEventListener('click', () => {
    treeView.style.display = "block";
})

let closeBtn = document.querySelector('.close-btn');
closeBtn.addEventListener('click', () => {
    treeView.style.display = "none";
    document.querySelector('.filter-input').value = "";
    filterDepts();
})

deptCheckboxes = document.querySelectorAll('.dept-checkbox');

for (let i = 0; i < deptCheckboxes.length; i++) {
    deptCheckboxes[i].addEventListener('change', () => updateLabel());
}

let uniCheckbox = document.querySelectorAll('.uni-checkbox');
for (let i = 0; i < uniCheckbox.length; i++) {
    uniCheckbox[i].addEventListener('change', () => {
        let deptList = uniCheckbox[i].parentNode.childNodes[2].childNodes;
        for (let y = 0; y < deptList.length; y++) {
            if (deptList[y].style.display !== "none") {
                deptList[y].childNodes[0].checked = uniCheckbox[i].checked;
            }
        }
        updateLabel();
    })
}

let filterInput = document.querySelector('.filter-input');
filterInput.addEventListener('keyup', () => filterDepts());

// let filterButton = document.querySelector('.filter-button');
// filterButton.addEventListener('click', () => filterDepts());
let deptLabel = document.querySelectorAll('.dept-label');
let uniLabel = document.querySelectorAll('.uni-label');
function filterDepts() {
    let filterValue = document.querySelector('.filter-input').value;
    clearFilter();
    filterValue = removeAccents(filterValue);
    for (let i = 0; i < deptLabel.length; i++) {
        if(deptLabel[i].innerText.includes(filterValue)) {

        } else {
            let listEl = deptLabel[i].parentElement;
            let uniEl = listEl.parentElement;
            let parentEl = uniEl.parentElement;
            listEl.style.display = 'none';
            let count = 0;
            for (let y = 0; y < uniEl.children.length; y++) {
                if (uniEl.children[y].style.display === 'none') {
                    count++;
                }
            }
            if (count === uniEl.children.length) {
                parentEl.style.display = 'none';
            }
        }
    }
    for (let i = 0; i < uniLabel.length; i++) {
        let uniName = removeAccents(uniLabel[i].innerText);
        if(uniName.includes(filterValue)) {
            let listEl = uniLabel[i].parentElement;
            for (let y = 0; y < listEl.children.length; y++) {
                listEl.style.display = 'block';
                switch (y) {
                    case 0:
                    case 1:
                        listEl.children[y].style.display = 'inline-block';
                        break;
                    case 2:
                        listEl.children[y].style.display = 'block';
                        break;
                    default:
                        break;
                }
            }
            for (let y = 0; y < listEl.children[2].children.length; y++) {
                listEl.children[2].children[y].style.display = 'block';
            }
        }
    }
}

function removeAccents(text) {
    return text.toUpperCase().replace(/Ά/g,'Α')
        .replace(/Έ/g, 'Ε')
        .replace(/Ή/g,'Η')
        .replace(/Ί/g, 'Ι')
        .replace(/Ό/g, 'Ο')
        .replace(/Ύ/g, 'Υ')
        .replace(/Ώ/g, 'Ω');
}

function clearFilter() {
    for (let i =0; i < deptLabel.length; i++) {
        deptLabel[i].parentElement.style.display = 'list-item';
        deptLabel[i].parentElement.parentElement.parentElement.style.display = 'block';
    }
}
let count = 0;
function updateLabel() {
    count = 0;
    for(let i = 0; i < deptCheckboxes.length; i++) {
        if (deptCheckboxes[i].checked) {
            count++;
        }
    }
    if (count === 1) {
        document.querySelector('.dept-selected-label').innerHTML = `${count} τμήμα επιλεγμένο`;
    } else {
        document.querySelector('.dept-selected-label').innerHTML = `${count} τμήματα επιλεγμένα`;
    }
}

let form = document.querySelector('form');
form.addEventListener('submit', (e) => {
    if (count === 0) {
        e.preventDefault();
    }
});

// let searchBtn = document.querySelector('.filter-button');
// searchBtn.addEventListener('submit', (e) => {
//    if (count === 0) {
//        e.preventDefault();
//    }
// });

window.addEventListener('unload', () => {
    document.querySelector('.dept-selected-label').innerHTML = `0 τμήματα επιλεγμένα`;
});

window.addEventListener('click', (e) => {
    let treeView = document.querySelector('.tree-view-container');
    let target = e.target;
    if (treeView.style.display === "block") {
        if (e.target === document.querySelector('.selector')) return;
        if (target.tagName === "LABEL" || target.tagName === "INPUT" || target.tagName === "LI" ||
            target.tagName === "UL") return;
        if (target.classList.contains('close-btn') || target.classList.contains('tree-view') || target.classList.contains('filter-container') ||
            target.classList.contains('search-dept-list') || target.classList.contains('tree-view-container')) return;
        document.querySelector('.tree-view-container').style.display = "none";
    }
});

let cookiesAcceptBtn = document.querySelector('.cookies-accept');
let cookiesDenyBtn = document.querySelector('.cookies-deny');

cookiesAcceptBtn.addEventListener('click', setCookie);
cookiesDenyBtn.addEventListener('click', denyCookies);
window.addEventListener('load', searchCookie);

function setCookie() {
    let date = new Date();
    date.setMonth(date.getMonth() + 1);
    document.cookie = `accept=1;${date};SameSite=Strict;path=/`;
    document.querySelector('.cookie-consent').style.display = "none";
    loadAnalytics();
}

function denyCookies() {
    let date = new Date();
    date.setMonth(date.getMonth() + 12);
    document.cookie = `accept=0;${date};SameSite=Strict;path=/`;
    document.querySelector('.cookie-consent').style.display = "none";
}

function searchCookie() {
    let cookie = document.cookie.search('accept');
    if (cookie === -1) {
        document.querySelector('.cookie-consent').style.display = "";
    } else {
        document.querySelector('.cookie-consent').style.display = "none";
        let value = getCookie("accept");
        if (value === "1") {
            loadAnalytics()
        }
    }
}

function loadAnalytics() {
    let s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = 'https://www.googletagmanager.com/gtag/js?id=G-SZHX53PWM7';
    document.querySelector('body').appendChild(s);
    let s1 = document.createElement('script');
    s1.type = 'text/javascript';
    s1.async = true;
    s1.innerText = "window.dataLayer = window.dataLayer || []; " +
        "function gtag(){dataLayer.push(arguments);} " +
        "gtag('js', new Date()); " +
        "gtag('config', 'G-SZHX53PWM7');"
    document.querySelector('body').appendChild(s1);
}

function getCookie(name) {
    let cookie = {};
    document.cookie.split(';').forEach(function(el) {
        let [k,v] = el.split('=');
        cookie[k.trim()] = v;
    })
    return cookie[name];
}
