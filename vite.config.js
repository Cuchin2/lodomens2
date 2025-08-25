import { defineConfig, loadEnv } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd());
    const appUrl = env.APP_URL ?? 'http://192.168.3.34:8000';

    return {
        server: {
            host: true, // escucha en 0.0.0.0
            port: 5173,
            hmr: {
                host: new URL(appUrl).hostname,
                protocol: new URL(appUrl).protocol.replace(':', ''),
                port: 5173,
            },
        },
        plugins: [
            laravel({
                input: [
                    'resources/css/web/app.css',
                    'resources/css/admin/app.css',
                    'resources/js/app.js',
                ],
                refresh: [
                    ...refreshPaths,
                    'app/Livewire/**',
                ],
            }),
        ],
    };
});
