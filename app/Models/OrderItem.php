<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory;

    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
      'order_id',
      'product_id',
      'quantity',
      'unit_price',
      'total_price',
    ];

    /**
     * @return BelongsTo
     */
    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
