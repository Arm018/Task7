import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import vueJsx from '@vitejs/plugin-vue-jsx';
import AutoImport from 'unplugin-auto-import/vite';
import Components from 'unplugin-vue-components/vite';
import vuetify from 'vite-plugin-vuetify';
import svgLoader from 'vite-svg-loader';
import { fileURLToPath } from 'node:url';

export default defineConfig({
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        vueJsx(),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/main.js',
            ],
            refresh: true,
        }),
        vuetify({
            styles: {
                configFile: 'resources/styles/variables/_vuetify.scss',
            },
        }),
        Components({
            dirs: ['resources/js/@core/components', 'resources/js/components'],
            dts: true,
            resolvers: [
                (componentName) => {
                    // Auto import `VueApexCharts`
                    if (componentName === 'VueApexCharts')
                        return { name: 'default', from: 'vue3-apexcharts', as: 'VueApexCharts' };
                },
            ],
        }),
        AutoImport({
            imports: ['vue', 'vue-router', '@vueuse/core', '@vueuse/math', 'pinia'],
            vueTemplate: true,
            ignore: ['useCookies', 'useStorage'],
            eslintrc: {
                enabled: true,
                filepath: './.eslintrc-auto-import.json',
            },
        }),
        svgLoader(),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '@core-scss': fileURLToPath(new URL('./resources/styles/@core', import.meta.url)),
            '@': fileURLToPath(new URL('./resources/js', import.meta.url)),
            '@core': fileURLToPath(new URL('./resources/js/@core', import.meta.url)),
            '@layouts': fileURLToPath(new URL('./resources/js/@layouts', import.meta.url)),
            '@images': fileURLToPath(new URL('./resources/images/', import.meta.url)),
            '@styles': fileURLToPath(new URL('./resources/styles/', import.meta.url)),
            '@configured-variables': fileURLToPath(new URL('./resources/styles/variables/_template.scss', import.meta.url)),
        },
    },
    define: { 'process.env': {} },
    build: {
        chunkSizeWarningLimit: 5000,
    },
    optimizeDeps: {
        exclude: ['vuetify'],
        entries: ['./resources/js/**/*.vue'],
    },
});
