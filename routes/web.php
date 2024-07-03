<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AttributesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CampaignController;

use App\Http\Controllers\MessageController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DescargarPdfController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\LogosClientController;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LibroReclamacionesController;
use App\Http\Controllers\LiquidacionController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\PoliticasdeCambioController;
use App\Http\Controllers\PoliticasEnvioController;
use App\Http\Controllers\PolyticsConditionController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StrengthController;
use App\Http\Controllers\ValoresAtributosController;

use App\Http\Controllers\TagController;
use App\Http\Controllers\TermsAndConditionController;
use App\Models\AboutUs;
use App\Models\Price;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Las rutas publicas */
Route::get('/', [IndexController::class, 'index'] )->name('index');
Route::get('/nosotros', [IndexController::class, 'nosotros'] )->name('nosotros');
Route::get('/servicios', [IndexController::class, 'servicios'] )->name('servicios');
Route::get('/comentario', [IndexController::class, 'comentario'] )->name('comentario');
Route::post('/comentario/nuevo', [IndexController::class, 'hacerComentario'] )->name('nuevocomentario');
Route::get('/contacto', [IndexController::class, 'contacto'] )->name('contacto');
Route::get('/preguntasFrecuentes', [IndexController::class, 'preguntasFrecuentes'] )->name('preguntasFrecuentes');




/* Proceso de pago */
Route::get('/carrito', [IndexController::class, 'carrito'] )->name('carrito');
Route::get('/pago', [IndexController::class, 'pago'] )->name('pago');
Route::post('/procesar/pago',[IndexController::class, 'procesarPago'])->name('procesar.pago');
Route::post('/agradecimiento', [IndexController::class, 'agradecimiento'] )->name('agradecimiento');
/* Catálogo y producto */
Route::get('/producto/{id}', [IndexController::class, 'producto'] )->name('producto');
Route::get('/catalogo/{filtro}', [IndexController::class, 'catalogo'] )->name('catalogo');
Route::post('carrito/buscarProducto', [CarritoController::class, 'buscarProducto'] )->name('carrito.buscarProducto');
Route::get('/coleccion/{filtro}', [IndexController::class, 'coleccion'] )->name('coleccion');
Route::get('/liquidacion', [IndexController::class, 'liquidacion'] )->name('liquidacion');
Route::get('/novedades', [IndexController::class, 'novedades'] )->name('novedades');
Route::get('/buscar', [IndexController::class, 'searchProduct'])->name('buscar');
Route::post('/procesarcarrito', [IndexController::class, 'procesarCarrito'])->name('procesar.carrito');
Route::post('catalogo_filtro_ajax', [IndexController::class, 'catalogoFiltroAjax'])->name('catalogo_filtro_ajax');
Route::post('cambiogaleria', [IndexController::class, 'cambioGaleria'])->name('cambioGaleria');

/* Página 404 */
Route::get('/404', [IndexController::class, 'error'] )->name('error');
/* Formulario de contacto */
Route::post('guardarContactos', [IndexController::class, 'guardarContacto'] )->name('guardarContactos');

Route::post('/getProvincia', [PriceController::class, 'getProvincias'])->name('prices.getProvincias');
Route::post('/getDistrito', [PriceController::class, 'getDistrito'])->name('prices.getDistrito');
Route::post('/calculeEnvio', [PriceController::class, 'calculeEnvio'])->name('prices.calculeEnvio');

Route::get('/politicas-de-devolucion', [IndexController::class, 'politicasDevolucion'])->name('politicas_dev');
Route::get('/terminos-y-condiciones', [IndexController::class, 'TerminosyCondiciones'])->name('terms_condition');
Route::get('/libro-de-reclamaciones', [IndexController::class, 'librodereclamaciones'] )->name('librodereclamaciones');


Route::get('/obtenerProvincia/{departmentId}', [IndexController::class, 'obtenerProvincia'])->name('obtenerProvincia');
Route::get('/obtenerDistritos/{provinceId}', [IndexController::class, 'obtenerDistritos'])->name('obtenerDistritos');
Route::post('/guardarDireccion', [IndexController::class, 'guardarDireccion'])->name('guardar.direccion');
Route::get('/politica-cambio/', [IndexController::class, 'politicaDeCambio'])->name('politicaDeCambio');
Route::get('/politica-envio/', [IndexController::class, 'pliticaDeEnvio'])->name('politicaDeEnvio');







