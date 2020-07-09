<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = [
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'user_id',
        'denda',
    ];

    protected $appends = [
        'denda_format'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detail_peminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'peminjaman_id');
    }

    public function getDendaFormatAttribute()
    {
        $tgl_sekarang = time();
        $tgl_pengembalian = strtotime($this->tanggal_pengembalian);

        $diff = $tgl_sekarang - $tgl_pengembalian;

        $result = 0;
        if ($diff > 0) {
            $result = $this->denda;
        }

        return 'Rp '.number_format($result);
    }
}