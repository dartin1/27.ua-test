<?
/**
 * @author Plitka Alexander
 */
include 'classes/updateDuplicates.php';
include 'classes/duplicateChains.php';
include 'classes/reader.php';
include 'classes/csvReader.php';
?>
<pre>
<?
$csvReader = new CsvReader('input.csv');
$updateDuplicates = new UpdateDuplicates($csvReader);
$updateDuplicates->process();

?>
</pre>