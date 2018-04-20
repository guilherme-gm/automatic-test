<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

class PostModelTest extends TestCase
{
    use TestCaseTrait;

    // only instantiate pdo once for test clean-up/fixture load
    static private $pdo = null;

    // only instantiate PHPUnit\DbUnit\Database\Connection once per test
    private $conn = null;

    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }

        return $this->conn;
    }

    public function getDataSet()
    {
        return $this->createFlatXmlDataSet('tests/postsFixture.xml');
    }

    public function testGetAll()
    {
        include 'src/models/Post.php';

        $posts = Post::getAll();

        $queryTable = $this->getConnection()->createQueryTable(
            'posts', 'SELECT id, title, content FROM posts'
        );
        $expectedTable = $this->createFlatXmlDataSet("tests/postsFixture.xml")
                              ->getTable("posts");
        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    // public function testCreate()
    // {
    //     $guestbook = new Guestbook();
    //     $guestbook->addEntry("suzy", "Hello world!");

    //     $queryTable = $this->getConnection()->createQueryTable(
    //         'guestbook', 'SELECT * FROM guestbook'
    //     );
    //     $expectedTable = $this->createFlatXmlDataSet("expectedBook.xml")
    //                           ->getTable("guestbook");
    //     $this->assertTablesEqual($expectedTable, $queryTable);
    // }
}