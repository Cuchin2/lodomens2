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
        './resources/views/components/**/*.blade.php',
    ],

    theme: {

        extend: {
            fontFamily: {
               // sans: ['Jura variant0','Tofu' ],
               sans: ['Jura','sans-serif'],
            },
            colors:{
                'gris-100':'#0F0F0F',
                'gris-90':'#1C1C1C',
                //'gris-80':'#202020',
                'gris-70':'#404040',
                //'gris-60':'#393939',
                'gris-50':'#4F4F4F',
                //'gris-40':'#6C6C6C',
                'gris-30':'#787878',
                //'gris-20':'#B5B5B5',
                'gris-10':'#A4A4A4',
                //'gris-5': '#F2F2F2',
                'verde-70':'#00904C',
                'verde-50':'#0CAD61',
                'verde-30':'#17C573',
                'turkey-70':'#00847B',
                'turkey-50':'#00A99D',
                'turkey-30':'#0ECBBE',
                'rojo-70':'#CE2F39',
                'rojo-50':'#EF4751',
                'rojo-30':'#FF545E',
                'corp-90':'#3A0107',
                'corp-70':'#800303',
                'corp-50':'#900D0D',
                'corp-30':'#AD0D0D',
                'corp-20':'#C83140',
                'corp2-70':'#AC803D',
                'corp2-50':'#C69B4C',
                'corp2-30':'#F2BC5D',
                'amarillo-70':'#EB9B00',
                'amarillo-50':'#FFB21C',
                'amarillo-30':'#F2BC5D',
                'morado-70':'#802FB1',
                'morado-50':'#963DCD',
                'morado-30':'#AE5DE0',
                'uva-70':'#3D42AD',
                'uva-50':'#5055CC',
                'uva-30':'#646AED',
                'azul-70':'#0081DF',
                'azul-50':'#00A3FF',
                'azul-30':'#2CB3FF',
                'naranja-70':'#E35D12',
                'naranja-50':'#FF6F1E',
                'naranja-30':'#FE8A49',
                },


            },

    },

    plugins: [forms, typography],
};

