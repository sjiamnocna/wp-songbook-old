<?php

/**
 * Songbook messages
 *
 * Methods adding possibility to simply show admin messages by WP Songbook
 *
 * @since       v. 2.0.
 * @version     1.0
 * @author      Sjiamnocna
 * @copyright   (c) 2015 Sjiamnocna
 * 
 */
class songbook_messages {

    public function __construct() {

        add_action('admin_notices', array($this, 'showmessage'));
    }

    /**
     * 
     * Creates WP admin message HTML structure and adds class
     * 
     * @param string $message   Text message to display
     * @param string $class     Class to add ('updated','notice','error')
     * @return string
     */
    public function create($message, $class) {
        //update-nag not supported
        if (in_array($class, array('updated', 'notice', 'error')))
            return "<div class=\"$class\"><p>$message</p></div>";
        else
            return;
    }

    /**
     * Executes method create() for all messages created by WP Songbook and filtered to a filter wpsb_notice
     * Shows message created by the method create()
     */
    public function showmessage() {
        $messages = apply_filters('wpsb_notice', array());

        if (is_array($messages) && count($messages) > 0)
            for ($i = 0; $i < count($messages); $i++) {
                if (is_array($messages[$i])) {

                    if (!isset($messages[$i][0]))
                        continue;
                    $text = $messages[$i][0];
                    if (isset($messages[$i][1]))
                        $class = $messages[$i][1];
                }

                $message = $this->create($text, $class);
                if (isset($message))
                    echo $message;
                unset($message);
            }
    }

}

$wpsb_messages = new songbook_messages();
