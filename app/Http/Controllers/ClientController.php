<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientService;


class ClientController extends Controller
{
    private $clientService;
    public function __construct(ClientService $clientService)
    {
        $this->clientService =$clientService;
    }

    public function getAllDataClient()
    {
        return response()->json([
            'data' => $this->clientService->getAllDataClient()
        ]);
    }

    public function createDataClient(Request $request)
    {
        $validatedData = $request->validate([
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        return response()->json([
            'data' => $this->clientService->createDataClient($request)
        ]);
    }

    public function getDataClientById($id)
    {
        return response()->json([
            'data' => $this->clientService->getDataClientById($id)
        ]);
    }

    public function updateDataClient(Request $request, $id)
    {
        return response()->json([
            'data' => $this->clientService->updateDataClient($request, $id)
        ]);
    }

    public function deleteDataClient($id)
    {
        return response()->json([
            'message' => $this->clientService->deleteDataClient($id)
        ]);
    }

}
