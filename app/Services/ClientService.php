<?php 

namespace App\Services;

use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientService
{
  private $clientRepository;

  public function __construct(ClientRepository $clientRepository)
  {
    $this->clientRepository = $clientRepository;
  }

  public function getAllDataClient()
  {
    return $this->clientRepository->getAllDataClient();
  }

  public function createDataClient(Request $request)
  {
    if ($request->hasFile('images')) {
      $images = $request->file('images');
      $images->storeAs('public/image', $images->hashName());

      $dataClient = [
        'images' => $images->hashName()
      ];

      return $this->clientRepository->createDataClient($dataClient);
    } else {
      return response()->json([
          'message' => 'Harap inputkan gambar!!'
      ], 400);
    }
  }

  public function getDataClientById($id)
  {
    return $this->clientRepository->getDataClientById($id);
  }

  public function updateDataClient(Request $request, $id)
  {
    if ($request->hasFile('images')) {
      $images = $request->file('images');
      $images->storeAs('public/image', $images->hashName());

      $dataClient = [
        'images' => $images->hashName()
      ];

      return $this->clientRepository->updateDataClient($dataClient, $id);
    } else {
      return response()->json([
          'message' => 'Harap inputkan gambar!!'
      ], 400);
  }
  }

  public function deleteDataClient($id)
  {
    return $this->clientRepository->deleteDataClient($id);
  }
}