<?php

namespace Tests\lib;

use application\lib\Db;
use PDO;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DbTest extends TestCase
{
    private Db $db;
    /**
     * @var MockObject|PDO
     */
    private MockObject $mockObject;

    protected function setUp(): void
    {
        $this->mockObject = $this->createMock(PDO::class);
        $this->db = new Db($this->mockObject);
    }

    /**
     * @return void
     * @covers \application\lib\Db::getPDO
     */
    public function testGetPDO(): void
    {
        $result = $this->db->getPDO();
        $this->assertInstanceOf(PDO::class, $result);
    }

    /**
     * @return void
     * @depends testGetPDO
     * @covers \application\lib\Db::oneValue
     */
    public function testOneValue(): void
    {
        $sql = 'SELECT id FROM users where email="email@debug.com"';

        $result = $this->db->oneValue($sql);
        $this->assertIsNotArray($result);
        $this->assertIsString($result);
    }

    /**
     * @return void
     * @depends testGetPDO
     * @covers \application\lib\Db::row
     */
    public function testRow(): void
    {
        $sql = 'SELECT * FROM users';
        $expectedArray = [
            0 => [
                'id' => '1',
                'email' => 'email@debug.com',
                'first_name' => 'DebugFirstName',
                'second_name' => 'DebugSecondName',
                'pass_word' => '$2y$10$xvoVzaOKjBPLrwinxndxDO0vjQV.my71Ia9zdKgCLp4HRrZ.Nh/bG',
                'access_token' => 'POx5y16iYyIYWRZ7pmdkMHI43',
                'created_date' => '2022-11-22 18:07:53'
            ],
            1 => [
                'id' => '2',
                'email' => 'igor.novak@gmail.com',
                'first_name' => 'Igor',
                'second_name' => 'Novak',
                'pass_word' => '$2y$10$7eaRaNWAudK4Qtpw4FP5ROswsqAgG9.qh4s3pIuK6ui1apq.0NRYC',
                'access_token' => null,
                'created_date' => '2022-11-22 18:08:18'
            ]
        ];

        $result = $this->db->row($sql);
        $this->assertIsArray($result[0]);
        $this->assertEquals($expectedArray, $result);
    }

    /**
     * @return void
     * @depends testGetPDO
     * @covers \application\lib\Db::column
     */
    public function testColumn(): void
    {
        $sql = 'SELECT first_name FROM users';
        $expectedArray = [
            '0' => 'DebugFirstName',
            '1' => 'Igor'
        ];

        $result = $this->db->column($sql);
        $this->assertIsArray($result);
        $this->assertEquals($expectedArray, $result);
    }
}
