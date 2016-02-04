<?php

namespace Tests\TMCms\Admin;

use TMCms\Admin\Messages;
use TMCms\Admin\Users\Entity\UsersMessage;

class MessagesTest extends \PHPUnit_Framework_TestCase {
    public function testSendMessage() {
        $message_text = 'Test text';
        $to_user_id = 1;

        $message = Messages::sendMessage($message_text, $to_user_id);

        // Remove test message
        $message->deleteObject();

        $this->assertInstanceOf('TMCms\Admin\Users\Entity\UserMessage', $message);
    }

    public function testReceiveMessages() {
        $message_text = 'Test text';
        $from_user_id = 1;
        $to_user_id = 1;

        // Send message
        $message = Messages::sendMessage($message_text, $to_user_id, $from_user_id);

        // Receive messages
        $messages = Messages::receiveMessages($from_user_id, $to_user_id);
        // Remove test message
        $message->deleteObject();

        // Check text was in received messages
        $texts = [];
        foreach ($messages as $message) {
            /** @var UsersMessage $message */
            $texts[] = $message->getMessage();
        }

        $this->assertTrue(in_array($message_text, $texts));
    }
}
