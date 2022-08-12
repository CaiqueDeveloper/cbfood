<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      if($row[2] != "" && $row[4] != "" && $row[4] != "Preco de Venda"){
        
            $id = Company::find(auth()->user()->company_id)->category()->updateOrCreate(['name' => 'NÃO DEFINIDA'])->id;
            return Company::find(auth()->user()->company_id)->product()->
            updateOrCreate(
                ['name' => $row[2]],
                ['name' => $row[2],'price' => $row[4], 'category_id' =>  $id]
            );
       }
         
    }
    
}
