<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\CvParserService;
use App\Models\CandidateProfile;
use App\Models\Application;

class CvUploader extends Component
{
    use WithFileUploads;

    public $jobOfferId;
    public $cv;
    public $isParsing = false;
    public $parsedData = null;

    public function mount($jobOfferId)
    {
        $this->jobOfferId = $jobOfferId;
    }

    public function updatedCv()
    {
        $this->validate([
            'cv' => 'required|mimes:pdf|max:10240', // 10MB max
        ]);
        
        $this->isParsing = true;
    }

    public function processCv(CvParserService $parser)
    {
        $this->validate([
            'cv' => 'required|mimes:pdf|max:10240',
        ]);

        // Guardar temporalmente para que pdftotext pueda leerlo
        $path = $this->cv->store('temp_cvs');
        $fullPath = storage_path('app/' . $path);

        try {
            $this->parsedData = $parser->parsePdf($fullPath);
            
            // Cleanup
            unlink($fullPath);
            $this->isParsing = false;

        } catch (\Exception $e) {
            $this->addError('cv', 'No se pudo leer el PDF. Por favor, asegúrate de que es un PDF válido con texto.');
            $this->isParsing = false;
        }
    }

    public function confirmApplication()
    {
        if (!$this->parsedData) {
            return;
        }

        // Crear o actualizar el perfil
        $profile = CandidateProfile::firstOrCreate(
            ['email' => $this->parsedData['email']],
            [
                'name' => $this->parsedData['name'],
                'phone' => $this->parsedData['phone'] ?? null,
                'english_level' => $this->parsedData['english_level'] ?? null,
                'parsed_content' => $this->parsedData,
            ]
        );

        // Crear la aplicación (si no existe para esta oferta)
        $application = Application::firstOrCreate([
            'candidate_profile_id' => $profile->id,
            'job_offer_id' => $this->jobOfferId,
        ], [
            'status' => 'new',
            'test_score' => null, // Esto se llenaría después si se hace test
        ]);

        // Redirigir o notificar
        $this->dispatch('application-submitted');
        
        // Reset component state
        $this->reset(['cv', 'parsedData', 'isParsing']);
    }

    public function render()
    {
        return view('livewire.cv-uploader');
    }
}
