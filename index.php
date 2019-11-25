<?
/**
 * @author Plitka Alexander
 */
include 'updateDuplicates.php';
include 'duplicateChains.php';
include 'reader.php';
include 'csvReader.php';

$csvReader = new CsvReader('input.csv');
$updateDuplicates = new UpdateDuplicates($csvReader);
$updateDuplicates->process();

?>
