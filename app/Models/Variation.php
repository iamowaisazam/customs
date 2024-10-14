<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Variation extends Model
{
    protected $table = 'variations';

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        "id",
        "product_id",
        "sku",
        "quantity",
        "price",
        "image",
        "created_at",
        "updated_at"
    ];


     // Relationship to itself for parent-child relationship
     public function attributes()
     {
         return $this->hasMany(VariationAttribute::class, 'variation_id');
     }

     public function product()
     {
         return $this->belongsTo(Product::class, 'product_id');
     }

   /**
     * Check if a variation ID exists in the variations table.
     *
     * @param  int  $id
     * @return bool
     */
    public static function idExists($id)
    {
        $variationAttribute = VariationAttribute::where('value_id', $id)->first();
        
        if ($variationAttribute) {
            return self::where('id', $variationAttribute->variation_id)->first();
        } else {
            return null;
        }
    }

     
}