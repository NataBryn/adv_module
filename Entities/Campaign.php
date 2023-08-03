<?php

    namespace Modules\Banners\Entities;

    use Illuminate\Database\Eloquent\Model;

    class Campaign extends Model
    {
        protected $table = 'banners_campaigns';

        protected $fillable = ['name', 'contact_person', 'email', 'phone', 'status', 'active', 'date_start', 'date_finish'];

        const STATUS_STOPPED = 0; // campaign stopped
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

        public function getCountViewsAttribute($value)
        {
            return $this->hasMany(Banner::class)->sum('views');
        }
        public function getCountClicksAttribute($value)
        {
            return $this->hasMany(Banner::class)->sum('clicks');
        }

        /**
         * Relation with banners
         */
        public function banners()
        {
            return $this->hasMany(Banner::class);
        }

        /**
         * Relation with active banners
         */
        public function bannersActive()
        {
            return $this->hasMany(Banner::class)->onlyActive();
        }
    }
