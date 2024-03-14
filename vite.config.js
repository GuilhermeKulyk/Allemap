import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        })
    ],
    resolve: {
        alias: {
            // Primeiro, definimos o jQuery
            'jquery': path.resolve(__dirname, 'node_modules/jquery/dist/jquery.min.js'),

            // Em seguida, definimos o Bootstrap, que depende do jQuery
            'bootstrap-js': 'bootstrap/dist/js/bootstrap.bundle.min.js',
            'bootstrap-css': 'bootstrap/dist/css/bootstrap.min.css',
            
            // Agora, os aliases para o Toastr e outros arquivos
            'toastr': '/node_modules/toastr/build/toastr.min.js',
            'toastr-css': '/node_modules/toastr/build/toastr.min.css',
            'toastr-config': '/resources/js/toastr-config.js',

            // Components and stuff
            'sidemenu': '/resources/js/sidemenu.js',
            'form-food-add': '/resources/js/form_food.js',
            
        }
    }   
});
