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
		
		// escape header row
		$headersEscaped = [];
		foreach ($headers as $header) {
			$headersEscaped[] = '"' . addslashes($header) . '"';
		}


		// escape rows
		$rowsEscaped = [];
		foreach ($rows as $row) {
			$rowEscaped = [];

			foreach ($row as $cell) {
				$rowEscaped[] = '"' . addslashes($cell) . '"';
			}

			$rowsEscaped[] = $rowEscaped;
		}

		// output header
		echo implode(',', $headersEscaped), "\r\n";

		// output rows
		foreach ($rowsEscaped as $row) {
			echo implode(',', $row), "\r\n";
		}

	}


}
