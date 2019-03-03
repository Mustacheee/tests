<?php

use PHPUnit\Framework\TestCase;
use Q4\src\ApiConnection;

final class ApiConnectionTest extends TestCase
{
    /**
     * Test with a good url, should see results
     */
    public function testGoodUrl()
    {
        $connection = new ApiConnection('https://foo.com/api/products');
        $data = $connection->fetchData();
        $this->assertTrue(!empty($data));
    }

    /**
     * Test with a bad url passed. Results should be an empty array.
     */
    public function testBadUrl()
    {
        $connection = new ApiConnection('https://foobar.com/api/products');
        $data = $connection->fetchData();
        $this->assertTrue(empty($data));
    }

    /**
     * Test with a good url and only high rated data wanted.
     * No product rating should be under 4;
     */
    public function testGoodUrlHighRated()
    {
        $connection = new ApiConnection('https://foo.com/api/products');
        $data = $connection->fetchHighRated();
        $result = true;

        foreach ($data as $datum) {
            if ($datum->rating < 4) {
                $result = false;
            }
        }

        $this->assertTrue($result);
    }

    /**
     * Test with a bad url and high rated data wanted.
     * Results should still be an empty array.
     */
    public function testBadUrlHighRated()
    {
        $connection = new ApiConnection('https://foobar.com/api/products');
        $data = $connection->fetchHighRated();
        $this->assertTrue(empty($data));
    }
}