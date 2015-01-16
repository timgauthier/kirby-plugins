<? 
// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');


// Based on code from @texnixe at http://getkirby.com/forum/general/20140723/extract-the-first-paragraph-from-an-article/
// Rewrote portions using the DOMDocument php to pull more reliably in my multilanguage environment.

   function getFirstPara($string){

		libxml_use_internal_errors(true); // This internalizes errors, essentially hiding them, harder to debug.

   	// a new dom object
		$dom = new domDocument; 
		 
		// load the html into the object
		
		if (!$dom->loadHTML('<?xml encoding="UTF-8">' . $string)) {

	  libxml_clear_errors(); // This hides the errors essentially, makes it hard to debug.
		
		// dirty fix
		foreach ($dom->childNodes as $item)
		    if ($item->nodeType == XML_PI_NODE)
		        $dom->removeChild($item); // remove hack
		$dom->encoding = 'UTF-8'; // insert proper
		}
		 
		// discard white space
		$dom->preserveWhiteSpace = false;

		$paragraphs = $dom->getElementsByTagName('p'); // We search for paragraphs, please note that markdown blockquotes will be lost, contents will be pulled.

		$paragraph = $paragraphs->item(0);
		
		 // Dump $paragraphs as HTML/XML that can be rendered on final page. This strips all blockquotes etc. First paragraph is just output as a paragraph.
		echo $paragraph->C14N();

    } 
?>
