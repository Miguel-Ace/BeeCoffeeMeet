import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: 
            [
                'resources/sass/general.scss',
                'resources/sass/auth.scss',
                'resources/sass/modal.scss',
                'resources/sass/modal_panel.scss',
                'resources/js/cafes/coordenadas.js',
                'resources/js/cafes/modal_crear.js',
                'resources/js/cafes/modal_editar.js',
                'resources/js/cafes/reservas.js',
                ,'resources/js/cafes/cafes.js',
                'resources/js/panel/otros_cafe.js',
                'resources/js/panel/notificaciones.js',
                'resources/js/panel/banner.js',
                'resources/js/panel/imagen_video.js',
                'resources/js/panel/panel.js',
            ],
            refresh: true,
        }),
    ],
});
