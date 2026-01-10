<?php

namespace App\Models\Transaksi;

use App\Models\Master\Driver;
use App\Models\Master\Kendaraan;
use App\Models\Master\Material;
use App\Models\Master\Suplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perjalanan extends Model
{
    use HasFactory;
    protected $table = 'perjalanan';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'tanggal',
        'kode',
        'kendaraan_id',
        'driver_id',
        'suplier_id',
        'material_id',
        'volume',
        'berat_total',
        'berat_kendaraan',
        'berat_muatan',
        'status'
    ];

    /**
     * Get the material that owns the Perjalanan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }

    /**
     * Get the user that owns the Perjalanan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id', 'id');
    }

    /**
     * Get the driver that owns the Perjalanan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }

    /**
     * Get the suplier that owns the Perjalanan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function suplier(): BelongsTo
    {
        return $this->belongsTo(Suplier::class, 'suplier_id', 'id');
    }
}
