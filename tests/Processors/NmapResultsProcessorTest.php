<?php

declare(strict_types=1);

namespace Reconmap\Processors;

use PHPUnit\Framework\TestCase;

class NmapResultsProcessorTest extends TestCase
{

    public function testGetOpenPorts()
    {
        $processor = new NmapResultsProcessor(__DIR__ . '/nmap-output-example.xml');
        $openPorts = $processor->parseOpenPorts();
        $this->assertContains(3306, $openPorts);
        $this->assertContains(8080, $openPorts);
    }
}
