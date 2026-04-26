<?php

namespace App\Services;

use Spatie\PdfToText\Pdf;
use Illuminate\Support\Facades\Log;

class CvParserService
{
    /**
     * Parse a PDF file and return a structured JSON with extracted data.
     * 
     * @param string $pdfPath
     * @return array
     */
    public function parsePdf(string $pdfPath): array
    {
        try {
            // Extracción cruda del PDF a Texto usando poppler-utils
            $text = Pdf::getText($pdfPath);
            
            // Simulación de envío a un LLM (OpenAI/Gemini) para estructurar datos.
            // En una implementación real, aquí se llamaría a OpenAI::chat()->create(...)
            return $this->simulateAiParsing($text);

        } catch (\Exception $e) {
            Log::error("Error parsing CV: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Fake AI parser that attempts to find basic patterns or return dummy data
     * for the purpose of the prototype.
     */
    private function simulateAiParsing(string $text): array
    {
        // Fallback básico/dummy para simular el comportamiento de la IA estructurando el JSON
        $parsed = [
            'name' => 'Candidato Detectado',
            'email' => 'candidato@ejemplo.com',
            'phone' => '+34 600 000 000',
            'english_level' => 'B2',
            'skills' => ['Laravel', 'PHP', 'Docker'],
            'experience_years' => 3,
            'raw_extracted_text' => substr($text, 0, 500) . '...',
        ];

        // Intento muy simple de extraer un email real si existe en el PDF
        preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $text, $matches);
        if (!empty($matches[0])) {
            $parsed['email'] = $matches[0];
            $parsed['name'] = ucfirst(explode('@', $matches[0])[0]);
        }

        return $parsed;
    }
}
