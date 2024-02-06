import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/styles.css', 
            'resources/js/bootstrap.js','resources/js/download.js',
            'resources/js/nav.js','resources/images/logo_egibide_cuadrado-copia.jpg'],
            refresh: true,
        }),
    ]

});
