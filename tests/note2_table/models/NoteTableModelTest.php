<?php
namespace Tests\note2_table\models;

use Tests\Test as TestCase;

class NoteTableModelTest extends TestCase
{
    private $NoteTableModel;
    static $data;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();

        $this->NoteTableModel = $container->get('NoteTableModel');
        $NoteEntity = $container->get('NoteEntity');

        if (!static::$data)
        {
            $find = $NoteEntity->findOne(['title' => 'test table']);
            if ($find)
            {
                $NoteEntity->remove($find['id']);
            }

            $find = $NoteEntity->findByPK(3);
            if(!$find)
            {
                $NoteEntity->add([
                    'title' => 'test table',
                    'public_id' => '',
                    'id' => 2,
                    'alias' => '',
                    'data' => '{"colHeaders":["test"],"data":[["test"]]}',
                    'tags' => '',
                    'type' => 'table',
                    'note_ids' => '',
                    'notice' => '',
                    'status' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 0,
                    'locked_at' => date('Y-m-d H:i:s'),
                    'locked_by' => 0,
                ]);
            }
            static::$data = true;
        }
    }

    public function testReplaceContent()
    {
        $try = $this->NoteTableModel->replaceContent('Test');
        $this->assertIsString($try);
    }

    /**
     * @dataProvider dataAdd
     */
    public function testAdd($data, $result)
    {
        $try = $this->NoteTableModel->add($data);
        $this->assertEquals($try , $result);
    }

    public function dataAdd()
    {
        return [
            [[
                'title' => '', 
                'data' => 'test table', 
                'tags' => [], 
                'notice' => '', 
                'status' => 0, 
            ], false],
            [[
                'title' => 'test table', 
                'data' => 'test table', 
                'tags' => [], 
                'notice' => '', 
                'status' => 0, 
            ], true],
        ];
    }

    /**
     * @dataProvider dataUpdate
     */
    public function testUpdate($data, $result)
    {
        $try = $this->NoteTableModel->update($data);
        $this->assertEquals($try , $result);
    }

    public function dataUpdate()
    {
         return [
            [[
                'id' => 0,
                'title' => 'test table', 
                'data' => 'test table', 
                'tags' => [], 
                'notice' => '', 
                'status' => 0, 
            ], false],
            [[
                'id' => 3,
                'title' => '', 
                'data' => 'test table', 
                'tags' => [], 
                'notice' => '', 
                'status' => 0,          
            ], false],
            [[
                'id' => 3,
                'title' => 'test table', 
                'data' => 'test table', 
                'tags' => [], 
                'notice' => '', 
                'status' => 0, 
            ], true],
        ];
    }

    /**
     * @dataProvider dataRemove
     */
    public function testRemove($id, $result)
    {
        $try = $this->NoteTableModel->remove($id);
        $this->assertEquals($try , $result);
    }

    public function dataRemove()
    {
        return [
            [0, false],
            [2, true],
        ];
    }

    /**
     * @dataProvider dataGetDetail
     */
    public function testGetDetail($id, $result)
    {
        $try = $this->NoteTableModel->getDetail($id);
        $try = is_array($try) ? true : false;
        $this->assertEquals($try , $result);
    }

    public function dataGetDetail()
    {
        return [
            [0, true],
            [2, true],
        ];
    }
}