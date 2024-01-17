<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TestimoniService;

class TestimoniController extends Controller
{
    private $testimoniService;

    public function __construct(TestimoniService $testimoniService)
    {
        $this->testimoniService = $testimoniService;
    }

    public function getAllDataTesti()
    {
        return response()->json([
            'data' => $this->testimoniService->getAllDataTesti()
        ]);
    }

    public function createDataTesti(Request $request)
    {
        $validateData = [
            'nama' => 'required|string',
            'profesi' => 'required|string',
            'text' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        return response()->json([
            'data' => $this->testimoniService->createDataTesti($request)
        ]);
    }

    public function getDataTestiById($id)
    {
        return response()->json([
            'data' => $this->testimoniService->getDataTestiById($id)
        ]);
    }

    public function updateDataTesti(Request $request, $id)
    {
        $validateData = [
            'nama' => 'required|string',
            'profesi' => 'required|string',
            'text' => 'required',
            'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        return response()->json([
            'data' => $this->testimoniService->updateDataTesti($request, $id)
        ]);
    }

    public function deleteDataTesti($id)
    {
        return response()->json([
            'message' => $this->testimoniService->deleteDataTesti($id)
        ]);
    }
}
