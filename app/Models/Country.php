<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $casts = [
        "name" => 'string',
        "google" => 'string',
        "shop" => 'integer',
        "facebook" => 'string',
        "analytics" => 'string',
        "active" => 'bool',
    ];

    protected $fillable = [
        "name",
        "google",
        "shop",
        "facebook",
        "analytics",
        "active",
    ];

    public function scopeActive() {
        return $this->where("active", true);
    }

}
