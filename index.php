<?php

	 require_once "FFmpegAutoloader.php";

	 \Phpffmpeg\FFmpegAutoloader::register();

	 $move=new \Phpffmpeg\adapter\ffmpeg_movie('../test.mp4',true);

	 $duration=$move->getDuration();

	 var_dump($duration);
	// exec('ffmpeg -version',$arr,$state);
	// print_r($state);
?>