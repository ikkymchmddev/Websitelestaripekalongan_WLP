// =============================================================================
// LESTARI PEKALONGAN - MAIN JAVASCRIPT
// =============================================================================

document.addEventListener('DOMContentLoaded', function() {
    // -------------------------------------------------------------------------
    // Navbar Toggle (Mobile)
    // -------------------------------------------------------------------------
    const navbarToggle = document.getElementById('navbarToggle');
    const navbarMenu = document.getElementById('navbarMenu');
    
    if (navbarToggle && navbarMenu) {
        navbarToggle.addEventListener('click', function() {
            navbarMenu.classList.toggle('active');
            const icon = navbarToggle.querySelector('i');
            if (navbarMenu.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }

    // -------------------------------------------------------------------------
    // Alert Close
    // -------------------------------------------------------------------------
    const alertCloseButtons = document.querySelectorAll('.alert-close');
    alertCloseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const alert = this.closest('.alert');
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 300);
        });
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    // -------------------------------------------------------------------------
    // Quantity Controls
    // -------------------------------------------------------------------------
    const quantityControls = document.querySelectorAll('.quantity-control');
    quantityControls.forEach(control => {
        const input = control.querySelector('input');
        const minusBtn = control.querySelector('.qty-minus');
        const plusBtn = control.querySelector('.qty-plus');
        const max = parseInt(input.getAttribute('max')) || 999;

        if (minusBtn) {
            minusBtn.addEventListener('click', function() {
                let value = parseInt(input.value) || 1;
                if (value > 1) {
                    input.value = value - 1;
                    input.dispatchEvent(new Event('change'));
                }
            });
        }

        if (plusBtn) {
            plusBtn.addEventListener('click', function() {
                let value = parseInt(input.value) || 1;
                if (value < max) {
                    input.value = value + 1;
                    input.dispatchEvent(new Event('change'));
                }
            });
        }
    });

    // -------------------------------------------------------------------------
    // Image Preview
    // -------------------------------------------------------------------------
    const imageInputs = document.querySelectorAll('input[type="file"][data-preview]');
    imageInputs.forEach(input => {
        input.addEventListener('change', function() {
            const previewId = this.getAttribute('data-preview');
            const preview = document.getElementById(previewId);
            
            if (preview && this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    // -------------------------------------------------------------------------
    // Smooth Scroll
    // -------------------------------------------------------------------------
    const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');
    smoothScrollLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // -------------------------------------------------------------------------
    // Form Validation
    // -------------------------------------------------------------------------
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    
                    // Show error message
                    let errorMsg = field.parentElement.querySelector('.form-error');
                    if (!errorMsg) {
                        errorMsg = document.createElement('span');
                        errorMsg.className = 'form-error';
                        field.parentElement.appendChild(errorMsg);
                    }
                    errorMsg.textContent = 'Field ini wajib diisi';
                } else {
                    field.classList.remove('error');
                    const errorMsg = field.parentElement.querySelector('.form-error');
                    if (errorMsg) errorMsg.remove();
                }
            });
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });

    // -------------------------------------------------------------------------
    // Confirm Delete
    // -------------------------------------------------------------------------
    const deleteButtons = document.querySelectorAll('[data-confirm]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const message = this.getAttribute('data-confirm') || 'Apakah Anda yakin?';
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });

    // -------------------------------------------------------------------------
    // Price Format
    // -------------------------------------------------------------------------
    window.formatPrice = function(price) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(price);
    };

    // -------------------------------------------------------------------------
    // Add to Cart Animation
    // -------------------------------------------------------------------------
    window.addToCartAnimation = function(button) {
        button.classList.add('added');
        button.innerHTML = '<i class="fas fa-check"></i> Ditambahkan';
        
        setTimeout(() => {
            button.classList.remove('added');
            button.innerHTML = '<i class="fas fa-cart-plus"></i> Tambah';
        }, 2000);
    };
});

// =============================================================================
// Cart Functions
// =============================================================================
const Cart = {
    updateQuantity: function(id, quantity) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/keranjang/update';
        
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.value = id;
        
        const qtyInput = document.createElement('input');
        qtyInput.type = 'hidden';
        qtyInput.name = 'jumlah';
        qtyInput.value = quantity;
        
        form.appendChild(idInput);
        form.appendChild(qtyInput);
        document.body.appendChild(form);
        form.submit();
    },

    remove: function(id) {
        if (confirm('Hapus produk dari keranjang?')) {
            window.location.href = '/keranjang/remove/' + id;
        }
    },

    updateBadge: function() {
        fetch('/api/keranjang/count')
            .then(res => res.json())
            .then(data => {
                const badge = document.getElementById('cartBadge');
                if (badge) badge.textContent = data.count || 0;
            });
    }
};
