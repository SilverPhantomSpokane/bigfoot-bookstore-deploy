<?php
namespace App\Models;
use Illuminate\Support\Str;


use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;     
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','price','description','image','department_id','item_number','user_id'];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->item_number)) {
                $product->item_number = 'ITEM-' . strtoupper(Str::random(6));
            }
        });
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

}

