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
        $confirmationNumber = OrderConfirmationNumberGenerator::generate();

        $this->assertEquals(24, strlen($confirmationNumber));
    }

    /** @test */
    public function can_only_contain_uppercase_letters_and_numbers()
    {
        $confirmationNumber = OrderConfirmationNumberGenerator::generate();

        $this->assertRegExp('/^[A-Z0-9]+$/', $confirmationNumber);
    }

    /** @test */
    public function confirmation_numbers_must_unique()
    {
        $confirmationNumbers = array_map(function ($i) {
            return OrderConfirmationNumberGenerator::generate();
        }, range(1, 10000));

        $this->assertCount(10000, array_unique($confirmationNumbers));
    }
}
