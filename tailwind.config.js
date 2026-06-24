import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'bg-primary': '#F5F6FA',
                'bg-secondary': '#FFFFFF',
                'bg-card': '#FFFFFF',
                'bg-hover': '#F0F1F5',
                'accent': '#6366f1',
                'accent-light': '#818cf8',
                'accent-glow': 'rgba(99,102,241,.15)',
                'success-custom': '#10b981',
                'warning-custom': '#f59e0b',
                'danger-custom': '#ef4444',
                'text-primary': '#1A1D26',
                'text-muted': '#6B7280',
                'border-custom': '#E5E7EB',
            },
            spacing: {
                'sidebar-w': '264px',
            },
        },
    },

    plugins: [forms],
};
