<?php
namespace Hook\GitHub;
/**
 * GitHub member event class.
 *
 * @category   API
 * @package    webhook-api
 * @author     Jakob Johansson
 * @copyright  2017
 * @license    https://github.com/jakobjohansson/webhook-api/blob/master/LICENSE.txt MIT-License
 */
class GitHubMemberEvent extends GitHubEvent {

    /**
     * The action performed on the issue
     * @var string
     */
    public $action = "";

    /**
     * The member object
     * @var Object
     */
    public $member = "";

    /**
     * The output to be sent to front end
     * @return string
     */
    public function __toString() {
        return $this->sender->login . " just " . $this->action
        . " <a href='" . $this->member->html_url . "'>"
        . $this->member->login . "</a> in the " 
        . $this->repository->full_name . " repository.";
    }
}