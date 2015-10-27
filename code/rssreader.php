<?php
	include("connectDB.php");
	class content
	{
		private $title;
		private $describtion;
		private $data;
		private $link;
		private $dlink;
		private $category;
		
		function __construct()
		{
		 $this->title = null;
		 $this->describtion = null;
		 $this->data = null;
		 $this->link = null;
		 $this->dlink = null;
		 $this->category = null;
		}
	}
	class mylist
	{
		public $table;
		
		function __construct()
		{
			$this->table[1] = Parasyte;
			$this->table[2] = Jojo;
			$this->table[3] = Shigatsu;
			$this->table[4] = Aldnoah;
			$this->table[5] = Classroom;
			$this->table[6] = Durarara;
			$this->table[7] = Cross;
			$this->table[8] = Garo;
			$this->table[9] = Yowamushi;
			$this->table[10] = Akatsuki;
			$this->table[11] = Parade;
			$this->table[12] = Kantai;
			$this->table[13] = Yatterman;
			$this->table[14] = Virgin;
			$this->table[15] = Horizon;
			$this->table[16] = Ghoul;
			$this->table[17] = Rolling;
			$this->table[18] = Exodus;
		}
	}
	function getPackNumber($link)
	{
		$raw = file_get_contents($link);
		$newlines = array("\t","\n","\r","\x20\x20","\0","\x0B");
		$content = str_replace($newlines, "", html_entity_decode($raw));
		$len = strlen($content);
		
		return $len;
	}
	function getRss($link)
	{
		$tempRss = file_get_contents($link);
		$newRss = new SimpleXmlElement($tempRss);
		
		return $newRss;
	}
	function countTitles($content)
	{
		$nofTitles = 0;
		$lista = new mylist;
		foreach($content->channel->item as $entry) 
		{
			for($i=1;$i<19;$i++)
			{
				if(strpos($entry->title,"[720p]") && strpos($entry->title,$lista->table[$i]))
				{
					$nofTitles = $nofTitles + 1;
				}
			}
		}		
		return $nofTitles;
	}
	function readRss($content)
	{
		$nofTitles = countTitles($content);
		$nofPerpage = 8;
		$actPage = $_GET['actpage'];
		$tableofTitles[$nofTitles][6];
		$startTitle = 1;
		$lista = new mylist;
		foreach($content->channel->item as $entry) 
		{
			for($i=1;$i<19;$i++)
			{
				if(strpos($entry->title,"[720p]") && strpos($entry->title,$lista->table[$i]))
				{
					$tableofTitles[$startTitle][1] = "<a href=".$entry->guid.">".$entry->title."</a>";
					$tableofTitles[$startTitle][2] = "<a href=".$entry->link.">.torrent</a>";
					$title = str_replace(" ","+",$entry->title);
					$title = str_replace("[","%5B",$title);
					$title = str_replace("]","%5D",$title);
					$tableofTitles[$startTitle][3] = "<a href=http://nibl.co.uk/bots.php?search=".$title.">XDCC</a>";
					$tableofTitles[$startTitle][4] = $entry->category;
					$tableofTitles[$startTitle][5] = $entry->pubDate;
					$tableofTitles[$startTitle][6] = $entry->description;
					$startTitle = $startTitle + 1;
				}	
			}
		}
		return $tableofTitles;
	}
	function getRssDB()
	{
		$connect = connect();
		
		$query = "SELECT * FROM rsscontent";
		$result = mysql_query($query) or die(mysql_error());
		$maxrows = mysql_num_rows($result);
		
		$tableofTitles[$maxrows][6];
		$actRow = 1;
		while($row=mysql_fetch_array($result)) 
		{
			$tableofTitles[$actRow][1] = $row['title'];
			$tableofTitles[$actRow][2] = $row['torr'];
			$tableofTitles[$actRow][3] = $row['xdcc'];
			$tableofTitles[$actRow][4] = $row['cat'];
			$tableofTitles[$actRow][5] = $row['pdate'];
			$tableofTitles[$actRow][6] = $row['descr'];
			$actRow = $actRow + 1;
		}
		disconnect($connect);
		
		return $tableofTitles;
	}
	
	function countTitlesDB()
	{
		$connect = connect();
		$query = "SELECT * FROM rsscontent";
		$result = mysql_query($query) or die(mysql_error());
		$maxrows = mysql_num_rows($result);
		disconnect($connect);
		
		return $maxrows;
	}
	function saveRss($tableofTitles,$content)
	{
		$connect = connect();
		$nofTitles = countTitles($content);
		$query = "SELECT * FROM rsscontent";
		$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
		for($i = 1; $i < $nofTitles + 1; $i++)
		{
			$exist = 0;
			$title = $tableofTitles[$i][1];
			$torr = $tableofTitles[$i][2];
			$xdcc = $tableofTitles[$i][3];
			$cat = $tableofTitles[$i][4];
			$pdate = $tableofTitles[$i][5];
			$desc = $tableofTitles[$i][6];
			$row = mysql_fetch_array($result);
			
			if($row['title'] == $tableofTitles[$i][1])
			{
				$exist = 1;
			}
			if($numrows == 0 || $exist == 0)
			{
				$query = "INSERT INTO u884401057_silab.rsscontent (id, title, torr, xdcc, cat, pdate, descr) VALUES (NULL,'$title', '$torr', '$xdcc', '$cat', '$pdate', '$desc')";
				mysql_query($query);
			}
		}
		disconnect($connect);
	}
	function showRss($tableofTitles,$content)
	{
		$nofTitles = countTitles($content);
		$nofPerpage = 8;
		$actPage = $_GET['actpage'];
		for($i = $actPage; $i < $actPage + $nofPerpage; $i++)
		{
			echo $tableofTitles[$i][1];
			echo "		";
			echo $tableofTitles[$i][2];
			echo "		";
			echo $tableofTitles[$i][3];
			echo "</br>";
			echo $tableofTitles[$i][4];
			echo "	";
			echo $tableofTitles[$i][5];
			echo "</br>";
			echo $tableofTitles[$i][6];
			echo "<br>";
			echo "<br>";
		}
		$nrstr = 0;
		for($i = 1; $i < $nofTitles + 1; $i=$i+$nofPerpage)
		{
			$nrstr++;
			echo "<a href=index.php?id=14&actpage=".$i.">[".$nrstr."]</a>";
		}
	}
	function showRssDB($tableofTitles)
	{
		$nofTitles = countTitlesDB();
		$nofPerpage = 8;
		$actPage = $_GET['actpage'];
		for($i = $actPage; $i < $actPage + $nofPerpage; $i++)
		{
			echo $tableofTitles[$i][1];
			echo "		";
			echo $tableofTitles[$i][2];
			echo "		";
			echo $tableofTitles[$i][3];
			echo "</br>";
			echo $tableofTitles[$i][4];
			echo "	";
			echo $tableofTitles[$i][5];
			echo "</br>";
			echo $tableofTitles[$i][6];
			echo "<br>";
			echo "<br>";
		}
		$nrstr = 0;
		for($i = 1; $i < $nofTitles + 1; $i=$i+$nofPerpage)
		{
			$nrstr++;
			echo "<a href=index.php?id=14&actpage=".$i.">[".$nrstr."]</a>";
		}
	}
	function continousWork()
	{
		set_time_limit(0);
		$endtime = time()+(1*60*60);
		while(time()<$endtime)
		{
			/*
			if(condition) //time etc
			{
				do something
			}
			*/
			sleep(1);
		}
	}
?>
