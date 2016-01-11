<?php

namespace App\Models\Mship\Account;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ban extends \App\Models\aTimelineEntry
{

    use SoftDeletes;

    protected $table      = 'mship_account_ban';
    protected $primaryKey = "account_ban_id";
    protected $dates      = ['period_start', 'period_finish', 'created_at', 'repealed_at', 'updated_at', 'deleted_at'];
    protected $touches    = ['account'];

    const TYPE_LOCAL   = 80;
    const TYPE_NETWORK = 90;

    public static function scopeIsNetwork($query){
        return $query->where("type", "=", self::TYPE_NETWORK);
    }

    public static function scopeIsLocal($query){
        return $query->where("type", "=", self::TYPE_LOCAL);
    }

    public static function scopeIsActive($query){
        return $query->isNotRepealed()->where("period_finish", ">=", \Carbon\Carbon::now());
    }

    public static function scopeIsHistoric($query){
        return $query->isNotRepealed()->where("period_finish", "<", \Carbon\Carbon::now());
    }

    public static function scopeIsRepealed($query){
        return $query->whereNotNull("repealed_at");
    }

    public static function scopeIsNotRepealed($query){
        return $query->whereNull("repealed_at");
    }

    public function account()
    {
        return $this->belongsTo('\App\Models\Mship\Account', 'account_id', 'account_id');
    }

    public function banner()
    {
        return $this->belongsTo('\App\Models\Mship\Account', 'banned_by', 'account_id');
    }

    public function reason()
    {
        return $this->belongsTo('\App\Models\Mship\Ban\Reason', 'reason_id', 'ban_reason_id');
    }

    public function notes(){
        return $this->morphMany(\App\Models\Mship\Account\Note::class, "attachment");
    }

    public function repeal(){
        $this->repealed_at = \Carbon\Carbon::now();
        $this->save();
    }

    public function getIsLocalAttribute(){
        return $this->type == self::TYPE_LOCAL;
    }

    public function getIsNetworkAttribute(){
        return $this->type == self::TYPE_NETWORK;
    }

    public function getIsRepealedAttribute(){
        return $this->repealed_at != null;
    }

    public function getIsActiveAttribute(){
        $period_start = $this->period_start;
        $period_finish = $this->period_finish;
        $now = \Carbon\Carbon::now();

        return ($now->between($period_start, $period_finish) && !$this->is_repealed);
    }

    public function getIsExpiredAttribute(){
        return !$this->is_active;
    }

    public function setPeriodAmountFromTS(){
        $diff = $this->period_start->diff($this->period_finish);

        /**
         * IF:
         * - We have hours AND minutes; OR
         * - We have days AND (minutes OR hours).
         * THEN:
         * - Whole thing is minutes.
         */
        if(($diff->h > 0 AND $diff->i != 0) OR ($diff->d > 0 AND ($diff->i != 0 OR $diff->h != 0))){
            $this->period_amount = $this->period_start->diffInMinutes($this->period_finish);
            $this->period_unit = 'M';
        } elseif($diff->d > 0){
            $this->period_amount = $this->period_start->diffInDays($this->period_finish);
            $this->period_unit = 'D';
        } elseif($diff->h > 0) {
            $this->period_amount = $this->period_start->diffInHours($this->period_finish);
            $this->period_unit = 'H';
        } else {
            $this->period_amount = $this->period_start->diffInMinutes($this->period_finish);
            $this->period_unit = 'M';
        }
    }

    public function getTypeStringAttribute()
    {
        switch ($this->attributes['type']) {
            case self::TYPE_LOCAL:
                return trans("mship.ban.type.local");
                break;
            case self::TYPE_NETWORK:
                return trans("mship.ban.type.network");
                break;
            default:
                return trans("mship.ban.type.unknown");
                break;
        }
    }

    public function getPeriodUnitStringAttribute()
    {
        switch ($this->attributes['period_unit']) {
            case "M":
                return "Minutes";
                break;
            case "H":
                return "Hours";
                break;
            case "D":
                return "Days";
                break;
            default:
                return "Unknown length";
                break;
        }
    }

    public function getDisplayValueAttribute()
    {
        // TODO: Implement getDisplayValueAttribute() method.
    }
}