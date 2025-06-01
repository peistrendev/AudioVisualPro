import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/tailwind.output.css'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        manifest: true, // Esto genera el archivo manifest.json
        outDir: 'public/build', // Asegura que la salida esté en public/build
    }
});