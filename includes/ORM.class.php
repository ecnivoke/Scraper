<?php 

class ORM {
// Properties
// End Properties

	public function __construct(){
		
	}
// Getters
// End Getters
// Setters
// End Setters
// Methods
	protected function checkTable($table){
		// Try to get a row
		try {
			$this->getRows('SELECT * FROM `'.$table.'` LIMIT 1');
			return true;
		}
		// Failed
		catch(Exception $e){
			return false;
		}
	}

	protected function buildTable($table, $values){

		// Build sql
		$sql = 'CREATE TABLE `'.$this->getPrefix().$table.'`(
			`id` int(11)';

		foreach($values as $column => $v){
			// None of the standard columns
			if( $column !== 'created' && 
				$column !== 'updated' && 
				$column !== 'status'){

				// Create int column
				if(is_numeric($v)){
					$sql .= ',`'.$column.'` int(11) NOT NULL';
				}
				// Create varchar column
				elseif(strlen($v) <= 255){
					$sql .= ',`'.$column.'` varchar(255) NOT NULL';
				}
				// Create text column
				else {
					$sql .= ',`'.$column.'` text NOT NULL';
				}
			}
		}

		// Standard table columns
		$sql .= ',`status` enum("a","i","d") NOT NULL';
		$sql .= ',`created` datetime NOT NULL';
		$sql .= ',`updated` datetime NOT NULL DEFAULT current_timestamp());';

		// Make `id` primary key
		$alter = 'ALTER TABLE `'.$table.'`
			ADD PRIMARY KEY (id),
			MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
		';

		// Create Table and columns
		$this->executeBuild($sql, $alter);

		// Insert record
		$this->insert($table, $values);
	}

	protected function buildColumn($table, $column, $values){
		// Build sql
		$sql = '
			ALTER TABLE 
				`'.$table.'`
			ADD
				`'.$column.'` ';

		// Create int column
		if(is_numeric($values[$column])){
			$sql .= 'int(11) NOT NULL;';
		}
		// Create varchar column
		elseif(strlen($values[$column]) <= 255){
			$sql .= 'varchar(255) NOT NULL;';
		}
		// Create text column
		else {
			$sql .= 'text NOT NULL;';
		}

		// Create Table and columns
		$this->executeBuild($sql);

		// Insert record
		$this->insert($table, $values);
	}
// End methods
}


 ?>