<?php
// Stub out the KokenPlugin class. I'd prefer not to do this, but I've no idea how to get a KokenPlugin from this repo.
if (!class_exists('KokenPlugin')) {
    class KokenPlugin
    {
        public function register_hook($hook, $method) {
            // No-op
        }
    }
}

// Load in the plugin to test.
require_once realpath(dirname(__FILE__).'/../plugin.php');

class InqkSlurmTest extends PHPUnit_Framework_TestCase
{
    public function testGeneratesSlugFromIDAndTimestamp()
    {
        $plugin = new InqkSlurm;

        $id  = 1234;
        $time = 1378032342;
        $checksum = 3;

        $this->assertEquals(
            $plugin->generate_slug($id, $time),
            "${time}${id}${checksum}",
            "Slug should be concatination of UNIX Timestamp, ID and checksum digit"
        );
    }
}
