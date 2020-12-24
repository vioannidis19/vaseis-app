let treeView = document.querySelector('.tree-view-container');
let selector = document.querySelector('.selector');
selector.addEventListener('click', () => {
    treeView.style.display = "block";
})

let closeBtn = document.querySelector('.close-btn');
closeBtn.addEventListener('click', () => {
    treeView.style.display = "none";
})

let uniCheckbox = document.querySelectorAll('.uni-checkbox');
for (let i = 0; i < uniCheckbox.length; i++) {
    uniCheckbox[i].addEventListener('change', () => {
        let deptList = uniCheckbox[i].parentNode.childNodes[2].childNodes;
        console.log(uniCheckbox[i].checked);
        for (let y = 0; y < deptList.length; y++) {
            deptList[y].childNodes[0].checked = uniCheckbox[i].checked;
        }
    })
}
