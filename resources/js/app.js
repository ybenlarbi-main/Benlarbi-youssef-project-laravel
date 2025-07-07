import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Enhanced Toast Notification System with Modern Styling
let toastIndex = 0;

window.showToast = function(message, type = 'info', options = {}) {
    const {
        title = null,
        duration = 5000,
        action = null,
        autoDismiss = true
    } = options;

    const container = document.getElementById('toast-container') || createToastContainer();
    const toastId = 'toast-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);

    // Create toast element with modern styling
    const toast = document.createElement('div');
    toast.innerHTML = createToastHTML(toastId, message, type, { title, duration, action, autoDismiss });
    const toastElement = toast.firstElementChild;

    // Set toast position with better stacking
    toastElement.style.setProperty('--toast-index', toastIndex);
    toastIndex++;

    container.appendChild(toastElement);

    // Enhanced entrance animation
    setTimeout(() => {
        toastElement.classList.add('show');
    }, 100);

    // Auto dismiss with smooth exit
    if (autoDismiss && duration > 0) {
        setTimeout(() => hideToast(toastId), duration);
    }

    // Clean up index when toast is removed
    setTimeout(() => {
        if (toastIndex > 0) toastIndex--;
    }, duration + 500);

    return toastId;
};

function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'fixed top-6 right-6 z-50 space-y-3';
    container.setAttribute('role', 'region');
    container.setAttribute('aria-label', 'Notifications');
    document.body.appendChild(container);
    return container;
}

function createToastHTML(toastId, message, type, options) {
    const { title, duration, action, autoDismiss } = options;

    const iconColors = {
        'success': 'text-success-600',
        'error': 'text-error-600',
        'warning': 'text-warning-600',
        'info': 'text-brand-600',
        'like': 'text-error-600',
        'comment': 'text-brand-600',
        'notification': 'text-purple-600'
    };

    const bgClasses = {
        'success': 'toast-success',
        'error': 'toast-error',
        'warning': 'toast-warning',
        'info': 'toast-info',
        'like': 'toast-error',
        'comment': 'toast-info',
        'notification': 'toast-info'
    };

    const icons = getToastIcon(type);
    const bgClass = bgClasses[type] || 'toast-info';
    const iconColor = iconColors[type] || 'text-brand-600';

    return `
        <div id="${toastId}"
             class="toast ${bgClass} toast-enter"
             style="margin-top: calc(var(--toast-index, 0) * 4.25rem);"
             role="alert"
             aria-live="polite">
            <div class="relative overflow-hidden">
                ${autoDismiss ? `
                    <div class="absolute top-0 left-0 h-1 bg-gradient-to-r from-brand-500 to-accent-purple-500 progress-bar-fill"
                         style="width: 100%; animation: progressBar ${duration / 1000}s linear;"></div>
                ` : ''}

                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 ${getBgColor(type)} rounded-xl flex items-center justify-center shadow-soft">
                                ${icons}
                            </div>
                        </div>

                        <div class="ml-4 w-0 flex-1">
                            ${title ? `<p class="text-sm font-bold text-neutral-900 tracking-wide">${title}</p>` : ''}
                            <p class="text-sm ${title ? 'text-neutral-600 mt-1' : 'text-neutral-800 font-semibold'}">
                                ${message}
                            </p>
                            ${action ? `<div class="mt-3">
                                <a href="${action.url}"
                                   class="inline-flex items-center text-xs font-bold ${iconColor} hover:opacity-80 transition-all duration-200 px-3 py-1.5 rounded-lg bg-current/10 hover:bg-current/20">
                                    ${action.text}
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>` : ''}
                        </div>

                        <div class="ml-4 flex-shrink-0">
                            <button onclick="hideToast('${toastId}')"
                                    class="inline-flex items-center justify-center w-8 h-8 text-neutral-400 hover:text-neutral-600 focus:outline-none focus:text-neutral-600 transition-all duration-200 rounded-lg hover:bg-neutral-100 group"
                                    aria-label="Close notification">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function getToastIcon(type) {
    const icons = {
        success: `<svg class="w-5 h-5 text-success-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>`,
        error: `<svg class="w-5 h-5 text-error-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>`,
        warning: `<svg class="w-5 h-5 text-warning-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
        </svg>`,
        like: `<svg class="w-5 h-5 text-error-600" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
        </svg>`,
        comment: `<svg class="w-5 h-5 text-brand-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
        </svg>`,
        notification: `<svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
        </svg>`,
        info: `<svg class="w-5 h-5 text-brand-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
        </svg>`
    };

    return icons[type] || icons.info;
}

