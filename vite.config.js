import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/form_food.js'
            ],
            refresh: true,
        })
    ],
    resolve: {
        alias: {
            'toastr': 'toastr/build/toastr.min.js' // Defina o caminho correto para o toastr
        }
    }
});
