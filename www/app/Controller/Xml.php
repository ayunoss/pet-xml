<?php

namespace app\Controller;

class Xml extends Controller {

    public function __construct() {
        parent::__construct();
        $this->_createTable();
    }

    public function uploadXmlAction(): void {
        $tmpName = $_FILES['file']['tmp_name'] ?? null;
        $error   = $_FILES['file']['error'] ?? null;
        if ($tmpName === null || $error > 0) {
            return;
        }
        $xmlData      = simplexml_load_file($tmpName);
        $preparedData = $this->_prepareDataToStore($xmlData);
        $this->_storeXml($preparedData);
    }

    public function showXmlDataAction(): void {
        $query    = 'SELECT * FROM pet WHERE age >= 3';
        $petsInfo = $this->db->getAssocDataViaPDO($query);

        echo '<table>
        <th>Code</th>
        <th>Pet name</th>
        <th>Species</th>
        <th>Breed</th>
        <th>Gender</th>
        <th>Age</th>
        <th>Parent</th>
        <th>Owner</th>';
        foreach ($petsInfo as $petInfo) {
            echo '<tr>';
            echo "<td> {$petInfo['code']} </td>";
            echo "<td> {$petInfo['name']} </td>";
            echo "<td> {$petInfo['species']} </td>";
            echo "<td> {$petInfo['breed']} </td>";
            echo "<td> {$petInfo['gender']} </td>";
            echo "<td> {$petInfo['age']} </td>";
            echo "<td> {$petInfo['parent_code']} </td>";
            echo "<td> {$petInfo['owner']} </td>";
            echo '</tr>';
        }
        echo '</table>';
    }

    /**
     * @param \SimpleXMLElement $data
     * @return array
     */
    private function _prepareDataToStore(\SimpleXMLElement $data): array {
        $result = [];
        foreach ($data as $datum) {
            $petOwner          = (string)$datum->attributes()['Name'];
            $petsData          = $this->_preparePetDataToStore($datum->Pets->Pet);
            $petsData['owner'] = $petOwner;
            $result[]          = $petsData;
        }
        return $result;
    }

    /**
     * @param \SimpleXMLElement $data
     * @return array
     */
    private function _preparePetDataToStore(\SimpleXMLElement $data): array {
        $result = [];
        foreach ($data as $datum) {
            $reward = $datum->Rewards ?? null;
            $parent = $datum->Parents->Parent ?? null;
            $result[] = [
                'code'        => (string)$datum->attributes()['Code'] ?? null,
                'name'        => (string)$datum->Nickname->attributes()['Value'] ?? null,
                'species'     => (string)$datum->attributes()['Type'] ?? null,
                'breed'       => (string)$datum->Breed->attributes()['Name'] ?? null,
                'gender'      => (string)$datum->attributes()['Gender'] ?? null,
                'age'         => (float)$datum->attributes()['Age'] ?? null,
                'has_reward'  => $reward !== null ? 1 : 0,
                'parent_code' => $parent !== null ? (string)$parent->attributes()['Code'] : $parent
            ];
        }
        return $result;
    }

    private function _storeXml(array $data): void {
        foreach ($data as $petsData) {
            $owner = $petsData['owner'];
            unset($petsData['owner']);
            foreach ($petsData as $params) {
                $params['owner'] = $owner;
                $query  = 'INSERT INTO `pet` (`code`, `name`, `species`, `breed`, `gender`, `age`, `has_reward`, `parent_code`, `owner`) 
                            VALUES (:code, :name, :species, :breed, :gender, :age, :has_reward, :parent_code, :owner)';
                try {
                    $this->db->queryPDO($query, $params);
                } catch (\PDOException $e) {
                    echo "Error while creating user: {$e->getMessage()}";
                }
            }
        }
    }

    private function _createTable(): void {
        $sql = "CREATE TABLE IF NOT EXISTS `pet` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `code` varchar(11) DEFAULT NULL,
              `name` varchar(255) DEFAULT NULL,
              `species` varchar(255) DEFAULT NULL,
              `breed` varchar(255) DEFAULT NULL,
              `gender` varchar(255) DEFAULT NULL,      
              `age` float(11) DEFAULT NULL,
              `has_reward` int(11) DEFAULT NULL,
              `parent_code` int(11) DEFAULT NULL,
              `owner` varchar(255) DEFAULT NULL,
              PRIMARY KEY (`id`),
              KEY (`code`),
              KEY (`age`)
            ) DEFAULT CHARSET=utf8;";
        try {
            $this->db->queryPDO($sql);
        } catch (\PDOException $e) {
            echo "Error while creating 'pet' table: {$e->getMessage()}";
        }
    }
}