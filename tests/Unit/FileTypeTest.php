<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileTypeTest extends TestCase
{
    /**
     * Test guest_filetype helper function
     * @dataProvider mimeTypeProvider
     * @return void
     */
    public function testGuestFileType($map, $mimetype, $expectedType)
    {
        $type = guest_filetype($mimetype, $map);
        $this->assertEquals($type, $expectedType);
    }

    public function mimeTypeProvider()
    {
        $map = [
            'text' => 0,
            'image' => 1,
            'video' => 2
        ];

        return [
            [$map, 'text/plain', 0],
            [$map, 'text/html', 0],
            [$map, 'image/jpeg', 1],
            [$map, 'image/png', 1],
            [$map, 'video/mp4', 2]
        ];
    }
}
