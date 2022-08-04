<?php
session_start();

include dirname(__FILE__)."/db_mysql.php";

class question_h
{
	var $question="";
	var $doit="";
	
	function init($iclass)
	{
		switch ($iclass)
		{
		case "1": //80%初級、20%中級
			$row = loaddata_array("wik_question"," WHERE class='1' ORDER BY RAND() LIMIT 8 ");
			for ($i=0;$i<count($row);$i++)
			{
				$r[$i] = $row[$i]['uid'];
			}
			$j = 8;
			$row = loaddata_array("wik_question"," WHERE class='2' ORDER BY RAND() LIMIT 2 ");
			for ($i=0;$i<count($row);$i++)
			{
				$r[$j] = $row[$i]['uid'];
				$j++;
			}
			break;
		case "2": //60%初級、20%中級、20%高級
			$row = loaddata_array("wik_question"," WHERE class='1' ORDER BY RAND() LIMIT 6 ");
			for ($i=0;$i<count($row);$i++)
			{
				$r[$i] = $row[$i]['uid'];
			}
			$j = 6;
			$row = loaddata_array("wik_question"," WHERE class='2' ORDER BY RAND() LIMIT 2 ");
			for ($i=0;$i<count($row);$i++)
			{
				$r[$j] = $row[$i]['uid'];
				$j++;
			}
			$j = 8;
			$row = loaddata_array("wik_question"," WHERE class='3' ORDER BY RAND() LIMIT 2 ");
			for ($i=0;$i<count($row);$i++)
			{
				$r[$j] = $row[$i]['uid'];
				$j++;
			}
			break;
		case "3": //30%初級、30%中級、40%高級
			$row = loaddata_array("wik_question"," WHERE class='1' ORDER BY RAND() LIMIT 3 ");
			for ($i=0;$i<count($row);$i++)
			{
				$r[$i] = $row[$i]['uid'];
			}
			$j = 3;
			$row = loaddata_array("wik_question"," WHERE class='2' ORDER BY RAND() LIMIT 3 ");
			for ($i=0;$i<count($row);$i++)
			{
				$r[$j] = $row[$i]['uid'];
				$j++;
			}
			$j = 6;
			$row = loaddata_array("wik_question"," WHERE class='3' ORDER BY RAND() LIMIT 4 ");
			for ($i=0;$i<count($row);$i++)
			{
				$r[$j] = $row[$i]['uid'];
				$j++;
			}
			break;
		}
		shuffle($r);
		$t_question = implode(",",$r);
		$t_doit = "0,0,0,0,0,0,0,0,0,0";
		$t_useranswer = "0,0,0,0";
		session_unregister("s_question");
		session_unregister("s_doit");
		session_unregister("s_isinit");
		session_unregister("s_win");
		session_unregister("s_pk");
		session_unregister("s_t_pk");
		session_unregister("s_useranswer");
		session_unregister("s_showquite");
		session_register("s_question");
		session_register("s_doit");
		session_register("s_isinit");
		session_register("s_win");
		session_register("s_pk");
		session_register("s_t_pk");
		session_register("s_useranswer");
		session_register("s_showquite");
		$_SESSION['s_question'] = $t_question;
		$_SESSION['s_doit'] = $t_doit;
		$_SESSION['s_isinit'] = 1;
		$_SESSION['s_win'] = $t_doit;
		$_SESSION['s_pk'] = 0;
		$_SESSION['s_t_pk'] = 20;
		$_SESSION['s_useranswer'] = $t_useranswer;
		$_SESSION['s_showquite'] = 0;
		//$this->question = $t_question;//$_SESSION['s_question'];
		//$this->doit = $_SESSION['s_doit'];
	}
	
	function is_init()
	{
		$result = false;
		if (session_is_registered("s_isinit"))
		{
			if ($_SESSION['s_isinit']=="1")
			{
				$result = true;
			}
		}
		return $result;
	}
	
	function free()
	{
		session_unregister("s_question");
		session_unregister("s_doit");
		session_unregister("s_isinit");
		session_unregister("s_win");
		session_unregister("s_pk");
		session_unregister("s_t_pk");
		session_unregister("s_useranswer");
		session_unregister("s_showquite");
	}
	
