<?php
namespace Tests\note_table\viewmodels;

use App\plugins\note_table\viewmodels\AdminNote;
use Tests\Test as TestCase;

class AdminNoteTest extends TestCase
{
    private $AdminNote;

    protected function setUp(): void
    {
        $app = $this->prepareApp();
        $container = $app->getContainer();
        $request = $container->get('request');
        $request->set('urlVars', ['id' => 1]);

        $this->AdminNote = new AdminNote($container);
    }

    public function testForm()
    {
        $try = $this->AdminNote->form();

        $this->assertIsArray($try);
    }

    public function testHistory()
    {
        $try = $this->AdminNote->history();

        $this->assertIsArray($try);
    }

    public function testGetFormFields()
    {
        $try = $this->AdminNote->getFormFields();

        $this->assertIsArray($try);
    }

    public function testPreview()
    {
        $try = $this->AdminNote->preview();

        $this->assertIsArray($try);
    }
}