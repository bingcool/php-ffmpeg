<?php

	require_once "FFmpegAutoloader.class.php";

	\Phpffmpeg\FFmpegAutoloader::register();

	$movie=new \Phpffmpeg\adapter\ffmpeg_movie('../test.mp4',true);

	$duration=$movie->getDuration();
 	$framenum=$movie->getFrameCount();
	$name=$movie->getFilename();
	$width=$movie->getFrameWidth();
	$height=$movie->getFrameHeight();
	$comment=$movie->getVideoCodec();

	$frame =$movie->getFrame(6);
	$frame->resize(400,400,20,20,20,50);
	$img=$frame->toGDImage();
	imagejpeg($img,'my.jpeg');
	imagedestroy($img);

	$size = $movie->getSize();
   	
   	$image = $movie->getImage('my.jpg',6,1000,1000);
   	
   	$gif = $movie->getGif('uu.gif',40,5,300,300);
	 
 	var_dump($duration).'<br>';
 	var_dump($framenum).'<br>';
 	var_dump($name)."<br>";
 	var_dump($width.'*'.$height);
 	var_dump($comment);
?>