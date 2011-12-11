<?php
/** 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Tool
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_iTunes_Search_Tool extends Zend_Tool_Framework_Provider_Abstract {
     /**
     * Read the first item of a feed
     *
     * @param  string $feed Named identifier for a feed
     * @return bool
     */
    public function search($searchTerm)
    {
//        if (!array_key_exists($feed, $this->_feeds)) {
//            throw new Zend_Tool_Project_Exception(sprintf(
//                'Unknown feed "%s"',
//                $feed
//            ));
//        }

//        $feed = Zend_Feed_Reader::import($this->_feeds[$feed]);
//        $title = $desc = $link = '';
//        foreach ($feed as $entry) {
//            $title = $entry->getTitle();
//            $desc  = $entry->getDescription();
//            $link  = $entry->getLink();
//            break;
//        }



        //$content = sprintf("%s\n%s\n\n%s\n", $title, strip_tags($desc), $link);

        $response = $this->_registry->getResponse();
        $response->appendContent("Hello '$searchTerm'");
        return true;
    }
}
