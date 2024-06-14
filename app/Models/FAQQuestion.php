<?php
namespace App\Models;
use App\Models\FAQCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQQuestion extends Model
{
    use HasFactory;
    
    public function category() {
        return $this->belongsTo('App\Models\FAQCategory');
    }
}