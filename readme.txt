前言
Phpffmpeg这个模块是基于php5写的，定义了许多可以处理的视频API。

可以参考：http://ffmpeg-php.sourceforge.net/doc/api/ffmpeg_frame.php

用法

模块已经实现了命名空间与require的映射结合,利用php5的命名空间和自动加载可以很方便地使用。在项目中要建立一个名为Phpffmpeg（名称不能改，因为要与文件定义的根命名空间对应相同）的空的文件夹，把文件下载后，将里面的文件复制至新建的Phpffmpeg文件夹下。

首先要导入 FFmpegAutoloader.class.php ,在执行静态的register()注册方法
	require_once "path/FFmpegAutoloader.class.php";
	\Phpffmpeg\FFmpegAutoloader::register();

这个path是新建Phpffmpeg文件的路径。

其实将FFmpegAutoloader文件命名成带有class的形式，如FFmpegAutoloader.class.php，是为了兼容在thinkphp3.2以上框架的命名空间加载。所以如果实在tp3.2以上的的框架中使用该模块的话，同样，需要在核心框架library中新建Phpffmpeg文件夹，将下载的文件全部复制至Phpffmpeg文件夹中。那么在Controller中使用的话，就不需要require_once了，直接执行

	\Phpffmpeg\FFmpegAutoloader::register();

这样已经实现了自动加载和自动注册功能，因为tp自动的自动加载功能会先执行require_once将文件包含进来。

API详解

ffmpeg_movie部分

（1）$movie = new ffmpeg_movie(String path_to_media, boolean persistent);

创建视频处理对象，第一个参数是视频url,第二个参数是以长连接打开视频资源，true或者false。

（2）$movie->getDuration();
获取视频时长，单位秒

（3）$movie->getFrameCount();
获取视频帧数

（4）$movie->getFrameRate();
获取帧率

（5）$movie->getFilename();
获取文件路径，包括文件名称

（6）$movie->getComment()；
获取视频的注释

（7）$movie->getTitle();
获取主题

（8）$movie->getFrameHeight()；
获取视频高度（分辨率）

（9）$movie->getFrameWidth()
获取视频宽度（分辨率）

（10）$movie->getPixelFormat()

获取像素格式,例如yuv420p

(11)$movie->getFrameNumber()；
获取当前帧索引

（12）$movie->getFrame([Integer framenumber]);

获取对应的帧,返回的对象将作为new ffmpeg_frame(Resource gd_image)的实例化对象。
Returns a frame from the movie as an ffmpeg_frame object. Returns false if the frame was not found. 

（13）$movie->getNextKeyFrame();

获取下一帧
Returns the next key frame from the movie as an ffmpeg_frame object. Returns false if the frame was not found. 

ffmpeg_frame部分

（1）$frame = new ffmpeg_frame(Resource gd_image);

参数是一个图片资源对象（需要自己创建），如果执行$movie->getFrame([Integer framenumber]);择返回的就是一个相当于new ffmpeg_frame(Resource gd_image);的实例化对象；

（2）$frame->getWidth(); 	

返回宽度

（3）$frame->getHeight();

返回高度

（3）$frame->getPTS();

（4）$frame->getPresentationTimestamp();

（5）$frame->resize(Integer width, Integer height [, Integer crop_top [, Integer crop_bottom [, Integer crop_left [, Integer crop_right ]]]]);

（6）$frame->crop(Integer crop_top [, Integer crop_bottom [, Integer crop_left [, Integer crop_right ]]]);

（7）$frame->toGDImage();

返回一个dg对象

例如:

	$frame = $movie->getFrame(6);//返回ffmpeg_frame的对象
	$frame->resize(400,400,20,20,20,50);
	$img = $frame->toGDImage();
	//将gd对象保存为图片
	imagejpeg($img,'my.jpeg');
	imagedestroy($img); 










