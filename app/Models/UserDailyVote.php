<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserDailyVote extends Model
{
    protected $fillable = ['user_id', 'date', 'total_votes_allowed', 'votes_used'];

    // Maximum votes per day
    // const MAX_VOTES_PER_DAY = 10;

    public static function getTodayRecord($user)
    {
        $today = Carbon::today()->toDateString();
        $record = self::firstOrNew(['user_id' => $user->id, 'date' => $today]);
        if (!$record->exists) {
            $record->total_votes_allowed = 1;
            $record->votes_used = 0;
        }
        return $record;
    }

    public function canVote()
    {
        return $this->votes_used < $this->total_votes_allowed;
    }

    public function useVote()
    {
        if ($this->canVote()) {
            $this->votes_used++;
            $this->save();
            return true;
        }
        return false;
    }

    public function addVotes($number)
    {
        // if ($this->total_votes_allowed + $number > self::MAX_VOTES_PER_DAY) {
        //     throw new \Exception('Cannot exceed maximum votes per day.');
        // }
        $this->total_votes_allowed += $number;
        $this->save();
    }
}