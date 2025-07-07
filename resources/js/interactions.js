/**
 * Modern UI Interactions for Social Network
 * Handles toasts, loading states, and form enhancements
 */

// Toast Notification System
class ToastManager {
    constructor() {
        this.container = this.createToastContainer();
        this.toasts = [];
    }

    createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'fixed top-4 right-4 z-50 space-y-2 max-w-sm';
        document.body.appendChild(container);
        return container;
    }

    show(message, type = 'info', duration = 5000) {
        const toast = this.createToast(message, type);
        this.container.appendChild(toast);
        this.toasts.push(toast);

        // Trigger entrance animation
        setTimeout(() => {
            toast.classList.add('animate-slide-down');
            toast.classList.remove('opacity-0', 'transform', 'scale-95');
        }, 10);

        // Auto-remove toast
        setTimeout(() => {
            this.remove(toast);
        }, duration);

        return toast;
    }

    createToast(message, type) {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type} opacity-0 transform scale-95 transition-all duration-300 cursor-pointer`;

        const icons = {
            success: `<svg class="w-5 h-5 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>`,
            error: `<svg class="w-5 h-5 text-error-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>`,
            warning: `<svg class="w-5 h-5 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
            </svg>`,
            info: `<svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>`
        };

        toast.innerHTML = `
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    ${icons[type] || icons.info}
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-neutral-900">${message}</p>
                </div>
                <div class="ml-4 flex-shrink-0">
                    <button class="inline-flex text-neutral-400 hover:text-neutral-500 focus:outline-none focus:text-neutral-500 transition ease-in-out duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        `;

        // Add click to dismiss
        toast.addEventListener('click', () => this.remove(toast));

        return toast;
    }

    remove(toast) {
        if (!toast || !toast.parentNode) return;

        toast.classList.add('animate-slide-up', 'opacity-0', 'transform', 'scale-95');

        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
            this.toasts = this.toasts.filter(t => t !== toast);
        }, 300);
    }
}

// Loading State Manager
class LoadingManager {
    constructor() {
        this.activeLoaders = new Set();
        this.overlay = null;
    }

    show(message = 'Loading...', target = null) {
        const loader = this.createLoader(message);

        if (target) {
            target.style.position = 'relative';
            target.appendChild(loader);
        } else {
            this.showGlobalLoader(loader);
        }

        this.activeLoaders.add(loader);
        return loader;
    }

    createLoader(message) {
        const loader = document.createElement('div');
        loader.className = 'absolute inset-0 bg-white/80 backdrop-blur-sm flex items-center justify-center z-50 rounded-xl';
        loader.innerHTML = `
            <div class="flex flex-col items-center space-y-3">
                <div class="loading-spinner animate-spin"></div>
                <p class="text-sm text-neutral-600 font-medium">${message}</p>
            </div>
        `;
        return loader;
    }

    showGlobalLoader(loader) {
        if (!this.overlay) {
            this.overlay = document.createElement('div');
            this.overlay.className = 'fixed inset-0 bg-black/20 backdrop-blur-sm flex items-center justify-center z-50';
            document.body.appendChild(this.overlay);
        }

        this.overlay.appendChild(loader);
        this.overlay.classList.remove('hidden');
    }

    hide(loader) {
        if (loader && loader.parentNode) {
            loader.parentNode.removeChild(loader);
            this.activeLoaders.delete(loader);
        }

        if (this.activeLoaders.size === 0 && this.overlay) {
            this.overlay.classList.add('hidden');
        }
    }

    hideAll() {
        this.activeLoaders.forEach(loader => this.hide(loader));
        this.activeLoaders.clear();
    }
}

// Form Enhancement
class FormEnhancer {
    constructor() {
        this.init();
    }

    init() {
        // Add floating label effect
        this.setupFloatingLabels();

        // Add form validation styling
        this.setupFormValidation();

        // Add button loading states
        this.setupButtonLoading();
    }

