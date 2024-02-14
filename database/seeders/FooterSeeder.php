<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Footer;
class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Footer::create([
            'title' => '¿Quiénes somos?',
            'content' => 'Joyería y moda masculina
            Potencia tu imagen y tu estilo
            La perfección está en los detalles',
            'email' => 'contacto@lodomens.com',
            'phone' => '9266846875',
            'address' => 'Surco, 15056',
            'order_message' => 'Mensaje de envios',
        ]);
    }
}
