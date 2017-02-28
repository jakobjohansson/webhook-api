<?php
namespace Hook\GitHub;
/**
 * GitHub project event class.
 *
 * @category   API
 * @package    webhook-api
 * @author     Jakob Johansson
 * @copyright  2017
 * @license    https://github.com/jakobjohansson/webhook-api/blob/master/LICENSE.txt MIT-License
 */
class GitHubProjectEvent extends GitHubEvent {

    /**
     * The action performed on the issue
     * @var string
     */
    public $action = "";

    /**
     * The project object
     * @var Object
     */
    public $project = "";

    /**
     * The output to be sent to front end
     * @return string
     */
    public function __toString() {
        return $this->sender->login . " just " . $this->action
        . " a project in the <a href='" . $this->repository->html_url
        . "'>" . $this->repository->full_name . "</a> repository.";
    }
}