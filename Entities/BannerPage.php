<?php

    namespace Modules\Banners\Entities;

    use App\Models\Page;
    use Illuminate\Database\Eloquent\Model;

    class BannerPage extends Model
    {
        protected $table = 'banners_pages';

        protected $fillable = ['banner_id', 'page_id'];

        /**
         * Relation with banner
         */
        public function banner()
        {
            return $this->belongsTo(Banner::class);
        }

        /**
         * Relation with page
         */
        public function page()
        {
            return $this->belongsTo(Page::class);
        }

    }
