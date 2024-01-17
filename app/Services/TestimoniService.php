<?php 

namespace App\Services;

use App\Repositories\TestimoniRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimoniService
{
  private $testimoniRepository;

  public function __construct(TestimoniRepository $testimoniRepository)
  {
    $this->testimoniRepository = $testimoniRepository;
  }

  public function getAllDataTesti()
  {
    return $this->testimoniRepository->getAllDataTesti();
  }

  public function createDataTesti(Request $request)
  {
    if ($request->hasFile('images')) {
      $images = $request->file('images');
      $images->storeAs('public/image', $images->hashName());
      $dataTesti = [
        'nama' => $request->nama,
        'profesi' => $request->profesi,
        'text' => $request->text,
        'images' => $images->hashName()
      ];

      return $this->testimoniRepository->createDataTesti($dataTesti);
    } else {
      return response()->json([
          'message' => 'Harap inputkan gambar!!'
      ], 400);
    }
  }

  public function getDataTestiById($id)
  {
    return $this->testimoniRepository->getDataTestiById($id);
  }

  public function updateDataTesti(Request $request, $id)
  {
      $testimoni = $this->testimoniRepository->getDataTestiById($id);

      if (!$testimoni) {
          return response()->json([
              'message' => 'testimoni not found'
          ], 404);
      }

      if ($request->hasFile('images')) {
          // Hapus gambar lama jika ada
          if ($testimoni->images && Storage::exists('public/image/' . $testimoni->images)) {
              Storage::delete('public/image/' . $testimoni->images);
          }

          $images = $request->file('images');
          $images->storeAs('public/image', $images->hashName());

          $dataTesti = [
              'nama' => $request->nama,
              'profesi' => $request->profesi,
              'text' => $request->text,
              'images' => $images->hashName()
          ];

          $this->testimoniRepository->updateDataTesti($dataTesti, $id);

          return response()->json([
              'message' => 'testimoni updated successfully'
          ], 200);
      } else {
          $dataTesti = [
            'nama' => $request->nama,
            'profesi' => $request->profesi,
            'text' => $request->text
        ];

        $this->testimoniRepository->updateDataTesti($dataTesti, $id);

        return response()->json([
            'message' => 'testimoni updated successfully'
        ], 200);
      }   
  }

  public function deleteDataTesti($id)
  {
    return $this->testimoniRepository->deleteDataTesti($id);
  }
}