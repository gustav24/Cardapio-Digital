// Main JavaScript file
document.addEventListener('DOMContentLoaded', function() {
    
    const navLinks = document.querySelectorAll('nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const path = this.getAttribute('href');
            loadContent(path);
        });
    });

    let cartCount = 0;
    const cartCountElement = document.querySelector('.cart-count');
    const cartIcon = document.getElementById('cartIcon');

    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const card = this.closest('.menu-card');
            const productName = card.querySelector('.card-title').textContent;
            const price = this.getAttribute('data-price');
            
            addToCartAnimation(this);
            updateCartCount();
            showNotification(`${productName} adicionado ao carrinho!`);
        });
    });

    function updateCartCount() {
        cartCount++;
        cartCountElement.textContent = cartCount;
        cartCountElement.classList.add('show');
        
        // Add bounce animation to cart icon
        cartIcon.classList.add('bounce');
        setTimeout(() => {
            cartIcon.classList.remove('bounce');
        }, 1000);
    }

    function addToCartAnimation(button) {
        button.classList.add('adding');
        setTimeout(() => {
            button.classList.remove('adding');
        }, 1000);
    }

    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.add('show');
        }, 100);

        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 2000);
    }

    async function loadContent(path) {
        try {
            const response = await fetch(path);
            const content = await response.text();
            document.getElementById('content').innerHTML = content;
           
            history.pushState({}, '', path);
        } catch (error) {
            console.error('Error loading content:', error);
        }
    }


    window.addEventListener('popstate', function() {
        loadContent(window.location.pathname);
    });
}); 