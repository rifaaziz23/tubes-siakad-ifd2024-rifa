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
                'bg-primary': '#0a0e1a',
                'bg-secondary': '#111827',
                'bg-card': '#1a2235',
                'bg-hover': '#1e2d45',
                'accent': '#6366f1',
                'accent-light': '#818cf8',
                'accent-glow': 'rgba(99,102,241,.25)',
                'success-custom': '#10b981',
                'warning-custom': '#f59e0b',
                'danger-custom': '#ef4444',
                'text-primary': '#f1f5f9',
                'text-muted': '#94a3b8',
                'border-custom': 'rgba(255,255,255,.07)',
            },
            spacing: {
                'sidebar-w': '260px',
            },
        },
    },

    plugins: [forms],
};
