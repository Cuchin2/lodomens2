<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=Role::create(['name'=>'Admin']);
        $blogger=Role::create(['name'=>'Blogger']);
        $cashier=Role::create(['name'=>'Cashier']);
        $client=Role::create(['name'=>'Client']);

        Permission::create(['name'=>'users.index','type'=>'usuario','description'=>'Ver vista lista de usuarios']);
        Permission::create(['name'=>'users.create','type'=>'usuario','description'=>'Ver vista de creación de usuarios']);
        Permission::create(['name'=>'users.store','type'=>'usuario','description'=>'Crear nuevos de usuarios']);
        Permission::create(['name'=>'users.show','type'=>'usuario','description'=>'Ver vista  de usuarios']);
        Permission::create(['name'=>'users.edit','type'=>'usuario','description'=>'Ver vista edición de usuarios']);
        Permission::create(['name'=>'users.update','type'=>'usuario','description'=>'Actualización de usuarios']);
        Permission::create(['name'=>'users.destroy','type'=>'usuario','description'=>'Eliminar de usuarios']);
        Permission::create(['name'=>'home','type'=>'dashboard','description'=>'Acceder al dashboard']);
        Permission::create(['name'=>'brands.index','type'=>'marcas','description'=>'Ver vista lista de marcas']);
        Permission::create(['name'=>'brands.create','type'=>'marcas','description'=>'Ver vista de creación de marcas']);
        Permission::create(['name'=>'brands.store','type'=>'marcas','description'=>'Crear nuevas marcas']);
        Permission::create(['name'=>'brands.edit','type'=>'marcas','description'=>'Ver vista de edición de marcas']);
        Permission::create(['name'=>'brands.update','type'=>'marcas','description'=>'Actualización marcas']);
        Permission::create(['name'=>'brands.destroy','type'=>'marcas','description'=>'Eliminar marcas']);
        Permission::create(['name'=>'tags.index','type'=>'etiquetas','description'=>'Ver vista lista de etiquetas']);
        Permission::create(['name'=>'tags.create','type'=>'etiquetas','description'=>'Ver vista de creación de etiquetas']);
        Permission::create(['name'=>'tags.store','type'=>'etiquetas','description'=>'Crear etiquetas']);
        Permission::create(['name'=>'tags.edit','type'=>'etiquetas','description'=>'Ver vista de edición de etiquetas']);
        Permission::create(['name'=>'tags.update','type'=>'etiquetas','description'=>'Actualizar etiquetas']);
        Permission::create(['name'=>'tags.destroy','type'=>'etiquetas','description'=>'Eliminar etiquetas']);
        Permission::create(['name'=>'categories.index','type'=>'categorias','description'=>'Ver vista lista de categorías']);
        Permission::create(['name'=>'categories.create','type'=>'categorias','description'=>'Ver vista de creación de categorías']);
        Permission::create(['name'=>'categories.store','type'=>'categorias','description'=>'Crear categorías']);
        Permission::create(['name'=>'categories.show','type'=>'categorias','description'=>'Ver vista de categorías']);
        Permission::create(['name'=>'categories.edit','type'=>'categorias','description'=>'Ver vista de edición de categorías']);
        Permission::create(['name'=>'categories.update','type'=>'categorias','description'=>'Actualizar categorías']);
        Permission::create(['name'=>'categories.destroy','type'=>'categorias','description'=>'Eliminar categorías']);
        Permission::create(['name'=>'products.index','type'=>'productos','description'=>'Ver vista lista de producto']);
        Permission::create(['name'=>'products.store','type'=>'productos','description'=>'Crear productos']);
        Permission::create(['name'=>'products.show','type'=>'productos','description'=>'Ver vista de producto']);
        Permission::create(['name'=>'products.edit','type'=>'productos','description'=>'Ver vista edición de producto']);
        Permission::create(['name'=>'products.update','type'=>'productos','description'=>'Actualizar producto']);
        Permission::create(['name'=>'products.destroy','type'=>'productos','description'=>'Eliminar producto']);
        Permission::create(['name'=>'posts.index','type'=>'blog','description'=>'Ver vista lista de blogs']);
        Permission::create(['name'=>'posts.store','type'=>'blog','description'=>'Crear blog']);
        Permission::create(['name'=>'posts.show','type'=>'blog','description'=>'Ver vista de blog']);
        Permission::create(['name'=>'posts.edit','type'=>'blog','description'=>'Ver vista edición de blog']);
        Permission::create(['name'=>'posts.update','type'=>'blog','description'=>'Actualizar blog']);
        Permission::create(['name'=>'posts.destroy','type'=>'blog','description'=>'Eliminar blog']);
        Permission::create(['name'=>'social_medias.index','type'=>'redes sociales','description'=>'Ver lista de redes sociales']);
        Permission::create(['name'=>'social_medias.create','type'=>'redes sociales','description'=>'Ver vista creación de redes sociales']);
        Permission::create(['name'=>'social_medias.store','type'=>'redes sociales','description'=>'crear de rede social']);
        Permission::create(['name'=>'social_medias.edit','type'=>'redes sociales','description'=>'Ver vista edición de redes sociales']);
        Permission::create(['name'=>'social_medias.update','type'=>'redes sociales','description'=>'Actualizar redes sociales']);
        Permission::create(['name'=>'social_medias.destroy','type'=>'redes sociales','description'=>'Eliminar redes sociales']);
        Permission::create(['name'=>'sliders.index','type'=>'carrusel','description'=>'Ver lista de carrusel']);
        Permission::create(['name'=>'sliders.store','type'=>'carrusel','description'=>'Ver vista creación de carrusel']);
        Permission::create(['name'=>'sliders.edit','type'=>'carrusel','description'=>'Ver vista edición de carrusel']);
        Permission::create(['name'=>'sliders.update','type'=>'carrusel','description'=>'Actualizar carrusel']);
        Permission::create(['name'=>'sliders.destroy','type'=>'carrusel','description'=>'Eliminar carrusel']);
        Permission::create(['name'=>'promotions.index','type'=>'promociones','description'=>'Ver lista de promociones']);
        Permission::create(['name'=>'promotions.create','type'=>'promociones','description'=>'Ver vista creación de promociones']);
        Permission::create(['name'=>'promotions.store','type'=>'promociones','description'=>'Crear promociones']);
        Permission::create(['name'=>'promotions.edit','type'=>'promociones','description'=>'Ver vista edición de promociones']);
        Permission::create(['name'=>'promotions.update','type'=>'promociones','description'=>'Actualizar promociones']);
        Permission::create(['name'=>'promotions.destroy','type'=>'promociones','description'=>'Eliminar promociones']);
        Permission::create(['name'=>'clients.index','type'=>'clientes','description'=>'Ver lista de clientes']);
        Permission::create(['name'=>'clients.create','type'=>'clientes','description'=>'Ver vista creación de clientes']);
        Permission::create(['name'=>'clients.store','type'=>'clientes','description'=>'Crear clientes']);
        Permission::create(['name'=>'clients.show','type'=>'clientes','description'=>'Ver vista de clientes']);
        Permission::create(['name'=>'clients.edit','type'=>'clientes','description'=>'Ver vista edición de clientes']);
        Permission::create(['name'=>'clients.update','type'=>'clientes','description'=>'Actualizar clientes']);
        Permission::create(['name'=>'clients.destroy','type'=>'clientes','description'=>'Eliminar clientes']);
        Permission::create(['name'=>'providers.index','type'=>'provedores','description'=>'Ver lista de provedores']);
        Permission::create(['name'=>'providers.create','type'=>'provedores','description'=>'Ver vista creación de provedores']);
        Permission::create(['name'=>'providers.store','type'=>'provedores','description'=>'Crear provedores']);
        Permission::create(['name'=>'providers.show','type'=>'provedores','description'=>'Ver vista de provedores']);
        Permission::create(['name'=>'providers.edit','type'=>'provedores','description'=>'Ver vista edición de provedores']);
        Permission::create(['name'=>'providers.update','type'=>'provedores','description'=>'Actualizar provedores']);
        Permission::create(['name'=>'providers.destroy','type'=>'provedores','description'=>'Eliminar provedores']);
        Permission::create(['name'=>'roles.index','type'=>'roles','description'=>'Ver vista de roles']);
        Permission::create(['name'=>'roles.show','type'=>'roles','description'=>'Ver vista de roles']);
        Permission::create(['name'=>'printers.index','type'=>'impresora','description'=>'Ver lista de impresoras']);
        Permission::create(['name'=>'printers.update','type'=>'impresora','description'=>'Actualizar impresoras']);
        Permission::create(['name'=>'orders.index','type'=>'pedidos','description'=>'Ver listas de pedidos']);
        Permission::create(['name'=>'orders.show','type'=>'pedidos','description'=>'Ver vista de pedidos']);
        Permission::create(['name'=>'sales.index','type'=>'ventas','description'=>'Ver lista de ventas']);
        Permission::create(['name'=>'sales.create','type'=>'ventas','description'=>'Crear venta']);
        Permission::create(['name'=>'sales.store','type'=>'ventas','description'=>'Ver vista creación de venta']);
        Permission::create(['name'=>'sales.show','type'=>'ventas','description'=>'Ver vista venta']);
        Permission::create(['name'=>'purchases.index','type'=>'compras','description'=>'Ver lista de compras']);
        Permission::create(['name'=>'purchases.create','type'=>'compras','description'=>'Ver vista creación de compras']);
        Permission::create(['name'=>'purchases.store','type'=>'compras','description'=>'Ver vista creación de compras']);
        Permission::create(['name'=>'purchases.show','type'=>'compras','description'=>'Ver vista de compras']);
        Permission::create(['name'=>'business.index','type'=>'empresa','description'=>'Ver lista de empresas']);
        Permission::create(['name'=>'business.update','type'=>'empresa','description'=>'Actualizar empresas']);
        Permission::create(['name'=>'subscriptions.index','type'=>'suscripción','description'=>'Ver lista de suscripciones']);
        Permission::create(['name'=>'subscriptions.destroy','type'=>'suscripción','description'=>'Eliminar suscripción']);
        Permission::create(['name'=>'update_product_status','type'=>'productos','description'=>'Actualizar estado de producto']);
        Permission::create(['name'=>'mark_all_notifications','type'=>'notificaciones','description'=>'Marcar todas las notificaciones']);
        Permission::create(['name'=>'mark_a_notification','type'=>'notificaciones','description'=>'Marcar una notificación']);
        Permission::create(['name'=>'update_profile','type'=>'usuario','description'=>'Actualizar perfil']);
        Permission::create(['name'=>'orders_update','type'=>'pedidos','description'=>'Actualizar pedidos']);
        Permission::create(['name'=>'reports.day','type'=>'reportes','description'=>'Ver reportes por día']);
        Permission::create(['name'=>'reports.date','type'=>'reportes','description'=>'Ver reportes por fecha']);
        Permission::create(['name'=>'report.results','type'=>'reportes','description'=>'Ver resultados de reportes']);
        Permission::create(['name'=>'upload.image','type'=>'imagenes','description'=>'Subir imágenes']);
        Permission::create(['name'=>'upload_images_product','type'=>'imagenes','description'=>'Subir imágenes de productos']);
        Permission::create(['name'=>'get.images','type'=>'imagenes','description'=>'Ver imágenes']);
        Permission::create(['name'=>'file.delete','type'=>'archivos','description'=>'Eliminar archivos']);
        Permission::create(['name'=>'purchases.pdf','type'=>'compras','description'=>'Acceder al PDF de compras']);
        Permission::create(['name'=>'sales.pdf','type'=>'ventas','description'=>'Acceder al PDF de ventas']);
        Permission::create(['name'=>'sales.print','type'=>'ventas','description'=>'Impirimir ventas']);
        Permission::create(['name'=>'upload.purchases','type'=>'compras','description'=>'Actualizar compras']);
        Permission::create(['name'=>'change.status.products','type'=>'productos','description'=>'Cambiar estado de productos']);
        Permission::create(['name'=>'change.status.purchases','type'=>'compras','description'=>'Cambias estado de compras']);
        Permission::create(['name'=>'change.status.sales','type'=>'ventas','description'=>'Cambiar estado de ventas']);
        Permission::create(['name'=>'get_products_by_barcode','type'=>'productos','description'=>'Obtener prodcutos por código de barras']);
        Permission::create(['name'=>'get_products_by_id','type'=>'productos','description'=>'Obtener productos por ID']);
        Permission::create(['name'=>'print_barcode','type'=>'impresora','description'=>'Imprimir codigo de barras']);
        Permission::create(['name'=>'get_subcategories','type'=>'categorias','description'=>'Obtener subcategorias']);
        Permission::create(['name'=>'get_products_by_subcategory','type'=>'productos','description'=>'Obtener productos por subcategoría']);
        Permission::create(['name'=>'pay','type'=>'pedidos','description'=>'Pagar']);
        Permission::create(['name'=>'approval','type'=>'pedidos','description'=>'Aprobar']);
        Permission::create(['name'=>'cancelled','type'=>'pedidos','description'=>'Cancelar']);
        Permission::create(['name'=>'web.my_account','type'=>'cliente','description'=>'Cuenta de cliente']);
        Permission::create(['name'=>'web.checkout','type'=>'cliente','description'=>'Verificar compras del cliente']);
        Permission::create(['name'=>'web.orders','type'=>'cliente','description'=>'Pedidos del cliente']);
        Permission::create(['name'=>'web.order_details','type'=>'cliente','description'=>'Detalles del pedido de clientes']);
        Permission::create(['name'=>'web.account_info','type'=>'cliente','description'=>'Información del cliente']);
        Permission::create(['name'=>'web.address_edit','type'=>'cliente','description'=>'Actualizar dirección del cliente']);
        Permission::create(['name'=>'web.change_password','type'=>'cliente','description'=>'Cambiar contraseña del cliente']);
        Permission::create(['name'=>'web.rate_product','type'=>'cliente','description'=>'Calificar productos']);
        Permission::create(['name'=>'web.update_client','type'=>'cliente','description'=>'Actualizar datos del cliente']);
        Permission::create(['name'=>'web.update_password','type'=>'cliente','description'=>'Actualizar contraseña del cliente']);


        $admin->givePermissionTo([
            'users.index',
            'users.create',
            'users.store',
            'users.show',
            'users.edit',
            'users.update',
            'users.destroy',
            'home',
            'brands.index',
            'brands.create',
            'brands.store',
            'brands.edit',
            'brands.update',
            'brands.destroy',
            'tags.index',
            'tags.create',
            'tags.store',
            'tags.edit',
            'tags.update',
            'tags.destroy',
            'categories.index',
            'categories.create',
            'categories.store',
            'categories.show',
            'categories.edit',
            'categories.update',
            'categories.destroy',
            'products.index',
            'products.store',
            'products.show',
            'products.edit',
            'products.update',
            'products.destroy',
            'posts.index',
            'posts.store',
            'posts.show',
            'posts.edit',
            'posts.update',
            'posts.destroy',
            'social_medias.index',
            'social_medias.create',
            'social_medias.store',
            'social_medias.edit',
            'social_medias.update',
            'social_medias.destroy',
            'sliders.index',
            'sliders.store',
            'sliders.edit',
            'sliders.update',
            'sliders.destroy',
            'promotions.index',
            'promotions.create',
            'promotions.store',
            'promotions.edit',
            'promotions.update',
            'promotions.destroy',
            'clients.index',
            'clients.create',
            'clients.store',
            'clients.show',
            'clients.edit',
            'clients.update',
            'clients.destroy',
            'providers.index',
            'providers.create',
            'providers.store',
            'providers.show',
            'providers.edit',
            'providers.update',
            'providers.destroy',
            'roles.index',
            'roles.show',
            'printers.index',
            'printers.update',
            'orders.index',
            'orders.show',
            'sales.index',
            'sales.create',
            'sales.store',
            'sales.show',
            'purchases.index',
            'purchases.create',
            'purchases.store',
            'purchases.show',
            'business.index',
            'business.update',
            'subscriptions.index',
            'subscriptions.destroy',
            'update_product_status',
            'mark_all_notifications',
            'mark_a_notification',
            'update_profile',
            'orders_update',
            'reports.day',
            'reports.date',
            'report.results',
            'upload.image',
            'upload_images_product',
            'get.images',
            'file.delete',
            'purchases.pdf',
            'sales.pdf',
            'sales.print',
            'upload.purchases',
            'change.status.products',
            'change.status.purchases',
            'change.status.sales',
            'get_products_by_barcode',
            'get_products_by_id',
            'print_barcode',
            'get_subcategories',
            'get_products_by_subcategory',
            'pay',
            'approval',
            'cancelled',
            'web.my_account',
            'web.checkout',
            'web.orders',
            'web.order_details',
            'web.account_info',
            'web.address_edit',
            'web.change_password',
            'web.rate_product',
            'web.update_client',
            'web.update_password'
        ]);

        $cashier->givePermissionTo([
            'home',
            'clients.index',
            'clients.create',
            'clients.store',
            'clients.show',
            'clients.edit',
            'clients.update',
            'clients.destroy',
			'orders.index',
            'orders.show',
			'sales.index',
            'sales.create',
            'sales.store',
            'sales.show',
            'purchases.index',
            'purchases.create',
            'purchases.store',
            'purchases.show',
			'update_product_status',
            'mark_all_notifications',
            'mark_a_notification',
			'orders_update',
			'reports.day',
            'reports.date',
            'report.results',
			'purchases.pdf',
			'sales.pdf',
            'sales.print',
			'upload.purchases',
			'change.status.purchases',
			'change.status.sales',
			'get_products_by_barcode',
            'get_products_by_id',
			'print_barcode',
        ]);

        $client->givePermissionTo([
            'pay',
            'approval',
            'cancelled',
            'web.my_account',
            'web.checkout',
            'web.orders',
            'web.order_details',
            'web.account_info',
            'web.address_edit',
            'web.change_password',
            'web.rate_product',
            'web.update_client',
            'web.update_password'
        ]);


        $admin_user= User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=> Hash::make('lalala123123'),
            'user_type_id'=> 1
        ]);

       /*  $admin_user->profile()->create([
            'first_name'=>$admin_user->name,
        ]); */
        $admin_user->assignRole('Admin')->save();
        $cashier_user= User::create([
            'name'=>'Cashier',
            'email'=>'Cashier@gmail.com',
            'password'=> Hash::make('lalala123123'),
            'user_type_id'=> 3
        ]);
       /*  $cashier_user->profile()->create([
            'first_name'=>$cashier_user->name,
        ]); */
        $cashier_user->assignRole('Cashier')->save();
        $client_user= User::create([
            'name'=>'Client',
            'email'=>'Client@gmail.com',
            'password'=> Hash::make('lalala123123'),
            'user_type_id'=> 2
        ]);
        /* $client_user->profile()->create([
            'first_name'=>$client_user->name,
        ]); */
        $client_user->assignRole('Client')->save();
    }
}
