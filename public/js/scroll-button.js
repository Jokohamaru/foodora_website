let pIndex = 0;
const pVisible = 3; // Hiển thị đúng 3 item

const pSlider = document.getElementById("premium-slider");
const pCards = document.querySelectorAll(".famous-keyword-pic-premium");
const pCardWidth = pCards[0].offsetWidth + 28;

document.getElementById("premium-next").onclick = () => {
    if (pIndex < pCards.length - pVisible) {
        pIndex++;
        pSlider.style.transform = `translateX(${-pCardWidth * pIndex}px)`;
    }
};

document.getElementById("premium-prev").onclick = () => {
    if (pIndex > 0) {
        pIndex--;
        pSlider.style.transform = `translateX(${-pCardWidth * pIndex}px)`;
    }
};
