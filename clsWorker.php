<?php
class clsWorker{

	public function __construct() {
		
	}		

	public function biss_hours( $startDate, $endDate ){
	    $periodInterval = new DateInterval( "P1D" );

	    $period = new DatePeriod( $startDate, $periodInterval, $endDate );
	    $total 	= 0;

	    foreach( $period as $date ){
	    	//today is working day?
	        if( in_array( $date->format('l'), array( 'Monday', 'Saturday' ))){
	        	if( $date->format('Y-m-d') == $startDate->format('Y-m-d') ){
		        	if( $date->format('Y-m-d') == $endDate->format('Y-m-d') ){		            	
		            	$total = $this->get_diferencia_times( $startDate, $endDate );
		            }
		            else{
		            	$hold = clone $startDate;
		            	$endtime = $hold->modify('+1 day');
		            	$endtime->setTime(0, 0);
		            	if( $total == 0 ){
							$interval = $startDate->diff( $endtime );
							$dias     = $interval->format('%a');
							$total    = 0;
							if( $dias == 1 ){
								$total = $interval->format('%a día y %H:%I:%S');
							}
							else{
								if( $dias == 0 ){
									$total = $interval->format('%H:%I:%S');
								}
								else{
									$total = $interval->format('%a días y %H:%I:%S');
								}
							}							
						}
		            }
	            }
	        }
	    }
		
		return $total;
	}	
}
?>

