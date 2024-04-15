import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: 
            [
                'resources/sass/auth.scss',
                'resources/sass/cafes.scss',
                'resources/sass/general.scss',
                'resources/sass/modal_panel.scss',
                'resources/sass/modal.scss',
                'resources/sass/panel.scss',
                'resources/sass/modal_imagenes.scss',
                'resources/js/apis.js',
                'resources/js/cafes/coordenadas.js',
                'resources/js/cafes/modal_crear.js',
                'resources/js/cafes/modal_editar.js',
                'resources/js/cafes/reservas.js',
                'resources/js/cafes/cafes.js',
                'resources/js/cafes/mapa_coordenadas.js',
                'resources/js/cafes/modal_rol.js',
                'resources/js/cafes/modal_lenguaje_soez.js',
                'resources/js/cafes/modal_favoritos.js',
                'resources/js/panel/otros_cafe.js',
                'resources/js/panel/notificaciones.js',
                'resources/js/panel/banner.js',
                'resources/js/panel/imagen_video.js',
                'resources/js/panel/panel.js',
                'resources/js/panel/comentarios.js',
                'resources/js/panel/horarios.js',
                'resources/js/panel/modal_imagenes.js',
            ],
            refresh: true,
        }),
    ],
});
