<?php
namespace Front\FrontBundle\Tests\Controller\UnitTest;

use Front\FrontBundle\Service\UploadManager;

class UploadManagerTest extends \PHPUnit_Framework_TestCase{

    public function testAdd()
    {
        $rootDir = 'defaultRoot';
        $calc = new UploadManager($rootDir);
        $result = $calc->addition(30, '12');

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(42, $result);
    }
}