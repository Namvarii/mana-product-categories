<?php

namespace ManaCMS\ManaProductCategories\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use ManaCMS\ManaProductCategories\Models\ProductCategory;

class CategoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $category = ProductCategory::updateOrCreate(
            ['id'=>$row['id']],
            [
                'level' => $row['level'] != null ? $row['level']-1  : 0,
                'parent_id' => $row['parent'] != null ? $row['parent'] : null,
                'title' => $row['title'] ,
                'slug' => $row['slug'] == null ? str_slug($row['title']) : str_slug($row['slug']),
                'desc' => $row['description'] != null ? $row['description'] : "محصولات موجود در دسته «{$row['title']}»",
            ]
        );
        return $category;
    }
}