function getBgColor(type) {
    const bgColors = {
        'success': 'bg-gradient-to-br from-success-100 to-success-200',
        'error': 'bg-gradient-to-br from-error-100 to-error-200',
        'warning': 'bg-gradient-to-br from-warning-100 to-warning-200',
        'info': 'bg-gradient-to-br from-brand-100 to-brand-200',
        'like': 'bg-gradient-to-br from-error-100 to-error-200',
        'comment': 'bg-gradient-to-br from-brand-100 to-brand-200',
        'notification': 'bg-gradient-to-br from-purple-100 to-purple-200'
    };

    return bgColors[type] || 'bg-gradient-to-br from-brand-100 to-brand-200';
}

window.hideToast = function(toastId) {
    const toast = document.getElementById(toastId);
    if (toast) {
        toast.classList.add('toast-hide');
        toast.classList.remove('toast-show');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }
};

// Enhanced Loading Overlay
window.showLoading = function(message = 'Processing...', submessage = 'Please wait a moment') {
    const overlay = document.getElementById('loading-overlay');
    if (overlay) {
        const messageEl = overlay.querySelector('.text-neutral-800');
        const submessageEl = overlay.querySelector('.text-neutral-500');
        if (messageEl) messageEl.textContent = message;
        if (submessageEl) submessageEl.textContent = submessage;
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
    }
};

window.hideLoading = function() {
    const overlay = document.getElementById('loading-overlay');
    if (overlay) {
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
    }
};

// Enhanced Form Functionality
window.enhanceForm = function(formId, options = {}) {
    const form = document.getElementById(formId);
    if (!form) return;

    // Add loading state on submit
    form.addEventListener('submit', function(e) {
        if (options.showLoading !== false) {
            showLoading(options.loadingMessage || 'Processing...', options.submessage || 'Please wait while we handle your request');
        }

        // Enhanced submit button state
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = `
                <div class="loading-spinner mr-2"></div>
                ${options.loadingText || 'Processing...'}
            `;

            // Store original text for potential restoration
            submitBtn.dataset.originalText = originalText;
        }
    });

    // Enhanced validation feedback
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });

        input.addEventListener('input', function() {
            clearFieldError(this);
        });
    });
};

// Field validation with modern styling
function validateField(field) {
    const errorClass = 'border-error-300 bg-error-50';
    const successClass = 'border-success-300 bg-success-50';

    // Remove existing validation classes
    field.classList.remove('border-error-300', 'bg-error-50', 'border-success-300', 'bg-success-50');

    if (field.validity.valid && field.value.trim() !== '') {
        field.classList.add(...successClass.split(' '));
    } else if (!field.validity.valid) {
        field.classList.add(...errorClass.split(' '));
    }
}

function clearFieldError(field) {
    field.classList.remove('border-error-300', 'bg-error-50');
}

// Smooth scroll with modern easing
window.smoothScrollTo = function(element, offset = 0) {
    if (typeof element === 'string') {
        element = document.querySelector(element);
    }
    if (element) {
        const targetPosition = element.offsetTop - offset;
        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    }
};

// Modern element animations
window.animateIn = function(element, animation = 'animate-fade-in', delay = 0) {
    if (typeof element === 'string') {
        element = document.querySelector(element);
    }
    if (element) {
        setTimeout(() => {
            element.classList.add(animation);
        }, delay);
    }
};

// Enhanced auto-resize textarea
window.autoResizeTextarea = function(textarea) {
    if (typeof textarea === 'string') {
        textarea = document.querySelector(textarea);
    }
    if (textarea) {
        // Reset height to auto to get the correct scrollHeight
        textarea.style.height = 'auto';
        // Set height to scrollHeight with some padding
        textarea.style.height = Math.min(textarea.scrollHeight + 4, 300) + 'px';
    }
};

// Modern intersection observer for animations
function observeAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-slide-up');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    document.querySelectorAll('.card, .animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
}

// Initialize Alpine.js
Alpine.start();

// Enhanced global event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Auto-resize textareas with modern behavior
    document.querySelectorAll('textarea[data-auto-resize]').forEach(textarea => {
        textarea.addEventListener('input', () => autoResizeTextarea(textarea));
        autoResizeTextarea(textarea);
    });

    // Modern card animations
    observeAnimations();

    // Enhanced button hover effects
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.classList.add('animate-scale-in');
        });

        btn.addEventListener('mouseleave', function() {
            this.classList.remove('animate-scale-in');
        });
    });

    // Auto-hide loading overlay if page loads completely
    window.addEventListener('load', function() {
        setTimeout(hideLoading, 100);
    });
});

// Add custom CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes progressBar {
        from { width: 100%; }
        to { width: 0%; }
    }

    .toast-enter {
        transform: translateX(100%) scale(0.95);
        opacity: 0;
    }

    .toast-show {
        transform: translateX(0) scale(1);
        opacity: 1;
    }

    .toast-hide {
        transform: translateX(100%) scale(0.95);
        opacity: 0;
    }
`;
document.head.appendChild(style);
