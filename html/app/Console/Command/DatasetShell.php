<?php 

App::uses('AppShell', 'Console/Command');

class DatasetShell extends AppShell {
    
    public $uses = array('Dataset');

    public function main() {
        $this->out('Hello world.');
    }


    public function generate($id = null) {
        // $user = $this->User->findByUsername($this->args[0]);
        // $this->out(print_r($user, true));
        if(true){

        	$fieldsDataset = array();
			$optionFields = array();
			$groupOptions = array();

        	//$dataset = $this->Dataset->find('first', array('conditions' => array( 'Dataset.id' => $id ) ) );
        	
        	$dataset = $this->Dataset->find('first', array('conditions' => array( 'Dataset.id' => $id ) ) );
        	
        	//option for fields
		    $data_clean = fopen( WWW_ROOT . 'uploads/datasets/' . $dataset['Dataset']['data_clean'] ,"r");
			$header_data_clean = null;
			while ($row = fgetcsv($data_clean)) {
			    if ($header_data_clean === null) {
			        $header_data_clean = $row;
			        continue;
			    }
			    $optionFields[] = array_combine($header_data_clean, $row);
			}
			fclose($data_clean);
			foreach ($optionFields as $option) {
				$groupOptions = array_merge_recursive($groupOptions, $option);
			}		    	
			
		    

		    //column info
		    $column_info = fopen( WWW_ROOT . 'uploads/datasets/' . $dataset['Dataset']['column_info'] ,"r");
			$header_column_info = null;
			while ($row = fgetcsv($column_info)) {
			    if ($header_column_info === null) {
			        $header_column_info = $row;
			        continue;
			    }
			    $fieldsDataset[] = array_combine($header_column_info, $row);
			}
			fclose($column_info);
			$fullArray = $this->prepareOptions($fieldsDataset, $groupOptions);

			$fullArrayJson = json_encode($fullArray);
			$file = 'dataset.json';
			file_put_contents($file, $fullArrayJson);


        }

    }

    private function prepareOptions($criteria = array(), $options = array()) {
		
		$indexOptions = array_keys($options);

		$arrayTemp = array();
		
		foreach ($criteria as $criterion) {

			$pushInArray = false;
			
			foreach ($indexOptions as $index) {
				
				if ( $criterion['Column'] == $index && ($criterion['IsScreenable'] == 'TRUE' OR $criterion['IsScreenable'] == 'TRUE') ) {

					$criterion['options'] = array_unique( $options[$index] );

					array_push($arrayTemp,  $criterion ) ;

					$pushInArray = true;

					break;

				}

			}

			if ($pushInArray == false) {
				
				array_push( $arrayTemp,  $criterion ) ;

			}


		}

		return $arrayTemp;
	}


}

?>
