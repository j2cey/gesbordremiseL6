<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Base\BaseTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class BaseModel extends Model
{
    use BaseTrait, LogsActivity;

    /**
     * @var string[] LogsActivity purpose
     */
    protected static $logAttributes = ['*'];

    public function getRouteKeyName() { return 'uuid'; }

    #region Eloquent Relationships

    public function status() {
        return $this->belongsTo('App\Status');
    }

    #endregion

    #region Scopes

    public function scopeDefault($query, $exclude = []) {
        return $query
            ->where('is_default', true)->whereNotIn('id', $exclude);
    }

    #endregion
}
