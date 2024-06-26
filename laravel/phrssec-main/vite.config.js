import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/phrssec/app.scss',
                'resources/sass/admin/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
