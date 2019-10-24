<?php
/*
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// sample-metadata
//   title: Translating Text
//   description: Translating Text
//   usage: php v3_translate_text.php [--text "Hello, world!"] [--target_language fr] [--project_id "[Google Cloud Project ID]"]
require_once __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 3 || count($argv) > 3) {
    return printf("Usage: php %s TEXT TARGET_LANGUAGE PROJECT_ID\n", __FILE__);
}
list($_, $text, $targetLanguage, $projectId) = $argv;

// [START translate_v3_translate_text]
use Google\Cloud\Translate\V3\TranslationServiceClient;

/**
 * Translating Text.
 *
 * @param string $text           The content to translate in string format
 * @param string $targetLanguage Required. The BCP-47 language code to use for translation.
 */
$translationServiceClient = new TranslationServiceClient();

// $text = 'Hello, world!';
// $targetLanguage = 'fr';
// $projectId = '[Google Cloud Project ID]';
$contents = [$text];
$formattedParent = $translationServiceClient->locationName($projectId, 'global');

try {
    $response = $translationServiceClient->translateText($contents, $targetLanguage, $formattedParent);
    // Display the translation for each input text provided
    foreach ($response->getTranslations() as $translation) {
        printf('Translated text: %s' . PHP_EOL, $translation->getTranslatedText());
    }
} finally {
    $translationServiceClient->close();
}

// [END translate_v3_translate_text]