    setupFloatingLabels() {
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.classList.add('ring-2', 'ring-brand-500', 'border-brand-500');
            });

            input.addEventListener('blur', () => {
                input.classList.remove('ring-2', 'ring-brand-500', 'border-brand-500');
            });
        });
    }

    setupFormValidation() {
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                const inputs = form.querySelectorAll('input[required], textarea[required]');
                let hasErrors = false;

                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        this.showFieldError(input, 'This field is required');
                        hasErrors = true;
                    } else {
                        this.clearFieldError(input);
                    }
                });

                if (hasErrors) {
                    e.preventDefault();
                }
            });
        });
    }

    showFieldError(input, message) {
        input.classList.add('border-error-500', 'focus:border-error-500', 'focus:ring-error-500');
        input.classList.remove('border-neutral-300');

        let errorElement = input.parentNode.querySelector('.form-error');
        if (!errorElement) {
            errorElement = document.createElement('p');
            errorElement.className = 'form-error';
            input.parentNode.appendChild(errorElement);
        }
        errorElement.textContent = message;
    }

    clearFieldError(input) {
        input.classList.remove('border-error-500', 'focus:border-error-500', 'focus:ring-error-500');
        input.classList.add('border-neutral-300');

        const errorElement = input.parentNode.querySelector('.form-error');
        if (errorElement) {
            errorElement.remove();
        }
    }

    setupButtonLoading() {
        const buttons = document.querySelectorAll('button[type="submit"]');
        buttons.forEach(button => {
            button.addEventListener('click', (e) => {
                if (button.form && button.form.checkValidity()) {
                    this.setButtonLoading(button);
                }
            });
        });
    }

    setButtonLoading(button) {
        button.disabled = true;
        button.innerHTML = `
            <div class="loading-spinner animate-spin mr-2"></div>
            ${button.textContent}
        `;
    }
}

// Initialize managers
const toastManager = new ToastManager();
const loadingManager = new LoadingManager();
const formEnhancer = new FormEnhancer();

// Global functions for easy access
window.showToast = (message, type = 'info', duration = 5000) => {
    toastManager.show(message, type, duration);
};

window.showLoading = (message = 'Loading...', target = null) => {
    return loadingManager.show(message, target);
};

window.hideLoading = (loader) => {
    loadingManager.hide(loader);
};

// Like/Unlike functionality for posts
class PostInteractions {
    constructor() {
        this.init();
    }

    init() {
        document.addEventListener('click', (e) => {
            if (e.target.matches('.like-button') || e.target.closest('.like-button')) {
                e.preventDefault();
                this.handleLike(e.target.closest('.like-button'));
            }
        });
    }

    async handleLike(button) {
        const postId = button.dataset.postId;
        const isLiked = button.classList.contains('liked');

        try {
            // Add optimistic UI update
            this.updateLikeButton(button, !isLiked);

            const response = await fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            if (!response.ok) {
                // Revert optimistic update
                this.updateLikeButton(button, isLiked);
                throw new Error('Network response was not ok');
            }

            const data = await response.json();

            // Update with server response
            this.updateLikeButton(button, data.liked);
            this.updateLikeCount(button, data.likes_count);

        } catch (error) {
            console.error('Error:', error);
            showToast('Failed to update like', 'error');
            // Revert optimistic update
            this.updateLikeButton(button, isLiked);
        }
    }

    updateLikeButton(button, isLiked) {
        if (isLiked) {
            button.classList.add('liked');
            button.innerHTML = `
                <svg class="w-4 h-4 text-red-500 fill-current" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            `;
        } else {
            button.classList.remove('liked');
            button.innerHTML = `
                <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            `;
        }
    }

    updateLikeCount(button, count) {
        const countElement = button.nextElementSibling;
        if (countElement) {
            countElement.textContent = count;
        }
    }
}

// Initialize post interactions
const postInteractions = new PostInteractions();

// Auto-hide flash messages
document.addEventListener('DOMContentLoaded', () => {
    const flashMessages = document.querySelectorAll('.flash-message');
    flashMessages.forEach(message => {
        setTimeout(() => {
            message.style.transition = 'opacity 0.5s ease-out';
            message.style.opacity = '0';
            setTimeout(() => {
                message.remove();
            }, 500);
        }, 5000);
    });
});

// Export for module usage
export { ToastManager, LoadingManager, FormEnhancer, PostInteractions };
