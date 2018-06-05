<?php

require __DIR__ . '/vendor/autoload.php';

class PHPWord2Text {

	protected function getElementsText($elements, $finish_char=' '){
		$retText = '';
		foreach($elements as $el){
			//echo "        Element: $j\n";
			
			if(method_exists($el,'getText')){
				$retText .= $el->getText().$finish_char;
			}
			else{
				//if($el instanceof \PhpOffice\PhpWord\Element\AbstractContainer){
				if(method_exists($el,'getElements')){
					//echo "        text: getting elements for class:".get_class($el)."\n";
					if(get_class($el) == 'PhpOffice\PhpWord\Element\TextRun'){
						$retText .= getElementsText($el->getElements(),'')." ";
					}
					else{
						$retText .= getElementsText($el->getElements())." ";
					}
				}
				else{
					//echo "        text: not available for class:".get_class($el)."\n";
				}
			}
		}
		return $retText;
	}

	public function extractText($filename){
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if($ext == 'docx'){
			$phpWord = \PhpOffice\PhpWord\IOFactory::load($filename, 'Word2007'); //gia .docx arxeia
		}
		elseif($ext == 'doc'){
			$phpWord = \PhpOffice\PhpWord\IOFactory::load($filename, 'MsDoc'); //gia .doc arxeia
		}
		elseif($ext == 'rtf'){
			$phpWord = \PhpOffice\PhpWord\IOFactory::load($source,'RTF'); //gia RTF arxeia
		}
		elseif($ext == 'odt'){
			$phpWord = \PhpOffice\PhpWord\IOFactory::load($source, 'ODText'); //gia .odt arxeia
		}
		else{
			return ''; //nothing to do here
		}
		
		$allSections = $phpWord->getSections();
		
		$ret = '';
		foreach($allSections as $s){

			$allElements = $s->getElements();
			
			//printElementsText($allElements, $j);
			
			$ret .= $this->getElementsText($allElements);

		}
		return $ret;
	}
}


