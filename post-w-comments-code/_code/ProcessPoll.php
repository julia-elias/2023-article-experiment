<?php 

$rootDir = "/home/content/85/9884685/html/post-with-comments-1-column/";

require_once $rootDir . '/_code/PollsLogging.php';

//if post type is open ended
if ($_POST["slider"])
{
		//call poll class to process new poll inputs
		$poll = new ProcessPoll($_POST["slider"], "slider", $_POST["slider-poll-answer"], $_POST["slider-poll-correct-txt"], $_POST["slider-poll-incorrect-txt"]);
		$results = $poll->init();
		$response = $poll->getSliderValue();
		$answer = $poll->getSliderAnswer();

		//log results of the poll
		$log = new PollsLogging($response, $answer, "slider", $_POST["slider-poll-name"]);
		$log->WriteToFile();
}
//if post type is choice
elseif ($_POST["radio-choice"])
{
		//call poll class to process new poll inputs
		$poll = new ProcessPoll($_POST["radio-choice"], "radio-choice", $_POST["choice-poll-answer"], $_POST["choice-poll-correct-txt"], $_POST["choice-poll-incorrect-txt"]);
		$results = $poll->init();
		$response = $poll->getRadioValue();
		$answer = $poll->getRadioAnswer();

		//log results of the poll
		$log = new PollsLogging($response, $answer, "radio-choice", $_POST["choice-poll-name"]);
		$log->WriteToFile();
}

if ($_POST["type"] == "ping")
{
		$log = new PollsLogging($_POST["start"], $_POST["render"], "log-time", "<user-browsing-site>");
		$log->WriteToFile();
}


if ($_POST["button"])
{
		//log results of the poll
		$log = new PollsLogging($_POST["id"], $_POST["button"], "button", "button");
		$log->WriteToFile();
}

if ($_POST["comment"])
{
		//log results of the poll
		$log = new PollsLogging($_POST["name"], $_POST["comment"], "comment", "comment", $_POST["commenter_position"]);
		$log->WriteToFile();
}

class ProcessPoll
{
		//class instance variables
		private $sliderValue, $sliderAnswer, $sliderResults, $sliderCorrectTxt, $sliderIncorrectTxt, $sliderDefault;
		private $radioValue, $radioAnswer, $radioResults, $radioCorrectTxt, $radioIncorrectTxt;
	
		//default constructor, initiate object
		function __construct($userResponse, $pollType, $pollAnswer, $pollCorrectTxt, $pollIncorrectTxt)
		{
				//for open ended questions
				if ($pollType == "slider")
				{
						$this->sliderValue =  $userResponse;
						$this->sliderAnswer = $pollAnswer;
						$this->sliderCorrectTxt = $pollCorrectTxt;
						$this->sliderIncorrectTxt = $pollIncorrectTxt;
						$this->sliderDefault = 0;
				}
				//for choice questions
				elseif ($pollType == "radio-choice")
				{
						$this->radioValue =  $userResponse;
						$this->radioAnswer = $pollAnswer;
						$this->radioCorrectTxt = $pollCorrectTxt;
						$this->radioIncorrectTxt = $pollIncorrectTxt;
				}
		}

		//starter function
		function init()
		{		
				//call function to process open ended question
				if ($this->sliderValue != null)
				{
						$value = $this->processSlider();
				}
				//call function to process choice question
				elseif ($this->radioValue != null)
				{
						$value = $this->processRadio();
				}
				
				return $value;
		}

		//used for processing open ended questions
		function processSlider()
		{
				$sResults = "";
				$sValue = $this->sliderValue;
				$sAnswer = explode("-", $this->sliderAnswer);
				$sCorrectTxt = $this->sliderCorrectTxt;
				$sIncorrectTxt = $this->sliderIncorrectTxt;
			
				//correct answer
				if($sValue >= $sAnswer[0] && $sValue <= $sAnswer[1])
				{
						$sResults .= $sCorrectTxt;
				}
				//incorrect answer
				else
				{
						$sValue = str_replace("XXX", $sValue, $sIncorrectTxt);
						$sResults .= $sValue;
				}
				
				return $sResults;
		}
		
		//used for processing choice questions
		function processRadio()
		{
				$sResults = "";
				$sValue = $this->radioValue;
				$sAnswer = $this->radioAnswer;
				$sCorrectTxt = $this->radioCorrectTxt;
				$sIncorrectTxt = $this->radioIncorrectTxt;
			
				//correct answer
				if($sValue == $sAnswer)
				{
						$sResults .= $sCorrectTxt;
				}
				//incorrect answer
				else
				{
						$sValue = str_replace("XXX", $sValue, $sIncorrectTxt);
						$sResults .= $sValue;
				}
				
				return $sResults;
		}
		
		/* getter methods for instance object */
		
		function getSliderValue()
		{
				return ($this->sliderValue != null) ? $this->sliderValue : $this->sliderDefault;
		}
		
		function getSliderAnswer()
		{
				return $this->sliderAnswer;
		}
		
		function getRadioValue()
		{
				return ($this->radioValue != null) ? $this->radioValue : "";
		}
		
		function getRadioAnswer()
		{
				return $this->radioAnswer;
		}
}

?>