<?php
App::uses('AppHelper', 'View/Helper');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class CsvResponseHelper extends AppHelper {

	function send($headers, $rows, $filename = 'export', $requestQuery = null) {

		if (isset($requestQuery['download']) && $requestQuery['download']) {
			header('Content-Type: application/csv');
			header('Content-Disposition: attachment; filename=' . $filename . '.csv');
			header('Pragma: no-cache');	
		}
		
		echo $this->array2csv($headers, $rows);


	}

	private function array2csv(array $headers, array $rows)
	{
	   ob_start();
	   $df = fopen("php://output", 'w');
	   fputcsv($df, $headers);
	   foreach ($rows as $row) {
	      fputcsv($df, $row);
	   }
	   fclose($df);
	   return ob_get_clean();
	}


}
