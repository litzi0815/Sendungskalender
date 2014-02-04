<?php
class terminrechner
{
	private $db;
	
	function __construct()
	{
		$this->db=mysql_connect('localhost','programmkalender','programmkalender');
		mysql_select_db('programmkalender',$this->db);
	}
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
	
	public function KalenderKollision($beginn,$ende)
	{
		$coll=array();
		$sql=mysql_query('SELECT id FROM termine WHERE '.$beginn.' BETWEEN beginn AND beginn+(dauer_std*3600-1)',$this->db);
		while($row=mysql_fetch_array($sql))
		{
			array_push($coll,$row['id']);
		}
		
		$sql=mysql_query('SELECT id FROM termine WHERE beginn='.$beginn,$this->db);
		while($row=mysql_fetch_array($sql))
		{
			array_push($coll,$row['id']);
		}
		
		$sql=mysql_query('SELECT id FROM termine WHERE beginn BETWEEN '.$beginn.' AND '.$ende,$this->db);
		while($row=mysql_fetch_array($sql))
		{
			array_push($coll,$row['id']);
		}
		
		$sql=mysql_query('SELECT id FROM termine WHERE beginn+(dauer_std*3600-1) BETWEEN '.$beginn.' AND '.$ende,$this->db);
		while($row=mysql_fetch_array($sql))
		{
			array_push($coll,$row['id']);
		}
		
		return array_unique($coll);
	}
	
	private function ListeToArray($liste)
	{
		return explode(',',$liste);
	}
	
	private function ArrayToListe($array)
	{
		return implode(',',$array);
	}
	
	private function DayBegin($timestamp)
	{
		return strtotime("midnight", $timestamp);;
	}
	
	private function DayEnd($timestamp)
	{
		return strtotime("tomorrow", $this->DayBegin($timestamp)) - 1;
	}
	
	private function UnixToDate($timestamp)
	{
		return date('Y-m-d',$timestamp);
	}
	
	public function AddEvent($sendung_id,$startdatum,$uhrzeit,$dauer_std,$tag,$tagesliste,$monatsliste,$calc_beginn,$calc_end)
	{
		//
	}
}
?>