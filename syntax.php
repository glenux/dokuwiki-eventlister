<?php
/**
 * Embed an image gallery
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Glenn Y. Rolland <glenux@glenux.net>
 */

if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

class syntax_plugin_eventlister extends DokuWiki_Syntax_Plugin {

    /**
     * Get Plugin info
     */
    function getInfo(){
        return array(
            'author' => 'Glenn Y. Rolland',
            'email'  => 'glenux@glenux.net',
            'date'   => '2010-10-14',
            'name'   => 'Dokuwiki EventLister',
            'desc'   => 'A listing plugin for dokuwiki. It lists either pages for upcoming, either for past events.',
            'url'    => 'http://github.com/glenux/dokuwiki-eventlister',

        );
    }

	/**
	 * What kind of syntax are we?
	 */
	function getType(){
		return 'substition';
	}

	/**
	 * What about paragraphs?
	 */
	function getPType(){
		return 'block';
	}

	/**
	 * Where to sort in?
	 */
	function getSort(){
		return 301;
	}


	/**
	 * Connect pattern to lexer
	 */
	function connectTo($mode) {
		$this->Lexer->addSpecialPattern('\{\{eventlister>[^}]*\}\}',$mode,'plugin_eventlister');
	}

    /**
     * Handle the match
     */
    function handle($match, $state, $pos, &$handler){
        $match = preg_replace("%{{eventlister>( (.*))?}}%", "\\2", $match);
        //echo "\n\t<!-- syntax_plugin_pageindex.handle() found >> $match << -->\n";
        return $match;
	}

	/**
	 * Create output
	 */
	function render($mode, &$R, $data) {
		if($mode != 'xhtml') return false;

		$R->info['cache'] = $data['cache'];
		$R->doc .= $this->_gallery($data);
		return true;
	}


}

//Setup VIM: ex: et ts=4 enc=utf-8 :

