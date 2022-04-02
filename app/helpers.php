<?php

use Illuminate\Support\Facades\Storage;

/**
 * Convert an array (JSON Object) to XML
 *
 * @param array $array
 * @param SimpleXMLElement $xml
 * @return void
 */
function arrayToXml($array, &$xml)
{
    foreach ($array as $key => $value) {
        if (is_int($key)) {
            $key = 'el';
        }
        if (is_array($value)) {
            $label = $xml->addChild($key);
            arrayToXml($value, $label);
        } else {
            $xml->addChild($key, $value);
        }
    }
}

/**
 * Save SimpleXMLElement object to a file in public storage xml folder
 *
 * @param SimpleXMLElement $xml
 * @param string $destination The destination path to save the file (Directory)
 * @param string $name The file name excluding the extension (.xml)
 * @return void
 */

function saveXMLAsFile($xml, $name)
{
    $filename = $name . '.xml';
    $path = public_path('/storage/xml/' . $filename);
    if (!Storage::exists($path)) {
        Storage::put('xml/' . $filename, '');
    }
    $xml->saveXML($path);
    return;
}
