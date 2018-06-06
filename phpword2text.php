<?php

require __DIR__ . '/vendor/autoload.php';

class PHPWord2Text {

	protected function getElementsText($elements, $finish_char=' '){
		$retText = '';
		foreach($elements as $el){
			if(method_exists($el,'getText')){
				$retText .= $el->getText().$finish_char;
			}
			else{
				if(method_exists($el,'getElements')){
					if(get_class($el) == 'PhpOffice\PhpWord\Element\TextRun'){
						$retText .= getElementsText($el->getElements(),'')." ";
					}
					else{
						$retText .= getElementsText($el->getElements())." ";
					}
				}
			}
		}
		return $retText;
	}

	public function extractText($filename){
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if($ext == 'docx'){
			$phpWord = \PhpOffice\PhpWord\IOFactory::load($filename, 'Word2007'); //for .docx files
		}
		elseif($ext == 'doc'){
			$phpWord = \PhpOffice\PhpWord\IOFactory::load($filename, 'MsDoc'); //for .doc files
		}
		elseif($ext == 'rtf'){
			$phpWord = \PhpOffice\PhpWord\IOFactory::load($source,'RTF'); //for RTF files
		}
		elseif($ext == 'odt'){
			$phpWord = \PhpOffice\PhpWord\IOFactory::load($source, 'ODText'); //for .odt files
		}
		else{
			return ''; //nothing to do here
		}
		
		$allSections = $phpWord->getSections();
		
		$ret = '';
		foreach($allSections as $s){

			$allElements = $s->getElements();

			$ret .= $this->getElementsText($allElements);

		}
		return $ret;
	}
}


