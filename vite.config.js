import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            // Copiar la carpeta images a public/build
            plugins: [
                require('rollup-plugin-copy')({
                    targets: [
                        { src: 'resources/images', dest: 'public/build' },
                    ],
                }),
            ],
        },
    },
});
