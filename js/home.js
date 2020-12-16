let selector = document.querySelector('.selector');
selector.addEventListener('click', () => {
    // let backGroundEl = document.querySelector('.bg');
    // backGroundEl.classList.replace('hidden', 'dark-bg');
    let treeView = document.querySelector('.tree-view-container');
    treeView.style.display = "block";
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
