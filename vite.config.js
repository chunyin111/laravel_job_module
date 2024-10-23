import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/app.js"], //for vue one-page-view, here can import css file from js file
            refresh: true,
        }),
    ],
});
