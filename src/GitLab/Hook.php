<?php

namespace Hook\GitLab;

use Hook\Request;
use Hook\Hook as BaseHook;
use Hook\Concerns\Authenticates;

class Hook extends BaseHook
{
    use Authenticates;

    /**
     * Create a new Hook instance.
     *
     * @param array  $map
     * @param string $secret
     *
     * @return mixed
     */
    public function __construct(array $map, $secret)
    {
        $this->map($map);

        if (Request::method() !== 'POST') {
            $this->errors[] = 'Wrong request method';

            return;
        }

        if (!Request::header('HTTP_X_GITLAB_EVENT')) {
            $this->errors[] = 'GitLab Event header not present';

            return;
        }

        $this->event = Request::header('HTTP_X_GITLAB_EVENT');

        if (isset($secret)) {
            $this->secret = $secret;

            return $this->auth();
        }
    }

    /**
     * Authenticate the request provided a signature.
     *
     * @return bool
     */
    private function auth()
    {
        if (!Request::header('HTTP_X_GITLAB_TOKEN')) {
            $this->errors[] = 'No signature provided';

            return false;
        }

        $this->signature = Request::header('HTTP_X_GITLAB_TOKEN');

        if (!$this->validate()) {
            $this->errors[] = 'Signature not authorized';

            return false;
        }

        return $this->authenticated = true;
    }

    /**
     * Compare the signature and the secret.
     *
     * @return bool
     */
    private function validate()
    {
        return $this->signature === $this->secret;
    }
}
