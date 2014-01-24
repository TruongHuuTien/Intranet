<?php
/**
 * Selectic Helper
 *
 * @library    Selectic
 * @author     Fabien Vautour <fabien.vautour@softconceptcanada.com>
 */
 
class Selectic_Helper
{
	const PATH_LANGUAGE = 'language';
	
	const LOG_LEVEL_0 = 'ERROR';
	const LOG_LEVEL_1 = 'DEBUG';
	const LOG_LEVEL_2 = 'WARNING';
	const LOG_LEVEL_3 = 'NOTICE';
	
	const FILENAME = 'log';
	
	/**
     * Translate a text
     *
     * @param string $text
     * @return string
     */
    public static function translate($text, $language, $file = 'translate')
    {
		$file = BP . DS . self::PATH_LANGUAGE . DS . $language . DS . $file . '.csv';
		$csv_data = self::csvToArray($file);
		
		return $csv_data[$text];
    }
	
	/**
     * Transform a CSV file in an array PHP
     *
     * @param string $filename
	 * @param string $delimiter
     * @return array
     */
	public static function csvToArray($filename = '', $delimiter = ',')
	{
		if(!file_exists($filename) || !is_readable($filename))
	        return false;
		
		$data = array();
		$file = fopen($filename, 'r');
		while (($line = fgetcsv($file)) !== FALSE) {
			$data[$line[0]] = $line[1];
		}
		fclose($file);
		
		return $data;
	}
	
	
}
