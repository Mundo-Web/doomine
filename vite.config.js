import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import path from 'path';
import fs from 'fs';

const components = fs.readdirSync(path.resolve(__dirname, 'resources/js')).filter(file => file.endsWith('.jsx') || file == 'app.js');


export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
           
        }),
    ],
    build: {
        rollupOptions: {
            // Genera un chunk separado para cada componente
            input: components.map(component => `resources/js/${component}`),
        },
    },
    server: {
        hmr: {
            host: 'localhost',
        },
       
    },
});
