<?php
/**
 * GitHub push event class.
 * Can be straight up echoed for message.
 *
 * @category   API
 * @package    webhook-api
 * @author     Jakob Johansson
 * @copyright  2017
 * @license    https://github.com/jakobjohansson/webhook-api/blob/master/LICENSE.txt MIT-License
 */
class GitPushEvent extends GitEvent {

    /**
     * URL to the event
     * @var String
     */
    public $compare = "";

    /**
     * Array with commits in the push
     * @var Array
     */
    public $commits = "";

    /**
     * Object with name and email properties of the pusher
     * @var Object
     */
    public $pusher = "";

    /**
     * The repository object in the push
     * @var Object
     */
    public $repository = "";

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

    /**
     * The output to be sent to front end
     * @return string
     */
    public function __toString() {
        return $this->pusher->name . " just pushed " . count($this->commits) . " commits to <a href='" . $this->compare . "'>" . $this->repository->full_name . "</a>.";
    }
}