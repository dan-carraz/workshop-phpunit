<?php

namespace App\Tests;

use App\Slug;
use PHPUnit\Framework\TestCase;

/**
 * Class SlugTest
 */
class SlugDataProviderTest extends TestCase
{
    /**
     * @param string $originalString
     * @param string $expectedResult
     *
     * @dataProvider providerTestSluggifyReturnsSluggifiedString
     */
    public function testSluggifyReturnsSluggifiedString(string $originalString, string $expectedResult)
    {
        $slug = new Slug();

        $result = $slug->sluggify($originalString);

        $this->assertSame($expectedResult, $result);
    }

    public function providerTestSluggifyReturnsSluggifiedString()
    {
        return array(
            array('This string will be sluggified', 'this-string-will-be-sluggified'),
            array('THIS STRING WILL BE SLUGGIFIED', 'this-string-will-be-sluggified'),
            array('This1 string2 will3 be 44 sluggified10', 'this1-string2-will3-be-44-sluggified10'),
            array('This! @string#$ %$will ()be "sluggified', 'this-string-will-be-sluggified'),
            array("Tänk efter nu – förr'n vi föser dig bort", 'tnk-efter-nu-frrn-vi-fser-dig-bort'),
            array('', ''),
        );
    }
}
