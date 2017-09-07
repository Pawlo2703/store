<?php

namespace Shop\Controllers\UserProfile;

use Shop\Core\Controller;

/**
 * Class Profile
 */
class Profile extends Controller {

    /**
     * Orders View
     */
    public function display() {
        $this->header();
        $this->view('home/User_profile/profile');
    }

}
