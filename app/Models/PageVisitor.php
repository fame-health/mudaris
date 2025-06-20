<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageVisitor extends Model
{
    protected $fillable = ['page_name', 'visit_count'];

    public static function incrementVisit($pageName)
    {
        $visitor = self::firstOrCreate(
            ['page_name' => $pageName],
            ['visit_count' => 0]
        );

        $visitor->increment('visit_count');
        return $visitor;
    }
}
