<?

/**
 * Class DuplicateChains
 * This class could be update in future for speed optimization
 * @author Plitka Alexander
 */
class DuplicateChains
{
    /**
     * @param mixed $duplicates
     * @return array
     */
    public function getParentIds($duplicates)
    {
        $duplicateChains = $this->makeChains($duplicates);
        $parentIds = $this->makeParentIds($duplicateChains);
        
        return $parentIds;
    }

    /**
     * @param mixed $duplicates
     * @return mixed
     */
    private function makeChains($duplicates)
    {
        foreach ($duplicates as $i => $duplicateI) {
            foreach ($duplicates as $j => $duplicateJ) {
                
                if ($i != $j && isset($duplicates[$i]) && isset($duplicates[$j])) {
                    if (array_intersect($duplicates[$i], $duplicates[$j])) {
                        $duplicates[$i] = array_unique(array_merge($duplicates[$i], $duplicates[$j]));
                        unset($duplicates[$j]);
                    }
                }
            }
        }
        
        return $duplicates;
    }

    /**
     * @param mixed $duplicateChains
     * @return array
     */
    private function makeParentIds($duplicateChains)
    {
        foreach ($duplicateChains as $duplicateChain) {
            $flipChain = array_flip($duplicateChain);
            foreach ($flipChain as $key => $value)
                $result[$key - 1] = min($duplicateChain);
        }
        ksort($result);
        
        return $result;
    }
}

?>