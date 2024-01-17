<?php 

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientRepository
{
  private $client; 

  public function __construct(Client $client)
  {
    $this->client = $client;
  }

  public function getAllDataClient()
  {
    return $this->client->get();
  }

  public function createDataClient(array $data)
  {
    return $this->client->create($data);
  }

  public function getDataClientById($id)
  {
    $dataClient = $this->client->find($id);
    return $dataClient;
  }

  public function updateDataClient(array $data, $id)
  {
    $dataClient = $this->client->find($id);
    $dataClient->update($data);

    return $dataClient;
  }

  public function deleteDataClient($id)
  {
    $dataClient = $this->client->find($id);
    $dataClient->delete();
    return "Data berhasil di hapus";
  }
}