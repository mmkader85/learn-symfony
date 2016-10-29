<?php

namespace PhpunitDe\Tests;

use AbdulBundle\Controller\CommunicationPreferencesNewController;
use PHPUnit_Extensions_Database_DataSet_IDataSet;

class DatabaseTest extends \PHPUnit_Extensions_Database_TestCase
{
    private $con;
    static private $pdo;
    private $cpnTable = 'communication_preferences_new';

    /**
     * Returns the test database connection
     * @return \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    protected function getConnection()
    {
        if (!$this->con) {
            if (!static::$pdo) {
                static::$pdo = new \PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASS']);
            }
            $this->con = $this->createDefaultDBConnection(static::$pdo);
        }

        return $this->con;
    }

    /**
     * Returns the test dataset.
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     *
     * There are several ways of getting DataSet including Array, CSV, YAML, Query and so on.
     */
    protected function getDataSet()
    {
        $xmlDataSet = dirname(__FILE__).'/Resources/mysymfony.xml';

        return $this->createMySQLXMLDataSet($xmlDataSet);
    }

    public function testInsert()
    {
        $currentRowCount = $this->getConnection()->getRowCount($this->cpnTable);

        $cpn = new CommunicationPreferencesNewController();
        $rowInserted = $cpn->pdoSave();

        static::assertEquals(($currentRowCount+$rowInserted), ($this->getConnection()->getRowCount($this->cpnTable)));
    }
}