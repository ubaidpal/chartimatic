<?php
namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class StoreAlbumPhotos extends Model
{
    protected $table = 'store_album_photos';
    protected $primaryKey = 'photo_id';

    protected $fillable =  [''];

    public function storageFile() {
        return $this->hasOne('Cartimatic\Store\StoreStorageFiles', 'file_id', 'file_id');
    }
}
