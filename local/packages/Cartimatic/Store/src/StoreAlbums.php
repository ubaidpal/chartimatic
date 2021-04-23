<?php
namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class StoreAlbums extends Model
{
    protected $table = 'store_albums';
    protected $primaryKey = 'album_id';

    protected $fillable =  [''];
    public function albumPhoto() {
        return $this->hasMany('Cartimatic\Store\StoreAlbumPhotos', 'album_id');
    }
}
