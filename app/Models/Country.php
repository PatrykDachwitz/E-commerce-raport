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
        "facebook_daily_budget" => "integer",
        "google_daily_budget" => "integer",
        "facebook_budget_currency" => "string",
        "google_budget_currency" => "string",
        "result-summary" => "bool"
    ];

    protected $fillable = [
        "name",
        "google",
        "shop",
        "facebook",
        "analytics",
        "active",
        "facebook_daily_budget",
        "google_daily_budget",
        "facebook_budget_currency",
        "google_budget_currency",
        "result-summary",
    ];

    public function scopeActive() {
        return $this->where("active", true);
    }

}
