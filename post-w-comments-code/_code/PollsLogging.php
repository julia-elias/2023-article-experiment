<?php

class PollsLogging
{
		//define instance variables
		private $ipAddress, $currTime, $pollResponse, $pollAnswer, $pollType, $pollName;

		function __construct($response, $answer, $type, $name, $commenter_position)
		{
				//set instance variables
				$this->ipAddress = $_SERVER["REMOTE_ADDR"];
				$this->currTime = date("m/d/Y g:i:s A",time()-18000);
				$this->pollResponse = $response;
				$this->pollAnswer = $answer;
				$this->pollType = $type;
				$this->pollName = $name;
				$this->commenter_position = $commenter_position;
				$this->rootDir = "/home/content/85/9884685/html/post-with-comments-1-column/";
		}

		function __deconstruct()
		{
				// do nothing, yet
		}

		function WriteToFile() 
		{	
				//create array of log files
				if ($this->pollName == "<user-browsing-site>")
				{
						$logPath = array($this->rootDir . "/_logs/" . $this->ipAddress . ".csv", $this->rootDir . "/_logs/" . $this->ipAddress . ".txt");
				}
				else
				{
						$logPath = array($this->rootDir . "/_logs/CommentsLogging.csv", $this->rootDir . "/_logs/CommentsLogging.txt");
				}
				
				//loop through log files
				foreach($logPath as $log)
				{
					  //open file with append
						$logFile = fopen($log, 'a') or die("A problem has occurred. Please contact administrator.");
						
						//create text string to add
						if ($this->pollName == "<user-browsing-site>")
						{
								$logText = $this->ipAddress . "|" . $this->currTime . "|" . $this->pollAnswer . "\n";
						}
						else
						{
								$logText = $this->ipAddress . "|" . $this->currTime . "|" . $this->pollName . "|" . $this->pollResponse . "|" . $this->pollAnswer . "|" . $this->commenter_position . "\n";
						}
						
						//write to file
						fwrite($logFile, $logText);
						
						//close file
						fclose($logFile);
				}
		}
}

?>