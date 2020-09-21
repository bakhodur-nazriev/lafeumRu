<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class HtaccessService
{

    public function addRedirection($from, $to, $code = 301)
    {
        if(!$from) return;
        
        if($to) {
            $redirectionString = "Redirect $code \"$from\" \"$to\"\r\n";
            $this->preventRedirectLoop($from, $to);

        } else {
            $redirectionString = "Redirect $code \"$from\"\r\n";
        }

        $this->insertToModRewrite($redirectionString);
    }    

    public function insertToModRewrite(string $command)
    {
        $htaccessContent = $this->getContent();

        $positionToInsert = $this->getInsertablePositionInTag(
            $htaccessContent,
            '<IfModule mod_rewrite.c>', '</IfModule>'
        );

        if($positionToInsert === null){
            $this->appendToHtaccess(
                "<IfModule mod_rewrite.c>\r\n$command</IfModule>\r\n"
            );
            return;
        } 
        
        $htaccessContent = substr_replace(
            $htaccessContent, 
            $command,
            $positionToInsert, 
            0
        );

        $this->setContent($htaccessContent);
    }

    public function appendToHtaccess(string $command)
    {
        File::append(
            $this->getPath(),
            $command
        );
    }

    
    /**
     * Helpers
     * 
     */

    
    /**
     * Returns path to .htaccess file
     */
    private function getPath()
    {
        return public_path('.htaccess');
    }

    /**
     * Returns content of .htaccess file
     */
    private function getContent()
    {
        return File::get($this->getPath());
    }

    /**
     * Replaces content of .htaccess with $content
     */
    private function setContent(string $content)
    {
        File::put($this->getPath(), $content);
    }

    /**
     * Returns insertable for commands position inside of a last founded tag in $htaccessContent,
     * returns null if position not found.
     */
    private function getInsertablePositionInTag(string $htaccessContent, string $tagStarts, string $tagEnds)
    {
        $lastTagStartPosition = mb_strrpos($htaccessContent, $tagStarts);

        if($lastTagStartPosition === false){
            return null;
        }

        $lastTagEndPosition = mb_strrpos($htaccessContent, $tagEnds, $lastTagStartPosition);

        if($lastTagEndPosition === false){
            return null;
        }

        return $lastTagEndPosition;
    }

    /**
     * Prevents redirect loop by removing previous backward redirections
     */
    private function preventRedirectLoop($from, $to)
    {
        $htaccessContent = $this->getContent();

        $from = str_replace('/', '\/', $from);
        $to = str_replace('/', '\/', $to);

        $contentWithoutBackward = preg_replace(
            '/Redirect(.*)"'. $to  .'" "'. $from .'"\\r\\n/',
            '', 
            $htaccessContent
        );

        $this->setContent($contentWithoutBackward);
    }
}