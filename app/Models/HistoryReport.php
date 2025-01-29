<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
      'type' => 'string',
      'date' => 'string',
      'name' => 'string',
    ];

    protected $fillable = [
        'type',
        'date',
        'string',
    ];
}
