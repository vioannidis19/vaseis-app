let hamburgerIcon = document.querySelector('.hamburger-icon');
let sideBar = document.querySelector('.side-bar');
let closeIcon = document.querySelector('.close-icon');
let sectionItems = document.querySelectorAll('.section-item');

hamburgerIcon.addEventListener('click', () => {
    if (sideBar.classList.contains('hidden-sidebar'))
        sideBar.classList.replace('hidden-sidebar', 'shown-sidebar')
    else sideBar.classList.toggle('shown-sidebar');
});

closeIcon.addEventListener('click', () => {
    sideBar.classList.replace('shown-sidebar', 'hidden-sidebar');
});

for (let i = 0; i < sectionItems.length; i++) {
    sectionItems[i].addEventListener('click', () => {
        sideBar.classList.replace('shown-sidebar', 'hidden-sidebar');
    })
}

