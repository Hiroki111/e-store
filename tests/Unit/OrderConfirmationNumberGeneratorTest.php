<?php

namespace Tests;

use App\OrderConfirmationNumberGenerator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class OrderConfirmationNumberGeneratorTest extends TestCase
{
    use DatabaseMigrations;

    //Must be 24 characters long
    //Can only contain uppercase and numbers
    //All order confirmation numbers must be unique

    /** @test */
    public function must_be_24_characters_long()
    {
        $generator = new OrderConfirmationNumberGenerator;

        $confirmationNumber = $generator->generate();

        $this->assertEquals(24, strlen($confirmationNumber));
    }

    /** @test */
    public function can_only_contain_uppercase_letters_and_numbers()
    {
        $generator = new OrderConfirmationNumberGenerator;

        $confirmationNumber = $generator->generate();

        $this->assertRegExp('/^[A-Z0-9]+$/', $confirmationNumber);
    }

    /** @test */
    public function confirmation_numbers_must_unique()
    {
        $generator = new OrderConfirmationNumberGenerator;

        $confirmationNumbers = array_map(function ($i) use ($generator) {
            return $generator->generate();
        }, range(1, 10000));

        $this->assertCount(10000, array_unique($confirmationNumbers));
    }
}
