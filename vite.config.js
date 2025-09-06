import { defineConfig, loadEnv } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd());
    const appUrl = env.APP_URL ?? 'http://localhost';

    return {
        server: {
            // Usa tu dirección IP específica en lugar de 'true' para forzar a Vite
            // a escuchar en esta interfaz de red.
            host: '192.168.3.34',
            port: 5173,
            hmr: {
                // Esta configuración asegura que HMR use la misma IP.
                host: '192.168.3.34',
                protocol: new URL(appUrl).protocol.replace(':', ''),
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
