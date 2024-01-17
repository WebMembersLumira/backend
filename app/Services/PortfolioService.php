<?php 

namespace App\Services;

use App\Repositories\PortfolioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioService
{
    private $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }
    
    public function getAllPortfolio()
    {
        return  $this->portfolioRepository->getAllPortfolio();
    }

    public function createDataPortfolio(Request $request)
    {
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $images->storeAs('public/image', $images->hashName());
      
            $dataPortfolio =[
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'images' => $images->hashName()
            ];
      
            return $this->portfolioRepository->createDataPortfolio($dataPortfolio);
          } else {
            return response()->json([
                'message' => 'Harap inputkan gambar!!'
            ], 400);
          }        
    }

     public function getDataPortfolioById($id)
     {
        return $this->portfolioRepository->getDataPortfolioById($id);
     }


     public function updateDataPortfolio(Request $request, $id)
     {
         $portfolio = $this->portfolioRepository->getDataPortfolioById($id);
     
         if (!$portfolio) {
             return response()->json([
                 'message' => 'Portfolio not found'
             ], 404);
         }
     
         if ($request->hasFile('images')) {
             // Hapus gambar lama jika ada
             if ($portfolio->images && Storage::exists('public/image/' . $portfolio->images)) {
                 Storage::delete('public/image/' . $portfolio->images);
             }
     
             $images = $request->file('images');
             $images->storeAs('public/image', $images->hashName());
     
             $dataPortfolio = [
                 'judul' => $request->judul,
                 'deskripsi' => $request->deskripsi,
                 'images' => $images->hashName()
             ];
     
             $this->portfolioRepository->updateDataPortfolio($dataPortfolio, $id);
     
             return response()->json([
                 'message' => 'Portfolio updated successfully'
             ], 200);
         } else {
             return response()->json([
                 'message' => 'Please input an image'
             ], 400);
         }   
     }
     

     

    public function deleteDataPortfolio($id)
    {
        return $this->portfolioRepository->deleteDataPortfolio($id);
    }
}