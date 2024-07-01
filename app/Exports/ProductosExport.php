<?php

namespace App\Exports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ProductosExport implements FromQuery, WithHeadings, WithMapping, WithEvents, ShouldAutoSize
{
    public function query()
    {
        return Products::query()->with('combinations');
    }

    public function headings(): array
    {
        return [
            'Producto ID', 'Producto Nombre', 'Precio', 'Descuento', 'SKU', 'Costo por Producto', 'Color', 'Talla', 'Stock'
        ];
    }

    public function map($product): array
    {
        $rows = [];

        $firstRow = [
            $product->id,
            $product->producto,
            $product->precio,
            $product->descuento,
            $product->sku,
            $product->costo_x_art,
            '', // empty cell for color
            '', // empty cell for talla
            '', // empty cell for stock
        ];

        $rows[] = $firstRow;

        foreach ($product->combinations as $combination) {
            $rows[] = [
                '', // empty cell for id
                '', // empty cell for product name
                '', // empty cell for price
                '', // empty cell for discount
                '', // empty cell for SKU
                '', // empty cell for cost per product
                $combination->color->valor ?? 'N/A',
                $combination->talla->valor ?? 'N/A',
                $combination->stock ?? 0,
            ];
        }

        return $rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $lastRow = $sheet->getHighestRow();

                // Define initial style array for borders
                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ];

                // Apply initial style to entire range
                $sheet->getStyle('A1:I' . $lastRow)->applyFromArray($styleArray);

                // Remove bottom border from last row
                $sheet->getStyle('A' . $lastRow . ':I' . $lastRow)->applyFromArray([
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Remove bottom border from rows that are not the last row of their product group
                for ($row = 2; $row <= $lastRow; $row++) {
                    $currentProductId = $sheet->getCell('A' . $row)->getValue();
                    $previousProductId = $sheet->getCell('A' . ($row - 1))->getValue();

                    if ($currentProductId !== $previousProductId) {
                        // Remove bottom border from the previous row of this product group
                        $sheet->getStyle('A' . ($row - 1) . ':I' . ($row - 1))->applyFromArray([
                            'borders' => [
                                'bottom' => [
                                    'borderStyle' => Border::BORDER_NONE,
                                ],
                            ],
                        ]);
                    }
                }
            },
        ];
    }
}
