<?php

namespace Tests\TMCms\Admin;

use TMCms\Admin\Messages;
use TMCms\Admin\Users\Entity\UsersMessageEntity;

class MessagesTest extends \PHPUnit_Framework_TestCase
{
    public function testSendMessage()
    {
        $message_text = 'Test text';
        $to_user_id = 1;

        $message = Messages::sendMessage($message_text, $to_user_id);

        // Remove test message
        $message->deleteObject();

        $test_msg = new UsersMessageEntity();

        $this->assertInstanceOf(get_class($test_msg), $message);
    }

    public function testReceiveMessages()
    {
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
            /** @var UsersMessageEntity $message */
            $texts[] = $message->getMessage();
        }

        $this->assertTrue(in_array($message_text, $texts));
    }
}
