<?php

    namespace Modules\Banners\Entities;

    use Illuminate\Database\Eloquent\Model;

    class File extends Model
    {
        protected $table = 'banners_files';

        protected $fillable = ['banner_id', 'filename'];

        /**
         * Relation with banner
         */
        public function banner()
        {
            return $this->belongsTo(Banner::class);
        }

    }
