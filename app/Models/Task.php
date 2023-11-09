<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Task extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $primaryKey = 'task_id';
    protected $guarded = [];




    public function getPriorityTextAttribute()
    {
        $priority = $this->priority;
        if ($priority == 1) {
            $text = 'Low';
        } elseif ($priority == 2) {
            $text = 'Medium';
        } elseif ($priority == 3) {
            $text = 'High';
        }
        return $text;
    }

    public function getStatusTextAttribute()
    {
        $status = $this->status;
        if ($status == 1) {
            $text = 'Working';
        } elseif ($status == 2) {
            $text = 'Completed';
        } elseif ($status == 3) {
            $text = 'Cancelled';
        }
        return $text;
    }
    public function getImageUrlAttribute()
    {
        $task_id = $this->task_id;
        $media = Media::where('model_id', $task_id)->get();
        $file = json_decode($media, TRUE);
        $filename = $file[0]['file_name'];
        $mediaId = $file[0]['id'];
        $server =  $_SERVER['HTTP_HOST'];
        
        $url = 'uploads/'.$mediaId.'/'.$filename;
        return $url;
    }
    
    protected $appends = ['PriorityText', 'StatusText', 'ImageUrl'];
    

}
