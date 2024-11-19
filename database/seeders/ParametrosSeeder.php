<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Parametro;

class ParametrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parametro::create([
            'nombre' => 'nombre_sistema',
            'valor' => 'Presitex',
            'descripcion' => 'Nombre que muestra el sistema',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'razon_social',
            'valor' => 'Empresa Comercial',
            'descripcion' => 'Denominación social del propietario del sistema',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'version_sistema',
            'valor' => 'v7',
            'descripcion' => 'Version del sistema',
            'access_level' => 1
        ]);
        // Parametro::create([
        //     'nombre' => 'logo_sistema',
        //     'valor' => 'data:image/png;base64,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'
        // ]);
        Parametro::create([
            'nombre' => 'logo_sistema_path',
            //'valor' => 'favicons/favicon32x32.ico'
            'valor' => 'img/logo_p.png',
            'descripcion' => 'logo del sistema',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'existencias_min',
            'valor' => '10',
            'descripcion' => 'Número de existencias minimas de productos',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'existencias_max',
            'valor' => '200',
            'descripcion' => 'Número de existencias máximas de productos',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'mensaje_bienvenida',
            'valor' => 'Somos una empresa comercial especializada en material textil, ¡Disfrute su estancia!',
            'descripcion' => 'Mensaje de bienvenida de página principal',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'descripción_empresa',
            'valor' => 'En nuestra empresa puedes disfrutar de un excelente Servicio de Atención al Cliente y de un amplio surtido de material textil, herramientas textiles, asesoramiento, etc. Todo lo que necesites para la manufactura textil lo puedes encontrar en Presitex.',
            'descripcion' => 'Descripción de la empresa que se muestra en la Home page del sistema',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'mision',
            'valor' => 'Distribuir productos textiles e innovadores de alta calidad que cumplan con las necesidades de nuestros clientes, brindando siempre un servicio de excelencia, para así lograr la rentabilidad que permita el crecimiento de nuestra empresa como el de nuestros colaboradores.',
            'descripcion' => 'Mision de la empresa que se muestra en la Home page del sistema',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'vision',
            'valor' => 'Ser una empresa líder entre el sector textil reconocida por su calidad y servicio a nivel nacional, promoviéndose siempre como una oportunidad para asociarse con cualquier otra industria y describiéndose como un lugar extraordinario para emprender su negocio.',
            'descripcion' => 'Vision de la empresa que se muestra en la Home page del sistema',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'localidad_empresa',
            'valor' => 'La Paz',
            'descripcion' => 'Cuidad donde opera la empresa',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'direccion_empresa',
            'valor' => 'Calle Isaac Tamayo, Galería "Centro Comercial Isaac Tamayo", 1er Piso (Local 103 - 104) La Paz, Bolivia, Bolivia',
            'descripcion' => 'Ubicación donde realiza actividades la empresa',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'correo_empresa',
            'valor' => 'presitex.tex@gmail.com',
            'descripcion' => 'Correo de la empresa que se muestra en la Home page del sistema y en reportes',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'telefono_empresa',
            'valor' => '(+591)2-460674|(+591)65788201',
            'descripcion' => 'Telefono de la personal de los propietarios de la empresa',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'telefono_contacto',
            'valor' => '(+591)2-460674|(+591)73238038|(+591)71996788',
            'descripcion' => 'Numeros de contacto de la empresa que se muestra en la Home page del sistema y en reportes',
            'access_level' => 2
        ]);
        Parametro::create([
            'nombre' => 'fecha_compra_venta',
            'valor' => 'true',
            'descripcion' => 'Campo Fecha para establecer manualmente en los forms de compra y venta',
            'access_level' => 1
        ]);
        Parametro::create([
            'nombre' => 'titulo_comprobante_venta',
            'valor' => 'Nota de venta',
            'descripcion' => 'Rotulo de titulo del comprobante de venta',
            'access_level' => 1
        ]);
    }
}
