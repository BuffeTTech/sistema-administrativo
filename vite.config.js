import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/multi-select-tag.css',
                'resources/js/multi-select-tag.js',
                'resources/js/teste.js',
            ],
            refresh: true,
        }),
    ],
});
