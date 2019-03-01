<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EventRepetition;

class Event extends Model
{
    /***************************************************************************/
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';
    
    /***************************************************************************/
    
    protected $fillable = [
        'title', 'description', 'organized_by', 'category_id', 'venue_id', 'image', 'facebook_event_link', 'website_event_link', 'status', 'repeat_type', 'repeat_until', 'repeat_weekly_on', 'repeat_monthly_on', 'on_monthly_kind'
    ];

    /***************************************************************************/
    /**
     * Get the teachers for the event.
     */
    public function teachers(){
        return $this->belongsToMany('App\Teacher', 'event_has_teachers', 'event_id', 'teacher_id');
    }

    /***************************************************************************/
    /**
     * Get the organizers for the event.
     */
    public function organizers(){
        return $this->belongsToMany('App\Organizer', 'event_has_organizers', 'event_id', 'organizer_id');
    }

    /***************************************************************************/
    /**
     * Get the organizers for the event.
     */
    public function eventRepetitions($type = null)
    {
        return $this->hasMany('App\EventRepetition', 'event_id');
    }

    /***************************************************************************/
    /**
     * Delete all the previous repetitions from the event_repetitions table
     *
     * @param  $eventId - Event id
     * @return none
     */
    public static function deletePreviousRepetitions($eventId){
        EventRepetition::where('event_id', $eventId)->delete();
    }

    /***************************************************************************/
    /**
     * Return Start and End dates of the first repetition of an event - By Event ID
     *
     * @param  int  event id
     * @return \App\EventRepetition the event repetition Start and End repeat dates
     */
    public static function getFirstEventRpDatesByEventId($eventId){
        $ret = EventRepetition::
                select('start_repeat','end_repeat')
                ->where('event_id',$eventId)
                ->first();
                
        return $ret;
    }
    
    /***************************************************************************/
    /**
     * Return Start and End dates of the first repetition of an event - By Repetition ID
     *
     * @param  int  event id
     * @return \App\EventRepetition the event repetition Start and End repeat dates
     */
    public static function getFirstEventRpDatesByRepetitionId($repetitionId){
        $ret = EventRepetition::
                select('start_repeat','end_repeat')
                ->where('id',$repetitionId)
                ->first();
                
        return $ret;
    }
}
