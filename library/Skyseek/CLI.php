<?php

class Skyseek_CLI {
	const BLACK = 30;
	const RED = 31;
	const GREEN = 32;
	const YELLOW = 33;
	const BLUE = 34;
	const MAGENTA = 35;
	const CYAN = 36;
	const WHITE = 37;

	const UP = "A";
	const DOWN = "B";
	const RIGHT = "C";
	const LEFT = "D";

	const A_LEFT = "G";

	public static $stdout = false;

	public static function colorEcho($what, $newLine = true, $fgColor=self::WHITE, $bgColor=self::BLACK, $bold=false) {



		$bgColor+=10;

		$bold=$bold?"1;":false;
		self::stdout("\033[{$bold}{$bgColor};{$fgColor}m{$what}\033[0m");

		if($newLine) {
			self::stdout("\r\n");
		}



	}

	public static function stdout($what) {
		if(!self::$stdout) {
			self::$stdout = fopen('php://stdout', 'w');
		}

		fwrite(self::$stdout, $what, strlen($what));
	}

	public static function confirm($message, $questionColor=self::YELLOW, $NLAfterQ=false) {
		self::colorEcho($message. " ", $NLAfterQ, $questionColor, self::BLACK, true);
		$response = substr(fread(STDIN, 1024), 0 , -1);

		switch ($response) {
			case '':
			case 'no':
			case 'n':
			case 'f':
			case 'false':
			case '0':
				$response = false;
				break;
			default:
				$response = true;
				break;
		}

		return $response ? true : false;
	}

	public static function move($N, $direction) {
		echo "\033[{$N}{$direction}";
	}

	public static function moveTo($x=0, $y=0) {
		echo "\033[{$y};{$x}H";
	}

	public static function clear() {
		echo "\033[2J";
	}

	public static function clearToEOL() {
		echo "\033[K";
	}

	public static function saveCursorPosition() {
		echo "\033[s";
	}

	public static function restoreCursorPosition() {
		echo "\033[u";
	}

	public static function NL($num=1) {
		for($i=0; $i<$num; $i++)
		self::stdout("\r\n")
		;
	}

	public static function showColors() {
		$colors = array(
			self::BLACK,
			self::RED,
			self::GREEN,
			self::YELLOW,
			self::BLUE,
			self::MAGENTA,
			self::CYAN,
			self::WHITE
		);

		foreach($colors as $color) {
			self::colorEcho("Test", true, $color);
			self::colorEcho("Test", true, $color, self::BLACK, true);
		}
	}

	public static function startMSG($what) {
		self::colorEcho($what, false, self::WHITE, self::BLACK, true);
	}

	public static function finishMSG($what, $color=self::GREEN) {
		self::move(60, self::A_LEFT);
		self::colorEcho("[  ", false);
		self::colorEcho($what, false, $color, self::BLACK, true);
		self::colorEcho("  ]", true);
	}

	public static function errorHandler($severity, $message, $file, $line) {
            self::NL(2);
            echo "Error";
            self::NL(1);
            echo $message;
            exit;
    }

	public static function show($title, $description=false, $die=true) {
		CLI::NL(1);
		CLI::colorEcho($title, true, CLI::RED);
		echo $description;

		CLI::NL(2);

		if($die) {
			exit;
		}
	}

	public function indent($what, $howMany=1) {
		$lines = explode("\n", $what);
		$indent = str_pad("", $howMany*2, "\t");
		foreach($lines as &$line) {
			$line = $indent . $line;
		}
		return implode("\n", $lines);
	}

	public function error($message=false, $description=false, $errorInfo=false) {
		CLI::NL(1);

		if($errorInfo) {
			CLI::colorEcho("A PHP Error Has Occured! ", true, CLI::RED, CLI::BLACK, true);

			CLI::colorEcho("\tMessage: ", false, CLI::YELLOW, CLI::BLACK, true);
			CLI::colorEcho($errorInfo['message'], true, CLI::WHITE, CLI::BLACK, true);


			CLI::colorEcho("\tFile: ", false, CLI::YELLOW, CLI::BLACK, true);
			CLI::colorEcho($errorInfo['file'], true, CLI::WHITE, CLI::BLACK, true);

			CLI::colorEcho("\tLine: ", false, CLI::YELLOW, CLI::BLACK, true);
			CLI::colorEcho($errorInfo['line'], true, CLI::WHITE, CLI::BLACK, true);

			CLI::colorEcho("\tSeverity: ", false, CLI::YELLOW, CLI::BLACK, true);
			CLI::colorEcho($errorInfo['severity'], true, CLI::WHITE, CLI::BLACK, true);



			self::NL();
			if(self::confirm("\tWould you like to see the backtrace?", CLI::MAGENTA)) {
				$step = 0;
				$backtraces = array_slice(debug_backtrace(),1);

				while(isset($backtraces[$step])) {
					self::colorEcho(self::indent(print_r($backtraces[$step], 1), 1), true, self::CYAN);
					$step++;
					if(isset($backtraces[$step]) && !self::confirm("\tView Next Point?", CLI::MAGENTA)) {
						$step = count($backtraces);
					}
				}
			}
		} else if($message || $description) {
			CLI::colorEcho("Error:" . $message, true, CLI::RED);
			echo $description;
		}







		exit;

	}
}