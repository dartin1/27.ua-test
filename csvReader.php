<?
/**
 * Class CsvReader
 * @author Plitka Alexander
 */
class CsvReader extends Reader
{
    /**
     * @var array
     */
    private $requiredFields;

    /**
     * CsvReader constructor.
     * @param string $fileName
     */
    public function __construct($fileName)
    {
        $this->output = "output.csv";

        $this->requiredFields = [
            "EMAIL",
            "CARD",
            "PHONE"
        ];

        $this->readFile($fileName);
    }

    /**
     * Read file to data
     * @param string $fileName
     */
    public function readFile($fileName)
    {
        $csvData = file($fileName);
        
        foreach ($csvData as $i => $csvLine) {
            if ($i == 0)
                $this->setInputHead(str_getcsv($csvLine));
            else {
                $csvFields = str_getcsv($csvLine);
                
                foreach ($csvFields as $j => $field) {
                    $this->data[$this->inputHead[$j]][] = $field;
                }
            }
        }
    }

    /**
     * Set csv table head
     * @param array $csvLine
     */
    private function setInputHead($csvLine)
    {
        foreach ($csvLine as $field)
            $this->inputHead[] = $field;
    }

    /**
     * @param mixed $data
     * @param bool $fileName
     */
    public function saveToFile($data, $fileName = false)
    {
        if (!$fileName)
            $fileName = $this->output;
        $file = fopen($fileName, "w");
        fputcsv($file, $this->inputHead);
        
        foreach ($data["ID"] as $i => $field) {
            unset($tmp);
            foreach ($this->inputHead as $j => $column) {
                $tmp[] = $data[$column][$i];
            }
            fputcsv($file, $tmp);
        }
    }

    /**
     * @param array $fields
     */
    public function setRequiredFields($fields)
    {
        $this->requiredFields = $fields;
    }

    public function getRequiredFields()
    {
        return $this->requiredFields;
    }
}
?>