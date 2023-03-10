<?php

namespace RocketLauncherBuilder\Tests\Integration\inc\Commands\GenerateSubscriberCommand;

use RocketLauncherBuilder\Tests\Integration\TestCase;

class Test_Execute extends TestCase
{
    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected($config, $expected) {
        self::assertFalse($this->filesystem->exists($expected['path']));
        if(! $config['provider_exists']) {
            $this->filesystem->delete($config['provider_path']);
        }
        $this->launch_app("subscriber {$config['class']}{$config['parameters']}");
        self::assertTrue($this->filesystem->exists($expected['path']));
        self::assertSame($expected['content'], $this->filesystem->get_contents($expected['path']));
        self::assertSame($expected['provider_content'], $this->filesystem->get_contents($config['provider_path']));
        self::assertSame($expected['plugin_content'], $this->filesystem->get_contents($config['plugin_path']));
    }
}
