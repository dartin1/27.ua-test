<?
/**
 * Class Reader
 * @author Plitka Alexander
 */
abstract class Reader
{
    /**
     * @var string
     */
    public $output;
    /**
     * @var array
     */
    protected $inputHead;
    /**
     * @var array
     */
    protected $data;

    /**
     * @param string $fileName
     */
    abstract public function readFile($fileName);

    /**
     * @param mixed $data
     * @param bool $fileName
     */
    abstract public function saveToFile($data, $fileName = false);

    public function getData()
    {
        return $this->data;
    }

    public function getInputHead()
    {
        return $this->inputHead;
    }
}

?>