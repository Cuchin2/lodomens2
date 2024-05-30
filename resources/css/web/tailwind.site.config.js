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
                'gris-100':'#171717',
                'gris-90':'#1C1C1C',
                'gris-80':'#292929',
                'gris-70':'#404040', 
                'gris-70': '#363636',
                'gris-60':'#424242',
                'gris-50':'#4F4F4F',
                'gris-40':'#646464',
                'gris-30':'#7A7A7A',
                'gris-20':'#8F8F8F',
                'gris-10':'#A4A4A4',
                'gris-5': '#D1D1D1',
                'corp-90':'#3A0107',
                'corp-80':'#500409',
                'corp-70':'#65070A',
                'corp-60':'#7B0A0C',
                'corp-50':'#900D0D',
                'corp-40':'#9E1619',
                'corp-30':'#AB1F26',
                'corp-20':'#B92832',
                'corp-10':'#C83140',
                'corp2-90':'#2F2200',
                'corp2-80':'#543900',
                'corp2-70':'#795000',
                'corp2-60':'#9E6600',
                'corp2-50':'#C37D00',
                'corp2-40':'#D29220',
                'corp2-30':'#E1A640',
                'corp2-20':'#F0BB5F',
                'corp2-10':'#FFD07F',
                'verde-90':'#00753E',
                'verde-80':'#038347',
                'verde-70':'#069150',
                'verde-60':'#099F58',
                'verde-50':'#0CAD61',
                'verde-40':'#1DC073',
                'verde-30':'#2ED385',
                'verde-20':'#3FE697',
                'verde-10':'#50F9A9', 
                },


            },

    },

    plugins: [forms, typography],
};

