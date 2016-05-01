<?php
class Page extends SiteTree
{

    private static $db = array(
    );

    private static $has_one = array(
    );

    public function canCreate()
    {
        return false;
    }

    private static $allowed_children = "none";
}
class Page_Controller extends ContentController
{

    /**
     * An array of actions that can be accessed via a request. Each array element should be an action name, and the
     * permissions or conditions required to allow the user to access it.
     *
     * <code>
     * array (
     *     'action', // anyone can access this action
     *     'action' => true, // same as above
     *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
     *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
     * );
     * </code>
     *
     * @var array
     */
    private static $allowed_actions = array(
    );

    public function init()
    {
        parent::init();

        Requirements::combine_files(
        'app.min.css',
            array(
            "{$this->ThemeDir()}/css/main.min.css",
            "{$this->ThemeDir()}/css/bootstrap.min.css",
            )
        );

        Requirements::combine_files(
            'app.min.js',
            array(
            "{$this->ThemeDir()}/js/jquery.min.js",
            "{$this->ThemeDir()}/js/bootstrap.min.js",
            "{$this->ThemeDir()}/js/script.js",
            )

        );
    }
}
