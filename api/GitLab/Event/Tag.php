<?php
namespace GitLab\Event;
/**
 * GitLab tag push event class.
 * Can be straight up echoed for message.
 *
 * @category   API
 * @package    webhook-api
 * @author     Jakob Johansson
 * @copyright  2017
 * @license    https://github.com/jakobjohansson/webhook-api/blob/master/LICENSE.txt MIT-License
 */
class Push extends Event {

    /**
     * The user who made the push
     * @var String
     */
    public $user_name;

    /**
     * The ref pushed
     * @var String
     */
    public $ref;

    /**
     * Gets the payload and selects the necessary properties
     * @param Object $payload JSON
     */
    public function __construct($payload) {
        foreach ($payload as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function __toString() {
        return $this->user_name . " just pushed the tag "
        . explode("/", $this->ref)[2]
        . " to the <a href='" . $this->project->web_url
        . "'>" . $this->project->name . "</a> repository.";
    }
}