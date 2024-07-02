<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Products extends Model
{
  use HasFactory;
  protected $fillable = [
    'producto',
    'precio',
    'descuento',
    'preciofiltro',
    'stock',
    'imagen',
    'destacar',
    'liquidacion',
    'recomendar',
    'atributes',
    'visible',
    'status',
    'extract',
    'description',
    'costo_x_art',
    'peso',
    'categoria_id',
    'collection_id',
    'sku',
    'order'
  ];


  public function categoria()
  {
      return $this->belongsTo(Category::class);
  }

  public function collection()
  {
      return $this->belongsTo(Collection::class);
  }

  public function galeria(){
    return $this->hasMany(Galerie::class, 'product_id');
  }

  public function tags()
  {
      return $this->belongsToMany(Tag::class, 'tags_xproducts', 'producto_id', 'tag_id');
  }
  
  public function scopeActiveDestacado($query)
  {
      return $query->where('status', true)->where('destacar', true);
  }

  public function attributeValues()
    {
        return $this->hasMany(AttributesValues::class, 'product_id');
                  
    }

  
  public function attributes()
  {
      return $this->belongsToMany(Attributes::class, 'attribute_product_values', 'product_id', 'attribute_id')
          ->withPivot('attribute_value_id');
          
  }

  public function images()
    {
        return $this->hasMany(ImagenProducto::class, 'product_id');
    }

  public function combinations()
    {
        return $this->hasMany(Combinacion::class, 'product_id');
    }


  public static function obtenerProductos($categoria_id = '', $paginado, $orden = ''){
    $return = Products::select('products.*','categories.name as category_name')->join('categories', 'categories.id', '=', 'products.categoria_id');

    if(!empty($categoria_id)){
        $return = $return->where('categoria_id', '=', $categoria_id);
    }

    $categoriesId = request()->get('categories_id');
    if(!empty($categoriesId)){
        $category_id = rtrim($categoriesId, ',');
        $category_id_array = explode(",", $category_id);
        $return = $return->whereIn('products.categoria_id', $category_id_array);
    }


    $collectionId = request()->get('coleccion_id');
    if(!empty($collectionId)){
        $collection_id = rtrim($collectionId, ',');
        $collection_id_array = explode(",", $collection_id);
        $return = $return->whereIn('products.collection_id', $collection_id_array);
    }
    

    $coloresId = request()->get('color_id');
    if(!empty($coloresId)){
        $colores_id = rtrim($coloresId, ',');
        $coloresId_array = explode(",", $colores_id);
        $return = $return->join('imagen_productos', "imagen_productos.product_id", '=', 'products.id');
        $return = $return->whereIn('imagen_productos.color_id', $coloresId_array);
    }


    $tallasId = request()->get('talla_id');
    if(!empty($tallasId)){
        $tallas_id = rtrim($tallasId, ',');
        $tallas_id_array = explode(",", $tallas_id);
        $return = $return->join('combinaciones', "combinaciones.product_id", '=', 'products.id');
        $return = $return->whereIn('combinaciones.talla_id', $tallas_id_array);
    }

    $preciosId = request()->get('precio_id');
    if(!empty($preciosId)){
        $precios_id = rtrim($preciosId, ',');
        $precios_id_array = explode(",", $precios_id);

        $rangos = []; 

        foreach ($precios_id_array as $rango) {
            if (strpos($rango, '_') !== false) {
                list($min, $max) = explode("_", $rango);
                $rangos[] = ['min' => (float)$min, 'max' => (float)$max];
            }
        }
        

        $return = $return->where(function ($query) use ($rangos) {
            foreach ($rangos as $rango) {
                $query->orWhere(function ($query) use ($rango) {
                    $query->whereBetween('products.preciofiltro', [$rango['min'], $rango['max']]);
                });
            }
        });
       
    }

    if ($orden !== '') {
        if ($orden == 'price_high') {
            $return = $return->orderBy('precio', 'desc');
        } elseif ($orden == 'price_low') {
            $return = $return->orderBy('precio', 'asc');
        } elseif ($orden == 'oldest') {
            $return = $return->orderBy('created_at', 'asc');
        }
    }


    $return = $return->where('products.status', '=', 1)
          ->where('products.visible', '=', 1)
          ->with('tags')
          ->groupBy('products.id')
          ->orderBy('products.order', 'ASC')
          ->paginate($paginado);

    return $return;

  }


    // public function attributeValues()
    // {
    //     return $this->hasMany(AttributesValues::class, 'attribute_id', 'id');
    // }

    // public function attributes()
    // {
    //     return $this->belongsToMany(Attributes::class, 'attribute_product_values', 'product_id', 'attribute_id')
    //         ->withPivot('attribute_value_id')
    //         ->with('attributeValues');
    // }


}
