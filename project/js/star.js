const stars = document.querySelectorAll('.star');

stars.forEach(star => {
    star.addEventListener('mouseenter', () => {
        stars.forEach(s => s.style.color = '#ccc'); // Reset all stars
        star.style.color = '#ffcc00'; // Highlight current star
        let previousStar = star.previousElementSibling;
        while (previousStar) {
            previousStar.nextElementSibling.style.color = '#ffcc00'; // Highlight previous stars
            previousStar = previousStar.previousElementSibling;
        }
    });

    star.addEventListener('mouseleave', () => {
        stars.forEach(s => s.style.color = '#ccc'); // Reset all stars
        const checkedStar = document.querySelector('input[name="rating"]:checked + .star');
        if (checkedStar) {
            let currentStar = checkedStar;
            while (currentStar) {
                currentStar.style.color = '#ffcc00'; // Keep selected stars highlighted
                currentStar = currentStar.previousElementSibling;
            }
        }
    });
});