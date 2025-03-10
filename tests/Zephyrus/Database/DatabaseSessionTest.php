<?php namespace Zephyrus\Tests\Database;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Zephyrus\Application\Configuration;
use Zephyrus\Database\DatabaseSession;

class DatabaseSessionTest extends TestCase
{
    public function testGetFailedInstance()
    {
        DatabaseSession::kill();
        self::expectException(RuntimeException::class);
        DatabaseSession::getInstance();
    }

    public function testInitiate()
    {
        DatabaseSession::initiate(Configuration::getDatabase());
        $database = DatabaseSession::getInstance()->getDatabase();
        self::assertEquals("dev", $database->getConfiguration()->getUsername());
        self::assertEquals("zephyrus", $database->getConfiguration()->getDatabaseName());
        self::assertEquals(['public'], $database->getConfiguration()->getSearchPaths());
    }
}
