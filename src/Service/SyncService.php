<?php


namespace App\Service;


use App\Repository\RevelConfigurationRepository;
use App\Repository\RevelToNetsuiteHistoryRepository;
use App\Repository\SyncHistoryRepository;
use App\Repository\SchedulerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Revel\Revel;

class SyncService
{

    const MANUAL = 0;

    private $entityManager;
    private $revelConfigurationRepository;
    /**
     * @var RevelToNetsuiteHistoryRepository
     */
    private $revelToNetsuiteHistoryRepository;
    /**
     * @var SyncHistoryRepository
     */
    private $syncHistoryRepository;
    /**
     * @var SchedulerRepository
     */
    private $schedulerRepository;
    /**
     * @var OutputInterface
     */

    /**
     * SyncService constructor.
     * @param RevelConfigurationRepository $revelConfigurationRepository
     * @param RevelToNetsuiteHistoryRepository $revelToNetsuiteHistoryRepository
     * @param SyncHistoryRepository $syncHistoryRepository
     * @param EntityManagerInterface $entityManager
     * @param SchedulerRepository $schedulerRepository
     */
    public function __construct(RevelConfigurationRepository $revelConfigurationRepository, RevelToNetsuiteHistoryRepository $revelToNetsuiteHistoryRepository, SyncHistoryRepository $syncHistoryRepository, EntityManagerInterface $entityManager,SchedulerRepository $schedulerRepository)
    {

        $this->entityManager = $entityManager;
        $this->revelConfigurationRepository = $revelConfigurationRepository;
        $this->revelToNetsuiteHistoryRepository = $revelToNetsuiteHistoryRepository;
        $this->syncHistoryRepository = $syncHistoryRepository;
        $this->schedulerRepository = $schedulerRepository;
    }

    /**
     * Process the bulk data.
     *
     * @param OutputInterface $output
     * @param null $initFlag
     * @param null $perPage
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function executeBulk(OutputInterface $output, $initFlag = null, $perPage = null)
    {

        try {

            $style = new OutputFormatterStyle('white', 'green', array('bold', 'blink'));
            $output->getFormatter()->setStyle('success', $style);

            $style = new OutputFormatterStyle('white', 'red', array('bold', 'blink'));
            $output->getFormatter()->setStyle('error', $style);

            $isActive = $this->schedulerRepository->find(1);
            if($isActive->getIsActive() != 1 ){

                $output->writeln("<error>Revel sync is not active - Please activate the revel schedular and run this command.</error>");
                exit;
            }

            $revelConfig = $this->revelConfigurationRepository->findAll();

            if (!$revelConfig) {
                $output->writeln(" Revel API configurations: <error>No revel configurations</error>");
                exit;
            } else {
                $output->writeln("Revel API connection status: <success> SUCCESS </success>\n");
            }

            $output->writeln(" <success> PLEASE WAIT... - REVEL SYNC WILL START SOON :) </success>");
            //dump($revelConfig[0]->getDomainName()); die;

            $revel = new Revel($revelConfig[0]->getDomainName(),
                $revelConfig[0]->getSecret(),
                $revelConfig[0]->getRevelKey());

            // Get all products.
            $products = $revel->products()->all();
            //$output->writeln("Revel connection: <success> SUCCESS </success>");

            $yncData = [];

            $counter = 1;
            foreach ($products as $product) {

                //dump($product->raw()); die;
                $productData = $product->data();
                $productName = $productData['name'] = $this->clean($productData['name']);

                $data = [];
                $data['module_name'] = 'Products';
                $data['module_entity'] = $productName;
                $data['entity_id'] = $product->id;
                $data['transaction_record'] = json_encode($productData);
                $data['is_success'] = 1;
                $data['destination'] = 'netSuite';
                $data['source'] = 'Revel';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['error'] = '';
                //$data['json_data'] = json_encode((object)$product->data());

                $yncData[] = $data;

                $output->writeln("Processing : $product->id - " . $productName . " -- <success> SUCCESS </success>");
                $this->logErrorFile(json_encode($productData));

                //$this->insertData($yncData, 'sync_history');
                //$yncData = [];

                if (($counter % 100) == 0 || $counter >= count($products)) {
                    if (!empty($yncData)) {
                        $this->insertData($yncData, 'sync_history');
                        $yncData = [];
                    }
                }

                $counter = $counter + 1;
            }

            $data = [];
            $data['ran_time'] = date("Y-m-d H:i:s");
            $data['is_success'] = 1;
            $data['error'] = '-';
            $data['processed_records_count'] = count($products);

            $synHistrory[] = $data;

            $this->insertData($synHistrory, 'revel_to_netsuite_history');

            $query = "update scheduler set is_success = 1, last_ran_time='" . date("Y-m-d H:i:s") . "' where id=1";
            $stmt = $this->entityManager->getConnection()->prepare($query);
            $stmt->execute();

        } catch (\Exception $e) {

            echo $e->getMessage();
            // $output->writeln("Exception: <error> " . $e->getMessage() . "</error>");
        }

        return;
    }

    /**
     * Insert Manager for a given data set and table.
     *
     * @param array $data
     * @param $tableName
     * @param array $excludedKeys
     * @param array $jsonDataKeys
     * @return array
     */
    protected function insertData(array $data, $tableName, $excludedKeys = [], $jsonDataKeys = [])
    {


        if (empty($data)) {
            return [];
        }

        $keys = $this->dataKeys($data);

        $keyString = implode(',', array_keys($keys));

        $query = "insert into {$tableName}({$keyString}) VALUES ";

        $rows = [];

        foreach ($data as $datum) {

            $datum = array_merge($keys, $datum);

            foreach ($datum as $key => $userDatum) {

                $jsonKey = in_array($key, $jsonDataKeys) ? $key : null;

                if ($jsonKey && isset($datum[$jsonKey]) && !empty($jsonData = $datum[$jsonKey])) {
                    $datum[$jsonKey] = $this->encapsulate(rtrim(ltrim($jsonData, "'"), "'"));
                } elseif ((empty($userDatum) || is_null($userDatum)) && !in_array($key, $excludedKeys)) {
                    $datum[$key] = 'NULL';
                } elseif (is_string($userDatum)) {
                    $datum[$key] = $this->encapsulate($userDatum);
                }
            }

            $rowString = implode(",", $datum);
            $rows[] = "({$rowString})";
        }

        if (empty($rows)) {
            $this->logErrorFile('Empty Data for query: ' . $query . "\n\nData: " . json_encode($rows));
            try {
                //$this->em->getConnection()->rollBack();
            } catch (\Exception $e) {
                $this->logErrorFile('Rollback Failed: Empty Data for query: ' . $query . "\n\nData: " . json_encode($rows));
            }

        }

        $query .= implode(',', $rows);

        $this->insert($query);
    }


