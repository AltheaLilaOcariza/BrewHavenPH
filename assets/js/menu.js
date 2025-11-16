// Carousel Functionality
const track = document.querySelector('.carousel-track');
const items = Array.from(track.children);
const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');

const itemWidth = items[0].offsetWidth + 10; // width + margin
let index = 0;

function updateCarousel() {
  track.style.transform = `translateX(${-index * itemWidth}px)`;
}

prevBtn.addEventListener('click', () => {
  if (index > 0) {
    index--;
    updateCarousel();
  }
});

nextBtn.addEventListener('click', () => {
  if (index < items.length - 3) { // showing 3 items at a time
    index++;
    updateCarousel();
  }
});

// View Order Button Scroll Behavior
const viewBtn = document.querySelector('.view-order-btn');
const footer = document.querySelector('footer');

window.addEventListener('scroll', () => {
    const footerTop = footer.getBoundingClientRect().top + window.scrollY; // footer's position relative to page top
    const btnHeight = viewBtn.offsetHeight;
    const margin = 20; // distance from viewport bottom
    const scrollY = window.scrollY; // current scroll

    // Button's fixed bottom position relative to viewport
    const fixedBottomY = scrollY + window.innerHeight - margin - btnHeight;

    if (fixedBottomY > footerTop) {
        // Footer is reached; stop button above footer
        viewBtn.style.position = 'absolute';
        viewBtn.style.top = `${footerTop - btnHeight - margin}px`; // place above footer
        viewBtn.style.bottom = 'auto';
        viewBtn.style.right = '20px';
    } else {
        // Normal fixed behavior
        viewBtn.style.position = 'fixed';
        viewBtn.style.bottom = `${margin}px`;
        viewBtn.style.top = 'auto';
        viewBtn.style.right = '20px';
    }
});




