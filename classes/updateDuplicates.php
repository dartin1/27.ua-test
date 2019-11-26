<?

/**
 * Class UpdateDuplicates
 * @author Plitka Alexander
 */
class UpdateDuplicates
{
    /**
     * @var Reader
     */
    private $csvReader;
    /**
     * @var mixed
     */
    private $duplicates;

    /**
     * UpdateDuplicates constructor.
     * @param Reader $csvReader
     */
    public function __construct(Reader $csvReader)
    {
        $this->csvReader = $csvReader;
    }

    public function process()
    {
        $duplicateChains = new DuplicateChains($this->duplicates);
        $requiredFields = $this->csvReader->getRequiredFields();
        $data = $this->csvReader->getData();

        foreach ($requiredFields as $requiredField) {
            $this->findDuplicates($data[$requiredField]);
        }

        $parentIds = $duplicateChains->getParentIds($this->duplicates);
        foreach ($data["ID"] as $key => $id) {
            $data["PARENT_ID"][$key] = $parentIds[$id];
        }

        $this->csvReader->saveToFile($data);
    }

    /**
     * Find duplicate values in array
     * @param $array
     */
    private function findDuplicates($array)
    {
        $data = $this->csvReader->getData();
        
        foreach ($array as $key => $val) {
            $this->duplicates[$val][] = $data["ID"][$key];
        }
    }

    /**
     * Show input data in array for debug
     */
    public function showInputData()
    {
        var_dump($this->csvReader->getData());
    }
}

?>