    /**
     * Get all the keys for a non-associative array of associative array.
     *
     * @param array $data
     * @return array
     */
    protected function dataKeys(array $data)
    {
        $keys = $this->array_collapse($data);

        foreach ($keys as $key => $value) {
            $keys[$key] = null;
        }

        return $keys;
    }

    /**
     * Wrap the given string value in single quotes.
     *
     * @param $value
     * @return string
     */
    protected function encapsulate($value)
    {
        return "'{$value}'";
    }

    protected function array_collapse($array)
    {
        $results = [];
        foreach ($array as $values) {
            if ($values instanceof Collection) {
                $values = $values->all();
            } elseif (!is_array($values)) {
                continue;
            }
            $results = array_merge($results, $values);
        }
        return $results;
    }

    /**
     * Push the data to the error log file.
     *
     * @param $data
     */
    protected function logErrorFile($data)
    {
        $now = date('Y-m-d H:i:s', time());

        file_put_contents(__DIR__ . '/../../var/log/track.txt', "[{$now}]\n\n" . $data, FILE_APPEND);
    }

    protected function appendLogErrorFile($data)
    {
        $now = date('Y-m-d H:i:s', time());

        file_put_contents(__DIR__ . '/../../Logs/error.txt', "[{$now}][{$this->methodName}]\n\n" . $data, FILE_APPEND);
    }

    /**
     * Push the data to the exception log file.
     *
     * @param $data
     */
    protected function logExceptionFile($data)
    {
        $now = date('Y-m-d H:i:s', time());

        file_put_contents(__DIR__ . '/../../Logs/exceptions.txt', "\n[{$now}][{$this->methodName}] " . $data, FILE_APPEND);
    }

    /**
     * Rollback on an exception.
     *
     * @param \Exception $e
     */
    protected function rollBack(\Exception $e)
    {
        try {
            $this->em->getConnection()->rollBack();
            $this->logErrorFile('Line: ' . $e->getLine() . "\nFile: " . $e->getFile() . "\nMsg:" . $e->getMessage());
            $this->reRun();
        } catch (\Exception $e) {
            $this->logErrorFile('Woopsie am not able to catch myself. | ' . $e->getMessage());
        }
    }


    public function killMe()
    {

        if (self::MANUAL) {
            return;
        }

        $myPid = getmypid();
        pcntl_fork();
        passthru("kill {$myPid}");

        //$this->runQuery("set foreign_key_checks=0;", false, true);
    }

    /**
     * Adds the slashes and removes any specific special characters.
     *
     * @param $value
     * @return null|string|string[]
     */
    public function clean($value)
    {
        $value = (str_replace('`', '', trim($value)));
        $value = (str_replace('\'', '', trim($value)));
        return (str_replace('\"', '', trim($value)));
    }

    /**
     * Re Run the command.
     *
     * @param array $parameters
     */
    public function reRun($parameters = [])
    {
        if (self::MANUAL) {
            return;
        }

        $parameterString = '';
        if (!empty($parameters)) {
            foreach ($parameters as $name => $value) {
                $parameterString .= " --{$name}={$value}";
            }
        }

        $commandName = $this->getName();

        $command = $this->getContainer()->getParameter('fa.php.path') . ' ' . $this->getContainer()
                ->get('kernel')
                ->getRootDir() . "/console {$commandName} {$parameterString} &> /dev/null";

        passthru($command, $returnVar);
    }

    /**
     * Run the insert query.
     *
     * @param string $query
     * @return bool
     */
    public function insert($query)
    {
        try {

            $stmt = $this->entityManager->getConnection()->prepare($query);
            $stmt->execute();

            return true;

        } catch (\Exception $e) {
            // $this->rollBack($e);
            //exit;

            echo $e->getMessage();
            die;
            //  $output->writeln("Exception: <error> " . $e->getMessage() . "</error>");

        }
    }

    /**
     * Run the insert query.
     *
     * @param array $queries
     */
    public function update(array $queries)
    {
        if (empty($queries)) {
            return;
        }

        $query = implode(';', $queries);

        try {
            $conn = $this->em->getConnection();
            $conn->exec($query);
        } catch (\Exception $e) {
            $this->rollBack($e);
        }

        return;
    }

}