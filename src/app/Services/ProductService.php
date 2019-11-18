<?php


namespace App\Services;


use App\Interfaces\ProductServiceInterface;
use App\Product;
use App\ProductAttribute;
use Illuminate\Http\Request;

class ProductService implements ProductServiceInterface
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function getAll(Request $request)
    {
        return Product::with('attributes')->get();
    }

    /**
     * @param Request $request
     * @return Product|mixed
     */
    public function create(Request $request)
    {
        $product = new Product();
        $product->fill($request->all());
        $product->save();

        if ($product) {
            $this->saveProductAttributes($product, $request->get('attributes'));
        }

        return $product;
    }

    /**
     * @param Product $product
     * @param $attributes
     * @return void
     */
    public function saveProductAttributes(Product $product, $attributes)
    {
        $productAttributes = [];
        foreach ($attributes as $k => $v)
        {
            $productAttributes[] = ['product_id' => $product->id,
                'key' => $k, 'value' => $v];
        }
        ProductAttribute::insert($productAttributes);
    }

}
