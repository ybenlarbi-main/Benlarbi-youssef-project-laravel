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
                inter: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Modern brand colors
                brand: {
                    50: '#f0f7ff',
                    100: '#e0efff',
                    200: '#b9dcff',
                    300: '#7cc4ff',
                    400: '#36a8ff',
                    500: '#0c8ce9',
                    600: '#0066cc',
                    700: '#0052a3',
                    800: '#004785',
                    900: '#003d6b',
                    950: '#002748',
                },
                // Enhanced neutrals
                neutral: {
                    50: '#fafbfc',
                    100: '#f2f4f7',
                    200: '#e5e9ef',
                    300: '#d0d6e0',
                    400: '#9ca6ba',
                    500: '#6b7489',
                    600: '#4a5568',
                    700: '#374151',
                    800: '#1f2937',
                    900: '#111827',
                    950: '#0a0e1a',
                },
                // Success colors
                success: {
                    50: '#ecfdf5',
                    100: '#d1fae5',
                    200: '#a7f3d0',
                    300: '#6ee7b7',
                    400: '#34d399',
                    500: '#10b981',
                    600: '#059669',
                    700: '#047857',
                    800: '#065f46',
                    900: '#064e3b',
                },
                // Warning colors
                warning: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#f59e0b',
                    600: '#d97706',
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                },
                // Error colors
                error: {
                    50: '#fff1f2',
                    100: '#ffe4e6',
                    200: '#fecdd3',
                    300: '#fda4af',
                    400: '#fb7185',
                    500: '#f43f5e',
                    600: '#e11d48',
                    700: '#be123c',
                    800: '#9f1239',
                    900: '#881337',
                },
                // Purple accent
                purple: {
                    50: '#faf5ff',
                    100: '#f3e8ff',
                    200: '#e9d5ff',
                    300: '#d8b4fe',
                    400: '#c084fc',
                    500: '#a855f7',
                    600: '#9333ea',
                    700: '#7c3aed',
                    800: '#6b21a8',
                    900: '#581c87',
                },
                // Reddit-inspired colors
                reddit: {
                    orange: '#ff4500',
                    blue: '#0079d3',
                    bg: '#ffffff',
                    'dark-bg': '#030303',
                    'card-bg': '#ffffff',
                    'dark-card': '#1a1a1b',
                    border: '#ccc',
                    'dark-border': '#343536'
                }
            },
            animation: {
                'fade-in': 'fadeIn 0.4s ease-out',
                'slide-up': 'slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1)',
                'slide-down': 'slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1)',
                'scale-in': 'scaleIn 0.3s cubic-bezier(0.4, 0, 0.2, 1)',
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'bounce-gentle': 'bounceGentle 0.6s ease-out',
                'float': 'float 3s ease-in-out infinite',
            },
            backdropBlur: {
                'xs': '2px',
            },
            boxShadow: {
                'soft': '0 2px 8px 0 rgba(0, 0, 0, 0.08)',
                'medium': '0 4px 16px 0 rgba(0, 0, 0, 0.12)',
                'large': '0 8px 32px 0 rgba(0, 0, 0, 0.16)',
                'glow': '0 0 20px rgba(12, 140, 233, 0.4)',
            },
            spacing: {
                '18': '4.5rem',
                '88': '22rem',
            }
        },
    },

    plugins: [forms],
};
