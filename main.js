document.addEventListener('scroll', function() {
    if (window.scrollY > 3450) {
        document.body.classList.add('scrolled-4');
        document.body.classList.remove('scrolled-3');
        document.body.classList.remove('scrolled-2');
        document.body.classList.remove('scrolled-1');
    }
    else if (window.scrollY > 2600) {
        document.body.classList.add('scrolled-3');
        document.body.classList.remove('scrolled-4');
        document.body.classList.remove('scrolled-2');
        document.body.classList.remove('scrolled-1');
    }
     else if (window.scrollY > 1900) {
        document.body.classList.add('scrolled-2');
        document.body.classList.remove('scrolled-4');
        document.body.classList.remove('scrolled-3');
        document.body.classList.remove('scrolled-1');
    } else if (window.scrollY > 410) {
        document.body.classList.add('scrolled-1');
        document.body.classList.remove('scrolled-2');
        document.body.classList.remove('scrolled-3');
        document.body.classList.remove('scrolled-4');
    } else {
        document.body.classList.remove('scrolled-1','scrolled-2', 'scrolled-3','scrolled-4');
    }
});


let nextDom = document.getElementById('next');
let prevDom = document.getElementById('prev');
let carouselDom = document.querySelector('.carousel');
let listItemDom = document.querySelector('.carousel .list');
let thumbnailDom = document.querySelector('.carousel .thumbnail');

nextDom.onclick = function() {
    showSlider('next');
};

prevDom.onclick = function() {
    showSlider('prev');
};

function showSlider(type) {
    let itemSlider = document.querySelectorAll('.carousel .list .item');
    let itemThumbnail = document.querySelectorAll('.carousel .thumbnail .thumb-item');

    if (type === 'next') {
        listItemDom.appendChild(itemSlider[0]);
        thumbnailDom.appendChild(itemThumbnail[0]);
        carouselDom.classList.add('next');
        setTimeout(() => {
            carouselDom.classList.remove('next');
        }, 500); // Match with the CSS animation duration
    } else if (type === 'prev') {
        let positionLastItem = itemSlider.length - 1;
        listItemDom.prepend(itemSlider[positionLastItem]);
        thumbnailDom.prepend(itemThumbnail[positionLastItem]);
        carouselDom.classList.add('prev');
        setTimeout(() => {
            carouselDom.classList.remove('prev');
        }, 500); // Match with the CSS animation duration
    }
}
window.addEventListener("DOMContentLoaded", () => {
    const spotlight = document.querySelector('.spotlight');

    let spotlightSize = 'transparent 160px, rgba(0, 0, 0, 1) 200px';

    window.addEventListener('mousemove', e => updateSpotlight(e));

    function updateSpotlight(e) {
        const spotlightRect = spotlight.getBoundingClientRect();
        const x = e.clientX - spotlightRect.left;
        const y = e.clientY - spotlightRect.top;
        spotlight.style.backgroundImage = `radial-gradient(circle at ${x}px ${y}px, ${spotlightSize})`;
    }
});

function scrollToSection(sectionId) {
    var section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

