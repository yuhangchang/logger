<?php


namespace Php\Exam;

use Psr\Log\LoggerInterface;
use SQLite3;

class Logger implements LoggerInterface
{
    private $db;
    private $id;
    public function __construct()
    {
        $db = new SQLite3('syslog.sqlite3');
        $sql =<<<EOF
          CREATE TABLE logs
          (
              id INTEGER PRIMARY KEY AUTOINCREMENT,
              level VARCHAR(10) NOT NULL,
              message TEXT NOT NULL
          );
          EOF;
        $ret = $db->exec($sql);
    }
    public function emergency($message, array $context = array())
    {
        self::sql(__FUNCTION__, $message);
    }
    public function alert($message, array $context = array())
    {
        self::sql(__FUNCTION__, $message);
    }
    public function critical($message, array $context = array())
    {
        self::sql(__FUNCTION__, $message);
    }
    public function error($message, array $context = array())
    {
        self::sql(__FUNCTION__, $message);
    }
    public function warning($message, array $context = array())
    {
        self::sql(__FUNCTION__, $message);
    }
    public function info($message, $context = array())
    {
        self::sql(__FUNCTION__, $message);
    }
    public function debug($message, $context = array())
    {
        self::sql(__FUNCTION__, $message);
    }
    public function notice($message, array $context = array())
    {
        self::sql(__FUNCTION__, $message);
    }

    public function log($level, $message, array $context = array())
    {
        echo "log";
    }

    private function sql($functionName, $message)
    {
        $db = new SQLite3('syslog.sqlite3');
        $sql =<<<EOF
            SELECT id from logs;
            EOF;
        $id = 0;
        $ret = $db->query($sql);
        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
            $id++;
            echo "id=".$row['id'];
        }
        $sql =<<<EOF
              INSERT INTO logs (id,level,message)
              VALUES ($id+1, '$functionName', '$message');
        EOF;

        $ret = $db->exec($sql);
        if (!$ret) {
            printf("%d...%s....%s\n", $id, $sql, $db->lastErrorMsg());
        // echo $db->lastErrorMsg();
        } else {
            echo "Records created successfully";
        }
    }
}
