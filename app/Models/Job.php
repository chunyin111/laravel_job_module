<?php 

namespace App\Models;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class job extends Model{
    use HasFactory;

    protected $table = 'job_listings';

    protected $guarded = [];
    // protected $guarded = []; // this is whitelist the column which need guard
    protected $isFillable;

    public function employer(){
        // dd($this->isFillable('title'));
        return $this->belongsTo(Employer::class);
    }

    public function tags(){
        // return $this->belongsToMany(Tag::class, null, 'job_listing_id'); can write like this also
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listing_id');
    }
    
}