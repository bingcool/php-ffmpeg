<?php
/**
 * ffmpeg_movie serves as a compatiblity adapter for old ffmpeg-php extension
 * 
 * @author huandzengbing
 * @package FFmpegPHP
 * @subpackage adapter
 * @link http://ffmpeg-php.sourceforge.net/doc/api/ffmpeg_movie.php
 * @license New BSD
 * @version 2.6
 */

namespace Phpffmpeg\adapter;

use Phpffmpeg\FFmpegMovie;
use Phpffmpeg\provider\FFmpegOutputProvider;

class ffmpeg_movie {

    protected $adaptee;
    protected $moviePath;
    protected $commend = 'ffmpeg';

    public function __construct($moviePath, $persistent = false) {
        $this->adaptee = new FFmpegMovie($moviePath, new FFmpegOutputProvider($this->commend, $persistent));
        $this->moviePath = $moviePath;
    }
    
    public function getDuration() {
        return $this->adaptee->getDuration();
    }
    
    public function getFrameCount() {
        return $this->adaptee->getFrameCount();
    }
    
    public function getFrameRate() {
        return $this->adaptee->getFrameRate();
    }
    
    public function getFilename() {
        return $this->adaptee->getFilename();
    }
    
    public function getComment() {
        return $this->adaptee->getComment();
    }
    
    public function getTitle() {
        return $this->adaptee->getTitle();
    }
    
    public function getArtist() {
        return $this->adaptee->getArtist();
    }
    
    public function getAuthor() {
        return $this->adaptee->getAuthor();
    }
    
    public function getCopyright() {
        return $this->adaptee->getCopyright();
    }
    
    public function getGenre() {     
        return $this->adaptee->getGenre();
    }
    
    public function getTrackNumber() {    
        return $this->adaptee->getTrackNumber();
    }
    
    public function getYear() {
        return $this->adaptee->getYear();
    }    
    
    public function getFrameHeight() {
        return $this->adaptee->getFrameHeight(); 
    }
    
    public function getFrameWidth() {
        return $this->adaptee->getFrameWidth(); 
    }
    
    public function getPixelFormat() {
        return $this->adaptee->getPixelFormat(); 
    }
    
    public function getBitRate() {
        return $this->adaptee->getBitRate(); 
    }
    
    public function getVideoBitRate() {
        return $this->adaptee->getVideoBitRate(); 
    }
    
    public function getAudioBitRate() {
        return $this->adaptee->getAudioBitRate(); 
    }
    
    public function getAudioSampleRate() {
        return $this->adaptee->getAudioSampleRate(); 
    }
    
    public function getFrameNumber() {
        return $this->adaptee->getFrameNumber(); 
    }
    
    public function getVideoCodec() {
        return $this->adaptee->getVideoCodec(); 
    }
    
    public function getAudioCodec() {
        return $this->adaptee->getAudioCodec(); 
    }
    
    public function getAudioChannels() {
        return $this->adaptee->getAudioChannels(); 
    }
    
    public function hasAudio() {
        return $this->adaptee->hasAudio(); 
    }
    
    public function hasVideo() {
        return $this->adaptee->hasVideo(); 
    }
    
    public function getFrame($framenumber = null) {
        $toReturn = null;
        $frame    = $this->adaptee->getFrame($framenumber);
        if ($frame != null) {
            $toReturn = new ffmpeg_frame($frame->toGDImage(), $frame->getPTS());
            $frame    = null;
        }                            
        
        return $toReturn;
    }
    
    public function getNextKeyFrame() {        
        $toReturn = null;
        $frame    = $this->adaptee->getNextKeyFrame(); 
        if ($frame != null) {
            $toReturn = new ffmpeg_frame($frame->toGDImage(), $frame->getPTS());
            $frame    = null;
        }
        
        return $toReturn;
    } 

    public function getSize() {
        return ceil(sprintf("%u",filesize($this->moviePath)) / 1024);
    }

    public function getImage($savePath,$second,$width,$height) {
        if($savePath && $second && $width && $height){
            $second = (int) $second;
            $width = (int) $width;
            $height = (int) $height;
            if($second > ($this->getDuration()-2)) {
                die("startsecond is over video duration!");
            }
            exec($this->commend.' -i '.$this->moviePath.' -y -f image2 -ss '.$second.' -t 0.001 -s '.$width.'x'.$height.' '.$savePath,$out,$status);
            if($status==0) {
                return true;
            }else {
                return false;
            }
        
        }else {
            die("four params is not set!");
        }
        
    }

    public function getGif($savePath,$startsecond,$lastsecond,$width,$height) {
        if($savePath && $startsecond && $lastsecond && $width && $height){
            $startsecond = (int) $startsecond;
            $lastsecond = (int) $lastsecond;
            $width = (int) $width;
            $height = (int) $height;
            if($startsecond > ($this->getDuration()-2)) {
                die("startsecond is over video duration!");
            }else if(($startsecond+$lastsecond) > ($this->getDuration()-2)) {
                die("startsecond+lastsecond is over video duration!");
            }
            exec($this->commend.' -i '.$this->moviePath.' -y -f gif -ss '.$startsecond.' -t '.$lastsecond.' -s '.$width.'x'.$height.' -pix_fmt rgb24 '.$savePath,$out,$status);
            if($status==0) {
                return true;
            }else {
                return false;
            }
        
        }else {
            die("five params is not set!");
        }
        
    }
    
    public function __clone() {
        $this->adaptee = clone $this->adaptee;
    }
    
    public function __destruct() {
        $this->adaptee = null;
    }
}