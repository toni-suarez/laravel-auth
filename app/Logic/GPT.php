<?php
namespace App\Logic;

use Illuminate\Support\Facades\Http;

class GPT
{
    public $url = 'https://api.openai.com/v1/chat/completions';
    public $response;

    public $input;
    public $limit;

    /**
     * Generates
     *
     * @return GPT
     */
    public static function generate()
    {
        return new self();
    }


    /**
     * Sets the input
     *
     * @param string $text
     * @return GPT
     */
    public function input($text)
    {
        $this->input = $text;
        return $this;
    }

    /**
     * Set the limit
     *
     * @param int $limit
     * @return GPT
     */
    public function limit($limit = 50)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Handle Request
     *
     * @return GPT
     */
    public function get()
    {
        $this->response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . config('openai.secret_key')
        ])->post($this->url,[
            "model" => "gpt-3.5-turbo-0125",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "
                        Ziel: Erstelle eine kurze, persönliche Beschreibung eines Users aus einem JSON-Input.; Anweisung: Lies den bereitgestellten JSON-Input und extrahiere relevante Informationen wie Name, Wohnort und optionale Felder wie Größe, Gewicht und Größe. Verwende diese Informationen, um eine kurze Beschreibung in der Ich-Perspektive zu verfassen.
                        Details: Die Beschreibung sollte freundlich und informativ sein und dem Leser einen kurzen Einblick in die Person geben. Bitte in europäischen Maßeinheiten arbeiten. Zum Beispiel Größen mit meter und Gewicht mit kg.
                        Wichtig: Die Beschreibung sollte nicht mehr als {$this->limit} Wörter lang sein und keine sensiblen Daten wie IDs enthalten. Bitte keine Lückentext. Sauberen Text bitte.
                    "
                ],
                [
                    "role" => "user",
                    "content" => "Input-JSON: {$this->input}"
                ],
            ]
        ])->json();

        return $this;
    }

    /**
     * Retrieve the response in text format
     *
     * @return string
     */
    public function toString()
    {
        if (!$this->response || !is_array($this->response)) {
            return;
        }

        return $this->response['choices'][0]['message']['content'];
    }

    /**
     * Retrieve the response as string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * Determin wheater an API Key exists
     *
     * @return boolean
     */
    public static function enabled()
    {
        return config('openai.secret_key') ? true : false;
    }
}
