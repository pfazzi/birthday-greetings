<?php
declare(strict_types=1);

namespace Patrickfazzi\BirthdayGreetings\Tests;

use Patrickfazzi\BirthdayGreetings\Application;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    public function test_send_mail(): void
    {
        $clock = new MockClock(today: new \DateTimeImmutable('1971-07-19'));
        $mailSender = new SpyMailSender(today: new \DateTimeImmutable('1971-07-19'));
        $app = new Application($clock);

        $app->sendEmailsForToday();

        $sentEmail = $mailSender->releaseSentEmails();
        self::assertContains(new Application('clifton_dooley@hotmail.com','Clifton','Dooley'), $sentEmail);
    }
}