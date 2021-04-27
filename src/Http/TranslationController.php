<?php

namespace Tradein\LanguageTranslation\Http;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    protected $translationFilesPath;
    protected $keys = [];

    public function __construct()
    {
        $this->translationFilesPath = resource_path() . '/assets/js/locale/lang';
    }

    public function index()
    {
        return response()->json([
            'translations' => $this->getAllTranslationsFromFile(),
            'message' => 'translation data'
        ]);
    }

    public function save(Request $request)
    {
        $translations = $request->get('translations');
        if (empty($translations)) {
            return response()->json(['data' => [], 'message' => 'Invalid data']);
        }

        $resFr = $this->saveTranslationToFile('fr', $this->reverseKeyValueFormat($translations['fr'], 'fr'));
        $resEn = $this->saveTranslationToFile('en', $this->reverseKeyValueFormat($translations['en']));
        $resDe = $this->saveTranslationToFile('de', $this->reverseKeyValueFormat($translations['de']));
        $resEs = $this->saveTranslationToFile('es', $this->reverseKeyValueFormat($translations['es']));

        if (!$resEn || !$resFr || !$resDe || !$resEs) {
            return response()->json(['data' => [], 'message' => 'Error saving some data']);
        }

        return response()->json(['data' => 'send updated translation data', 'message' => 'translation saved successfully']);
    }

    protected function getCount()
    {
        //
    }

    protected function getAllTranslationsFromFile()
    {
        return [
            'fr' => $this->keyValueFormat($this->getTranslationFromFile('fr')),
            'en' => $this->keyValueFormat($this->getTranslationFromFile('en')),
            'de' => $this->keyValueFormat($this->getTranslationFromFile('de')),
            'es' => $this->keyValueFormat($this->getTranslationFromFile('es')),
        ];
    }

    protected function keyValueFormat($data)
    {
        $newData = [];
        foreach($data as $key => $value) {
            $tempValue = [];
            foreach($value as $key_1 => $value_1) {
                $tempValue[] = ['prevKey' => $key_1, 'key' => $key_1, 'value' => $value_1, 'disabled' => 'disabled'];
            }
            $newData[] = ['key' => $key, 'value' => $tempValue];
        }
        return $newData;
    }

    protected function reverseKeyValueFormat($data, $lang = null)
    {
        $newData = [];
        foreach ($data as $key => $value) {
            $tempValue = [];
            foreach ($value['value'] as $key_1 => $value_1) {
                if ($lang == 'fr') {
                    if ($value_1['key'] != $value_1['prevKey']) {
                        $this->keys[$value_1['prevKey']] = $value_1['key'];
                    }
                } else {
                    if (isset($this->keys[$value_1['key']]) && $value_1['key'] != $this->keys[$value_1['key']]) {
                        $value_1['key'] = $this->keys[$value_1['key']];
                    }
                }
                $tempValue[$value_1['key']] = $value_1['value'];
            }
            $newData[$value['key']] = $tempValue;
        }
        return $newData;
    }

    protected function getTranslationFromFile($lang = 'fr')
    {
        $translation = file_get_contents($this->translationFilesPath . "/{$lang}.json");
        return json_decode($translation);
    }

    protected function saveTranslationToFile($lang, $content)
    {
        return file_put_contents($this->translationFilesPath . "/{$lang}.json", json_encode($content));
    }
}
