<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $table = 'detail_peminjaman';
    protected $fillable = [
        'peminjaman_id',
        'book_id',
    ];

    public function book()
    {
        return $this->belongsTo(Buku::class, 'book_id');
    }
}
