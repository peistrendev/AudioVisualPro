import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js','resources/css/tailwind.output.css'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});

module.exports = {
  theme: {
    extend: {
      screens: {
        '1080p': '1080px',
      }
    }
  }
}
