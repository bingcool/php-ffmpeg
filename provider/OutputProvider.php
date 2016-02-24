<?php
/**
 * OutputProvider interface of all output providers
 * 
 * @author huandzengbing
 * @package FFmpegPHP
 * @subpackage provider
 * @license New BSD
 * @version 2.6
 */

namespace Phpffmpeg\provider;

interface OutputProvider {

    /**
     * Setting movie file path
     * 
     * @param string $movieFile
     */
    public function setMovieFile($movieFile);
    
    /**
     * Getting parsable output
     * 
     * @return string
     */
    public function getOutput();
}