<?php

    namespace Modules\Banners\Entities;

    use App\Models\Page;
    use Illuminate\Database\Eloquent\Model;

    class Banner extends Model
    {
        protected $table = 'banners_items';

        protected $fillable = ['campaign_id', 'name', 'size_id', 'type', 'image', 'code', 'target_url', 'date_start', 'date_finish', 'region_id', 'hide_mobile', 'hide_tablets', 'priority', 'limit_views', 'limit_clicks', 'description', 'status', 'active', 'views', 'clicks'];

        const TYPE_IMAGE = 0; // banner type image
        const TYPE_CODE  = 1; // banner type code

        const STATUS_STOPPED = 0; // banner stopped
        const STATUS_STARTED = 1; // campaign started

        /**
         * Get name of status
         *
         * @param $status
         *
         * @return string
         */
        public static function getStatusBadge($status)
        {
            switch ($status) {
                case self::STATUS_STOPPED:
                    return '<span class="badge badge-secondary">' . __('banners::ui.stopped') . '</span>';
                    break;
                case self::STATUS_STARTED:
                    return '<span class="badge badge-success">' . __('banners::ui.started') . '</span>';
                    break;
            }
        }

        /**
         * Get name of type
         *
         * @param $type
         *
         * @return string
         */
        public static function getTypeBadge($type)
        {
            switch ($type) {
                case self::TYPE_IMAGE:
                    return '<span class="badge badge-info">' . __('banners::ui.banner_type_image') . '</span>';
                    break;
                case self::TYPE_CODE:
                    return '<span class="badge badge-info">' . __('banners::ui.banner_type_code') . '</span>';
                    break;
            }
        }

        /**
         * Relation with campaign
         */
        public function campaign()
        {
            return $this->belongsTo(Campaign::class);
        }

        /**
         * Relation with size
         */
        public function size()
        {
            return $this->belongsTo(Size::class);
        }

        /**
         * Relation with size
         */
        public function file()
        {
            return $this->hasOne(File::class, 'banner_id')->latest();
        }

        /**
         * Relation with pages
         */
        public function pages()
        {
            return $this->hasMany(BannerPage::class, 'banner_id')->with('page')->latest();
        }


        /**
         * Scope filter by active
         *
         * @param $query
         *
         * @return mixed
         */
        public function scopeOnlyActive($query)
        {
            return $query->whereActive(true);
        }

    }