	function set_showquite()
	{
		session_unregister("s_t_pk");
		session_unregister("s_useranswer");
		session_unregister("s_showquite");
		session_register("s_t_pk");
		session_register("s_useranswer");
		session_register("s_showquite");
		$_SESSION['s_t_pk'] = 0;
		$_SESSION['s_useranswer'] = "1,1,1,1";
		$_SESSION['s_showquite'] = 1;
	}
	
	function get_showquite()
	{
		return $_SESSION['s_showquite'];
	}
	
	function now_question_index()
	{
		$t_doit = explode(",",$_SESSION['s_doit']);
		$j=0;
		for ($i=0;$i<count($t_doit);$i++)
		{
			if ($t_doit[$i]==0)
			{
				$j = $i;
				break;
			}
		}
		return $j;
	}
	
	function isEnd()
	{
		$t_doit = explode(",",$_SESSION['s_doit']);
		$result = true;
		for ($i=0;$i<count($t_doit);$i++)
		{
			if ($t_doit[$i]==0)
			{
				$result = false;
				break;
			}
		}
		return $result;
	}
	
	function chk_Answer()
	{
		$t_doit = explode(",",$_SESSION['s_win']);
		$a['win'] = 0;
		$a['lost'] = 0;
		for ($i=0;$i<count($t_doit);$i++)
		{
			if ($t_doit[$i]==0)
			{
				$a['lost']++;
			}else
			{
				$a['win']++;
			}
		}
		return $a;
	}
	
	function get_question()
	{
		$this->question = $_SESSION['s_question'];
		return $this->question;
	}
	
	function get_doit()
	{
		$this->doit = $_SESSION['s_doit'];
		return $this->doit;
	}
	
	function set_doit($index)
	{
		$t_doit = explode(",",$_SESSION['s_doit']);
		$t_doit[$index] = "1";
		session_unregister("s_doit");
		session_register("s_doit");
		$_SESSION['s_doit'] = implode(",",$t_doit);
		//
		session_unregister("s_useranswer");
		session_register("s_useranswer");
		$_SESSION['s_useranswer'] = "0,0,0,0";
		//
		$t = $_SESSION['s_pk'];
		$s_t_pk = $_SESSION['s_t_pk'];
		$t+=$s_t_pk;
		session_unregister("s_pk");
		session_register("s_pk");
		$_SESSION['s_pk'] = $t;
		session_unregister("s_t_pk");
		session_register("s_t_pk");
		$_SESSION['s_t_pk'] = 20;
	}
	
	function get_pk()
	{
		$this->doit = $_SESSION['s_pk'];
		$s_t_pk = $_SESSION['s_t_pk'];
		return $this->doit+$s_t_pk;
	}
	
	function get_win()
	{
		$this->doit = $_SESSION['s_win'];
		return $this->doit;
	}
	
	function set_win($index)
	{
		/*$t = $_SESSION['s_pk'];
		session_unregister("s_pk");
		session_register("s_pk");
		$t+=10;
		$_SESSION['s_pk'] = $t;*/
		//
		$t_doit = explode(",",$_SESSION['s_win']);
		$t_doit[$index] = "1";
		session_unregister("s_win");
		session_register("s_win");
		$_SESSION['s_win'] = implode(",",$t_doit);
	}
	
	function get_question_answer($index)
	{
		$t_question = explode(",",$_SESSION['s_question']);
		
		$row = loaddata_row("wik_question"," WHERE uid='".$t_question[$index]."' ");
		return $row;
	}
	
	function get_useranswer()
	{
		$t_useranswer = explode(",",$_SESSION['s_useranswer']);
		return $t_useranswer;
	}
	
	function chk_question_answer($ans_index,$playeranswer)
	{
		//回答第幾題
		$t_useranswer = explode(",",$_SESSION['s_useranswer']);
		$t_useranswer[$playeranswer-1] = "1";
		session_unregister("s_useranswer");
		session_register("s_useranswer");
		$_SESSION['s_useranswer'] = implode(",",$t_useranswer);
		
		$t_question = explode(",",$_SESSION['s_question']);
		
		$row = loaddata_row("wik_question"," WHERE uid='".$t_question[$ans_index]."' ");
		
		$result = false;
		if ($playeranswer==$row['answer'])
		{
			$result = true;
		}else
		{
			$s_t_pk = $_SESSION['s_t_pk'];
			$s_t_pk-=5;
			session_unregister("s_t_pk");
			session_register("s_t_pk");
			$_SESSION['s_t_pk'] = $s_t_pk;
		}
		return $result;
	}
}
?>