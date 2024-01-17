<?php 

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Testimoni;

class TestimoniRepository
{
  private $testimoni;

  public function __construct(Testimoni $testimoni)
  {
    $this->testimoni = $testimoni;
  }

  public function getAllDataTesti()
  {
    return $this->testimoni->get();
  }

  public function createDataTesti(array $data)
  {
    return $this->testimoni->create($data);
  }

  public function getDataTestiById($id)
  {
    $dataTesti = $this->testimoni->find($id);

    return $dataTesti;
  }

  public function updateDataTesti(array $data, $id)
  {
    $dataTesti = $this->testimoni->find($id);
    $dataTesti->update($data);

    return $dataTesti;
  }

  public function deleteDataTesti($id)
  {
    $dataTesti = $this->testimoni->find($id);
    $dataTesti->delete();
    return "data berhasil dihapus!";
  }
}