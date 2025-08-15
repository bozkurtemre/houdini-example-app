<?php

namespace App\Controller;

use Houdini\HoudiniBundle\Service\TelemetryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{
    public function __construct(private TelemetryService $telemetry)
    {
    }

    #[Route('/test', name: 'app_test')]
    public function index(): JsonResponse
    {
        $this->telemetry->captureMessage('User login successful', 'info', [
            'user_id' => 123,
            'login_method' => 'oauth'
        ]);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }

    #[Route('/test', name: 'app_test_post', methods: ['POST'])]
    public function postTest(): JsonResponse
    {
        return $this->json([
            'message' => 'This is a POST request to the test endpoint.',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
