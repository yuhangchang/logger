<?php
use Psr\Log\LoggerInterface;

namespace Php\Exam;

class Logger implements LoggerInterface
{
    public function __construct()
    {
        // code...
    }

    public function info()
    {
        echo "info";
    }
    public function debug()
    {
        echo "debug";
    }
    public function notice()
    {
        echo "notice";
    }
    public function hello()
    {
        echo 'hello';
    }
}
