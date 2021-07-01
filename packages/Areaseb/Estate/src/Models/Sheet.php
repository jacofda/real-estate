<?php

namespace Areaseb\Estate\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sheet extends Model
{
    protected $table = 'property_sheets';
    protected $fillable = [
        'client_id',
        'user_id',
        'signed',
        'signed_at'
    ];
    protected $dates = [
        'signed_at'
    ];

    /**
     * --------
     * FUNCTIONS
     * --------
     */

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Let's create the uuid when the model is created
        self::creating(function ($query) {
            $query->uuid = Str::uuid();
        });
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete()
    {
        $this->views->each(function ($view) {
            $view->sheet()->dissociate();
            $view->save();
        });
        parent::delete();
    }

    /**
     * --------
     * RELATIONSHIPS
     * --------
     */

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function views()
    {
        return $this->hasMany(View::class, 'property_sheet_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * --------
     * SCOPES
     * --------
     */
    public function scopeUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid);
    }

    public function scopeNotSigned($query)
    {
        return $query->where('signed', false);
    }

    public function scopeSigned($query)
    {
        return $query->where('signed', true);
    }

    /**
     * --------
     * ACCESSOR
     * --------
     */

    //get class name
    public function getClassAttribute() {
        $arr = explode("\\", get_class($this));
        return end($arr);
    }

    public function getTransClassAttribute() {
        return 'Foglio di visita';
    }

    public function getDirectoryAttribute() {
        return str_plural(strtolower($this->class));
    }
}
