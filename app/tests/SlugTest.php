<?php

namespace App\Tests;

use App\Slug;
use PHPUnit\Framework\TestCase;

/**
 * Class SlugTest
 */
class SlugTest extends TestCase
{
    public function testSluggifyReturnsSluggifiedString()
    {
        $originalString = 'This string will be sluggified';
        $expectedResult = 'this-string-will-be-sluggified';

        $slug = new Slug();

        $result = $slug->sluggify($originalString);

        $this->assertSame($expectedResult, $result);
    }

    public function testSluggifyReturnsExpectedForStringsContainingNumbers()
    {
        $originalString = 'This1 string2 will3 be 44 sluggified10';
        $expectedResult = 'this1-string2-will3-be-44-sluggified10';

        $slug = new Slug();

        $result = $slug->sluggify($originalString);

        $this->assertSame($expectedResult, $result);
    }

    public function testSluggifyReturnsExpectedForStringsContainingSpecialCharacters()
    {
        $originalString = 'This! @string#$ %$will ()be "sluggified';
        $expectedResult = 'this-string-will-be-sluggified';

        $slug = new Slug();

        $result = $slug->sluggify($originalString);

        $this->assertSame($expectedResult, $result);
    }

    public function testSluggifyReturnsExpectedForStringsContainingNonEnglishCharacters()
    {
        $originalString = "Tänk efter nu – förr'n vi föser dig bort";
        $expectedResult = 'tnk-efter-nu-frrn-vi-fser-dig-bort';

        $slug = new Slug();

        $result = $slug->sluggify($originalString);

        $this->assertSame($expectedResult, $result);
    }

    public function testSluggifyReturnsExpectedForEmptyStrings()
    {
        $originalString = '';
        $expectedResult = '';

        $slug = new Slug();

        $result = $slug->sluggify($originalString);

        $this->assertSame($expectedResult, $result);
    }
}
