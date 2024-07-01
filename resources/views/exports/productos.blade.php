<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products Export</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }

    th {

      background-color: #eee;
      padding: 5px !important;
      border-bottom: 0.1px solid #ccc;
      height: 25px;
    }

    .product-row {
      border-top: 2px solid black;
    }
  </style>
</head>

<body>
  <table>
    <thead>
      <tr>
        <th>Producto ID</th>
        <th>Producto Nombre</th>
        <th>Precio</th>
        <th>Descuento</th>
        <th>SKU</th>
        <th>Costo por Producto</th>
        <th>Color</th>
        <th>Talla</th>
        <th>Stock</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
        <tr class="product-row">
          <td rowspan="{{ $product->combinations->count() + 1 }}">{{ $product->id }}</td>
          <td rowspan="{{ $product->combinations->count() + 1 }}">{{ $product->producto }}</td>
          <td rowspan="{{ $product->combinations->count() + 1 }}">{{ $product->precio }}</td>
          <td rowspan="{{ $product->combinations->count() + 1 }}">{{ $product->descuento }}</td>
          <td rowspan="{{ $product->combinations->count() + 1 }}">{{ $product->sku }}</td>
          <td rowspan="{{ $product->combinations->count() + 1 }}">{{ $product->costo_x_art }}</td>
        </tr>
        @foreach ($product->combinations as $combination)
          <tr>
            <td>{{ $combination->color->valor ?? 'N/A' }}</td>
            <td>{{ $combination->talla->valor ?? 'N/A' }}</td>
            <td>{{ $combination->stock ?? 0 }}</td>
          </tr>
        @endforeach
      @endforeach
    </tbody>
  </table>
</body>

</html>
