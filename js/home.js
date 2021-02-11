let treeView = document.querySelector('.tree-view-container');
let selector = document.querySelector('.selector');
selector.addEventListener('click', () => {
    treeView.style.display = "block";
})

let closeBtn = document.querySelector('.close-btn');
closeBtn.addEventListener('click', () => {
    treeView.style.display = "none";
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

let filterButton = document.querySelector('.filter-button');
filterButton.addEventListener('click', () => filterDepts());
let deptLabel = document.querySelectorAll('.dept-label');
function filterDepts() {
    let filterValue = document.querySelector('.filter-input').value;
    clearFilter();
    filterValue = filterValue.toUpperCase();
    filterValue = filterValue.replace(/Ά/g,'Α')
        .replace(/Έ/g, 'Ε')
        .replace(/Ή/g,'Η')
        .replace(/Ί/g, 'Ι')
        .replace(/Ό/g, 'Ο')
        .replace(/Ύ/g, 'Υ')
        .replace(/Ώ/g, 'Ω')
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
}

function clearFilter() {
    for (let i =0; i < deptLabel.length; i++) {
        deptLabel[i].parentElement.style.display = 'list-item';
        deptLabel[i].parentElement.parentElement.parentElement.style.display = 'block';
    }
}
let count = 0;
function updateLabel() {
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

let searchBtn = document.querySelector('.filter-button');
searchBtn.addEventListener('submit', (e) => {
   if (count === 0) {
       e.preventDefault();
   }
});