Route::middleware(['auth:sanctum', 'verified', 'can:Admin'])->group(function () {

    Route::prefix('admin')->group(function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('analytics');
        Route::get('/dashboard/fintech', [DashboardController::class, 'fintech'])->name('fintech');

        Route::resource('/politicas-de-devolucion', PolyticsConditionController::class);

        Route::resource('/terminos-y-condiciones', TermsAndConditionController::class);



        //messages
        Route::resource('/mensajes', MessageController::class);
        Route::post('/mensajes/borrar', [MessageController::class, 'borrar'])->name('mensajes.borrar');

        //Datos Generales
        Route::resource('/datosgenerales', GeneralController::class);
        Route::post('/datosgenerales/statusBaner',[ GeneralController::class,'statusBaner'])->name('datosgenerales.statusBaner');
        
        Route::post('/datosgenerales/json', [GeneralController::class, 'updateJson'])->name('newArribals.updateJson');


        //Testimonies
        Route::resource('/testimonios', TestimonyController::class);
        Route::post('/testimonios/deleteTestimony', [TestimonyController::class, 'deleteTestimony'] )->name('testimonios.deleteTestimony');
        Route::post('/testimonios/updateVisible', [TestimonyController::class, 'updateVisible'] )->name('testimonios.updateVisible');

        //Categorías
        Route::resource('/categorias', CategoryController::class);
        Route::post('/categorias/deleteCategory', [CategoryController::class, 'deleteCategory'] )->name('categorias.deleteCategory');
        Route::post('/categorias/updateVisible', [CategoryController::class, 'updateVisible'] )->name('categorias.updateVisible');
        Route::get('/categorias/contarCategorias', [CategoryController::class, 'contarCategoriasDestacadas'] )->name('categorias.contarCategoriasDestacadas');



        //Servicios
        Route::resource('/servicios', ServiceController::class);
        Route::post('/servicios/deleteService', [ServiceController::class, 'deleteService'] )->name('servicio.deleteService');
        Route::post('/servicios/updateVisible', [ServiceController::class, 'updateVisible'] )->name('servicio.updateVisible');


        //Blog
        Route::resource('/blog', BlogController::class);
        Route::post('/blog/deleteBlog', [BlogController::class, 'deleteBlog'] )->name('blog.deleteBlog');
        Route::post('/blog/updateVisible', [BlogController::class, 'updateVisible'] )->name('blog.updateVisible');

        //Crud Logos
        Route::resource('/logos', LogosClientController::class);
        Route::post('/logos/deleteLogo', [LogosClientController::class, 'deleteLogo'] )->name('logos.deleteLogo');

        //Equipo
        Route::resource('/staff', StaffController::class);
        Route::post('/staff/updateVisible', [StaffController::class, 'updateVisible'])->name('staff.updateVisible');

        //Beneficios    
        Route::resource('/strength', StrengthController::class);
        Route::post('/strength/updateVisible', [StrengthController::class, 'updateVisible'])->name('strength.updateVisible');
        Route::post('/strength/borrar', [StrengthController::class, 'borrar'])->name('strength.borrar');
      
        
        //Nosotros
        Route::resource('/aboutus', AboutUsController::class);
        Route::post('/aboutus/updateVisible', [AboutUsController::class, 'updateVisible'])->name('aboutus.updateVisible');
        Route::post('/aboutus/borrar', [AboutUsController::class, 'borrar'])->name('aboutus.borrar');
       
        //Atributes
        Route::resource('/attributes', AttributesController::class);
        Route::post('/attributes/updateVisible', [AttributesController::class, 'updateVisible'])->name('attributes.updateVisible');
        Route::post('/attributes/borrar', [AttributesController::class, 'borrar'])->name('attributes.borrar');

        //valores atributes
        Route::resource('/valoresattributes', ValoresAtributosController::class);
        Route::post('/valoresattributes/borrar', [ValoresAtributosController::class, 'borrar'])->name('valoresattributes.borrar');
        Route::post('/valoresattributes/updateVisible', [ValoresAtributosController::class, 'updateVisible'])->name('valoresattributes.updateVisible');

        //Etiquetas
        Route::resource('/tags', TagController::class);
        Route::post('/tags/deleteTags', [TagController::class, 'deleteTags'])->name('tags.deleteTags');

        //Precios
        Route::resource('/prices', PriceController::class);
       

        //Productos
        Route::resource('/products', ProductsController::class);
        Route::post('/products/updateVisible', [ProductsController::class, 'updateVisible'])->name('products.updateVisible');
        Route::post('/products/borrar', [ProductsController::class, 'borrar'])->name('products.borrar');
        Route::post('/products/borrarimg', [ProductsController::class, 'borrarimg'])->name('products.borrarimg');
        Route::post('/products/buscaCombinacion', [ProductsController::class, 'buscaCombinacion'])->name('products.buscaCombinacion');
        Route::post('/products/actualizarStock', [ProductsController::class, 'actualizarStock'])->name('products.actualizarStock');

        //Preguntas frecuentes
        Route::resource('/faqs', FaqsController::class);
        Route::post('/faqs/updateVisible', [FaqsController::class, 'updateVisible'])->name('faqs.updateVisible');
        Route::post('/faqs/borrar', [FaqsController::class, 'borrar'])->name('faqs.borrar');

        //Sliders   
        Route::resource('/slider', SliderController::class);
        Route::post('/slider/updateVisible', [SliderController::class, 'updateVisible'])->name('slider.updateVisible');
        Route::post('/slider/deleteSlider', [SliderController::class, 'deleteSlider'])->name('slider.deleteSlider');

        //Liquidacion   
        Route::resource('/liquidacion', LiquidacionController::class);
        Route::post('/liquidacion/updateVisible', [LiquidacionController::class, 'updateVisible'])->name('liquidacion.updateVisible');
        Route::post('/liquidacion/deleteSlider', [LiquidacionController::class, 'deleteLiquidacion'])->name('liquidacion.deleteLiquidacion');

        //Galeria
        Route::resource('/galerie', GalerieController::class);
        Route::post('/galerie/updateVisible', [GalerieController::class, 'updateVisible'])->name('galerie.updateVisible');
        Route::post('/galerie/borrar', [GalerieController::class, 'borrar'])->name('galerie.borrar');

        //Colecciones
        Route::resource('/colecciones', CollectionController::class);
        Route::post('/colecciones/deleteCollection', [CollectionController::class, 'deleteCollection'] )->name('collection.deleteCollection');
        Route::post('/colecciones/updateVisible', [CollectionController::class, 'updateVisible'] )->name('collection.updateVisible');

        //Pedidos
        Route::get('/orders', [PedidosController::class, 'listadoPedidos'])->name('orders');
        Route::get('/orders/{id}', [PedidosController::class, 'verPedido'])->name('verPedido');
        
        Route::post('guardarformulario', [LibroReclamacionesController::class, 'storePublic'] )->name('guardarFormReclamo');

        Route::resource('/reclamo', LibroReclamacionesController::class);
        Route::post('/reclamo/borrar', [LibroReclamacionesController::class, 'borrar'])->name('reclamo.borrar');

        Route::get('/politica-cambio',[PoliticasdeCambioController::class, 'index'])->name('politicadeCambio.index');
        Route::post('/politica-cambio/guardar/{id}',[PoliticasdeCambioController::class, 'guardar'])->name('politicadeCambio.guardar');

        Route::get('/politica-envio',[PoliticasEnvioController::class, 'index'])->name('PoliticadeEnvio.index');
        Route::post('/politica-envio/guardar/{id}',[PoliticasEnvioController::class, 'guardar'])->name('PoliticadeEnvio.guardar');

        


        Route::get('/descargarpdf/detalleOrdenes/{id}',[DescargarPdfController::class, '__invoke'])->name('descargarPdf.ordenes');
        Route::get('/descargarpdf/mensajes/{id}',[DescargarPdfController::class, 'mensajes'])->name('descargarPdf.mensaje');

        Route::get('/productos/export', [ProductsController::class, 'export'])->name('productos.export');

        Route::fallback(function() {
            return view('pages/utility/404');
        });
        
    });
    
});


Route::middleware(['auth:sanctum', 'verified', 'can:Customer'])->group(function () {

 Route::get('/micuenta', [IndexController::class, 'micuenta'] )->name('micuenta');
 Route::get('/micuenta/pedidos', [IndexController::class, 'pedidos'] )->name('pedidos');
 Route::get('/micuenta/direccion', [IndexController::class, 'direccion'] )->name('direccion');
 Route::post('/micuenta/direccion/direccionFavorita', [IndexController::class, 'direccionFavorita'])->name('direccionFavorita');

 Route::post('/micuenta/cambiofoto', [IndexController::class, 'cambiofoto'] )->name('cambiofoto');
 Route::post('/micuenta/direccion/cambiofoto', [IndexController::class, 'cambiofoto'] )->name('cambiofoto');
 Route::post('/micuenta/pedidos/cambiofoto', [IndexController::class, 'cambiofoto'] )->name('cambiofoto');



 Route::post('/micuenta/actualizarPerfil', [IndexController::class, 'actualizarPerfil'] )->name('actualizarPerfil');


});