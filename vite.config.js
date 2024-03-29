import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue  from '@vitejs/plugin-vue';
import * as path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue()
    ],

    resolve: {
        alias: [
            {
                find: '@',
                replacement: path.resolve('./resources/js')
            }
        ],

        extensions: [
            '.js',
            '.vue',
            '.json'
        ]
    }
});
