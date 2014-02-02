<?php
class terminrechner
{
	private function GetTagNr($timestamp)
	{
		return date('N',$timestamp);
	}
	
	private function GetTagName($timestamp)
	{
		return date('A',$timestamp);
	}
	
	private function GetWochenNr($timestamp)
	{
		$monat_begin=strtotime("midnight first day of this month",$timestamp);
		$woche_monat_begin=date('W',$monat_begin);
		$woche_current=date('W',$timestamp);
		$wochen_nr=$woche_monat_begin-$woche_current+1;
		return $wochen_nr;
	}
	
	public function CalcWoechentlich($begin_calc,$end_calc,$show_id,$uhrzeit,$wochenabstand,$tag,$wochenliste) // Tag: 1 (Mo) - 7 (So) - Ausnahmen: Liste der Wochen (z. B. 1,3,5 - leer=wöchentlich)
	{
		
	}
}
?>