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
	
	private function CalcTagPos($timestamp) // wievielter wochentag des monats?
	{
		$nr=date('d',$timestamp);
		$count=0;
		while($nr>0)
		{
			$nr=$nr-7;
			$count++;
		}
		return $count;
	}
	
	private function GetWochenNr($timestamp)
	{
		$monat_begin=strtotime("midnight first day of this month",$timestamp);
		$woche_monat_begin=date('W',$monat_begin);
		$woche_current=date('W',$timestamp);
		$wochen_nr=$woche_current-$woche_monat_begin+1;
		return $wochen_nr;
	}
	
	public function CalcEvent($begin_calc,$end_calc,$startdatum,$tag,$tagesliste,$monatsliste) // Tag: 1 (Mo) - 7 (So) - Tages/monatsliste (array): Liste der Tage/monate (z. B. 1,3,5 - leer=wöchentlich/monatlich)
	{
		$list=array();
		
		if($begin_calc<$startdatum)
		{
			$begin_calc=$startdatum;
		}
		
		while($this->GetTagNr($begin_calc)!=$tag) // Gehe immer einen Tag vor, bis der erste Sendungstemrin erreicht ist
		{
			$begin_calc=$begin_calc+86400; // 24 Stunden addieren
		}
		
		for($i=$begin_calc;$i<=$end_calc;$i=$i+604800)
		{
			if(empty($monatsliste) || in_array(date('m',$i),$monatsliste))
			{
				if(empty($tagesliste) || in_array($this->CalcTagPos($i),$tagesliste))
				{
					array_push($list,$i);
				}
			}
		}
		return $list;
	}
}
?>