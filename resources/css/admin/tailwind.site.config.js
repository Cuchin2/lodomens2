import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
    //    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    //    './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            margin:{
                '54': '54px',
            },
            height: {
                '54': '54px',
                    },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                'gris-100':'#171717',
                'gris-90':'#1C1C1C',
                'gris-80':'#292929',
                'gris-70':'#363636',
                'gris-60':'#424242',
                'gris-50':'#4F4F4F',
                'gris-40':'#656565',
                'gris-30':'#7A7A7A',
                'gris-20':'#8F8F8F',
                'gris-10':'#A4A4A4',
                'gris-5': '#D1D1D1',
                'corp-90':'#C000A1',
                'corp-70':'#D917B9',
                'corp-60':'#E023C5',
                'corp-50':'#F12ED2',
                'corp-30':'#F852DD',
                'corp-10':'#FF76E9',
                'corp2-90':'#522C1C',
                'corp2-70':'#5A3424',
                'corp2-50':'#613C2C',
                'corp2-30':'#6C4637',
                'corp2-10':'#765142',
                'verde-90':'#00753E',
                'verde-80':'#038347',
                'verde-70':'#069150',
                'verde-60':'#099F58',
                'verde-50':'#0CAD61',
                'verde-40':'#1DC073',
                'verde-30':'#2ED385',
                'verde-20':'#3FE697',
                'verde-10':'#50F9A9',
                'amarillo-90':'#C28000',
                'amarillo-80':'#D78D00',
                'amarillo-70':'#EB9B00',
                'amarillo-60':'#F5A70E',
                'amarillo-50':'#FFB21C',
                'amarillo-40':'#FFB931',
                'amarillo-30':'#FFC045',
                'amarillo-20':'#FFC962',
                'amarillo-10':'#FFD37E',
                'naranja-90':'#C54D0A',
                'naranja-80':'#D4550E',
                'naranja-70':'#E35D12',
                'naranja-60':'#F16618',
                'naranja-50':'#FF6F1E',
                'naranja-40':'#FF7D34',
                'naranja-30':'#FE8A49',
                'naranja-20':'#FF955A',
                'naranja-10':'#FFA06B',
                'rojo-90':'#AA1720',
                'rojo-80':'#BB232C',
                'rojo-70':'#CD2F39',
                'rojo-60':'#DE3B45',
                'rojo-50':'#EF4751',
                'rojo-40':'#F3505A',
                'rojo-30':'#F75962',
                'rojo-20':'#FB616B',
                'rojo-10':'#FF6A73',
                'turkey-90':'#01766E',
                'turkey-80':'#017D75',
                'turkey-70':'#00847B',
                'turkey-60':'#00978C',
                'turkey-50':'#00A99D',
                'turkey-40':'#07BBAD',
                'turkey-30':'#0ECCBE',
                'turkey-20':'#2AE3D5',
                'turkey-10':'#45F9EB',
                'azul-90':'#026EBC',
                'azul-80':'#0178CD',
                'azul-70':'#0081DF',
                'azul-60':'#0092EF',
                'azul-50':'#00A3FF',
                'azul-40':'#16ABFF',
                'azul-30':'#2CB3FF',
                'azul-20':'#47BDFF',
                'azul-10':'#61C6FF',
                'uva-90':'#34389D',
                'uva-80':'#393DA5',
                'uva-70':'#3D42AD',
                'uva-60':'#474CBD',
                'uva-50':'#5055CC',
                'uva-40':'#5A60DD',
                'uva-30':'#646AED',
                'uva-20':'#6F75F6',
                'uva-10':'#7A80FF',
                'morado-90':'#702C99',
                'morado-80':'#782EA5',
                'morado-70':'#802FB1',
                'morado-60':'#8B36BF',
                'morado-50':'#963DCD',
                'morado-40':'#A24DD7',
                'morado-30':'#AE5DE0',
                'morado-20':'#BD6EED',
                'morado-10':'#CB7FFA',
                }

            },
            fontSize: {
                '15': '15px',
                    },
    },
    plugins: [forms, typography],
};

