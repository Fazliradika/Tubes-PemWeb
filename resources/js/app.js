import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Global Toast Notification System
window.showToast = function(message, type = 'success', duration = 4000) {
    // Create toast container if it doesn't exist
    let container = document.getElementById('toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'fixed top-4 right-4 z-[9999] flex flex-col gap-2';
        document.body.appendChild(container);
    }

    // Toast styles based on type
    const styles = {
        success: {
            bg: 'bg-green-500',
            icon: '✓',
            iconBg: 'bg-green-600'
        },
        error: {
            bg: 'bg-red-500',
            icon: '✕',
            iconBg: 'bg-red-600'
        },
        warning: {
            bg: 'bg-yellow-500',
            icon: '⚠',
            iconBg: 'bg-yellow-600'
        },
        info: {
            bg: 'bg-blue-500',
            icon: 'ℹ',
            iconBg: 'bg-blue-600'
        }
    };

    const style = styles[type] || styles.info;

    // Create toast element
    const toast = document.createElement('div');
    toast.className = `${style.bg} text-white px-4 py-3 rounded-lg shadow-lg flex items-center gap-3 min-w-[300px] max-w-md transform translate-x-full transition-transform duration-300 ease-out`;
    toast.innerHTML = `
        <span class="${style.iconBg} rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold">${style.icon}</span>
        <span class="flex-1 text-sm font-medium">${message}</span>
        <button class="text-white/80 hover:text-white transition" onclick="this.parentElement.remove()">✕</button>
    `;

    container.appendChild(toast);

    // Animate in
    requestAnimationFrame(() => {
        toast.classList.remove('translate-x-full');
        toast.classList.add('translate-x-0');
    });

    // Auto remove after duration
    setTimeout(() => {
        toast.classList.remove('translate-x-0');
        toast.classList.add('translate-x-full');
        setTimeout(() => toast.remove(), 300);
    }, duration);
};

// Make Alpine available globally for form handling
Alpine.data('formHandler', () => ({
    loading: false,
    async submitForm(event) {
        this.loading = true;
        // Let the form submit normally
    }
}));

Alpine.start();
