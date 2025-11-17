// Client-side validation and interactions
document.addEventListener('DOMContentLoaded', function() {
    // Form validation for login/register
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const inputs = form.querySelectorAll('input[required]');
            let valid = true;
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    alert(`${input.placeholder} is required.`);
                    valid = false;
                }
            });
            if (!valid) e.preventDefault();
        });
    });

    // Search functionality on index.php
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                card.style.display = title.includes(query) ? 'block' : 'none';
            });
        });
    }

    // Filter by category
    const filterSelect = document.getElementById('category-filter');
    if (filterSelect) {
        filterSelect.addEventListener('change', function() {
            const category = this.value;
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                const cardCategory = card.dataset.category;
                card.style.display = category === '' || cardCategory === category ? 'block' : 'none';
            });
        });
    }
});
